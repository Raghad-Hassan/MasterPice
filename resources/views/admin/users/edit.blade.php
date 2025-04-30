@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">تعديل المستخدم</h2>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>الاسم الأول</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}">
            @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>الاسم الأخير</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}">
            @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
