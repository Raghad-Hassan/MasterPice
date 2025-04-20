<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
    
            if (Auth::id() !== 1) {
                Auth::logout();
                return back()->withErrors(['email' => 'غير مصرح لك بالدخول كأدمن.']);
            }
    
            return redirect()->route('admin.dashboard');
        }
    
        return back()->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.']);
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح.');
    }
}