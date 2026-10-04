<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminReferralController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $users = User::withCount('referrals')
            ->whereNotNull('referral_code')
            ->orderBy('created_at')
            ->paginate(25)
            ->withQueryString();

        return view('admin.referrals', [
            'pageTitle' => 'Referrals | Admin Panel',
            'users' => $users,
        ]);
    }

    public function tree(User $user)
    {
        $refs = $user->referrals()->get();

        return view('admin.referral-tree', [
            'pageTitle' => 'Referral tree: ' . $user->name . ' | Admin Panel',
            'user' => $user,
            'refs' => $refs,
        ]);
    }

    public function adjustBonus(Request $request, User $user)
    {
        $data = $request->validate([
            'type' => ['required', 'in:bonus,referral_bonus'],
            'action' => ['required', 'in:add,subtract'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $amount = round((float) $data['amount'], 2);

        if ($data['action'] === 'add') {
            $user->increment($data['type'], $amount);
        } else {
            $user->decrement($data['type'], $amount);
            $amount = -$amount;
        }

        $label = $data['type'] === 'bonus' ? 'Bonus' : 'Referral bonus';

        Transaction::create([
            'user_id' => $user->id,
            'type' => $amount >= 0 ? 'credit' : 'debit',
            'title' => ($amount >= 0 ? 'Bonus added: ' : 'Bonus removed: ') . $label,
            'amount' => abs($amount),
            'status' => 'completed',
            'reference' => 'BNS-' . strtoupper(Str::random(10)),
            'note' => $data['note'] ?? null,
        ]);

        $this->logActivity('referral.adjust_bonus', 'User', $user->id,
            'Adjusted ' . $label . ' for ' . $user->name . ' by $' . number_format(abs($amount), 2) . ' (' . $data['action'] . ')',
            ['user_id' => $user->id, 'type' => $data['type'], 'amount' => abs($amount), 'action' => $data['action']]);

        return back()->with('success', $label . ' updated for ' . $user->name . '.');
    }
}
