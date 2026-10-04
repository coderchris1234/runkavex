@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ editting: null }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Loan Products</h2>
            <p class="text-sm text-content-secondary mt-1">Loan plans offered on the loans apply page</p>
        </div>
        <button @click="editting = { id: null, name: '', description: '', min_amount: 500, max_amount: 10000, interest_rate: 5, interest_type: 'simple', min_duration: 1, max_duration: 12, processing_fee: 1, min_account_balance: 0, requires_collateral: 0, collateral_percentage: null, is_active: 1 }"
            class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ New Product</button>
    </div>

    @if(session('success'))
        <div class="p-3 rounded-lg bg-gain/10 border border-gain/20 text-gain text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($plans as $plan)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 flex flex-col">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-content-primary">{{ $plan->name }}</h3>
                        <p class="text-xs text-content-tertiary mt-0.5">{{ str_replace(' ', ' / ', ucwords($plan->interest_type)) }} interest</p>
                    </div>
                    <span class="px-2 py-0.5 text-xs font-medium rounded {{ $plan->is_active ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $plan->is_active ? 'Active' : 'Hidden' }}</span>
                </div>
                <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                    <div class="bg-surface-overlay rounded-lg px-3 py-2">
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Range</p>
                        <p class="font-semibold text-content-primary">${{ number_format($plan->min_amount) }} – ${{ number_format($plan->max_amount) }}</p>
                    </div>
                    <div class="bg-surface-overlay rounded-lg px-3 py-2">
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Rate</p>
                        <p class="font-semibold text-content-primary">{{ $plan->interest_rate }}% {{ $plan->interest_type }}</p>
                    </div>
                    <div class="bg-surface-overlay rounded-lg px-3 py-2">
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Duration</p>
                        <p class="font-semibold text-content-primary">{{ $plan->min_duration }}–{{ $plan->max_duration }} mo</p>
                    </div>
                    <div class="bg-surface-overlay rounded-lg px-3 py-2">
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Processing Fee</p>
                        <p class="font-semibold text-content-primary">{{ $plan->processing_fee }}%</p>
                    </div>
                </div>
                <p class="text-sm text-content-secondary mt-3">{{ $plan->description }}</p>
                <div class="mt-2 text-xs text-content-tertiary">
                    Min balance ${{ number_format($plan->min_account_balance) }}
                    @if($plan->requires_collateral)
                        &middot; Collateral {{ $plan->collateral_percentage }}%
                    @endif
                </div>
                <div class="flex gap-2 mt-4">
                    <button @click='editting = { id: {{ $plan->id }}, name: "{{ addslashes($plan->name) }}", description: "{!! addslashes($plan->description ?? '') !!}", min_amount: {{ $plan->min_amount }}, max_amount: {{ $plan->max_amount }}, interest_rate: {{ $plan->interest_rate }}, interest_type: "{{ $plan->interest_type }}", min_duration: {{ $plan->min_duration }}, max_duration: {{ $plan->max_duration }}, processing_fee: {{ $plan->processing_fee }}, min_account_balance: {{ $plan->min_account_balance }}, requires_collateral: {{ $plan->requires_collateral ? 1 : 0 }}, collateral_percentage: {{ $plan->collateral_percentage ?? 'null' }}, is_active: {{ $plan->is_active ? 1 : 0 }} }'
                        class="flex-1 px-3 py-2 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">Edit</button>
                    <form method="POST" action="{{ route('admin.loan-plans.destroy', $plan) }}" @submit="confirm('Delete this loan product?')" x-data>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface-raised border border-surface-border rounded-xl p-8 text-center text-content-tertiary text-sm">No loan products yet.</div>
        @endforelse
    </div>

    <div x-show="editting !== null" x-cloak class="fixed inset-0 bg-black/60 z-40"></div>
    <div x-show="editting !== null" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-lg bg-surface-raised border border-surface-border rounded-xl p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-content-primary mb-4" x-text="editting.id ? 'Edit Product' : 'New Product'"></h3>
            <form :action="editting.id ? '/admin/loan-plans/' + editting.id : '/admin/loan-plans'" method="POST" class="space-y-4">
                @csrf
                <template x-if="editting.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Name</label>
                        <input type="text" name="name" x-model="editting.name" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Interest Type</label>
                        <select name="interest_type" x-model="editting.interest_type" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                            <option value="simple">Simple</option>
                            <option value="compound">Compound</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Min Amount ($)</label>
                        <input type="number" name="min_amount" x-model="editting.min_amount" min="0" step="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Max Amount ($)</label>
                        <input type="number" name="max_amount" x-model="editting.max_amount" min="0" step="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Interest Rate (%)</label>
                        <input type="number" name="interest_rate" x-model="editting.interest_rate" min="0" step="0.01" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Processing Fee (%)</label>
                        <input type="number" name="processing_fee" x-model="editting.processing_fee" min="0" step="0.01" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Min Duration (months)</label>
                        <input type="number" name="min_duration" x-model="editting.min_duration" min="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Max Duration (months)</label>
                        <input type="number" name="max_duration" x-model="editting.max_duration" min="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Min Account Balance ($)</label>
                        <input type="number" name="min_account_balance" x-model="editting.min_account_balance" min="0" step="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Collateral %</label>
                        <input type="number" name="collateral_percentage" x-model="editting.collateral_percentage" min="0" step="1" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Requires Collateral</label>
                        <select name="requires_collateral" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                            <option value="1" x-bind:selected="editting.requires_collateral === 1 || editting.requires_collateral === true">Yes</option>
                            <option value="0" x-bind:selected="editting.requires_collateral === 0 || editting.requires_collateral === false">No</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Visibility</label>
                        <select name="is_active" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                            <option value="1" x-bind:selected="!editting.id || editting.is_active === 1 || editting.is_active === true">Active (shown to users)</option>
                            <option value="0" x-bind:selected="editting.id && (editting.is_active === 0 || editting.is_active === false)">Hidden</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Description</label>
                    <textarea name="description" x-model="editting.description" rows="2" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary"></textarea>
                </div>
                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" @click="editting = null" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-secondary hover:text-content-primary transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection