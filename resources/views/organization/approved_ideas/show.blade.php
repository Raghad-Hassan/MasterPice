@extends('organization.layouts.app')

@section('content')
<style>
    .dashboard-container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .dashboard-title {
        color: #005364;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #019f87;
    }
    
    .idea-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        border: none;
        overflow: hidden;
    }
    
    .card-body {
        padding: 30px;
    }
    
    .detail-group {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .detail-group:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        color: #005364;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 8px;
        display: block;
    }
    
    .detail-value {
        color: #495057;
        font-size: 1rem;
        line-height: 1.6;
    }
    
    .detail-value img {
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
    }
    
    .btn-back {
        background: linear-gradient(135deg, #005364, #019f87);
        border: none;
        padding: 10px 25px;
        font-weight: 600;
        border-radius: 8px;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-back:hover {
        background: linear-gradient(135deg, #004354, #018f77);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(1, 159, 135, 0.3);
        color: white;
    }
    
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .detail-label {
            font-size: 1rem;
        }
    }
</style>

<div class="dashboard-container">
    <h2 class="dashboard-title">تفاصيل الفكرة</h2>

    <div class="card mb-4 idea-card">
        <div class="card-body">
            <div class="detail-group">
                <span class="detail-label">عنوان الفكرة:</span>
                <p class="detail-value">{{ $idea->title }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">الوصف:</span>
                <p class="detail-value">{{ $idea->description }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">الوصف التفصيلي:</span>
                <p class="detail-value">{{ $idea->idea_description }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">الأهداف:</span>
                <p class="detail-value">{{ $idea->idea_goals }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">عدد الأيام:</span>
                <p class="detail-value">{{ $idea->duration_days }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">المدة الزمنية:</span>
                <p class="detail-value">{{ $idea->idea_duration }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">الجهات ذات العلاقة:</span>
                <p class="detail-value">{{ $idea->related_entities }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">الجهات المسؤولة:</span>
                <p class="detail-value">{{ $idea->idea_authorities }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">المنطقة:</span>
                <p class="detail-value">{{ $idea->idea_region ?? 'غير محددة' }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">المدينة:</span>
                <p class="detail-value">{{ $idea->city }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">المجال:</span>
                <p class="detail-value">{{ $idea->field }}</p>
            </div>

            <div class="detail-group">
                <span class="detail-label">الصورة:</span>
                <div class="detail-value">
                    @if($idea->image)
                        <img src="{{ asset('storage/' . $idea->image) }}" alt="صورة الفكرة" class="img-fluid" style="max-width: 300px;">
                    @else
                        <p>لا توجد صورة.</p>
                    @endif
                </div>
            </div>

            <div class="detail-group">
                <span class="detail-label">تاريخ الإنشاء:</span>
                <p class="detail-value">{{ $idea->created_at?->format('Y-m-d') ?? 'غير متوفر' }}</p>
            </div>
        </div>
    </div>

    <a href="{{ route('institution.approvedIdeas') }}" class="btn btn-back">رجوع</a>
</div>
@endsection