@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">إضافة مستخدم</h2>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div>
            <label for="first_name">الاسم الأول</label>
            <input type="text" name="first_name" id="first_name" required>
        </div>
    
        <div>
            <label for="last_name">الاسم الأخير</label>
            <input type="text" name="last_name" id="last_name" required>
        </div>
    
        <div>
            <label for="phone">رقم الهاتف</label>
            <input type="text" name="phone" id="phone" required>
        </div>
    
        <div>
            <label for="gender">الجنس</label>
            <select name="gender" id="gender" required>
                <option value="male">ذكر</option>
                <option value="female">أنثى</option>
            </select>
        </div>
    
        <div>
            <label for="nationality">الجنسية</label>
            <input type="text" name="nationality" id="nationality" required>
        </div>
    
        <div>
            <label for="governorate">المحافظة</label>
            <input type="text" name="governorate" id="governorate" required>
        </div>
    
        <div>
            <label for="birth_date">تاريخ الميلاد</label>
            <input type="date" name="birth_date" id="birth_date" required>
        </div>
    
        <div>
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" required>
        </div>
    
        <div>
            <label for="password">كلمة المرور</label>
            <input type="password" name="password" id="password" required>
        </div>
    
        <div>
            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
    
        <button type="submit">تسجيل</button>
    </form>
</div>    
@endsection
