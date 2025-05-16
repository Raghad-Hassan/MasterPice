<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Validator;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\FeedbackSubmitted;


class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً لإرسال الفيدباك.');
        }

        // أولاً نعمل trim للرسالة
        $message = trim($request->input('message'));

        // ثم نعمل فاليديشن بعد الـ trim
        $validator = Validator::make(['message' => $message], [
            'message' => 'required|string|min:3|max:1000',
        ], [
            'message.required' => 'رأيك مهم، لا تترك الرسالة فاضية',
            'message.min' => 'الرسالة يجب أن تحتوي على 3 أحرف على الأقل.',
            'message.max' => 'الرسالة لا يجب أن تتجاوز 1000 حرف.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Feedback::create([
            'user_id' => Auth::id(),
            'message' => $message,
        ]);

        Auth::user()->notify(new FeedbackSubmitted($message));
        return redirect()->back()->with('success', 'تم إرسال الفيدباك بنجاح!');
    }
}
