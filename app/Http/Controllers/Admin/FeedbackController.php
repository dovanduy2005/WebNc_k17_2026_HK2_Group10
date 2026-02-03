<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        $consultations = Consultation::latest()->get();
        return view('admin.feedbacks.index', compact('feedbacks', 'consultations'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Đã xóa phản hồi thành công!');
    }

    public function destroyConsultation(Consultation $consultation)
    {
        $consultation->delete();
        return back()->with('success', 'Đã xóa yêu cầu tư vấn thành công!');
    }

    public function reply(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'admin_reply' => 'required|string|max:1000',
        ]);

        $feedback->update([
            'admin_reply' => $validated['admin_reply'],
            'replied_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Đã gửi phản hồi thành công!');
    }
}
