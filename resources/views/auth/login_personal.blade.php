<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معاً</title>
    <!-- استيراد المكتبات المطلوبة -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            direction: rtl;
            font-family: 'Cairo', sans-serif;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.20);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box .icon {
            font-size: 50px;
            color: #02d3ac;
            margin-bottom: 10px;
        }

        h2 {
            margin-bottom: 25px;
            color: #02d3ac;
            font-size: 24px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #02d3ac;
        }

        .input-group input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .forgot {
            display: block;
            text-align: right;
            color:#02d3ac;
            font-size: 14px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .btn-personal {
            width: 100%;
            padding: 12px;
            background-color: #02d3ac;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-personal:hover {
            background-color: #029a84;
        }
        
        .link-login {
            font-size: 16px;
            font-weight: bold;
            color: #02d3ac; 
            text-decoration: none;
            padding: 1px;
            display: inline-block;
            margin-top: 10px;
        }

        .link-login:hover {
            color: #029a84; 
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <h2>تسجيل الدخول</h2>
        
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger text-end">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="email_or_phone" placeholder="البريد الإلكتروني أو رقم الهاتف" required>
            </div>
        
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="كلمة المرور" required>
            </div>
        
            <button type="submit" class="btn-personal">تسجيل الدخول</button>
            
            <a href="{{ route('index') }}" class="link-login">الرجوع للصفحة الرئيسية</a>
        </form>
 
</body>
</html>