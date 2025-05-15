<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | لوحة التحكم - العمل التطوعي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary: #005364; /* أخضر أساسي */
            --secondary: #02d3ac; /* أخضر فاتح */
            --accent: #FF9800; /* برتقالي */
            --bg: #F5F5F5; /* خلفية فاتحة */
            --text: #333333; /* نص داكن */
            --sidebar-width: 240px;
        }

        html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            transition: all 0.3s;
            overflow: hidden;
        }

        /* الشريط الجانبي */
       :root {
  --sidebar-primary: #005364;
  --sidebar-accent: #019f87;
  --sidebar-hover: rgba(1, 159, 135, 0.15);
  --sidebar-text: #ffffff;
  --sidebar-border: rgba(255, 255, 255, 0.1);
}

 
.sidebar {
  width: 250px;
  background: var(--sidebar-primary);
  color: var(--sidebar-text);
  height: 100vh;
  position: fixed;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
  z-index: 1000;
  box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
  font-family: 'Tajawal', sans-serif;
  /* إزالة overflow:hidden وإضافة التالي */
  display: flex;
  flex-direction: column;
}

.sidebar-header {
  padding: 25px 20px;
  text-align: center;
  border-bottom: 1px solid var(--sidebar-border);
  background-color: rgba(0, 0, 0, 0.1);
  position: relative;
 
}
    
.sidebar-header h2 {
  font-weight: 700;
  margin: 0;
  font-size: 1.5rem;
  color: white;
  position: relative;
  z-index: 1;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.sidebar-menu {
  padding: 15px 0;
  overflow-y: auto;
  height: calc(100vh - 90px);
  scrollbar-width: thin;
}

.sidebar-menu li {
  list-style: none;
  padding: 0;
  margin: 5px 15px;
  border-radius: 8px;
  overflow: hidden;
  transition: all 0.3s ease;
  border-left: 3px solid transparent;
}

.sidebar-menu li a.nav-link {
  color: rgba(255, 255, 255, 0.9);
  text-decoration: none;
  display: flex;
  align-items: center;
  padding: 12px 15px;
  transition: all 0.3s ease;
}

.sidebar-menu li:hover {
  background: var(--sidebar-hover);
  border-left: 3px solid var(--sidebar-accent);
}

.sidebar-menu li:hover a.nav-link {
  color: white;
  transform: translateX(5px);
}

.sidebar-menu li.active {
  background: linear-gradient(90deg, rgba(1, 159, 135, 0.3), transparent);
  border-left: 3px solid var(--sidebar-accent);
}

.sidebar-menu li.active a.nav-link {
  color: white;
  font-weight: 500;
}

.sidebar-menu li i {
  margin-left: 12px;
  font-size: 1.1rem;
  width: 24px;
  text-align: center;
  transition: all 0.3s ease;
}

.sidebar-menu li:hover i {
  color: var(--sidebar-accent);
}

.sidebar-menu li span {
  font-size: 0.95rem;
  transition: all 0.3s ease;
}

/* زر تسجيل الخروج */
.sidebar-menu li form.nav-link {
  padding: 0;
}

.sidebar-menu li button {
  background: transparent;
  border: none;
  color: rgba(255, 255, 255, 0.9);
  cursor: pointer;
  padding: 12px 15px;
  display: flex;
  align-items: center;
  width: 100%;
  font-size: 0.95rem;
  text-align: right;
  transition: all 0.3s ease;
}

.sidebar-menu li button:hover {
  color: white;
  background: rgba(255, 255, 255, 0.1);
  transform: translateX(5px);
}

.sidebar-menu li button i {
  margin-left: 12px;
  color: #ff6b6b;
}

/* ✅ المحتوى الرئيسي */
.main-content {
  margin-left: 5px;
  margin-top: 70px; 
  padding: 20px;
  height: calc(100vh - 70px); 
  overflow-y: auto; 
  background-color: var(--bg);
}



/* الشريط العلوي المبسط */
.navbar {
    height: 70px;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
    position: fixed;
    right: var(--sidebar-width);
    left: 0;
    top: 0;
    z-index: 1001;
    transition: all 0.3s;
}

/* الجزء الأيسر - يحتوي فقط على زر القائمة */
.navbar-left {
    display: flex;
    align-items: center;
}

.toggle-btn {
    font-size: 20px;
    cursor: pointer;
    color: var(--primary);
    transition: all 0.3s;
    padding: 10px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toggle-btn:hover {
    background: rgba(0, 83, 100, 0.1);
    color: var(--sidebar-accent);
}

/* الجزء الأيمن - يحتوي فقط على البروفايل */
.profile-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--text);
    transition: all 0.3s;
    gap: 10px;
}

