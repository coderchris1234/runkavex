<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = Notification::with('user');

        if ($request->filled('scope')) {
            if ($request->scope === 'broadcast') {
                $query->where('is_broadcast', true);
            } elseif ($request->scope === 'targeted') {
                $query->where('is_broadcast', false)->whereNotNull('user_id');
            }
        }

        return view('admin.notifications', [
            'pageTitle' => 'Notifications | Admin Panel',
            'notifications' => $query->latest()->paginate(30)->withQueryString(),
            'users' => User::orderBy('name')->get(['id', 'name', 'email']),
            'scopeFilter' => $request->scope ?? '',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:2000'],
            'target' => ['required', 'in:all,user'],
            'user_ids' => ['nullable', 'array'],
            'user_ids.*' => ['exists:users,id'],
        ]);

        if ($data['target'] === 'all') {
            $userIds = User::pluck('id')->all();

            foreach ($userIds as $userId) {
                Notification::create([
                    'user_id' => $userId,
                    'title' => $data['title'],
                    'message' => $data['message'],
                    'type' => 'info',
                    'is_broadcast' => true,
                ]);
            }

            $count = count($userIds);
            $this->logActivity('notification.broadcast', 'Notification', null,
                'Broadcast notification to all users (' . $count . '): ' . $data['title'],
                ['count' => $count]);

            return back()->with('success', 'Notification broadcast to all ' . $count . ' users.');
        }

        $ids = $data['user_ids'] ?? [];
        foreach ($ids as $userId) {
            Notification::create([
                'user_id' => $userId,
                'title' => $data['title'],
                'message' => $data['message'],
                'type' => 'info',
                'is_broadcast' => false,
            ]);
        }

        $this->logActivity('notification.send', 'Notification', null,
            'Sent targeted notification to ' . count($ids) . ' user(s): ' . $data['title'],
            ['user_ids' => $ids]);

        return back()->with('success', 'Notification sent to ' . count($ids) . ' user(s).');
    }

    public function delete(Notification $notification)
    {
        $this->logActivity('notification.delete', 'Notification', $notification->id,
            'Deleted notification: ' . $notification->title);

        $notification->delete();

        return back()->with('success', 'Notification removed.');
    }
}
