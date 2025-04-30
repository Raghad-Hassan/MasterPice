<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    
    public function index()
{
    $organizations = Organization::all(); 
    return view('admin.organization.index', compact('organizations'));
}

    
    public function create()
    {
        return view('admin.organization.create');
    }


public function store(Request $request)
{
    $request->validate([
        'organization_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|digits:10',
        'email' => 'required|email|unique:organizations',
        'password' => 'required|string|min:8',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'website' => 'nullable|url',
        'governorate' => 'required|string|max:255',
        'sector' => 'required|in:private,NGO',
        'national_id' => 'required|string|max:20',
        'volunteer_services' => 'required|in:yes,no',
        'volunteer_type' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    
    $profile_picture = $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : null;
    $image = $request->file('image') ? $request->file('image')->store('organization_images', 'public') : null;

   
    Organization::create([
        'user_id' => auth()->id(), 
        'organization_name' => $request->organization_name,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'profile_picture' => $profile_picture,
        'website' => $request->website,
        'governorate' => $request->governorate,
        'sector' => $request->sector,
        'national_id' => $request->national_id,
        'volunteer_services' => $request->volunteer_services,
        'volunteer_type' => $request->volunteer_type,
        'bio' => $request->bio,
        'image' => $image,
    ]);

    return redirect()->route('admin.organizations.index')->with('success', 'تم إضافة المؤسسة بنجاح');
}


   
public function edit($id)
{
    $organization = Organization::findOrFail($id);
    return view('admin.organization.edit', compact('organization'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'organization_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|digits:10',
        'email' => 'required|email|unique:organizations,email,' . $id,
        'password' => 'nullable|string|min:8',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'website' => 'nullable|url',
        'governorate' => 'required|string|max:255',
        'sector' => 'required|in:private,NGO',
        'national_id' => 'required|string|max:20',
        'volunteer_services' => 'required|in:yes,no',
        'volunteer_type' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $organization = Organization::findOrFail($id);

    
    $profile_picture = $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : $organization->profile_picture;
    $image = $request->file('image') ? $request->file('image')->store('organization_images', 'public') : $organization->image;

   
    $organization->update([
        'organization_name' => $request->organization_name,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : $organization->password,
        'profile_picture' => $profile_picture,
        'website' => $request->website,
        'governorate' => $request->governorate,
        'sector' => $request->sector,
        'national_id' => $request->national_id,
        'volunteer_services' => $request->volunteer_services,
        'volunteer_type' => $request->volunteer_type,
        'bio' => $request->bio,
        'image' => $image,
    ]);

    return redirect()->route('admin.organizations.index')->with('success', 'تم تحديث المؤسسة بنجاح');
}

    
    public function destroy(Organization $organization)
    {
       
        if ($organization->profile_picture && Storage::exists('public/' . $organization->profile_picture)) {
            Storage::delete('public/' . $organization->profile_picture);
        }

        $organization->delete();
        return redirect()->route('admin.organizations.index')->with('success', 'تم حذف المؤسسة بنجاح');
    }
}
