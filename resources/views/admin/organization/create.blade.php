<!-- resources/views/admin/organization/create.blade.php -->

@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>إضافة مؤسسة جديدة</h2>

        <form action="{{ route('admin.organizations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="organization_name">اسم المؤسسة</label>
                <input type="text" class="form-control" id="organization_name" name="organization_name" required>
            </div>

            <div class="form-group">
                <label for="first_name">الاسم الأول</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">الاسم الأخير</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">صورة البروفايل</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            </div>

            <div class="form-group">
                <label for="website">الموقع الإلكتروني</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>

            <div class="form-group">
                <label for="governorate">المحافظة</label>
                <input type="text" class="form-control" id="governorate" name="governorate" required>
            </div>

            <div class="form-group">
                <label for="sector">القطاع</label>
                <select class="form-control" id="sector" name="sector" required>
                    <option value="private">خاص</option>
                    <option value="NGO">منظمة غير ربحية</option>
                </select>
            </div>

            <div class="form-group">
                <label for="national_id">الرقم الوطني</label>
                <input type="text" class="form-control" id="national_id" name="national_id" required>
            </div>

            <div class="form-group">
                <label for="volunteer_services">خدمات المتطوعين</label>
                <select class="form-control" id="volunteer_services" name="volunteer_services" required>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
            </div>

            <div class="form-group">
                <label for="volunteer_type">نوع التطوع</label>
                <input type="text" class="form-control" id="volunteer_type" name="volunteer_type">
            </div>

            <div class="form-group">
                <label for="bio">السيرة الذاتية</label>
                <textarea class="form-control" id="bio" name="bio"></textarea>
            </div>

            <div class="form-group">
                <label for="image">صورة أخرى</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">إضافة المؤسسة</button>
        </form>
    </div>
@endsection
