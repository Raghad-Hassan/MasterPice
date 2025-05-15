<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\VolunteerOpportunity;
use Illuminate\Http\Request;

class VolunteerOpportunityController extends Controller
{
    public function index()
{
    // جلب الفرص التطوعية مع أسماء المستخدمين وأهداف التنمية المستدامة المرتبطة بها
    $opportunities = VolunteerOpportunity::with(['applicants.user', 'goal'])->paginate(10);

    return view('organization.opportunities.index', compact('opportunities'));
}

    public function showApplicants($opportunityId)
{
    $opportunity = VolunteerOpportunity::findOrFail($opportunityId);

    // جلب المتطوعين المسجلين في هذه الفرصة
    $applicants = $opportunity->applicants()->with('user')->get();

    return view('organization.opportunities.applicants', compact('opportunity', 'applicants'));
}

   
public function removeApplicant($opportunityId, $applicationId)
{
    $application = OpportunityApplication::where('opportunity_id', $opportunityId)
                                          ->where('id', $applicationId)
                                          ->first();

    if ($application) {
        $application->delete();
        return redirect()->back()->with('success', 'تم حذف المتطوع من الفرصة بنجاح.');
    }

    return redirect()->back()->with('error', 'لم يتم العثور على المتطوع.');
}

}
