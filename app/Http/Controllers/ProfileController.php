<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OpportunityApplication; 
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
   
    public function showProfile()
    {
        $user = auth()->user();

        
        $volunteerHours = $user->volunteeringHours()->sum('hours');
        $completedProjects = $user->projects()->count();
        $certificatesCount = $user->certificates()->count();

        // احضار آخر الفرص التطوعية اللي سجل فيها اليوزر
        $userId = auth()->id();

        $recentActivities = OpportunityApplication::where('user_id', $userId)
            ->with('opportunity') // نجيب معلومات الفرصة المرتبطة
            ->latest()
            ->take(5)
            ->get();

        return view('user.profil', compact('user', 'volunteerHours', 'completedProjects', 'certificatesCount', 'recentActivities'));
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
            'email'      => 'required|email|max:255|unique:users,email,' . auth()->id(),
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

        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'phone'      => $validatedData['phone'],
            'email'      => $validatedData['email'],
            'bio'        => $validatedData['bio'],
        ]);

        return redirect()->route('profile.show')->with('success', 'تم تحديث البروفايل بنجاح.');
    }



    public function uploadPhoto(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // تحقق من نوع الصورة والحجم
    ]);

    $user = Auth::user();

    
    $path = $request->file('image')->store('profile_images', 'public');

   
    if ($user->profile_image && Storage::disk('public')->exists(str_replace('/storage/', '', $user->profile_image))) {
        Storage::disk('public')->delete(str_replace('/storage/', '', $user->profile_image));
    }

   
    $user->profile_image = '/storage/' . $path;
    $user->save();

    return redirect()->back()->with('success', 'تم تحديث صورة البروفايل.');
}
}
