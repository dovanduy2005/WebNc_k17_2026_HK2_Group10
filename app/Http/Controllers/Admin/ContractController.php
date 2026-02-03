<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with(['user', 'car'])->latest()->paginate(10);
        return view('admin.contracts.index', compact('contracts'));
    }

    public function show(Contract $contract)
    {
        $contract->load(['user', 'car']);
        return view('admin.contracts.show', compact('contract'));
    }

    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,active,complete,cancelled',
            'inspection_date' => 'nullable|date',
            'handover_date' => 'nullable|date',
        ]);

        $contract->update($validated);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
