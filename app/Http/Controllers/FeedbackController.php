<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function create()
    {
        $pastFeedbacks = Auth::user()->feedbacks()->latest()->get();
        return view('feedback', compact('pastFeedbacks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'rating' => $validated['rating'],
        ]);

        return back()->with('success', 'Cảm ơn bạn đã gửi phản hồi!');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'car_interested' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        Consultation::create($validated);

        return back()->with('success', 'Yêu cầu của bạn đã được gửi thành công. Chúng tôi sẽ liên hệ lại sớm nhất!');
    }
}
