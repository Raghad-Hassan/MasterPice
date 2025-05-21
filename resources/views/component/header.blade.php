<!DOCTYPE html>
<html lang="en">
<head>
    
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>معاً</title>
    
    <!-- Laravel CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts (Cairo font) -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
   
    <style>
    /* ===== الأساسيات والخطوط ===== */
* {
    font-family: 'Cairo', sans-serif;
}

body, html {
    margin: 0;
    padding: 0;
    font-family: 'Cairo', sans-serif;
    background-color: #eef1f4;
    color: #333;
    direction: rtl;
}

/* ===== الهيدر والنافبار ===== */
body {
    direction: rtl;
}

/* Navbar styling */
/* أساسيات النافبار */
.navbar {
    background-color: #005364;
    font-size: 18px;
    padding: 0.8rem 1.5rem;
    transition: all 0.3s ease;
}

/* تحسينات للشاشات الصغيرة */
@media (max-width: 991.98px) {
    .navbar {
        padding: 0.5rem 1rem;
    }
    
    .navbar-brand img.logo-img {
        height: 50px !important;
    }
    
    .navbar-nav {
        padding: 1rem 0;
    }
    
    .nav-item {
        margin: 0.5rem 0;
    }
}

/* زر تسجيل الدخول */
.btn-login {
    background-color: #02d3ac;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-login:hover {
    background-color: #019f87;
    color: white;
    transform: translateY(-2px);
}

/* روابط القائمة */
.navbar-nav .nav-link {
    color: white !important;
    margin: 0 10px;
    padding: 0.5rem 1rem !important;
    position: relative;
    transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #02d3ac !important;
}

/* تأثير العنصر النشط */
.navbar-nav .nav-item.active .nav-link,
.navbar-nav .nav-link.active {
    color: #02d3ac !important;
    font-weight: 600;
}

.navbar-nav .nav-item.active .nav-link::after,
.navbar-nav .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #02d3ac;
    transition: all 0.3s ease;
}

/* قائمة المستخدم المنسدلة */
.user-dropdown {
    background: transparent !important;
    border: none !important;
    color: white !important;
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem !important;
}

.user-dropdown:focus {
    box-shadow: none !important;
}

.icon-style {
      color: white !important;
    font-size: 1.8rem !important;
    margin-left: 80px; /* بدل ما كان margin-right */
    transition: color 0.3s ease !important;

}

.user-dropdown:hover .icon-style {
    color: #02d3ac !important;
    margin-left: 80px; /* بدل ما كان margin-right */
}

.dropdown-menu {
    background-color: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.5rem;
    margin-top: 0.5rem !important;
   
}
.dropdown-menu-end {
    right: 0 !important;
    left: auto !important;
    min-width: 180px;
    z-index: 1050;
    overflow: hidden;
    transform: translateX(0%) !important;
}

/* في الشاشات الصغيرة: خلّي القائمة تاخذ عرض الشاشة تقريباً */
@media (max-width: 575.98px) {
    .dropdown-menu-end {
        left: 0 !important;
        right: 0 !important;
        width: 95% !important;
        margin: 0 auto;
    }
}

/* عناصر القائمة المنسدلة */
.dropdown-item {
    color: #029a84 !important;
    padding: 0.5rem 1.5rem;
  
    transition: all 0.2s ease;
    font-size: 0.95rem;
    font-weight: 600;
}

.dropdown-item:hover {
    background-color: #02d3ac !important;
    color: #fff !important;
    padding-right: 1.5rem;
}

