<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
   
    public function showLoginForm()
    {
        return view('auth.login_organization');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($credentials['email_or_phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        if (Auth::guard('organization')->attempt([
            $field => $credentials['email_or_phone'],
            'password' => $credentials['password']
        ], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('organization.dashboard'));
        }

        return back()->withErrors([
            'email_or_phone' => 'بيانات الاعتماد المقدمة غير متطابقة مع سجلاتنا.',
        ])->onlyInput('email_or_phone');
    }

    
    public function showRegistrationForm()
    {
        return view('auth.register_organization');
    }

    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:organizations',
            'phone' => 'required|string|max:20|unique:organizations',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
            'governorate' => 'required|string',
            'sector' => 'required|in:private,NGO',
            'national_id' => 'required|string',
            'volunteer_services' => 'required|in:yes,no',
            'volunteer_type' => 'required_if:volunteer_services,yes|string|nullable',
            'logistics_services' => 'nullable|string',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

       
        $profile_picture = null;
        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('organization_images', 'public');
        }

        $organization = Organization::create([
            'organization_name' => $request->organization_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'profile_picture' => $profile_picture,
            'website' => $request->website,
            'governorate' => $request->governorate,
            'sector' => $request->sector,
            'national_id' => $request->national_id,
            'volunteer_services' => $request->volunteer_services,
            'volunteer_type' => $request->volunteer_type,
            'logistics_services' => $request->logistics_services,
            'bio' => $request->bio,
            'image' => $image,
             'description' => $request->description ?? null,
        ]);

        Auth::guard('organization')->login($organization);

        return redirect()->route('organization.dashboard')->with('success', 'تم تسجيل المؤسسة بنجاح!');
    }

   
    public function logout(Request $request)
    {
        Auth::guard('organization')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'تم تسجيل الخروج بنجاح');
    }

    
    public function dashboard()
    {
        return view('organization.dashboard', [
            'organization' => Auth::guard('organization')->user()
        ]);
    }
}