@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ editting: null }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Signal Plans</h2>
            <p class="text-sm text-content-secondary mt-1">Pricing plans offered on the signal pages</p>
        </div>
        <button @click="editting = { id: null, name: '', price: '', duration: 1, short_description: '', benefits_text: '' }" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ New Plan</button>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($plans as $plan)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 flex flex-col">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-content-primary">{{ $plan->name }}</h3>
                        <p class="text-2xl font-extrabold text-primary mt-1">${{ number_format($plan->price, 0) }}<span class="text-sm font-medium text-content-tertiary"> / {{ $plan->duration }} wk</span></p>
                    </div>
                    <span class="px-2 py-0.5 text-xs font-medium rounded {{ $plan->is_active ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $plan->is_active ? 'Active' : 'Hidden' }}</span>
                </div>
                <p class="text-sm text-content-secondary mt-2">{{ $plan->short_description }}</p>
                <ul class="mt-4 space-y-1.5 flex-1">
                    @foreach($plan->benefitsList() as $benefit)
                        <li class="flex items-center gap-2 text-sm text-content-secondary">
                            <span class="text-gain">&#10003;</span> {{ $benefit }}
                        </li>
                    @endforeach
                </ul>
                <div class="flex gap-2 mt-4">
                    <button @click='editting = { id: {{ $plan->id }}, name: "{{ addslashes($plan->name) }}", price: {{ $plan->price }}, duration: {{ $plan->duration }}, short_description: "{!! addslashes($plan->short_description ?? '') !!}", benefits_text: {!! json_encode(implode("\n", $plan->benefitsList())) !!} }'
                        class="flex-1 px-3 py-2 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">Edit</button>
                    <form method="POST" action="{{ url('/admin/signals/plans/' . $plan->id) }}" @submit="confirm('Delete this plan?')" x-data>
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
            <form :action="editting.id ? '/admin/signals/plans/' + editting.id : '/admin/signals/plans'" method="POST" class="space-y-4">
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
                        <label class="block text-sm font-medium text-content-secondary mb-1">Price ($)</label>
                        <input type="number" name="price" x-model="editting.price" step="0.01" min="0.01" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Duration (weeks)</label>
                        <input type="number" name="duration" x-model="editting.duration" min="1" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
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
                    <label class="block text-sm font-medium text-content-secondary mb-1">Short description</label>
                    <input type="text" name="short_description" x-model="editting.short_description" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Benefits (one per line)</label>
                    <textarea name="benefits" x-model="editting.benefits_text" rows="4" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary"></textarea>
                    <p class="text-xs text-content-tertiary mt-1">Each line becomes a bullet point on the card.</p>
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