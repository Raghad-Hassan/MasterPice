<?php

namespace App\Http\Controllers;

use App\Models\AnnualConference;
use App\Models\ConferenceRegistration;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    
    public function index()
    {
        $conference = AnnualConference::where('status', 'active')
                                    ->orderBy('date', 'desc')
                                    ->first();
    
        if (!$conference) {
            return view('index')->with('message', 'لا توجد مؤتمرات متاحة حالياً');
        }
    
        return view('index', compact('conference'));
    }

    
    public function showRegistrationForm($id)
    {
       
        $conference = AnnualConference::findOrFail($id);
        
        if (!$conference->active) {
            abort(404, 'المؤتمر غير متاح حالياً');
        }
        
        return view('conferences.register', compact('conference'));
    }



    
    public function register(Request $request, $conferenceId)
    {
       
       
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:conference_registrations,email',
            'phone' => 'required|string|max:15',
            'interest_field' => 'required|string',
            'city' => 'required|string',
            'previous_experience' => 'required|in:yes,no',
            'experience_details' => 'nullable|string|required_if:previous_experience,yes',
            'skills' => 'nullable|array',
            'motivation' => 'required|string',
        ]);

       
        $registration = new ConferenceRegistration();
        $registration->fill([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'interest_field' => $request->interest_field,
            'city' => $request->city,
            'previous_experience' => $request->previous_experience ,
            'experience_details' => $request->experience_details,
            'skills' => json_encode($request->skills),
            'motivation' => $request->motivation,
            'conference_id' => $conferenceId,
            'user_id' => auth()->id() , 
            'participation_reason' => $request->motivation,
        ]);

        $registration->save();

        return redirect()->route('conferences.index')
                       ->with('success', 'تم تسجيلك في المؤتمر بنجاح!');
    }

    
    public function show($id)
{
    $conference = AnnualConference::findOrFail($id);

    $conferenceStats = (object)[
        'workshops_count' => $conference->workshops()->count(),
        'activities_count' => $conference->activities()->count(),
    ];

    $conferences = AnnualConference::all();

    return view('conferences.show', compact('conference', 'conferenceStats', 'conferences'))->with('success', 'تم التسجيل بنجاح!');
}

    
    public function adminIndex()
    {
        $conferences = AnnualConference::all();
        return view('admin.annual_conferences.index', compact('conferences'));
    }

    
    public function create()
    {
        return view('admin.annual_conferences.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'expected_participants' => 'required|integer',
            'organizations_count' => 'required|integer',
            'activities' => 'required|string',
            'workshops' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        
        $conference = AnnualConference::create($request->except('image'));

        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('conferences', 'public');
            $conference->update(['image' => $imagePath]);
        }

        return redirect()->route('admin.annual-conferences.index')
                         ->with('success', 'تم إنشاء المؤتمر بنجاح');
    }

 
     
  
    public function edit($id)
    {
        $conference = AnnualConference::findOrFail($id);
        return view('admin.annual_conferences.edit', compact('conference'));
    }

    
    public function update(Request $request, $id)
    {
        $conference = AnnualConference::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'expected_participants' => 'required|integer',
            'organizations_count' => 'required|integer',
            'activities' => 'required|string',
            'workshops' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'sometimes|boolean',
        ]);

        // تحديث المؤتمر
        $conference->update($request->except('image'));

       

        return redirect()->route('admin.annual-conferences.index')
                         ->with('success', 'تم تحديث المؤتمر بنجاح');
    }

    
    public function destroy($id)
    {
        $conference = AnnualConference::findOrFail($id);
        $conference->delete();

        return redirect()->route('admin.annual-conferences.index')
                         ->with('success', 'تم حذف المؤتمر بنجاح');
    }

   
    public function showParticipants($id)
{
   
    $conference = AnnualConference::findOrFail($id);

    
    $registrations = ConferenceRegistration::where('conference_id', $id)->get();

   
    return view('admin.participants', compact('conference', 'registrations'));
}


}
