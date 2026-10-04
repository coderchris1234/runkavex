@extends('layouts.admin')

@section('content')

<div class="max-w-2xl space-y-6">
    <div>
        <a href="{{ route('admin.trades') }}" class="text-xs text-content-tertiary hover:text-content-primary mb-1 inline-block">&larr; Back to trades</a>
        <h2 class="text-xl font-bold text-content-primary">Create Trade</h2>
        <p class="text-sm text-content-secondary mt-1">Place a trade on behalf of a user</p>
    </div>

    @if($errors->any())
        <div class="bg-loss/10 border border-loss/20 text-loss rounded-lg px-4 py-3 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/trades/create') }}" class="bg-surface-raised border border-surface-border rounded-xl p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-content-secondary mb-1">User</label>
            <select name="user_id" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <option value="">Select a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">Asset</label>
                <select name="trading_asset_id" id="admin-asset-select" required
                    onchange="document.getElementById('admin-symbol-custom').value = ''; document.getElementById('admin-symbol-hidden').value = this.options[this.selectedIndex]?.dataset.symbol || ''; document.getElementById('admin-name-field').value = this.options[this.selectedIndex]?.dataset.name || '';"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    <option value="">Choose asset...</option>
                    @foreach($assets->groupBy('asset_class') as $class => $group)
                        <optgroup label="{{ ucfirst($class) }}">
                            @foreach($group as $asset)
                                <option value="{{ $asset['id'] }}" data-symbol="{{ $asset['symbol'] }}" data-name="{{ $asset['name'] }}">{{ $asset['symbol'] }} — {{ $asset['name'] }} ({{ $asset['price'] }})</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <input type="text" name="symbol" id="admin-symbol-custom" placeholder="Optional custom symbol (overrides selection)"
                    oninput="document.getElementById('admin-symbol-hidden').value = '';"
                    class="mt-2 w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
                <input type="hidden" name="symbol" id="admin-symbol-hidden">
                <p class="text-xs text-content-tertiary mt-1">Leave blank to use the selected asset's symbol.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">Name (optional)</label>
                <input type="text" name="name" id="admin-name-field" value="{{ old('name') }}" placeholder="e.g. Bitcoin" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
                <label class="block text-sm font-medium text-content-secondary mt-4 mb-1">Type</label>
                <select name="trade_type" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    <option value="binary" {{ old('trade_type', 'binary') === 'binary' ? 'selected' : '' }}>Binary</option>
                    <option value="spot" {{ old('trade_type') === 'spot' ? 'selected' : '' }}>Spot</option>
                    <option value="forex" {{ old('trade_type') === 'forex' ? 'selected' : '' }}>Forex</option>
                    <option value="crypto" {{ old('trade_type') === 'crypto' ? 'selected' : '' }}>Crypto</option>
                    <option value="stock" {{ old('trade_type') === 'stock' ? 'selected' : '' }}>Stock</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">Action</label>
                <select name="action" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    <option value="buy" {{ old('action', 'buy') === 'buy' ? 'selected' : '' }}>Buy</option>
                    <option value="sell" {{ old('action') === 'sell' ? 'selected' : '' }}>Sell</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">Amount ($)</label>
                <input type="number" name="amount" step="0.01" min="1" required value="{{ old('amount') }}" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">Leverage</label>
                <select name="leverage" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    @foreach([1, 2, 5, 10, 25, 50, 100, 200, 500] as $lev)
                        <option value="{{ $lev }}" {{ old('leverage', 1) == $lev ? 'selected' : '' }}>{{ $lev }}x</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">Duration (min, optional)</label>
                <input type="number" name="duration" min="1" placeholder="Leave empty for spot" value="{{ old('duration') }}" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm text-content-secondary">
            <input type="checkbox" name="demo" value="1" {{ old('demo') ? 'checked' : '' }} class="rounded border-surface-border accent-primary">
            Demo trade (no balance deduction)
        </label>

        <div class="flex gap-2 pt-1">
            <button type="submit" class="flex-1 px-4 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Place Trade</button>
        </div>
    </form>
</div>

@endsection