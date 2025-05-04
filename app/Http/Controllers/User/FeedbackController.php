<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Validator;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
    
        $validator = Validator::make($request->all(), [
            'message' => ['required', 'string', 'max:1000', function ($attribute, $value, $fail) {
                if (trim($value) === '') {
                    $fail('الرسالة لا يمكن أن تكون فارغة أو تحتوي فقط على مسافات.');
                }
            }],
        ], [
            'message.required' => 'الرسالة مطلوبة.',
            'message.max' => 'الرسالة لا يجب أن تتجاوز 1000 حرف.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $feedback = new Feedback();
        $feedback->message = $request->message;
        $feedback->user_id = Auth::id();
        $feedback->save();
    
        return redirect()->back()->with('success', 'تم إرسال الفيدباك بنجاح!');
    }
}
