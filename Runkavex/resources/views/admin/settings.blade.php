@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Site Settings</h2>
        <p class="text-sm text-content-secondary mt-1">General platform settings shown to users</p>
    </div>

    <form method="POST" action="{{ route('admin.settings') }}" class="max-w-xl space-y-4">
        @csrf
        @foreach($settings as $setting)
            <div>
                <label class="block text-sm font-medium text-content-secondary mb-1">{{ $setting->label() }}</label>
                @if($setting->key === 'maintenance_mode')
                    <select name="maintenance_mode"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-sm text-content-primary focus:outline-none focus:border-primary">
                        <option value="0" {{ $setting->value === '0' ? 'selected' : '' }}>Maintenance Off (site live)</option>
                        <option value="1" {{ $setting->value === '1' ? 'selected' : '' }}>Maintenance On (503 shown to visitors)</option>
                    </select>
                    <p class="text-xs text-content-tertiary mt-1.5">Admins and the login page are always accessible. Clear the application cache after changing this setting.</p>
                @else
                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
                @endif
                @error($setting->key)
                    <p class="text-xs text-loss mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
        <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Settings</button>
    </form>
</div>

@endsection