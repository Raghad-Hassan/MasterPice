<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المؤسسة - الفرص التطوعية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }
        .layout {
            display: flex;
            flex-direction: row; /* مهم: خليها row حتى يظل الـ sidebar على اليمين في RTL */
            min-height: 100vh;
        }
        .sidebar {
            background-color: #2c3e50;
            width: 250px;
            color: white;
            padding: 20px;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: #34495e;
            border-radius: 5px;
            padding: 8px;
        }
        .sidebar .nav-link i {
            margin-left: 8px;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="layout">
    <!-- الشريط الجانبي -->
    <div class="sidebar">
        <h4 class="text-white mb-4">لوحة التحكم</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('organization.dashboard') }}" class="nav-link {{ request()->is('organization/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> لوحة التحكم
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('organization.opportunities.index') }}" class="nav-link {{ request()->is('organization/opportunities') ? 'active' : '' }}">
                    <i class="fas fa-building"></i> عرض الفرص
                </a>
            </li>
 
            <li class="nav-item">
                <a href="{{ route('organization.comments.index') }}" class="nav-link">
                    <i class="fas fa-comments"></i> التعليقات
                </a>
            </li> 
            
            
          
            <li class="nav-item">
                <form method="POST" action="{{ route('organization.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none;">
                        <i class="fas fa-sign-out-alt"></i> تسجيل خروج
                    </button>
                </form>
            </li>
            
             
           
            
            
            
            
        </ul>
    </div>

   
    <div class="main-content">
        @yield('content')
    </div>
</div>

</body>
</html>
