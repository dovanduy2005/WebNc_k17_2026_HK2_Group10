<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $cars = Auth::user()->favorites()->latest()->get();
        
        return view('favorites', compact('cars'));
    }

    public function toggle(Car $car)
    {
        $user = Auth::user();
        
        if ($user->favorites()->where('car_id', $car->id)->exists()) {
            $user->favorites()->detach($car->id);
            $message = 'Đã xóa khỏi danh sách yêu thích';
        } else {
            $user->favorites()->attach($car->id);
            $message = 'Đã thêm vào danh sách yêu thích';
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_favorite' => $user->favorites()->where('car_id', $car->id)->exists(),
            ]);
        }

        return back()->with('success', $message);
    }
}
