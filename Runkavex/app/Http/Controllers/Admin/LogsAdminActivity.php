<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait LogsAdminActivity
{
    protected function logActivity(string $action, ?string $entityType = null, $entityId = null, ?string $description = null, array $metadata = []): void
    {
        AuditLog::create([
            'admin_id' => Auth::guard('admin')->id(),
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
            'metadata' => $metadata ?: null,
            'ip' => request()->ip(),
        ]);
    }
}
