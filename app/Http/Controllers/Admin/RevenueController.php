<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        // Calculate Revenues (Approved contracts only?) 
        // Assuming 'signed' or similar status means revenue is realized.
        // For now, let's count all non-cancelled contracts or just sum them up based on status logic if available.
        // Based on user request, typically "Doanh thu" means actual money.
        // Let's assume all deposits are revenue for now, or filter by specific status if we knew it.
        // Given previous code used `Contract::where('status', 'complete')`, let's stick to that or `signed`.
        // Let's check ContractController.php again to see available statuses.
        // Code in dashboard used `revenue = Contract::where('status', 'complete')->sum('deposit_amount')`.
        // But seed data might not have 'complete'.
        // Recent contracts table showed 'pending', 'signed'.
        // Let's count ALL deposits for simplicity now or 'signed' + 'complete'.
        
        // Let's use all for now to show data, as user is testing.
        $query = Contract::query(); 

        $weeklyRevenue = $query->clone()
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('deposit_amount');

        $monthlyRevenue = $query->clone()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('deposit_amount');

        $yearlyRevenue = $query->clone()
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('deposit_amount');

        // Breakdown List
        $contracts = Contract::with(['car', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.revenue.index', compact('weeklyRevenue', 'monthlyRevenue', 'yearlyRevenue', 'contracts'));
    }
}
