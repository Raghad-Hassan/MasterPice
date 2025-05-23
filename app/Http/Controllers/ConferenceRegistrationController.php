<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConferenceRegistration;
use App\Models\AnnualConference;

class ConferenceRegistrationController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:conference_registrations,email',
            'phone' => 'required|string|max:15',
            'interest_field' => 'required|string',
            'city' => 'required|string',
            'previous_experience' => 'required|in:yes,no',
           'experience_details' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'motivation' => 'required|string',
            'conference_id' => 'required|exists:annual_conferences,id',
        ], [
            'email.unique' => 'هذا البريد الإلكتروني مسجل بالفعل للمؤتمر.',
        ]);

       
        $registration = new ConferenceRegistration();
        $registration->full_name = $request->full_name;
        $registration->email = $request->email;
        $registration->phone = $request->phone;
        $registration->interest_field = $request->interest_field;
        $registration->city = $request->city;
        $registration->previous_experience = $request->previous_experience == 'yes' ? true : false;
        $registration->experience_details = $request->experience_details;
        $registration->skills = json_encode($request->skills);
        $registration->motivation = $request->motivation;
        $registration->conference_id = $request->conference_id;

        
        $registration->save();

       
 


   
}

}