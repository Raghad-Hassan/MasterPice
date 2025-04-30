<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\VolunteerOpportunity;
use App\Models\Opportunity;
use App\Models\Organization;
use Illuminate\Http\Request;

class UserOpportunityController extends Controller
{
    // عرض كل الفرص
    public function index()
    {
        $opportunities = VolunteerOpportunity::paginate(6);
        return view('user.عرض الفرص', compact('opportunities'));
    }

    // عرض تفاصيل فرصة وحدة
    public function show($id)
    {
        // $opportunity = VolunteerOpportunity::findOrFail($id);
        $organization = Organization::with('volunteerOpportunities')->findOrFail($id);
        $opportunity = VolunteerOpportunity::where('id', $id)->first();
        // dd($opportunity->id);
        return view('user.opportunit-details', compact('opportunity'));
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
    
            // التحقق من السعة
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
}
