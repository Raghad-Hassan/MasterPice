@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">الملف الشخصي</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $admin->first_name) }}">
        @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
        
        
        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $admin->last_name) }}">
        @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
        

        <div class="mb-3">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>تغيير صورة الملف الشخصي (اختياري)</label>
            <input type="file" name="profile_image" class="form-control">
            @error('profile_image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        @if($admin->profile_image)
            <div class="mb-3">
                <img src="{{ asset('storage/profile_images/' . $admin->profile_image) }}" alt="صورة البروفايل" width="100">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