.profile-link:hover {
    color: var(--primary);
}

.profile-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid var(--secondary);
    object-fit: cover;
    transition: all 0.3s;
}

.profile-link:hover .profile-image {
    border-color: var(--primary);
}

.profile-name {
    font-weight: 600;
    font-size: 15px;
}

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 992px) {
    .navbar {
        right: 0;
    }
}

@media (max-width: 768px) {
    .profile-name {
        display: none;
    }
}

@media (max-width: 576px) {
    .navbar {
        padding: 0 15px;
    }
    
    .toggle-btn {
        padding: 8px;
    }
}

        /* المحتوى الرئيسي */
        .main-content {
            margin-right: var(--sidebar-width);
            margin-top: 70px;
            padding: 25px;
            width: 100%;
            transition: all 0.3s;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            color: var(--primary);
            font-weight: 700;
        }

        /* بطاقات الإحصائيات */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid var(--secondary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: var(--secondary);
        }

        .stat-card-title {
            color: #777;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-card-value {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
            color: var(--primary);
        }

        .stat-card-change {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .stat-card-change.up {
            color:#02d3ac;
        }

        .stat-card-change.down {
            color: #e53e3e;
        }

        /* الجداول */
        .table-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .table-section h2 {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            color: var(--primary);
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--primary);
        }

        tr:hover {
            background: #f8f9fa;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status.active {
            background: #c6f6d5;
            color: #02d3ac;
        }

        .status.pending {
            background: #feebc8;
            color: #dd6b20;
        }

        .status.inactive {
            background: #fed7d7;
            color: #e53e3e;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background: #005364;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--secondary);
            color: var(--secondary);
        }

        .btn-outline:hover {
            background: var(--secondary);
            color: white;
        }

        .btn-danger {
            background: #e53e3e;
            color: white;
        }

        .btn-danger:hover {
            background: #c53030;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 13px;
        }

        /* الرسوم البيانية */
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .chart-container h2 {
            margin-bottom: 20px;
            color: var(--primary);
        }

        .chart-placeholder {
            height: 350px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            border: 1px dashed #ddd;
        }

        /* كروت المؤتمرات */
        .conference-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .conference-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .conference-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .conference-image {
            height: 160px;
            background-color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
        }

        .conference-body {
            padding: 20px;
        }

        .conference-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .conference-meta {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }

        .conference-meta i {
            margin-left: 8px;
            color: var(--secondary);
        }

        .conference-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        
            .nav-link {
                color: white; 
                text-decoration: none; 
            }

            .nav-link:hover {
                color: #f0f0f0; 
            }

            
            .active .nav-link {
                color:#02d3ac;
                font-weight: bold; 
            }
            .sidebar {
            max-height: 100vh; 
            overflow-y: auto;
            }

        
        @media (max-width: 1200px) {
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                right: -100%;
            }

            .sidebar.active {
                right: 0;
            }

            .navbar {
                left: 0;
            }

            .main-content {
                margin-right: 0;
            }
        }

        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .search-bar input {
                width: 180px;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 0 15px;
            }
            
            .user-info {
                display: none;
            }
            
            .search-bar input {
                width: 120px;
                padding-left: 30px;
            }

            
            
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- الشريط الجانبي -->
    @include('admin.component.sidebar')

    <!-- الشريط العلوي -->
    @include('admin.component.header')

    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        @yield('content')
    </div>

    

    <script>
        // إظهار/إخفاء الشريط الجانبي
        document.querySelector('.toggle-btn').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>