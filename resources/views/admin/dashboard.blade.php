@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
    <div class="page-header">
        <h1>لوحة التحكم</h1>
        <div class="breadcrumb">
            الرئيسية
        </div>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-title">إجمالي المتطوعين</span>
                <div class="stat-card-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
            </div>
            <div class="stat-card-value">1,245</div>
            <div class="stat-card-change up">
                <i class="fas fa-arrow-up"></i>
                <span>12% عن الشهر الماضي</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-title">إجمالي المؤسسات</span>
                <div class="stat-card-icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="stat-card-value">186</div>
            <div class="stat-card-change up">
                <i class="fas fa-arrow-up"></i>
                <span>8% عن الشهر الماضي</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-title">الفرص التطوعية</span>
                <div class="stat-card-icon">
                    <i class="fas fa-tasks"></i>
                </div>
            </div>
            <div class="stat-card-value">56</div>
            <div class="stat-card-change down">
                <i class="fas fa-arrow-down"></i>
                <span>5% عن الشهر الماضي</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-title">الفعاليات القادمة</span>
                <div class="stat-card-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="stat-card-value">12</div>
            <div class="stat-card-change up">
                <i class="fas fa-arrow-up"></i>
                <span>3 فعاليات جديدة</span>
            </div>
        </div>
    </div>

    <!-- عرض أحدث مؤتمر -->
   <div class="card mt-4 shadow-sm p-4 rounded-4 border-0" style="background-color: #f9f9f9;">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-calendar-alt me-3" style="color: #005364; font-size: 1.5rem;"></i>
        <h3 class="mb-0" style="color: #005364;">أحدث المؤتمرات</h3>
    </div>

    @if ($conference)
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <!-- اسم المؤتمر -->
            <div class="col">
                <div class="card border-start border-4 h-100 p-3 bg-white shadow-sm rounded-3" 
                     style="border-color: #02d3ac;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-heading me-2" style="color: #005364;"></i>
                        <h5 class="card-title mb-0" style="color: #005364;">اسم المؤتمر</h5>
                    </div>
                    <p class="card-text ps-4">{{ $conference->title }}</p>
                </div>
            </div>
            
            <!-- عدد المشاركين -->
            <div class="col">
                <div class="card border-start border-4 h-100 p-3 bg-white shadow-sm rounded-3" 
                     style="border-color: #005364;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-users me-2" style="color: #005364;"></i>
                        <h5 class="card-title mb-0" style="color: #005364;">عدد المشاركين</h5>
                    </div>
                    <p class="card-text ps-4">
                        {{ $conference->expected_participants }}
                        <span class="text-muted ms-1">مشارك</span>
                    </p>
                </div>
            </div>
            
            <!-- عدد المنظمات -->
            <div class="col">
                <div class="card border-start border-4 h-100 p-3 bg-white shadow-sm rounded-3" 
                     style="border-color: #02d3ac;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-building me-2" style="color: #005364;"></i>
                        <h5 class="card-title mb-0" style="color: #005364;">عدد المنظمات</h5>
                    </div>
                    <p class="card-text ps-4">
                        {{ $conference->organizations_count }}
                        <span class="text-muted ms-1">منظمة</span>
                    </p>
                </div>
            </div>
            
            <!-- الأنشطة -->
            <div class="col">
                <div class="card border-start border-4 h-100 p-3 bg-white shadow-sm rounded-3" 
                     style="border-color: #005364;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-tasks me-2" style="color: #005364;"></i>
                        <h5 class="card-title mb-0" style="color: #005364;">الأنشطة</h5>
                    </div>
                    <p class="card-text ps-4">{{ $conference->activities }}</p>
                </div>
            </div>
            
            <!-- ورش العمل -->
            <div class="col">
                <div class="card border-start border-4 h-100 p-3 bg-white shadow-sm rounded-3" 
                     style="border-color: #02d3ac;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-chalkboard-teacher me-2" style="color: #005364;"></i>
                        <h5 class="card-title mb-0" style="color: #005364;">ورش العمل</h5>
                    </div>
                    <p class="card-text ps-4">{{ $conference->workshops }}</p>
                </div>
            </div>

            <!-- حالة المؤتمر -->
            <div class="col">
                <div class="card border-start border-4 h-100 p-3 bg-white shadow-sm rounded-3" 
                     style="border-color: {{ $conference->status == 'active' ? '#02d3ac' : ($conference->status == 'pending' ? '#ffc107' : '#dc3545') }};">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-info-circle me-2" 
                           style="color: {{ $conference->status == 'active' ? '#02d3ac' : ($conference->status == 'pending' ? '#ffc107' : '#dc3545') }};"></i>
                        <h5 class="card-title mb-0" style="color: #005364;">حالة المؤتمر</h5>
                    </div>
                    <p class="card-text ps-4 fw-bold" 
                       style="color: {{ $conference->status == 'active' ? '#02d3ac' : ($conference->status == 'pending' ? '#ffc107' : '#dc3545') }};">
                        <i class="fas {{ $conference->status == 'active' ? 'fa-check-circle' : ($conference->status == 'pending' ? 'fa-clock' : 'fa-times-circle') }} me-2"></i>
                        {{ $conference->status == 'active' ? 'نشط' : ($conference->status == 'pending' ? 'قيد التنفيذ' : 'منتهي') }}
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-3 d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            لا توجد مؤتمرات حالياً
        </div>
    @endif
</div>

<!-- ستايل إضافي -->
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1) !important;
    }
    .border-start {
        border-left-width: 4px !important;
    }
    .card-text {
        color: #495057;
    }
</style>
    
    
@endsection
