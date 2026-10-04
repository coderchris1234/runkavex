<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use Illuminate\Http\Request;

class AdminMarketController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $markets = Market::query()
            ->when($request->filled('class') && $request->class !== 'all', fn ($q) => $q->where('class', $request->class))
            ->when($request->filled('q'), function ($q) use ($request) {
                $q->where(fn ($w) => $w->where('name', 'like', "%{$request->q}%")->orWhere('symbol', 'like', "%{$request->q}%"));
            })
            ->orderBy('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.markets', [
            'pageTitle' => 'Markets | Admin Panel',
            'markets' => $markets,
            'classFilter' => $request->class ?? 'all',
            'q' => $request->q ?? '',
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $market = Market::create([
            'id' => (Market::query()->max('id') ?? 0) + 1,
            'name' => $data['name'],
            'symbol' => $data['symbol'],
            'class' => $data['class'],
            'price' => $data['price'] !== '' ? $data['price'] : null,
            'price_change' => $data['price_change'] !== '' ? $data['price_change'] : null,
            'img' => $data['img'],
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->logActivity('market.create', 'Market', $market->id, 'Created market asset ' . $market->symbol . ' (' . $market->name . ')');

        return back()->with('success', 'Market asset created.');
    }

    public function update(Request $request, Market $market)
    {
        $data = $this->validated($request);

        $market->update([
            'name' => $data['name'],
            'symbol' => $data['symbol'],
            'class' => $data['class'],
            'price' => $data['price'] !== '' ? $data['price'] : null,
            'price_change' => $data['price_change'] !== '' ? $data['price_change'] : null,
            'img' => $data['img'],
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->logActivity('market.update', 'Market', $market->id, 'Updated market asset ' . $market->symbol);

        return back()->with('success', 'Market asset updated.');
    }

    public function toggle(Market $market)
    {
        $market->update(['is_active' => ! $market->is_active]);

        $this->logActivity($market->is_active ? 'market.activate' : 'market.deactivate', 'Market', $market->id,
            ($market->is_active ? 'Activated' : 'Deactivated') . ' market asset ' . $market->symbol);

        return back()->with('success', $market->symbol . ($market->is_active ? ' activated.' : ' deactivated.'));
    }

    public function destroy(Market $market)
    {
        $this->logActivity('market.delete', 'Market', $market->id, 'Deleted market asset ' . $market->symbol . ' (' . $market->name . ')');

        $market->delete();

        return back()->with('success', 'Market asset deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'symbol' => ['required', 'string', 'max:50'],
            'class' => ['required', 'in:crypto,forex,stock,etf,index'],
            'price' => ['nullable', 'string', 'max:40'],
            'price_change' => ['nullable', 'string', 'max:20'],
            'img' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}