<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\VolunteerOpportunity;
use App\Models\OpportunityApplication;
use App\Models\OpportunityComment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function index()
    {
       
        $availableOpportunities = VolunteerOpportunity::where('status', 'available')->get();

       
        $fullOpportunities = VolunteerOpportunity::where('status', 'full')->get();

        
        $totalVolunteers = OpportunityApplication::count();

        
        $comments = OpportunityComment::all();

       
        return view('organization.dashboard', [
            'availableOpportunities' => $availableOpportunities,
            'fullOpportunities' => $fullOpportunities,
            'totalVolunteers' => $totalVolunteers,
            'comments' => $comments
        ]);
    }

    
    public function show($id)
    {
        $opportunity = VolunteerOpportunity::findOrFail($id);

        
        $applications = OpportunityApplication::where('opportunity_id', $id)->get();

       
        $comments = OpportunityComment::where('opportunity_id', $id)->get();

        return view('organization.dashboard', compact('opportunity', 'applications', 'comments'));
    }

    
    public function acceptApplication($applicationId)
    {
        $application = OpportunityApplication::findOrFail($applicationId);
        $application->status = 'approved'; 
        $application->save();

        return redirect()->back()->with('success', 'تم قبول الطلب');
    }

    
    public function rejectApplication($applicationId)
    {
        $application = OpportunityApplication::findOrFail($applicationId);
        $application->status = 'rejected'; 
        $application->save();

        return redirect()->back()->with('success', 'تم رفض الطلب');
    }

    public function showOrganizationOpportunities()
    {
        // جلب الفرص المتاحة
        $availableOpportunities = VolunteerOpportunity::where('status', 'available')->get();
$fullOpportunities = VolunteerOpportunity::where('status', 'full')->get();
$totalVolunteers = OpportunityApplication::count();

return view('organization.dashboard', compact(
    'opportunity',
    'applications',
    'comments',
    'availableOpportunities',
    'fullOpportunities',
    'totalVolunteers'
));

    }
}
