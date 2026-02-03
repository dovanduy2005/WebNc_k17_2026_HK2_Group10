<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $totalContracts = Contract::where('status', 'pending')->count(); // Đơn hàng mới
        $totalUsers = User::where('role', '!=', 'admin')->count(); // Chỉ đếm khách hàng
        
        // Doanh thu tính từ tất cả tiền cọc của các đơn hàng không bị hủy
        $revenue = Contract::where('status', '!=', 'cancelled')->sum('deposit_amount'); 
        
        $recentContracts = Contract::with(['user', 'car'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalCars', 'totalContracts', 'totalUsers', 'revenue', 'recentContracts'));
    }
}
