<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\VolunteerOpportunity;

class OpportunityController extends Controller
{
    public function index()
{
    $opportunities = VolunteerOpportunity::paginate(10); 
    return view('organization.opportunities.index', compact('opportunities'));
}

    public function create()
    {
        return view('organization.opportunities.create');
    }

    public function store(Request $request)
    {   
        // dd($request->all());
        // dd($request->all());
        Log::info('تم استدعاء دالة store في OpportunityController');
        Log::info('البيانات المستلمة:', $request->all());
        // dd($request->all());
     
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'volunteer_hours' => 'required', 
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'category' => 'required|in:entrepreneurship,environment,health,arts,education,sports,other', 
            'city' => 'required|in:amman,zarqa,irbid,ajloun,mafraq,kareem,madaba,tafilah,maan,batn,jerash,aqaba', 
            'total_hours' => 'required|numeric|min:1', 
            'days' => 'required|string', 
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'gender' => 'required|in:all,male,female', 
            'total_volunteers' => 'required|integer|min:1',
            'transportation' => 'nullable|in:available,unavailable',
            'status' => 'required|in:available,full', 
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'total_participants' => 'required|integer|min:0', 
            'min_hours' => 'required',
            'max_hours' => 'required', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 

        ]);
        
        // dd($validated);
        
        
        try {
            
            $imagePath = null;
           
        
          
            $opportunity = new VolunteerOpportunity();
        
            
            $opportunity->organization_id = 1;
        
            $opportunity->title = $validated['title'];
            $opportunity->description = $validated['description'];
            $opportunity->category = $validated['category'];
            $opportunity->location = $validated['location'];
            $opportunity->city = $validated['city'];
            $opportunity->start_date = $validated['start_date'];
            $opportunity->end_date = $validated['end_date'];
            $opportunity->gender = $validated['gender'];
            $opportunity->total_volunteers = $validated['total_volunteers'];
            $opportunity->current_volunteers = 0;
            $opportunity->min_hours = $validated['min_hours'];
            $opportunity->max_hours = $validated['max_hours'];
            $opportunity->status = $validated['status'];
            $opportunity->image = $imagePath;
            $opportunity->days = $validated['days'];
            $opportunity->transportation = $validated['transportation'];
            $opportunity->total_participants = $validated['total_participants'];
            $opportunity->current_participants = 0;
        
          
            $opportunity->volunteer_hours = $validated['volunteer_hours']; 
            $opportunity->total_hours = $validated['total_hours'];
            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('opportunity_images', 'public');
                $opportunity->image = $imagePath; 
            }
           
            Log::info('بيانات الفرصة قبل الحفظ:', $opportunity->toArray());
        
           
            $opportunity->save();
        
           
            return redirect()->route('organization.opportunities.index')
                   ->with('success', 'تم إضافة الفرصة بنجاح!');
        } catch (\Exception $e) {
          
            // return back()->withErrors($validator)->withInput();

        }
        
    }        
    
    


    public function edit($id)
    {
        $opportunity = VolunteerOpportunity::findOrFail($id);
        return view('organization.opportunities.edit', compact('opportunity'));
    }
    

    public function update(Request $request, $id)
    {
        Log::info('تم استدعاء دالة update في OpportunityController');
        Log::info('البيانات المستلمة للتعديل:', $request->all());
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'volunteer_hours' => 'required|numeric',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:entrepreneurship,environment,health,arts,education,sports,other',
            'city' => 'required|in:amman,zarqa,irbid,ajloun,mafraq,kareem,madaba,tafilah,maan,batn,jerash,aqaba',
            'total_hours' => 'required|numeric|min:1',
            'days' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'gender' => 'required|in:all,male,female',
            'total_volunteers' => 'required|integer|min:1',
            'transportation' => 'nullable|in:available,unavailable',
            'status' => 'required|in:available,full',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'total_participants' => 'required|integer|min:0',
            'min_hours' => 'required|numeric|min:1',
            'max_hours' => 'required|numeric|min:1',
        ]);
    
        try {
            $opportunity = VolunteerOpportunity::findOrFail($id);
    
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('opportunities', $imageName, 'public');
                $opportunity->image = $imagePath;
            }
    
           
            $opportunity->title = $validated['title'];
            $opportunity->description = $validated['description'];
            $opportunity->category = $validated['category'];
            $opportunity->location = $validated['location'];
            $opportunity->city = $validated['city'];
            $opportunity->start_date = $validated['start_date'];
            $opportunity->end_date = $validated['end_date'];
            $opportunity->gender = $validated['gender'];
            $opportunity->total_volunteers = $validated['total_volunteers'];
            $opportunity->min_hours = $validated['min_hours'];
            $opportunity->max_hours = $validated['max_hours'];
            $opportunity->status = $validated['status'];
            $opportunity->days = $validated['days'];
            $opportunity->transportation = $validated['transportation'] ?? null;
            $opportunity->start_time = $validated['start_time'] ?? null;
            $opportunity->end_time = $validated['end_time'] ?? null;
            $opportunity->volunteer_hours = $validated['volunteer_hours'];
            $opportunity->total_participants = $validated['total_participants'];
    
            $opportunity->save();
    
            return redirect()->route('organization.opportunities.index')
                             ->with('success', 'تم تحديث الفرصة بنجاح');
        } catch (\Exception $e) {
            Log::error('حدث خطأ أثناء التحديث: ' . $e->getMessage());
            return back()->withErrors('حدث خطأ أثناء التحديث، يرجى المحاولة مرة أخرى.');
        }
    }
    

    public function destroy(VolunteerOpportunity $opportunity)
    {
        $opportunity->delete();
        return redirect()->route('organization.opportunities.index')
               ->with('success', 'تم حذف الفرصة بنجاح!');
    }



}