<?php

namespace App\Http\Controllers\Admin;

use App\Models\AnnualConference;
use App\Models\ConferenceRegistration;  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
       
        $conference = AnnualConference::latest()->first(); 

     
        return view('admin.dashboard', compact('conference'));
    }
    

    public function showStatistics()
{
   
    $conference = AnnualConference::first();
    $registrations = ConferenceRegistration::where('conference_id', $conference->id)->get();  // جلب المشاركين

    return view('admin.participants', compact('conference', 'registrations'));
}
}


