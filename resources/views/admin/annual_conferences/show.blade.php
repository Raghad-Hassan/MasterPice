@extends('admin.layouts.app')

@section('title', 'تفاصيل المؤتمر')

@section('content')
<div class="page-header">
    <h1>تفاصيل المؤتمر</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">الرئيسية</a> / 
        <a href="{{ route('admin.annual-conferences.index') }}">المؤتمرات السنوية</a> / 
        تفاصيل
    </div>
</div>

<div class="conference-details">
    <div class="conference-header">
        <div class="conference-image">
            @if($conferences->image)
                <img src="{{ asset('storage/' . $conferences->image) }}" alt="{{ $conferences->name }}">
            @else
                <div class="no-image">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            @endif
        </div>
        <div class="conference-info">
            <h2>{{ $conferences->name }}</h2>
            <div class="conference-meta">
                <div class="meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $conferences->location }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar-day"></i>
                    <span>{{ $conferences->date }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-users"></i>
                    <span>{{ $conferences->participants_count }} مشارك</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-info-circle"></i>
                    <span class="status {{ $conferences->status == 'active' ? 'active' : ($conferences->status == 'pending' ? 'pending' : 'inactive') }}">
                        {{ $conferences->status == 'active' ? 'نشط' : ($conferences->status == 'pending' ? 'قيد التنفيذ' : 'منتهي') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="conference-description">
        <h3>وصف المؤتمر</h3>
        <p>{{ $conferences->description }}</p>
    </div>
    
    <div class="conference-actions">
        <a href="{{ route('admin.annual-conferences.edit', $conferences->id) }}" class="btn btn-outline">
            <i class="fas fa-edit"></i> تعديل
        </a>
        <form action="{{ route('admin.annual-conferences.destroy', $conferences->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا المؤتمر؟')">
                <i class="fas fa-trash"></i> حذف
            </button>
        </form>
        <a href="{{ route('admin.annual-conferences.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> العودة للقائمة
        </a>
    </div>
</div>
@endsection

@section('styles')
<style>
    
    .conference-details {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .conference-header {
        display: flex;
        align-items: flex-start;
        margin-bottom: 30px;
    }
    
    .conference-image {
        width: 250px;
        height: 250px;
        border-radius: 10px;
        overflow: hidden;
        margin-left: 20px;
        flex-shrink: 0;
    }
    
    .conference-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .conference-image .no-image {
        width: 100%;
        height: 100%;
        background-color: var(--secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 60px;
    }
    
    .conference-info {
        flex-grow: 1;
    }
    
    .conference-info h2 {
        color: var(--primary);
        margin-bottom: 20px;
    }
    
    .conference-meta {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
    }
    
    .meta-item i {
        margin-left: 10px;
        color: var(--secondary);
        font-size: 18px;
    }
    
    .conference-description {
        margin: 30px 0;
        padding: 20px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }
    
    .conference-description h3 {
        color: var(--primary);
        margin-bottom: 15px;
    }
    
    .conference-actions {
        display: flex;
        gap: 15px;
    }
    
    @media (max-width: 768px) {
        .conference-header {
            flex-direction: column;
        }
        
        .conference-image {
            width: 100%;
            margin-left: 0;
            margin-bottom: 20px;
        }
        
        .conference-meta {
            grid-template-columns: 1fr;
        }
        
        .conference-actions {
            flex-direction: column;
        }
    }
</style>
@endsection