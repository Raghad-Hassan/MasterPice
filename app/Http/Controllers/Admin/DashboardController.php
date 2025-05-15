<?php

namespace App\Http\Controllers\Admin;

use App\Models\AnnualConference;
use App\Models\ConferenceRegistration;  
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   public function index()
{
    // جلب آخر مؤتمر
    $conference = \App\Models\AnnualConference::latest()->first(); 

    // جلب الإحصائيات
    $totalVolunteers = \App\Models\User::count();
    $totalOrganizations = \App\Models\Organization::count();
    $totalOpportunities = \App\Models\VolunteerOpportunity::count();
   

    // عدد الأفكار الموافق عليها
    $approvedIdeas = \App\Models\Idea::where('status', 'approved')->count();

    // جلب آخر 5 تعليقات مع المستخدم
    $feedbacks = \App\Models\Feedback::with('user')->latest()->take(5)->get(); 

    // تمرير البيانات إلى الـ View
    return view('admin.dashboard', compact(
        'conference',
        'totalVolunteers',
        'totalOrganizations',
        'totalOpportunities',
        'approvedIdeas', 
        'feedbacks'
    ));
}


    public function showStatistics()
    {
        $conference = AnnualConference::first();
        $registrations = ConferenceRegistration::where('conference_id', $conference->id)->get(); 

        return view('admin.participants', compact('conference', 'registrations'));
    }
}
