<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;

class NewsletterSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = NewsletterSubscription::latest()->get();
        return view('organization.newsletter.index', compact('subscriptions'));
    }
}
