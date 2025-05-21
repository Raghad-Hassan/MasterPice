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
   
    $conference = \App\Models\AnnualConference::
    latest()
    ->first(); 

    
    $totalVolunteers = \App\Models\User::count();
    $totalOrganizations = \App\Models\Organization::count();
    $totalOpportunities = \App\Models\VolunteerOpportunity::count();
    $approvedIdeas = \App\Models\Idea::where('status', 'approved')->count();

    
    $feedbacks = \App\Models\Feedback::with('user')
    ->latest()
    ->take(5)
    ->get(); 

    
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
