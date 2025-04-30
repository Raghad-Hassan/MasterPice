<!-- resources/views/admin/organization/edit.blade.php -->

@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>تعديل المؤسسة</h2>

        <form action="{{ route('admin.organizations.update', $organization->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="organization_name">اسم المؤسسة</label>
                <input type="text" class="form-control" id="organization_name" name="organization_name" value="{{ old('organization_name', $organization->organization_name) }}" required>
            </div>

            <div class="form-group">
                <label for="first_name">الاسم الأول</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $organization->first_name) }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">الاسم الأخير</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $organization->last_name) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $organization->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $organization->email) }}" required>
            </div>

            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $organization->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور (اتركها فارغة إذا لم تريد تغييرها)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="profile_picture">صورة البروفايل</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                @if ($organization->profile_picture)
                    <img src="{{ asset('storage/' . $organization->profile_picture) }}" alt="Profile Picture" width="100">
                @endif
            </div>

            <div class="form-group">
                <label for="website">الموقع الإلكتروني</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $organization->website) }}">
            </div>

            <div class="form-group">
                <label for="governorate">المحافظة</label>
                <input type="text" class="form-control" id="governorate" name="governorate" value="{{ old('governorate', $organization->governorate) }}" required>
            </div>

            <div class="form-group">
                <label for="sector">القطاع</label>
                <select class="form-control" id="sector" name="sector" required>
                    <option value="private" {{ $organization->sector == 'private' ? 'selected' : '' }}>خاص</option>
                    <option value="NGO" {{ $organization->sector == 'NGO' ? 'selected' : '' }}>منظمة غير ربحية</option>
                </select>
            </div>

            <div class="form-group">
                <label for="national_id">الرقم الوطني</label>
                <input type="text" class="form-control" id="national_id" name="national_id" value="{{ old('national_id', $organization->national_id) }}" required>
            </div>

            <div class="form-group">
                <label for="volunteer_services">خدمات المتطوعين</label>
                <select class="form-control" id="volunteer_services" name="volunteer_services" required>
                    <option value="yes" {{ $organization->volunteer_services == 'yes' ? 'selected' : '' }}>نعم</option>
                    <option value="no" {{ $organization->volunteer_services == 'no' ? 'selected' : '' }}>لا</option>
                </select>
            </div>

            <div class="form-group">
                <label for="volunteer_type">نوع التطوع</label>
                <input type="text" class="form-control" id="volunteer_type" name="volunteer_type" value="{{ old('volunteer_type', $organization->volunteer_type) }}">
            </div>

            <div class="form-group">
                <label for="bio">السيرة الذاتية</label>
                <textarea class="form-control" id="bio" name="bio">{{ old('bio', $organization->bio) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">تحديث المؤسسة</button>
        </form>
    </div>
@endsection
