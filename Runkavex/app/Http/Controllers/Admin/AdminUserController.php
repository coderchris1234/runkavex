<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'admin') {
                $query->where('is_admin', true);
            }
        }

        return view('admin.users.index', [
            'pageTitle' => 'Users | Admin Panel',
            'users' => $query->withCount(['deposits', 'withdrawals'])->latest()->paginate(25)->withQueryString(),
        ]);
    }

    public function show(User $user)
    {
        $user->load(['deposits', 'withdrawals', 'investments', 'loans', 'trades', 'supportTickets']);

        return view('admin.users.show', [
            'pageTitle' => $user->name . ' | Admin Panel',
            'user' => $user,
            'transactions' => $user->transactions()->latest()->take(20)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username', 'regex:/^[a-zA-Z0-9_.-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'balance' => ['nullable', 'numeric', 'min:0'],
            'password' => ['required', 'string', 'min:6'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'country' => $data['country'] ?? null,
            'balance' => $data['balance'] ?? 0,
            'referral_code' => strtoupper(Str::random(8)),
            'password' => Hash::make($data['password']),
            'is_admin' => $request->boolean('is_admin'),
            'is_active' => true,
        ]);

        $this->logActivity('user.create', 'User', $user->id,
            'Created user ' . $user->name . ' (' . $user->email . ')'
            . ($user->is_admin ? ' with admin access' : ''));

        return redirect()->route('admin.users.show', $user)->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9_.-]+$/', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update($data);

        $this->logActivity('user.update', 'User', $user->id, 'Updated profile for ' . $user->name . ' (' . $user->email . ')');

        return back()->with('success', 'Profile updated.');
    }

    public function changePassword(Request $request, User $user)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user->update(['password' => Hash::make($data['password'])]);

        $this->logActivity('user.password_reset', 'User', $user->id, 'Reset password for ' . $user->name);

        return back()->with('success', 'Password updated.');
    }

    public function adjustBalance(Request $request, User $user)
    {
        $data = $request->validate([
            'type' => ['required', 'in:credit,debit'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        if ($data['type'] === 'debit' && $data['amount'] > (float) $user->balance) {
            return back()->withErrors(['amount' => 'Debit exceeds the user balance.']);
        }

        $amount = round((float) $data['amount'], 2);

        if ($data['type'] === 'credit') {
            $user->increment('balance', $amount);
        } else {
            $user->decrement('balance', $amount);
        }

        Transaction::create([
            'user_id' => $user->id,
            'type' => $data['type'],
            'title' => ($data['type'] === 'credit' ? 'Admin credit' : 'Admin debit') . ($data['note'] ? ': ' . $data['note'] : ''),
            'amount' => $amount,
            'status' => 'completed',
            'reference' => 'ADJ-' . strtoupper(Str::random(10)),
            'note' => 'Adjusted by ' . Auth::guard('admin')->user()->name,
        ]);

        $this->logActivity('user.balance_adjust', 'User', $user->id,
            'Adjusted balance for ' . $user->name . ' by ' . $data['type'] . ' $' . number_format($amount, 2),
            ['user_id' => $user->id, 'type' => $data['type'], 'amount' => $amount]);

        return back()->with('success', 'Balance updated (' . $data['type'] . ' $' . number_format($amount, 2) . ').');
    }

    public function toggleActive(User $user)
    {
        if ($user->is_admin && $user->is_active) {
            return back()->with('error', 'You cannot deactivate an admin account.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        $this->logActivity($user->is_active ? 'user.activate' : 'user.deactivate', 'User', $user->id,
            ($user->is_active ? 'Activated' : 'Deactivated') . ' user ' . $user->name);

        return back()->with('success', $user->name . ' is now ' . ($user->is_active ? 'active' : 'deactivated') . '.');
    }

    public function toggleAdmin(User $user)
    {
        if (Auth::guard('admin')->id() === $user->id) {
            return back()->with('error', 'You cannot remove your own admin access.');
        }

        $user->update(['is_admin' => ! $user->is_admin]);

        $this->logActivity($user->is_admin ? 'user.grant_admin' : 'user.revoke_admin', 'User', $user->id,
            ($user->is_admin ? 'Granted' : 'Revoked') . ' admin access for ' . $user->name);

        return back()->with('success', 'Admin access ' . ($user->is_admin ? 'granted' : 'revoked') . ' for ' . $user->name . '.');
    }
}