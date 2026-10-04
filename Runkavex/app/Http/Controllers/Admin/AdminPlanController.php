<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
use Illuminate\Http\Request;

class AdminPlanController extends Controller
{
    public function index()
    {
        return view('admin.plans', [
            'pageTitle' => 'Investment Plans | Admin Panel',
            'plans' => InvestmentPlan::orderBy('min_amount')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        InvestmentPlan::create([
            'name' => $data['name'],
            'min_amount' => $data['min_amount'],
            'max_amount' => $data['max_amount'],
            'interest_rate' => $data['interest_rate'],
            'duration' => $data['duration'],
            'color' => $data['color'] ?? '#16C79A',
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Investment plan created.');
    }

    public function update(Request $request, InvestmentPlan $plan)
    {
        $data = $this->validated($request, $plan);

        $plan->update([
            'name' => $data['name'],
            'min_amount' => $data['min_amount'],
            'max_amount' => $data['max_amount'],
            'interest_rate' => $data['interest_rate'],
            'duration' => $data['duration'],
            'color' => $data['color'] ?? '#16C79A',
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Investment plan updated.');
    }

    public function destroy(InvestmentPlan $plan)
    {
        $plan->delete();

        return back()->with('success', 'Investment plan deleted.');
    }

    protected function validated(Request $request, $plan = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'min_amount' => ['required', 'numeric', 'min:0'],
            'max_amount' => ['nullable', 'numeric', 'gt:min_amount'],
            'interest_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'duration' => ['required', 'integer', 'min:1'],
            'color' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}