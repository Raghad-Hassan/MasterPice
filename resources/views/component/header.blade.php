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
.navbar {
    background-color: #005364; 
    font-size: 18px;
    padding: 1rem 2rem;
}

.btn-login {
    background-color: #02d3ac; 
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.navbar.fixed-top {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;
}

.btn-login:hover {
    background-color: #019f87;
    color: white;
}

.navbar-nav .nav-link {
    color: white !important;
    margin: 0 15px;
    text-decoration: none;
}


.navbar-nav .nav-link:hover {
    color: #02d3ac !important;
    transition: color 0.3s ease-in-out;
    border-bottom: 2px solid #02d3ac;
}


.navbar-nav .nav-link.active {
    color: #02d3ac !important;
    border-bottom: 2px solid #02d3ac;
}


@media (max-width: 991px) {
    .navbar-nav {
        text-align: center;
    }

    
    .navbar-nav .nav-link {
        font-size: 16px;
        margin: 10px 0;
    }

    .navbar {
        padding: 1rem;
    }

    
    .btn-login {
        font-size: 16px;
        padding: 12px 24px;
    }
}


/* ===== عناصر القائمة ===== */
.nav-item .nav-link {
    color: white;
    padding: 0.5rem 1rem;
    transition: color 0.3s ease;
}

.nav-item .nav-link:hover {
    color: #02d3ac;
}

.active-link {
    color: #ff6600 !important;
    font-weight: bold;
}

/* ===== Dropdown المستخدم ===== */
.dropdown {
    position: relative;
    display: inline-block;
}

.btn.dropdown-toggle {
    background: transparent;
    border: none;
    color: white;
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    transition: none;
}

.icon-style {
    color: white !important;
    font-size: 2rem !important;
    margin-right: 0.5rem;
    margin-left: 100px !important;
    transition: none !important;
}

.icon-style:hover {
    color: #02d3ac !important;
}

/* إزالة تأثيرات الضغط */
.btn.dropdown-toggle:active,
.btn.dropdown-toggle:focus,
.icon-style:active,
.icon-style:focus {
    transform: none !important;
    outline: none !important;
    box-shadow: none !important;
    border: none !important;
}

.dropdown-toggle::after {
    display: none !important;
}

/* قائمة Dropdown */
.dropdown-menu {
    background-color: #ffffff;
    border: 1px solid #333;
    border-radius: 0.25rem;
    margin-top: 0.5rem !important;
    width: 100%;
    min-width: 200px;
    position: absolute !important;
    left: 0 !important;
}

.dropdown-item {
    color: #029a84 !important;
    padding: 0.75rem 1.5rem;
    text-align: right;
    transition: background-color 0.2s ease;
    font-size: 1rem;
    border-bottom: 1px solid #333;
    font-weight: 600;
}

.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item:hover {
    background-color: #02d3ac !important;
    color: #fff !important;
}

.dropdown-item[type="submit"] {
    background: none;
    border: none;
    width: 100%;
    text-align: right;
    cursor: pointer;
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

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="اللوغو" height="100" class="me-2">
            </a>
    
            <!-- Button to toggle navbar collapse on small screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('تعرف') }}">تعرف علينا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('نساهم') }}">لماذا نساهم؟</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('عرض') }}">شارك معنا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('بنك') }}">بنك الأفكار</a>
                    </li>
                </ul>
            </div>
    
            <!-- Dropdown for user authentication -->
            <div class="dropdown">
                @auth
                    <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1 icon-style" style="color: white; font-size: 2rem;"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="margin-top: 50px;">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">الصفحة الشخصية</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
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
<div class="circle" id="social-circle" onclick="toggleSocialLinks()">
    <i class="fas fa-share-alt"></i>
    <span class="tooltip">مواقع التواصل الاجتماعي</span>
    <!-- روابط التواصل الاجتماعي (تم وضعها داخل الدائرة الآن) -->
    <div class="social-links">
        <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>
</div>


        
        
    </div>


    <!-- نافذة البوب أب لإدخال الرأي -->
 <div id="message-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>شاركنا رأيك</h2>
        </div>
        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <div class="modal-body">
                <textarea id="user-message" name="message" placeholder="اكتب رأيك هنا..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="submit-btn">إرسال</button>
                <button type="button" class="close-btn" onclick="closeMessageModal()">إغلاق</button>
            </div>
        </form>
    </div>
</div>
    <script>


        
        function openMessageModal() {
            document.getElementById("message-modal").style.display = "flex";
        }

        function closeMessageModal() {
            document.getElementById("message-modal").style.display = "none";
        }

        function submitMessage() {
            let message = document.getElementById("user-message").value;
            if (message.trim() !== "") {
                alert("تم إرسال رأيك بنجاح: " + message);
                closeMessageModal();
            } else {
                alert("يرجى كتابة رأيك أولاً.");
            }
        }

        function toggleSocialLinks() {
    var circle = document.getElementById("social-circle");
    circle.classList.toggle("active");
}

    </script>
    <!-- Bootstrap JS (إذا كنت تستخدم Bootstrap 5، يجب استخدام فقط Bootstrap.bundle.min.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
