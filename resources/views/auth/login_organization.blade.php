<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معاً</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/counter.js"></script>
    <style>
        body {
            direction: rtl;
            font-family: 'Cairo', sans-serif;
            background-color: #fff; /* الخلفية أصبحت بيضاء */
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

        .btn-organization {
            width: 100%;
            padding: 12px;
            background-color: #02d3ac;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn-organization:hover {
            background-color: #029a84;
        }

        .forgot-password {
            color: #02d3ac;
            text-decoration: none;
            font-size: 14px;
            margin-left: 190px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #02d3ac;
            text-decoration: none;
            font-size: 16px;
        }

        .register-link:hover {
            color: #029a84
        }
    </style>
</head>
<body>

  <div class="login-box">
    <div class="icon">
      <i class="fas fa-building"></i>
    </div>
    <h2>تسجيل دخول حساب مؤسسة</h2>
    <form action="#" method="POST">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="text" name="email_or_phone" placeholder="البريد الإلكتروني أو رقم الهاتف" required>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="كلمة المرور" required>
      </div>

      <a href="#" class="forgot-password">هل نسيت كلمة السر؟</a>

      <button class="btn-organization" type="submit">تسجيل دخول</button>
      <a class="register-link" href="{{ route('register_organization') }}">إنشاء حساب مؤسسة</a>
    
      <a href="{{ route('index') }}" class="register-link">الرجوع الى الصفحة الرئيسية</a>


    </form>
  </div>

</body>
</html>
