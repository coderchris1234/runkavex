@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ editting: null }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Investment Plans</h2>
            <p class="text-sm text-content-secondary mt-1">Trading plans shown on the investment pages</p>
        </div>
        <button @click="editting = { id: null, name: '', min_amount: '', max_amount: '', interest_rate: '', duration: 1, color: '#16C79A', is_active: 1 }" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ New Plan</button>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($plans as $plan)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 flex flex-col">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-content-primary" style="color: {{ $plan->color }}">{{ $plan->name }}</h3>
                        <p class="text-2xl font-extrabold text-content-primary mt-1">{{ $plan->interest_rate }}%<span class="text-sm font-medium text-content-tertiary"> / {{ $plan->duration }} days</span></p>
                    </div>
                    <span class="px-2 py-0.5 text-xs font-medium rounded {{ $plan->is_active ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $plan->is_active ? 'Active' : 'Hidden' }}</span>
                </div>
                <p class="text-sm text-content-secondary mt-2">${{ number_format($plan->min_amount, 0) }} – {{ $plan->max_amount ? '$' . number_format($plan->max_amount, 0) : 'unlimited' }}</p>
                <div class="flex gap-2 mt-4 pt-4 border-t border-surface-border">
                    <button @click='editting = { id: {{ $plan->id }}, name: "{{ addslashes($plan->name) }}", min_amount: "{{ $plan->min_amount }}", max_amount: "{{ $plan->max_amount }}", interest_rate: "{{ $plan->interest_rate }}", duration: {{ $plan->duration }}, color: "{!! addslashes($plan->color) !!}", is_active: {{ $plan->is_active ? 1 : 0 }} }'
                        class="flex-1 px-3 py-2 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">Edit</button>
                    <form method="POST" action="{{ url('/admin/plans/' . $plan->id) }}" @submit="confirm('Delete this plan?')" x-data>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="editting !== null" x-cloak class="fixed inset-0 bg-black/60 z-40"></div>
    <div x-show="editting !== null" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-lg bg-surface-raised border border-surface-border rounded-xl p-6">
            <h3 class="text-lg font-bold text-content-primary mb-4" x-text="editting.id ? 'Edit Plan' : 'New Plan'"></h3>
            <form :action="editting.id ? '/admin/plans/' + editting.id : '/admin/plans'" method="POST" class="space-y-4">
                @csrf
                <template x-if="editting.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Plan name</label>
                        <input type="text" name="name" x-model="editting.name" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Interest rate (%)</label>
                        <input type="number" name="interest_rate" x-model="editting.interest_rate" step="0.01" min="0" max="100" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Min amount</label>
                        <input type="number" name="min_amount" x-model="editting.min_amount" step="0.01" min="0" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Max amount</label>
                        <input type="number" name="max_amount" x-model="editting.max_amount" step="0.01" min="0" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Duration (days)</label>
                        <input type="number" name="duration" x-model="editting.duration" min="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Accent color</label>
                        <input type="color" name="color" x-model="editting.color" class="w-full h-10 bg-surface-overlay border border-surface-border rounded-lg cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Visibility</label>
                        <select name="is_active" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none focus:border-primary">
                            <option value="1" x-bind:selected="!editting.id || editting.is_active === 1 || editting.is_active === true">Active (shown to users)</option>
                            <option value="0" x-bind:selected="editting.id && (editting.is_active === 0 || editting.is_active === false)">Hidden</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Plan</button>
                    <button type="button" @click="editting = null" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection