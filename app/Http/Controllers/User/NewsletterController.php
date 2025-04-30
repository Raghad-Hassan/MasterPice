<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email',
        ]);

        NewsletterSubscription::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'تم الاشتراك بنجاح!');
    }
}
