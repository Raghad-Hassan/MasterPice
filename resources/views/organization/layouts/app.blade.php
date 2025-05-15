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
            padding-right: 20px; /* تعويض عن السايد بار الثابت */
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: linear-gradient(180deg, #005364 0%, #019f87 100%);
            width: 250px;
            color: white;
            padding: 20px 0;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            box-shadow: -2px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h4 {
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-header h4 i {
            color: #ffffff;
        }
        
        .nav {
            padding: 0 15px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 15px;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }
        
        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateX(-5px);
        }
        
        .nav-link.active {
            color: white;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 100%);
            border-right: 3px solid white;
            font-weight: 600;
        }
        
        .nav-link.active:before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: white;
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
            margin-left: 10px;
            font-size: 16px;
        }
        
        .nav-item:last-child {
            margin-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 15px;
        }
        
        .nav-item:last-child .nav-link {
            color: #ffebee;
        }
        
        .nav-item:last-child .nav-link:hover {
            background-color: rgba(255, 235, 238, 0.2);
        }
        
        /* تأثيرات إضافية */
        .nav-link:hover i {
            transform: scale(1.1);
        }
        
        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-right: 250px; /* تعويض عن السايد بار الثابت */
            width: 100%;
        }
        
        /* تصميم متجاوب */
        @media (max-width: 768px) {
            body {
                padding-right: 0;
            }
            
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .sidebar-header h4 span {
                display: none;
            }
            
            .nav-link span {
                display: none;
            }
            
            .nav-link {
                justify-content: center;
            }
            
            .nav-link i {
                margin-left: 0;
                font-size: 18px;
            }
            
            .main-content {
                margin-right: 70px;
            }
        }
    </style>
</head>
<body>

<div class="layout">
    <!-- الشريط الجانبي -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-cogs"></i> <span>لوحة التحكم</span></h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('organization.dashboard') }}" class="nav-link {{ request()->is('organization/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> <span>لوحة التحكم</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('organization.opportunities.index') }}" class="nav-link {{ request()->is('organization/opportunities') ? 'active' : '' }}">
                    <i class="fas fa-building"></i> <span>عرض الفرص</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->routeIs('institution.approvedIdeas') ? 'active' : '' }}">
                <a href="{{ route('institution.approvedIdeas') }}" class="nav-link">
                    <i class="fa fa-check-circle"></i> <span>الأفكار الموافق عليها</span>
                </a>
            </li>
            
            <li class="nav-item">
                <form method="POST" action="{{ route('organization.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; text-align: right;">
                        <i class="fas fa-sign-out-alt"></i> <span>تسجيل خروج</span>
                    </button>
                </form>
            </li>
        </ul> 
    </div>

    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

</body>
</html>