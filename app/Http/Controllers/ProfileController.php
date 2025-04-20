<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // عرض البروفايل
    public function showProfile()
    {
        $user = auth()->user();
        return view('user.profil', compact('user'));
    }

    // عرض نموذج تعديل البروفايل
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profil', compact('user'));
    }

    // تحديث بيانات البروفايل
    public function update(Request $request)
    {
        $user = Auth::user();

       
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'phone'      => ['required', 'regex:/^07[0-9]{8}$/'], 
            'email'      => 'required|email|max:255|unique:users,email,' . auth()->id(), // تجاهل المستخدم الحالي
            'bio'        => 'nullable|string|max:255', 
        ], [
            'first_name.required' => 'الاسم الأول مطلوب.',
            'first_name.string'   => 'الاسم الأول يجب أن يكون نصاً.',
            'first_name.max'      => 'الاسم الأول يجب ألا يزيد عن 50 حرفاً.',
        
            'last_name.required' => 'اسم العائلة مطلوب.',
            'last_name.string'   => 'اسم العائلة يجب أن يكون نصاً.',
            'last_name.max'      => 'اسم العائلة يجب ألا يزيد عن 50 حرفاً.',
        
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex'    => 'يجب أن يبدأ رقم الهاتف بـ 07 ويتكون من 10 أرقام.',
        
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email'    => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.max'      => 'البريد الإلكتروني يجب ألا يزيد عن 255 حرفاً.',
            'email.unique'   => 'البريد الإلكتروني مستخدم مسبقاً.',
        
            'bio.max'        => 'النبذة يجب ألا تزيد عن 255 حرفاً.',
        ]);
        


            
       

        // تحديث حقل first_name فقط
        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'bio' => $validatedData['bio'],


        ]);

        return redirect()->route('profile.show')->with('success', 'تم تحديث الاسم بنجاح');
    }
}
