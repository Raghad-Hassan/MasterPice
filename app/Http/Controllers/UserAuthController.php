<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserAuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showLoginForm() {
        return view('auth.login_personal');
    }

    

public function login(Request $request)
{
    $request->validate([
        'email_or_phone' => 'required',
        'password' => 'required',
    ], [
        'email_or_phone.required' => 'يرجى إدخال البريد الإلكتروني أو رقم الهاتف',
        'password.required' => 'يرجى إدخال كلمة المرور',
    ]);

    $field = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    if (Auth::attempt([$field => $request->email_or_phone, 'password' => $request->password])) {
        $request->session()->regenerate();

        $user = Auth::user();

        
        if (is_null($user->email_verified_at) && $user->role_id != 1) {
            Auth::logout();
            return redirect()->route('verification.notice');
        }

        // التوجيه حسب الدور
        return match ($user->role_id) {
            1 => redirect()->route('admin.dashboard'),
            3 => redirect()->route('index'),
            default => back()->withErrors(['email_or_phone' => 'نوع المستخدم غير معروف.']),
        };
    }

    return back()->withErrors(['email_or_phone' => 'بيانات الدخول غير صحيحة']);
}

    public function showRegister()
    {
        return view('auth.register_personal');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required|regex:/^07[0-9]{8}$/|unique:users,phone',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:100',
            'governorate' => 'required|string|max:100',
            'birth_date' => 'required|date|before:today',
            'email' => 'required|email|unique:users,email',
           'password' => 'required|min:8|confirmed', // "confirmed" تتحقق من تطابق كلمة السر مع تأكيد كلمة السر
            'password_confirmation' => 'required|min:8',
        ], [
            'first_name.required' => 'الاسم الأول مطلوب',
            'last_name.required' => 'اسم العائلة مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.regex' => 'يجب أن يبدأ رقم الهاتف بـ 07 ويتكون من 10 أرقام',
            'phone.unique' => 'رقم الهاتف مستخدم مسبقاً',
            'gender.required' => 'يرجى تحديد الجنس',
            'nationality.required' => 'يرجى إدخال الجنسية',
            'governorate.required' => 'يرجى إدخال المحافظة',
            'birth_date.required' => 'يرجى إدخال تاريخ الميلاد',
            'email.required' => 'يرجى إدخال البريد الإلكتروني', 
            'email.email' => 'البريد الإلكتروني غير صالح', 
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقاً', 
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',
            'password.required' => 'يرجى إدخال كلمة المرور',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف',
            'password.confirmed' => 'كلمة المرور وتأكيدها غير متطابقتين',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'governorate' => $request->governorate,
            'birth_date' => $request->birth_date,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
            'role_id' => 3,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
