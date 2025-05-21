<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\VolunteerOpportunity;
use App\Models\OpportunityApplication;
use App\Models\OpportunityComment;
use App\Models\User; 
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Organization;

class DashboardController extends Controller
{
   private function getDashboardData()
{
    $availableOpportunities = VolunteerOpportunity::withCount('applications')
        ->where('status', 'available')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    $recentComments = OpportunityComment::with(['user', 'opportunity'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return [
        'total_opportunities'    => VolunteerOpportunity::count(),
        'open_opportunities'     => VolunteerOpportunity::where('status', 'available')->count(),
        'closed_opportunities'   => VolunteerOpportunity::where('status', 'full')->count(),
        'total_volunteers'       => OpportunityApplication::count(),
        'total_comments'         => OpportunityComment::count(),
        'availableOpportunities' => $availableOpportunities,
        'recentComments'        => $recentComments,
    ];
}

   public function index()
{
    $data = $this->getDashboardData();

    
    $organization = Organization::where('user_id', auth()->id())->first();

    
    $data['organization'] = $organization;

    return view('organization.dashboard', $data);
}


public function show($id)
{
    $data = $this->getDashboardData();

   
    $opportunity = VolunteerOpportunity::findOrFail($id);
    $data['opportunity']   = $opportunity;
    $data['applications']  = OpportunityApplication::where('opportunity_id', $id)->get();
    $data['comments']      = OpportunityComment::where('opportunity_id', $id)->get();

    
    $organization = Organization::where('user_id', auth()->id())->first();

   
    $data['organization'] = $organization;

    return view('organization.dashboard', $data);
}


   
    public function rejectApplication($applicationId)
    {
        $application = OpportunityApplication::findOrFail($applicationId);
        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'تم رفض الطلب');
    }



}
