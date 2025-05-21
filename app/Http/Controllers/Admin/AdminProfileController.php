<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::user();
        return view('admin.profile.show', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

       
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        
        if ($request->hasFile('profile_image')) {
           
            if ($admin->profile_image) {
                Storage::delete('public/profile_images/' . $admin->profile_image);
            }

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);
            $admin->profile_image = $imageName;
        }

       
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        
        $admin->save();

      
        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
