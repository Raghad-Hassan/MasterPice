<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      .dropdown {
    position: relative;
    display: inline-block;
}

/* Style for the dropdown toggle button */
.btn.dropdown-toggle {
    background: transparent;
    border: none;
    color: white;
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    transition: none;
    position: relative;
}

/* User icon specific styling */
.icon-style {
    color: white !important;
    font-size: 2rem !important;
    transition: none !important;
    margin-right: 0.5rem;
    display: inline-block;
    vertical-align: middle;
    margin-left: 100px !important; /* تعديل هنا */
}
.icon-style:hover {
    color: #02d3ac !important;
}

/* Remove all click effects on the button and icon */
.btn.dropdown-toggle:active,
.btn.dropdown-toggle:focus,
.icon-style:active,
.icon-style:focus {
    transform: none !important;
    outline: none !important;
    box-shadow: none !important;
    border: none !important;
}

/* Dropdown menu styling */
.dropdown-menu {
    background-color: #ffffff;
    border: 1px solid #333;
    border-radius: 0.25rem;
    margin-top: 0.5rem !important; /* تعديل هنا */
    width: 100%;
    min-width: 1000px;
    position: absolute !important; /* إضافة مهمة */
    left: 1000px !important; /* إضافة مهمة */
   
}

/* Dropdown items styling */
.dropdown-item {
    color:#029a84!important;
    padding: 0.75rem 1.5rem;
    text-align: right;
    transition: background-color 0.2s ease;
    font-size: 1rem;
    border-bottom: 1px solid #333;
    font-weight: 800px;
}

/* Last item shouldn't have bottom border */
.dropdown-item:last-child {
    border-bottom: none;
}

/* Hover effect for dropdown items */
.dropdown-item:hover {
    background-color: #02d3ac !important;
    color: #fff !important;
}

/* Active/focus state for dropdown items */
.dropdown-item:focus, 
.dropdown-item:active {
    background-color: #444 !important;
}

/* Logout button specific styling */
.dropdown-item[type="submit"] {
    background: none;
    border: none;
    width: 100%;
    text-align: right;
    cursor: pointer;
}

/* Remove Bootstrap's default dropdown arrow */
.dropdown-toggle::after {
    display: none !important;
}

/* إصلاح تحرك النافبار عند فتح القائمة */
.navbar {
    overflow: visible !important;
    position: fixed !important;
    width: 100%;
    z-index: 1030;
    top: 0; /* إضافة مهمة */
}

.navbar-collapse {
    overflow: visible !important;
}

/* تعديل إضافي لضمان عدم تحرك العناصر */
.container-fluid {
    position: relative;
}

.dropdown-toggle {
    white-space: nowrap;
}
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .fixed-circles {
            position: fixed;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
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
        }

        .circle i {
            color: white;
            font-size: 24px;
        }

        /* إظهار النص عند التمرير */
        .circle:hover .tooltip {
            visibility: visible;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        /* إخفاء النص بشكل افتراضي */
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
        }

        /* إظهار الروابط عند النقر */
        .circle.active .social-links {
            display: block;
        }

        /* ستايل مربع التواصل الاجتماعي */
        .social-links {
            display: none;
            position: absolute;
            top: 0;
            left: 60px;
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
        }

        .social-links a {
            color: white;
            margin: 5px;
            font-size: 18px;
        }

        .social-links a:hover {
            color: #3498db;
        }

        .circle:hover {
            background-color: #2ecc71;
        }

        /* ستايل نافذة البوب أب */
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
        }

        .modal-body textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-footer {
            margin-top: 10px;
        }

        .close-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


 .social-links {
    display: none; /* إخفاء الروابط في البداية */
    position: absolute; /* لجعلها تظهر فوق الدائرة */
    top: 35px; /* ضبط المسافة التي تظهر فيها الروابط */
    left: -150px; /* تعديل المسافة على اليمين أو اليسار حسب الحاجة */
    background-color: #333;
    padding: 7px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.social-links  {
    color: #02d3ac;
    font-size: 20px;
    margin: 10px;
    text-decoration: none;
}

.social-links :hover {
    color: #02d3ac;
}

#social-circle.active .social-links {
    display: block; 
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid ">
            
            <a class="navbar-brand" href="{{ url('/') }}">اللوغو</a>
           
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
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

            @auth
            <div class="dropdown">
                @auth
                    <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1 icon-style" style="color: white; font-size: 2rem;"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style=" margin-top: 50px;">
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
            
            @else
            <a href="{{ route('login') }}" class="btn-login">تسجيل الدخول</a>
            @endauth
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


        
        <div class="circle" id="email-circle" onclick="">
            <i class="fas fa-envelope"></i>
            <span class="tooltip">تواصل معنا</span>
        </div>
    </div>
    <!-- نافذة البوب أب لإدخال الرأي -->
    <div id="message-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>شاركنا رأيك</h2>
            </div>
            <div class="modal-body">
                <textarea id="user-message" placeholder="اكتب رأيك هنا..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="submit-btn" onclick="submitMessage()">إرسال</button>
                <button class="close-btn" onclick="closeMessageModal()">إغلاق</button>
            </div>
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
