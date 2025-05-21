<?php

namespace App\Http\Controllers\Admin;
use App\Models\AnnualConference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 


class AnnualConferenceController extends Controller
{
    public function index()
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
        'image' => 'nullable|image', 
         'status' => 'required|in:pending,active,done', 
    ]);

    
    $conference = new AnnualConference($request->all());

    $conference->save();

   
    return redirect()->route('admin.annual-conferences.index')->with('success', 'تم إضافة المؤتمر بنجاح');
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
            'image' => 'nullable|image',
             'status' => 'required|in:pending,active,done',
        ]);

        $conference->update($request->except('image'));

    
       $conference->status = $request->input('status');

  
    if ($request->hasFile('image')) {
        $conference->image = $request->file('image')->store('images', 'public');
    }
    $conference->save();

    return redirect()->route('admin.annual-conferences.index')->with('success', 'تم تحديث المؤتمر بنجاح');
}
    public function destroy($id)
    {
        $conference = AnnualConference::findOrFail($id);
        $conference->delete();
        return redirect()->route('admin.annual-conferences.index');
    }

    public function showRegistrationForm(AnnualConference $conference) {
        return view('conferences.register', compact('conference'));
    }
}