/* تحسينات للهواتف */
@media (max-width: 575.98px) {
    .navbar-brand img.logo-img {
        height: 45px !important;
    }
    
    .btn-login {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .navbar-nav .nav-link {
        font-size: 1rem;
        padding: 0.5rem !important;
    }
}

/* ===== الدوائر الجانبية ===== */
.fixed-circles {
    position: fixed;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    z-index: 9999;
}

.circle {
    width: 50px;
    height: 50px;
    background-color: #3498db;
    border-radius: 50%;
    margin-bottom: 15px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    transition: background-color 0.3s ease;
}

.circle:hover {
    background-color: #02d3ac;
}

.circle i {
    color: white;
    font-size: 24px;
}

/* Tooltip للنص التوضيحي */
.tooltip {
    visibility: hidden;
    position: absolute;
    right: 60px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #333;
    color: white;
    padding: 5px;
    border-radius: 5px;
    font-size: 14px;
    width: max-content;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.circle:hover .tooltip {
    visibility: visible;
    opacity: 1;
}

/* روابط التواصل الاجتماعي */
.social-links {
    display: none;
    position: absolute;
    top: 35px;
    left: -150px;
    background-color: #333;
    padding: 7px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.social-links a {
    color: #02d3ac;
    font-size: 20px;
    margin: 10px;
    text-decoration: none;
}

.social-links a:hover {
    color: white;
}

#social-circle.active .social-links {
    display: block;
}

/* ===== نافذة الرسائل (Modal) ===== */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
    z-index: 99999;
}

.modal-content {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    width: 500px;
    text-align: center;
}

.modal-header {
    font-size: 20px;
    margin-bottom: 10px;
    color: #005364;
}

.modal-body textarea {
    width: 100%;
    height: 100px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: vertical;
}

.modal-footer {
    margin-top: 20px;
}

.close-btn {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}

.submit-btn {
    background-color: #2ecc71;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.close-btn:hover, .submit-btn:hover {
    opacity: 0.9;
}

/* ===== محتوى المؤتمر ===== */
.conference-container {
    width: 100%;
    margin: 0 auto;
    padding: 10px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #fff;
    box-shadow: 0 0 12px rgba(39, 139, 115, 0.1);
    position: relative;
    min-height: 100vh;
    margin-top: 60px;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.conference-content {
    position: relative;
    z-index: 2;
}

.text-content {
    position: relative;
    z-index: 3;
    background-color: rgba(0,0,0,0.3);
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.stat-card {
    background: rgba(255,255,255,0.9);
    padding: 20px;
    border-radius: 5px;
    margin: 10px;
    position: relative;
    z-index: 3;
}

.btn-custom {
    background-color: #02d3ac;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    position: relative;
    z-index: 3;
    transition: background-color 0.3s ease;
}

.btn-custom:hover {
    background-color: #019f87;
    color: white;
}

.user-dropdown.dropdown-toggle::after {
    display: none !important;
}


    </style>
</head>

<body>
    
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <!-- الشعار -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo2.png') }}" alt="اللوغو" height="100" class="me-2 logo-img">
        </a>

        <!-- زر القائمة للهواتف -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- عناصر القائمة -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('index') }}">الرئيسية</a>
            </li>
            <li class="nav-item {{ request()->routeIs('تعرف') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('تعرف') }}">تعرف علينا</a>
            </li>
            <li class="nav-item {{ request()->routeIs('نساهم') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('نساهم') }}">لماذا نساهم؟</a>
            </li>
            <li class="nav-item {{ request()->routeIs('عرض') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('عرض') }}">شارك معنا</a>
            </li>
            <li class="nav-item {{ request()->routeIs('بنك') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('بنك') }}">بنك الأفكار</a>
            </li>
        </ul>

                <!-- نسخة الموبايل من تسجيل الدخول / الملف الشخصي -->
                <div class="d-lg-none mt-3">
                    @auth
                        <div class="dropdown">
                           <a class="nav-link text-center" href="#" id="mobileUserDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu w-100">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">الصفحة الشخصية</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-login w-100 text-center d-block">تسجيل الدخول</a>
                    @endauth
                </div>
            </ul>
        </div>

        <!-- تسجيل الدخول أو الملف الشخصي (دائمًا ظاهر على الشاشات الكبيرة) -->
        <div class="d-none d-lg-flex align-items-center ms-auto">
            @auth
                <div class="dropdown">
                    <button class="btn dropdown-toggle user-dropdown" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1 icon-style"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">الصفحة الشخصية</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">تسجيل الدخول</a>
            @endauth
        </div>
    </div>
</nav>

    




    {{-- side bar right --}}
    <div class="fixed-circles">
        <!-- دائرة الأيقونة مسج -->
        <div class="circle" id="message-circle" onclick="openMessageModal()">
            <i class="fas fa-comment-dots"></i>
            <span class="tooltip">لآرائكم واقتراحاتكم</span>
        </div>

       
        <!-- دائرة التواصل الاجتماعي -->
{{-- <div class="circle" id="social-circle" onclick="toggleSocialLinks()">
    <i class="fas fa-share-alt"></i>
    <span class="tooltip">مواقع التواصل الاجتماعي</span>
    <!-- روابط التواصل الاجتماعي (تم وضعها داخل الدائرة الآن) -->
    <div class="social-links">
        <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>
</div>  --}}
    </div>

 {{-- نحدد حالة عرض المودال حسب وجود success أو errors --}}
<div id="message-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>شاركنا رأيك</h2>
        </div>

        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <div class="modal-body">
                {{-- الرسائل --}}
                @if (session('registered'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        تم التسجيل بنجاح! هل ترغب بمشاركة رأيك؟
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <textarea id="user-message" name="message" placeholder="اكتب رأيك هنا...">{{ old('message') }}</textarea>
            </div>

            <div class="modal-footer">
                <button type="submit" class="submit-btn">إرسال</button>
                <button type="button" class="close-btn" onclick="closeMessageModal()">إغلاق</button>
            </div>
        </form>
    </div>
</div>

{{-- هذا السطر بيشغل المودال تلقائيًا إذا كان فيه سيشن --}}
@if (session('registered') || session('show_feedback_modal'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            openMessageModal();
        });
    </script>
@endif

<script>
    function openMessageModal() {
        document.getElementById("message-modal").style.display = "flex";
    }

    function closeMessageModal() {
        document.getElementById("message-modal").style.display = "none";
    }

    
</script>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
