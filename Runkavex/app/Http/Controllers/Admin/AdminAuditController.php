<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminAuditController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('admin');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('action', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($request->filled('admin')) {
            $query->where('admin_id', $request->admin);
        }

        return view('admin.audit', [
            'pageTitle' => 'Audit Log | Admin Panel',
            'logs' => $query->latest()->paginate(50)->withQueryString(),
            'actions' => AuditLog::distinct()->orderBy('action')->pluck('action')->values(),
            'selectedAction' => $request->action ?? '',
        ]);
    }
}