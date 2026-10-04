<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanPlan;
use Illuminate\Http\Request;

class AdminLoanPlanController extends Controller
{
    use LogsAdminActivity;

    public function index()
    {
        return view('admin.loan-plans', [
            'pageTitle' => 'Loan Products | Admin Panel',
            'plans' => LoanPlan::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $plan = LoanPlan::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'min_amount' => $data['min_amount'],
            'max_amount' => $data['max_amount'],
            'interest_rate' => $data['interest_rate'],
            'interest_type' => $data['interest_type'],
            'min_duration' => $data['min_duration'],
            'max_duration' => $data['max_duration'],
            'processing_fee' => $data['processing_fee'],
            'min_account_balance' => $data['min_account_balance'],
            'requires_collateral' => $request->boolean('requires_collateral'),
            'collateral_percentage' => $request->boolean('requires_collateral') && $data['collateral_percentage'] !== null ? $data['collateral_percentage'] : null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->logActivity('loan_plan.create', 'LoanPlan', $plan->id, 'Created loan product ' . $plan->name);

        return back()->with('success', 'Loan product created.');
    }

    public function update(Request $request, LoanPlan $plan)
    {
        $data = $this->validated($request);

        $plan->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'min_amount' => $data['min_amount'],
            'max_amount' => $data['max_amount'],
            'interest_rate' => $data['interest_rate'],
            'interest_type' => $data['interest_type'],
            'min_duration' => $data['min_duration'],
            'max_duration' => $data['max_duration'],
            'processing_fee' => $data['processing_fee'],
            'min_account_balance' => $data['min_account_balance'],
            'requires_collateral' => $request->boolean('requires_collateral'),
            'collateral_percentage' => $request->boolean('requires_collateral') && $data['collateral_percentage'] !== null ? $data['collateral_percentage'] : null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->logActivity('loan_plan.update', 'LoanPlan', $plan->id, 'Updated loan product ' . $plan->name);

        return back()->with('success', 'Loan product updated.');
    }

    public function destroy(LoanPlan $plan)
    {
        $this->logActivity('loan_plan.delete', 'LoanPlan', $plan->id, 'Deleted loan product ' . $plan->name);

        $plan->delete();

        return back()->with('success', 'Loan product deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
            'min_amount' => ['required', 'numeric', 'min:0'],
            'max_amount' => ['required', 'numeric', 'gt:min_amount'],
            'interest_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'interest_type' => ['required', 'in:simple,compound'],
            'min_duration' => ['required', 'integer', 'min:1'],
            'max_duration' => ['required', 'integer', 'gte:min_duration'],
            'processing_fee' => ['required', 'numeric', 'min:0', 'max:100'],
            'min_account_balance' => ['required', 'numeric', 'min:0'],
            'collateral_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}