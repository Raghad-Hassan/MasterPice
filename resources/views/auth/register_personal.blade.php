<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معاً - تسجيل حساب جديد</title>
    <!-- استيراد المكتبات المطلوبة -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            direction: rtl;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 1000px;
            text-align: center;
            margin-top: 350px;
        }

        h1 {
            color: #02d3ac;
            margin-bottom: 50px;
        }

        .icon {
            font-size: 40px;
            color: #02d3ac;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
            display: flex;
            justify-content: space-between;
        }

        .form-group input {
            width: 60%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #bbb;
        }

        .form-group select {
            width: 60%;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 50px;
            font-size: 14px;
        }

        .form-group label {
            display: block;
            text-align: right;
            margin-bottom: 5px;
        }

        .forget-password {
            color: #02d3ac;
            font-size: 17px;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }

        .forget-password:hover {
            text-decoration: underline;
        }

        button {
            background-color: #02d3ac;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 30%;
            cursor: pointer;
            font-size: 16px;
        }
        

        button:hover {
            background-color: #028f71;
        }

        .account-type {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .account-type div {
            text-align: center;
            cursor: pointer;
        }

        .account-type div:hover {
            color: #02d3ac;
        }

        .account-type i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .back-link {
            color: #02d3ac;
            text-decoration: none;
            display: block;
            margin-bottom: 20px;
            text-align: right;
        }

        .back-link:hover {
            text-decoration: underline;
        }
        
        button[onclick] {
            font-size: 16px;
            color: #02d3ac;
            background-color: transparent;
            border: none;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            cursor: pointer;
            text-align: center;
        }

        button[onclick]:hover {
            color: #019d7f;
        }
       
        .center-button {
            display: flex;
            justify-content: center;
        }

        .form-group {
        display: flex;
        justify-content: space-between;
        gap: 4%;
        margin-bottom: 15px;
    }

    .form-group > div {
        width: 48%;
    }

    select, input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
    .form-select{
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }
    

    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-user"></i> يرجى إدخال تفاصيل الحساب</h1>
        <a class="back-link" href="{{ route('index') }}">
            <i class="fas fa-arrow-left"></i> الرجوع الى الصفحه الرئيسية
        </a>
       <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            
            @if($errors->any())
                <div class="alert alert-danger text-end">
                    <ul style="list-style: none; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <div style="width:48%;">
                    <label for="first_name">الاسم الأول</label>
                    <input type="text" id="first_name" name="first_name" placeholder="الاسم الأول" required value="{{ old('first_name') }}">
                </div>
                <div style="width:48%;">
                    <label for="last_name">اسم العائلة</label>
                    <input type="text" id="last_name" name="last_name" placeholder="اسم العائلة" required value="{{ old('last_name') }}">
                </div>
            </div>

            <div class="form-group">
                <div style="width:48%;">
                    <label for="phone">رقم الهاتف</label>
                    <input type="text" id="phone" name="phone" placeholder="رقم الهاتف" required value="{{ old('phone') }}">
                </div>
               
            </div>

            <div class="form-group">
                <div>
                    <label for="gender">الجنس</label>
                    <select id="gender" name="gender" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>
                <div>
                    <label for="nationality">الجنسيه</label>
                    <input type="text" id="nationality" name="nationality" placeholder="الجنسيه" required value="{{ old('nationality') }}">
                </div>
            </div>
            
           
            
                <div style="width:48%;">
                    <label for="governorate" >المحافظة</label>
                    <select id="governorate" name="governorate" class=".form-group " required>

                        

                        <option value="" disabled selected>اختر المحافظة</option>
                        <option value="البلقاء" {{ old('governorate') == 'البلقاء' ? 'selected' : '' }}>البلقاء</option>

                         <option value="عمان" {{ old('governorate') == 'عمان' ? 'selected' : '' }}>عمان</option>
                        <option value="إربد" {{ old('governorate') == 'إربد' ? 'selected' : '' }}>إربد</option>
                        <option value="الزرقاء" {{ old('governorate') == 'الزرقاء' ? 'selected' : '' }}>الزرقاء</option>
                        <option value="المفرق" {{ old('governorate') == 'المفرق' ? 'selected' : '' }}>المفرق</option>
                        <option value="العقبة" {{ old('governorate') == 'العقبة' ? 'selected' : '' }}>العقبة</option>
                        <option value="الطفيلة" {{ old('governorate') == 'الطفيلة' ? 'selected' : '' }}>الطفيلة</option>
                        <option value="معان" {{ old('governorate') == 'معان' ? 'selected' : '' }}>معان</option>
                        <option value="الكرك" {{ old('governorate') == 'الكرك' ? 'selected' : '' }}>الكرك</option>
                        <option value="مأدبا" {{ old('governorate') == 'مأدبا' ? 'selected' : '' }}>مأدبا</option>
                        <option value="جرش" {{ old('governorate') == 'جرش' ? 'selected' : '' }}>جرش</option>
                        <option value="عجلون" {{ old('governorate') == 'عجلون' ? 'selected' : '' }}>عجلون</option>
                        <option value="الرمثا" {{ old('governorate') == 'الرمثا' ? 'selected' : '' }}>الرمثا</option>
                    </select>
                </div>
          

            
            <div class="form-group">
                <div style="width:48%;">
                    <label for="birth_date">تاريخ الميلاد</label>
                    <input type="date" id="birth_date" name="birth_date" required value="{{ old('birth_date') }}">
                </div>
                
                <div style="width:48%;">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" placeholder="example@email.com" required value="{{ old('email') }}">
                </div>
            </div>
            
            <div class="form-group">
                <div style="width:48%;">
                    <label for="password">كلمة السر</label>
                    <input type="password" id="password" name="password" placeholder="كلمة السر" required>
                </div>
                <div style="width:48%;">
                    <label for="password_confirmation">تأكيد كلمة السر</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="تأكيد كلمة السر" required>
                </div>
            </div>
            

            <button type="submit">تسجيل</button>
        
        </form>

        <!-- مركزية الزر -->
        <div class="center-button">
            <button onclick="window.location.href='{{ route('login1') }}'">تسجيل الدخول الى الحساب الشخصي</button>
        </div>
    </div>
    </div>

    
</body>
</html>