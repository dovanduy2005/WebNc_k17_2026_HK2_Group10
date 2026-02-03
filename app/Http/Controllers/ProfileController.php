<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $contracts = $user->contracts()->with('car')->latest()->get();
        
        $stats = [
            'favorites_count' => $user->favorites()->count(),
            'bookings_count' => $user->bookings()->count(),
            'contracts_count' => $contracts->count(),
        ];
        
        return view('profile.show', [
            'user' => $user,
            'contracts' => $contracts,
            'stats' => $stats,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'avatar_file' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ];

        if ($request->hasFile('avatar_file')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $path = $request->file('avatar_file')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }
}
