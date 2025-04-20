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
            margin-top: 800px;
        }

        h1 {
            color: #02d3ac;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 40px;
            color: #02d3ac;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .form-row .col {
            width: 48%;
            margin-bottom: 10px;
        }

        .form-group input, .form-group select {
            width: 60%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group label {
            display: block;
            text-align: right;
            margin-bottom: 5px;
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
            margin-top: 20px;
            display: block; 
            margin: 20px auto; 
        }

        button:hover {
            background-color: #028f71;
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

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            margin: 0 auto;
        }

        .card-title {
            text-align: center;
            font-size: 27px;
            margin-bottom: 20px;
            color:#02d3ac;
        }

        .forget-password-register {
            color: #02d3ac; 
            font-size: 17px;
            text-decoration: none; 
            display: inline-block;
            margin-top: 3px; 
            transition: color 0.3s ease; 
        }

        .forget-password-register:hover {
            color: #028f71; 
        }

    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-building"></i> إنشاء حساب مؤسسة</h1>
        <a class="back-link" href="{{ route('index') }}"><i class="fas fa-arrow-left"></i> الرجوع الى الصفحه الرئيسية</a>

        <!-- الحقول الأساسية -->
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="organization_name">اسم المؤسسة</label>
                    <input type="text" id="organization_name" name="organization_name" placeholder="اسم المؤسسة" required>
                </div>
                <div class="col">
                    <label for="website">الموقع الإلكتروني</label>
                    <input type="url" id="website" name="website" placeholder="الموقع الإلكتروني" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="first_name">الاسم الأول</label>
                    <input type="text" id="first_name" name="first_name" placeholder="الاسم الأول" required>
                </div>
                <div class="col">
                    <label for="last_name">اسم العائلة</label>
                    <input type="text" id="last_name" name="last_name" placeholder="اسم العائلة" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" placeholder="البريد الإلكتروني" required>
                </div>
                <div class="col">
                    <label for="phone">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" placeholder="رقم الهاتف" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="password">كلمة السر</label>
                    <input type="password" id="password" name="password" placeholder="كلمة السر" required>
                </div>
                <div class="col">
                    <label for="confirm_password">تأكيد كلمة السر</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="تأكيد كلمة السر" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="governorate">المحافظة</label>
                    <select id="governorate" name="governorate" required>
                        <option value="">-- Governorate --</option>
                        <option value="Amman">عمان</option>
                        <option value="Zarqa">الزرقاء</option>
                        <option value="Irbid">إربد</option>
                        <option value="Aqaba">العقبة</option>
                    </select>
                </div>
                <div class="col">
                    <label for="sector">القطاع</label>
                    <select id="sector" name="sector" required>
                        <option value="">-- قطاع --</option>
                        <option value="private">قطاع خاص</option>
                        <option value="NGO">منظمة غير ربحية</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- المعلومات المتعلقة بشهادة التسجيل -->
        <div class="card">
            <h3 class="card-title">المعلومات المتعلقة بشهادة التسجيل :</h3>

            <div class="form-group">
                <label for="organization_name">اسم الجهة</label>
                <input type="text" id="organization_name" name="organization_name" placeholder="اسم الجهة" required>
            </div>

            <div class="form-group">
                <label for="national_id">الرقم الوطني للمنشأة</label>
                <input type="text" id="national_id" name="national_id" placeholder="الرقم الوطني للمنشأة" required>
            </div>

            <div class="form-group">
                <label for="volunteer_services">هل ترغب في تقديم خدمات تطوعية ضمن مجال عمل المركز الوطني للأمن وإدارة الأزمات؟*</label>
                <select id="volunteer_services" name="volunteer_services" required>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
            </div>

            <div class="form-group">
                <label for="volunteer_type">ما هو نوع التطوع الذي ترغب في تقديمه؟</label>
                <input type="text" id="volunteer_type" name="volunteer_type" placeholder="نوع التطوع" required>
            </div>

            <div class="form-group">
                <label for="logistics_services">يرجى تحديد ما هي الخدمات اللوجستية التي يمكنك تقديمها</label>
                <input type="text" id="logistics_services" name="logistics_services" placeholder="الخدمات اللوجستية" required>
            </div>

            <button type="submit">تسجيل</button>
            <a href="{{ route('login_organization') }}" class="forget-password-register">تسجيل الدخول لحساب مؤسسة</a>
        </div>
    </div>

</body>
</html>
