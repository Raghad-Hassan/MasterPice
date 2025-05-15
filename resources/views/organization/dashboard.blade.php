@extends('organization.layouts.app')

@section('content')
<style>
    .dashboard-container {
        margin-right: 20px; /* تعويض مساحة السايد بار */
        padding: 20px;
    }
    
    .stat-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card .card-body {
        padding: 1.5rem;
    }
    
    .stat-card .card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .stat-card .card-text {
        font-size: 1.75rem;
        font-weight: 700;
    }
    
    .section-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        height: 100%;
    }
    
    .section-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .section-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }
    
    .section-header a {
        color: #019f87;
        font-size: 0.875rem;
        text-decoration: none;
    }
    
    .section-header a:hover {
        text-decoration: underline;
    }
    
    .item-card {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s ease;
    }
    
    .item-card:hover {
        background: #f9f9f9;
    }
    
    .item-card:last-child {
        border-bottom: none;
    }
    
    .item-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .item-meta {
        color: #666;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: 500;
    }
    
    .quick-action-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        padding: 1.5rem;
        text-align: center;
        color: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .quick-action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .quick-action-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    .quick-action-text {
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .dashboard-container {
            margin-right: 0;
            padding: 15px;
        }
    }
</style>

<div class="dashboard-container">
    <h2 class="mb-4" style="font-weight: 700; color: #005364;">لوحة تحكم المؤسسة</h2>

    <!-- بطاقات الإحصائيات -->
    <div class="row mb-4">
        <!-- عدد الفرص -->
        <div class="col-md-3 mb-3">
            <div class="stat-card text-white" style="background: linear-gradient(135deg, #019f87, #005364);">
                <div class="card-body">
                    <h5 class="card-title">عدد الفرص</h5>
                    <p class="card-text">{{ $total_opportunities ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- فرص مفتوحة -->
        <div class="col-md-3 mb-3">
            <div class="stat-card text-white" style="background: linear-gradient(135deg, #019f87, #005364);">
                <div class="card-body">
                    <h5 class="card-title">فرص مفتوحة</h5>
                    <p class="card-text">{{ $open_opportunities ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- عدد المتطوعين -->
        <div class="col-md-3 mb-3">
            <div class="stat-card text-white" style="background: linear-gradient(135deg, #019f87, #005364);">
                <div class="card-body">
                    <h5 class="card-title">عدد المتطوعين</h5>
                    <p class="card-text">{{ $total_volunteers ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- عدد التعليقات -->
        <div class="col-md-3 mb-3">
            <div class="stat-card text-white" style="background: linear-gradient(135deg, #019f87, #005364);">
                <div class="card-body">
                    <h5 class="card-title">عدد التعليقات</h5>
                    <p class="card-text">{{ $total_comments ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- الفرص الحديثة والتعليقات -->
    <div class="row">
        <!-- قسم الفرص الحديثة -->
        <div class="col-md-6 mb-4">
            <div class="section-card">
                <div class="section-header">
                    <h2>أحدث الفرص التطوعية</h2>
                    <a href="{{ route('organization.opportunities.index') }}">عرض الكل</a>
                </div>
                
                @if(isset($availableOpportunities) && $availableOpportunities->isNotEmpty())
                    @foreach($availableOpportunities as $opportunity)
                    <div class="item-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="item-title">{{ $opportunity->title }}</h3>
                                <p class="item-meta">
                                    <i class="fas fa-map-marker-alt"></i> {{ $opportunity->city }} - {{ $opportunity->location }}
                                </p>
                                <div>
                                    <span class="badge" style="background-color: #e0f7fa; color: #006064;">
                                        {{ $opportunity->status == 'available' ? 'متاحة' : 'مكتملة' }}
                                    </span>
                                    <span class="badge" style="background-color: #e8f5e9; color: #2e7d32;">
                                        متطوعين: {{ $opportunity->current_volunteers }}/{{ $opportunity->total_volunteers }}
                                    </span>
                                </div>
                            </div>
                            <span class="text-muted small">
                                {{ $opportunity->start_date->format('d M') }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="item-card text-center text-muted">
                        لا توجد فرص تطوعية متاحة حالياً
                    </div>
                @endif
            </div>
        </div>

        <!-- قسم التعليقات الحديثة -->
        <div class="col-md-6 mb-4">
            <div class="section-card">
                <div class="section-header">
                    <h2>أحدث التعليقات</h2>
                    <a href="#">عرض الكل</a>
                </div>
                
                @forelse($recentComments as $comment)
                <div class="item-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                               <h3 class="item-title">
                                {{ ($comment->user->first_name ?? '') . ' ' . ($comment->user->last_name ?? '') ?: 'مستخدم مجهول' }}
                            </h3>
                                <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mb-2">{{ $comment->comment }}</p>
                            @if($comment->opportunity)
                            <span class="badge" style="background-color: #f5f5f5; color: #333;">
                                فرصة: {{ $comment->opportunity->title }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="item-card text-center text-muted">
                    لا توجد تعليقات حالياً
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- بطاقات الإجراءات السريعة -->
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <a href="{{ route('organization.opportunities.create') }}" class="quick-action-card" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                <div class="quick-action-icon" style="background: rgba(255,255,255,0.2);">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="quick-action-text">إضافة فرصة جديدة</div>
            </a>
        </div>
        
        <div class="col-md-3 mb-4">
             <a href="{{ route('organization.certificates.create') }}" class="quick-action-card" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                <div class="quick-action-icon" style="background: rgba(255,255,255,0.2);">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="quick-action-text">إصدار شهادات</div>
            </a>
        </div>
        
         <div class="col-md-3 mb-4">
        <a href="{{ route('institution.approvedIdeas') }}" class="quick-action-card" style="background: linear-gradient(135deg, #8E44AD, #9B59B6);">
            <div class="quick-action-icon" style="background: rgba(255,255,255,0.2);">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="quick-action-text">الأفكار الموافق عليها</div>
        </a>
    </div>
        
        
    </div>
</div>

@push('scripts')
<script>
    function acceptApplication(id) {
        alert('تم قبول الطلب رقم ' + id);
    }

    function rejectApplication(id) {
        alert('تم رفض الطلب رقم ' + id);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // أي كود تريد تنفيذه عند تحميل الصفحة
    });
</script>
@endpush
@endsection