<?php

namespace App\Http\Controllers\Organization;

use App\Models\SustainableDevelopmentGoal;
use App\Models\OpportunityApplication;
use App\Http\Controllers\Controller;
use App\Models\VolunteerOpportunity;
use App\Models\Opportunity;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Notifications\OpportunityRegistrationSuccess;
use App\Notifications\OpportunityNotification;

class UserOpportunityController extends Controller
{
    
    public function index()
    {
        $opportunities = VolunteerOpportunity::paginate(6);
        return view('user.عرض الفرص', compact('opportunities'));
    }

    
    public function show($id)
{
    $opportunity = VolunteerOpportunity::findOrFail($id);

   
    $goals = SustainableDevelopmentGoal::where('organization_id', $opportunity->organization_id)->get();

    return view('user.opportunit-details', compact('opportunity', 'goals'));
}


    public function register(Request $request) {
        OpportunityApplication::create([
            'user_id' => $request->userId,
            'opportunity_id' => $request->oppId
        ]);

        $opp = VolunteerOpportunity::find($request->oppId)->first();

        if ($opp) {
            $opp->update([
                'current_volunteers' => $opp->current_volunteers + 1,
            ]);
        }
        return response()->noContent();
    }

    public function registerss($id)
    {
        \Log::info('Register attempt', ['user_id' => auth()->id(), 'opportunity_id' => $id]);
    
        if (!auth()->check()) {
            \Log::warning('Unauthorized registration attempt');
            return response()->json(['error' => 'يرجى تسجيل الدخول أولاً'], 401);
        }
    
        try {
            DB::beginTransaction();
    
            $opportunity = VolunteerOpportunity::findOrFail($id);
            \Log::debug('Opportunity found', ['opportunity' => $opportunity]);
    
            
            if ($opportunity->current_volunteers >= $opportunity->total_volunteers) {
                \Log::warning('Opportunity full', ['opportunity_id' => $id]);
                return response()->json(['error' => 'لا يوجد أماكن متاحة'], 400);
            }
    
            
            $existing = OpportunityApplication::where([
                'user_id' => auth()->id(),
                'opportunity_id' => $id
            ])->exists();
    
            if ($existing) {
                \Log::warning('Duplicate registration attempt', ['user_id' => auth()->id(), 'opportunity_id' => $id]);
                return response()->json(['error' => 'مسجل مسبقاً في هذه الفرصة'], 400);
            }
    
            
            $application = OpportunityApplication::create([
                'user_id' => auth()->id(),
                'opportunity_id' => $opportunity->id,
                'status' => 'pending'
            ]);
            \Log::info('Application created', ['application' => $application]);
    
            
            $opportunity->increment('current_volunteers');
            \Log::debug('Volunteer count updated', ['new_count' => $opportunity->current_volunteers]);
    
            DB::commit();
    
            return response()->json(['success' => 'تم التسجيل بنجاح']);
    
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Registration error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'حدث خطأ: ' . $e->getMessage()], 500);
        }
    }

public function registerOpportunity(Request $request)
{
    if (!auth()->check()) {
        return redirect()->route('login')->withErrors('يرجى تسجيل الدخول أولاً');
    }

    try {
        $opportunity = VolunteerOpportunity::findOrFail($request->opportunity_id);

        if ($opportunity->current_volunteers >= $opportunity->total_volunteers) {
            return redirect()->back()->with('error', 'عذراً، لقد اكتمل العدد المتطوعين لهذه الفرصة.');
        }

        $existing = OpportunityApplication::where([
            'user_id' => auth()->id(),
            'opportunity_id' => $opportunity->id
        ])->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'مسجل مسبقاً في هذه الفرصة');
        }

        OpportunityApplication::create([
            'user_id' => auth()->id(),
            'opportunity_id' => $opportunity->id,
            'status' => 'pending',
        ]);

        $opportunity->increment('current_volunteers');

        return redirect()->back()->with('success', 'تم التسجيل بنجاح');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors('حدث خطأ: ' . $e->getMessage());
    }
}





    public function showGoals()
{
    $goals = SustainableDevelopmentGoal::with('organization')->get(); 
    return view('user.opportunit-details', compact('goals'));
}
    
}
