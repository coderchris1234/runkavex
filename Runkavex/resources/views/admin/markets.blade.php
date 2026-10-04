@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ editting: null }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Markets</h2>
            <p class="text-sm text-content-secondary mt-1">Trading assets shown on the markets &amp; trade pages</p>
        </div>
        <button @click="editting = { id: null, name: '', symbol: '', class: 'crypto', price: '', price_change: '', img: '', is_active: 1 }" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ New Asset</button>
    </div>

    @if(session('success'))
        <div class="p-3 rounded-lg bg-gain/10 border border-gain/20 text-gain text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="p-3 rounded-lg bg-loss/10 border border-loss/20 text-loss text-sm">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.markets') }}" class="flex flex-wrap gap-2">
        <select name="class" class="rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-primary px-3 py-2 focus:outline-none focus:border-primary">
            <option value="all" {{ $classFilter === 'all' ? 'selected' : '' }}>All classes</option>
            @foreach(['crypto', 'forex', 'stock', 'etf', 'index'] as $c)
                <option value="{{ $c }}" {{ $classFilter === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
            @endforeach
        </select>
        <input type="text" name="q" value="{{ $q }}" placeholder="Search name or symbol..." class="rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-primary px-3 py-2 placeholder-content-tertiary focus:outline-none focus:border-primary">
        <button type="submit" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-primary hover:bg-surface-border transition-colors">Filter</button>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-surface-border">
                    <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Class</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">Price</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">24h Change</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($markets as $market)
                    <tr class="hover:bg-surface-overlay/50 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($market->img)
                                    <img src="{{ $market->img }}" alt="" class="w-8 h-8 rounded-full bg-surface-overlay" loading="lazy">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-primary/15 text-primary flex items-center justify-center font-semibold text-xs">{{ strtoupper(substr($market->symbol, 0, 2)) }}</div>
                                @endif
                                <div>
                                    <span class="font-semibold text-content-primary">{{ $market->name }}</span>
                                    <span class="text-xs text-content-tertiary ml-1">{{ $market->symbol }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-surface-overlay text-content-secondary capitalize">{{ $market->class }}</span>
                        </td>
                        <td class="px-4 py-3 text-right font-medium text-content-primary">{{ $market->price ?? '—' }}</td>
                        <td class="px-4 py-3 text-right font-medium {{ $market->price_change && str_starts_with($market->price_change, '-') ? 'text-loss' : 'text-gain' }}">{{ $market->price_change ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-xs font-medium rounded {{ $market->is_active ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $market->is_active ? 'Active' : 'Hidden' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <button @click='editting = { id: {{ $market->id }}, name: "{{ addslashes($market->name) }}", symbol: "{{ addslashes($market->symbol) }}", class: "{{ $market->class }}", price: "{{ addslashes($market->price ?? '') }}", price_change: "{{ addslashes($market->price_change ?? '') }}", img: "{{ addslashes($market->img ?? '') }}", is_active: {{ $market->is_active ? 1 : 0 }} }'
                                    class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">Edit</button>
                                <form method="POST" action="{{ route('admin.markets.toggle', $market) }}">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">{{ $market->is_active ? 'Hide' : 'Show' }}</button>
                                </form>
                                <form method="POST" action="{{ route('admin.markets.destroy', $market) }}" @submit="confirm('Delete this asset?')" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-content-tertiary text-sm">No markets match your filter.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $markets->links() }}

    <div x-show="editting !== null" x-cloak class="fixed inset-0 bg-black/60 z-40"></div>
    <div x-show="editting !== null" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-lg bg-surface-raised border border-surface-border rounded-xl p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-content-primary mb-4" x-text="editting.id ? 'Edit Asset' : 'New Asset'"></h3>
            <form :action="editting.id ? '/admin/markets/' + editting.id : '/admin/markets'" method="POST" class="space-y-4">
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
                        <label class="block text-sm font-medium text-content-secondary mb-1">Symbol</label>
                        <input type="text" name="symbol" x-model="editting.symbol" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Class</label>
                        <select name="class" x-model="editting.class" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                            @foreach(['crypto', 'forex', 'stock', 'etf', 'index'] as $c)
                                <option value="{{ $c }}">{{ ucfirst($c) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Visibility</label>
                        <select name="is_active" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                            <option value="1" x-bind:selected="editting.is_active === 1 || editting.is_active === true">Active</option>
                            <option value="0" x-bind:selected="editting.is_active === 0 || editting.is_active === false">Hidden</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Price (as displayed)</label>
                        <input type="text" name="price" x-model="editting.price" placeholder="1,234.56" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">24h Change (as displayed)</label>
                        <input type="text" name="price_change" x-model="editting.price_change" placeholder="+2.09%" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Logo URL</label>
                    <input type="text" name="img" x-model="editting.img" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" @click="editting = null" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-secondary hover:text-content-primary transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection