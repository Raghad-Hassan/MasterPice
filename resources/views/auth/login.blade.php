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
        background: linear-gradient(to left, #02d3ac, #28a745);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
      }

      .containerLog {
        display: flex;
        gap: 30px;
        background-color: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 0 25px rgba(0,0,0,0.15);
        max-width: 800px;
        width: 100%;
        flex-wrap: wrap;
        justify-content: center;
      }

      .card {
        background-color: #f9f9f9;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        width: 300px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
      }

      .card:hover {
        transform: translateY(-5px);
      }

      .icon {
        font-size: 60px;
        margin-bottom: 15px;
        color: #02d3ac;
      }

      h3 {
        margin-bottom: 20px;
        color: #333;
      }

      .btn-login {
        background-color: #02d3ac;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 10px;
        transition: all 0.3s;
        width: 100%;
      }

      .btn-login:hover {
        background-color: #029a84;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }

      .link {
        display: block;
        margin-top: 15px;
        color: #02d3ac;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
      }

      .link:hover {
        color: #029a84;
        text-decoration: underline;
      }

      @media (max-width: 700px) {
        .containerLog {
          flex-direction: column;
          align-items: center;
          padding: 20px;
        }
        
        .card {
          width: 100%;
          margin-bottom: 20px;
        }
      }
    </style>
</head>
<body>

  <div class="containerLog">
    <!-- حساب شخصي -->
    <div class="card">
      <div class="icon"><i class="fas fa-user"></i></div>
      <h3>حساب شخصي</h3>
      
      <!-- استبدل الرابط بالزر التالي -->
      <form action="{{ route('login1') }}" method="GET" style="display: inline;">
        
          <button type="submit" class="btn-login">تسجيل الدخول</button>
      </form>
      
      <a class="link" href="{{ route('register') }}">إنشاء حساب شخصي</a>
  </div>

    <!-- حساب مؤسسة -->
    {{-- <div class="card">
      <div class="icon"><i class="fas fa-building"></i></div>
      <h3>حساب مؤسسة</h3>
      <button class="btn-login" onclick="window.location.href='{{ route('login_organization') }}'">تسجيل الدخول</button>
      <a class="link" href="{{ route('register_organization') }}">إنشاء حساب مؤسسة</a>    </div>
  </div> --}}

</body>
</html>