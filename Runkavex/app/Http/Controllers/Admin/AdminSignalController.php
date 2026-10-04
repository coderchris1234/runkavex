<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SignalPlan;
use App\Models\SignalSubscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminSignalController extends Controller
{
    public function subscriptions(Request $request)
    {
        $query = SignalSubscription::with('user', 'plan');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        return view('admin.signals.subscriptions', [
            'pageTitle' => 'Signal Subscriptions | Admin Panel',
            'statusFilter' => $request->status ?? 'all',
            'subscriptions' => $query->latest()->paginate(30)->withQueryString(),
        ]);
    }

    public function approve(SignalSubscription $subscription)
    {
        if ($subscription->status !== 'pending') {
            return back()->with('error', 'This subscription is not pending.');
        }

        $subscription->update([
            'status' => 'active',
            'started_at' => now(),
            'ends_at' => now()->addWeeks($subscription->duration),
        ]);

        $user = $subscription->user;
        if ((float) $user->balance < (float) $subscription->price) {
            $subscription->update(['status' => 'pending']);

            return back()->with('error', 'Insufficient balance to activate this subscription.');
        }

        $user->decrement('balance', (float) $subscription->price);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'debit',
            'title' => 'Signal subscription: ' . $subscription->plan_name,
            'amount' => $subscription->price,
            'status' => 'completed',
            'note' => 'Activated by admin',
        ]);

        return back()->with('success', 'Subscription "' . $subscription->plan_name . '" activated.');
    }

    public function reject(SignalSubscription $subscription)
    {
        if ($subscription->status !== 'pending') {
            return back()->with('error', 'This subscription is not pending.');
        }

        $subscription->update(['status' => 'rejected']);

        return back()->with('success', 'Subscription request rejected.');
    }

    public function plans()
    {
        return view('admin.signals.plans', [
            'pageTitle' => 'Signal Plans | Admin Panel',
            'plans' => SignalPlan::orderBy('id')->get(),
        ]);
    }

    public function storePlan(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'duration' => ['required', 'integer', 'min:1'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:2000'],
        ]);

        SignalPlan::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'short_description' => $data['short_description'] ?? null,
            'benefits' => json_encode(array_filter(array_map('trim', explode("\n", $data['benefits'] ?? '')))),
            'is_active' => true,
        ]);

        return back()->with('success', 'Signal plan created.');
    }

    public function updatePlan(Request $request, SignalPlan $plan)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'duration' => ['required', 'integer', 'min:1'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $plan->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'short_description' => $data['short_description'] ?? null,
            'benefits' => json_encode(array_filter(array_map('trim', explode("\n", $data['benefits'] ?? '')))),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Signal plan updated.');
    }

    public function destroyPlan(SignalPlan $plan)
    {
        $plan->delete();

        return back()->with('success', 'Signal plan deleted.');
    }
}