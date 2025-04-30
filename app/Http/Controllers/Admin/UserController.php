<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
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
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);
    
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'governorate' => $request->governorate,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 3, 
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }
    

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
    
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'تم تعديل المستخدم بنجاح');
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}