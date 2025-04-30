<?php

namespace App\Http\Controllers\User;

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
        
        $request->validate([
            'message' => 'required|string|max:1000', 
        ]);

        
        $feedbacks = new Feedback();
        $feedbacks->message = $request->message;
        $feedbacks->user_id = auth()->id(); 
        $feedbacks->save();

       
        return redirect()->back()->with('success', 'تم إرسال الفيدباك بنجاح!');
    }

}
