<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use App\Models\VolunteerOpportunity;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    //    لإنشاء الشهادة
    public function create(Request $request)
    {
       
        $userId = $request->query('user');
        $opportunityId = $request->query('opportunity');

       
        return view('organization.certificates.create', compact('userId', 'opportunityId'));
    }

   
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'user_id' => 'required|exists:users,id', 
            'volunteer_opportunities_id' => 'required|exists:volunteer_opportunities,id', 
            'title' => 'required|string|max:255', 
            'organization' => 'required|string|max:255', 
            'issue_date' => 'required|date', 
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

       
        if ($request->hasFile('image_path')) {
            
            $data['image_path'] = $request->file('image_path')->store('certificates', 'public');
        }

       
        Certificate::create($data);

      
        return redirect()->back()->with('success', 'تم إصدار الشهادة بنجاح.');
    }
}
