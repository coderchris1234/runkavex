<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class AdminSupportController extends Controller
{
    public function index(Request $request)
    {
        $query = SupportTicket::with('user');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        return view('admin.support.index', [
            'pageTitle' => 'Support | Admin Panel',
            'statusFilter' => $request->status ?? 'all',
            'tickets' => $query->latest()->paginate(30)->withQueryString(),
        ]);
    }

    public function show(SupportTicket $ticket)
    {
        return view('admin.support.show', [
            'pageTitle' => 'Ticket #' . $ticket->reference . ' | Admin Panel',
            'ticket' => $ticket->load('user'),
        ]);
    }

    public function reply(Request $request, SupportTicket $ticket)
    {
        $data = $request->validate([
            'admin_reply' => ['required', 'string', 'max:5000'],
        ]);

        $ticket->update([
            'admin_reply' => $data['admin_reply'],
            'status' => 'replied',
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Reply sent to the user.');
    }

    public function close(SupportTicket $ticket)
    {
        $ticket->update(['status' => 'closed']);

        return back()->with('success', 'Ticket closed.');
    }
}