<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\VolunteerOpportunity;
use App\Models\OpportunityApplication;
use App\Models\OpportunityComment;
use App\Models\User; // تأكد من استيراد نموذج المستخدم
use Illuminate\Http\Request;

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
        return view('organization.dashboard', $data);
    }

    // دالة عرض تفاصيل الفرصة التطوعية
    public function show($id)
    {
        $data = $this->getDashboardData();

        // بيانات الفرصة المحددة
        $opportunity = VolunteerOpportunity::findOrFail($id);
        $data['opportunity']   = $opportunity;
        $data['applications']  = OpportunityApplication::where('opportunity_id', $id)->get();
        $data['comments']      = OpportunityComment::where('opportunity_id', $id)->get();

        return view('organization.dashboard', $data);
    }

    // دالة لرفض طلب التقديم
    public function rejectApplication($applicationId)
    {
        $application = OpportunityApplication::findOrFail($applicationId);
        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'تم رفض الطلب');
    }
}
