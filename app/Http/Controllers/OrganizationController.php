<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    // عرض نموذج تسجيل الدخول للمؤسسات
    public function showLoginForm()
    {
        return view('auth.login_organization');
    }

    // معالجة تسجيل الدخول للمؤسسات
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        // تحديد ما إذا كان المدخل بريدًا إلكترونيًا أو رقم هاتف
        $field = filter_var($credentials['email_or_phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        // محاولة تسجيل الدخول للمؤسسة
        if (Auth::guard('organization')->attempt([
            $field => $credentials['email_or_phone'],
            'password' => $credentials['password']
        ])) {
            // تجديد الجلسة بعد تسجيل الدخول
            $request->session()->regenerate();

            // التوجيه إلى لوحة تحكم المؤسسة (dashboard)
            return redirect()->route('organization.dashboard');  // التأكد من استخدام المسار الصحيح
        }

        // في حالة فشل تسجيل الدخول
        return back()->withErrors([
            'email_or_phone' => 'بيانات الاعتماد المقدمة غير متطابقة مع سجلاتنا.',
        ]);
    }

    // عرض نموذج إنشاء حساب للمؤسسات
    public function showRegistrationForm()
    {
        return view('auth.register_organization');
    }

    // معالجة إنشاء حساب للمؤسسات
    public function register(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:organizations',
            'phone' => 'required|string|max:20|unique:organizations',
            'password' => 'required|string|min:8|confirmed',
            'website' => 'nullable|url',
            'governorate' => 'required|string',
            'sector' => 'required|in:private,NGO',
            'national_id' => 'required|string',
            'volunteer_services' => 'required|in:yes,no',
            'volunteer_type' => 'required_if:volunteer_services,yes|string|nullable',
        ]);

        // إذا كانت هناك أخطاء في التحقق من البيانات المدخلة
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // إنشاء المؤسسة بدون ربطها بأي مستخدم
        $organization = Organization::create([
            'organization_name' => $request->organization_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'website' => $request->website,
            'governorate' => $request->governorate,
            'sector' => $request->sector,
            'national_id' => $request->national_id,
            'volunteer_services' => $request->volunteer_services,
            'volunteer_type' => $request->volunteer_type,
            'logistics_services' => $request->logistics_services,
        ]);

        
        Auth::guard('organization')->login($organization);

        
        return redirect()->route('organization.dashboard');
    }

    
    public function logout(Request $request)
    {
        
        Auth::guard('organization')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // عرض لوحة تحكم المؤسسة
    public function dashboard()
    {
        // عرض صفحة لوحة تحكم المؤسسة
        return view('organization.dashboard');
    }
}
