<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminDepositController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = Deposit::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('admin.deposits', [
            'pageTitle' => 'Deposits | Admin Panel',
            'statusFilter' => $request->status,
            'deposits' => $query->latest()->paginate(30)->withQueryString(),
            'users' => User::orderBy('name')->get(['id', 'name', 'email']),
        ]);
    }

    public function approve(Request $request, Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->with('error', 'This deposit has already been processed.');
        }

        $user = $deposit->user;
        $user->increment('balance', (float) $deposit->amount);

        $deposit->update([
            'status' => 'approved',
            'note' => $request->input('note') ?? $deposit->note,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'credit',
            'title' => 'Deposit approved: ' . $deposit->method,
            'amount' => $deposit->amount,
            'status' => 'completed',
            'reference' => 'DEP-APPROVED-' . strtoupper(Str::random(10)),
            'note' => $request->input('note'),
        ]);

        $this->logActivity('deposit.approve', 'Deposit', $deposit->id,
            'Approved deposit of $' . number_format($deposit->amount, 2) . ' for ' . $user->name,
            ['user_id' => $user->id, 'amount' => $deposit->amount]);

        return back()->with('success', 'Deposit of $' . number_format($deposit->amount, 2) . ' approved and credited.');
    }

    /**
     * Streams the uploaded proof of payment.
     *
     * Served through an authenticated route rather than a public disk URL so the
     * file is never world-readable and works on shared hosting, where
     * `storage:link` symlinks are often unavailable.
     */
    public function proof(Request $request, Deposit $deposit)
    {
        abort_if(! $deposit->proof, 404);

        // Reject any stored path that tries to escape the proofs directory.
        if (! Str::startsWith($deposit->proof, 'proofs/') || Str::contains($deposit->proof, '..')) {
            abort(404);
        }

        if (! Storage::disk('public')->exists($deposit->proof)) {
            abort(404);
        }

        // Note the signature: response($path, $name, $headers, $disposition).
        $filename = 'deposit-' . $deposit->id . '-' . Str::random(8)
            . '.' . pathinfo($deposit->proof, PATHINFO_EXTENSION);

        return Storage::disk('public')->response(
            $deposit->proof,
            $filename,
            [],
            $request->boolean('download') ? 'attachment' : 'inline'
        );
    }

    public function reject(Request $request, Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->with('error', 'This deposit has already been processed.');
        }

        $deposit->update([
            'status' => 'rejected',
            'note' => $request->input('note'),
        ]);

        $this->logActivity('deposit.reject', 'Deposit', $deposit->id,
            'Rejected deposit of $' . number_format($deposit->amount, 2) . ' for ' . $deposit->user->name);

        return back()->with('success', 'Deposit request rejected.');
    }
}