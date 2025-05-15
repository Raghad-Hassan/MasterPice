@extends('organization.layouts.app')

@section('content')
<style>
    .volunteers-container {
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 1000px;
    }

     .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eaeaea;
    }
    
    .page-title {
        color: #005364;
        font-weight: 700;
        margin: 0;
    }
    
    .back-btn {
        background-color: white;
        color: #005364;
        border: 1px solid #019f87;
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .back-btn:hover {
        background-color: #f0f0f0;
        transform: translateX(-3px);
    }
    
    
    .volunteers-title {
        color: #005364;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #019f87;
    }
    
    .alert-info {
        background-color: #e6f7f5;
        border-color: #b3e8e3;
        color: #005364;
    }
    
    .list-group-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        margin-bottom: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .list-group-item:hover {
        background-color: #f5f5f5;
        transform: translateX(5px);
    }
    
    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .bg-success {
        background-color: #019f87 !important;
    }
    
    .bg-warning {
        background-color: #ffc107 !important;
        color: #005364;
    }
    
    .bg-danger {
        background-color: #dc3545 !important;
    }
    
    .btn {
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 0.9rem;
        margin-right: 8px;
    }
    
    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
    
    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }
    
    .btn-success {
        background-color: #019f87;
        border-color: #019f87;
    }
    
    .btn-success:hover {
        background-color: #017f6d;
        border-color: #017f6d;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
    }
    
    @media (max-width: 768px) {
        .volunteers-container {
            padding: 20px;
        }
        
        .list-group-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .list-group-item > * {
            margin-bottom: 10px;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<div class="volunteers-container">
     <div class="page-header">
        <h1 class="page-title">{{ isset($opportunity) ? 'تعديل الفرصة' : 'إضافة فرصة جديدة' }}</h1>
        <a href="{{ route('organization.opportunities.index') }}" class="btn back-btn">
            <i class="fas fa-arrow-right"></i> العودة للقائمة
        </a>
    </div>
    <h3 class="volunteers-title">المتطوعين المسجلين في فرصة التطوع: {{ $opportunity->title }}</h3>

    @if($applicants->isEmpty())
        <div class="alert alert-info">
            لا يوجد متطوعين مسجلين في هذه الفرصة بعد.
        </div>
    @else
        <ul class="list-group">
            @foreach($applicants as $application)
                <li class="list-group-item">
                    <div>
                        {{ $application->user->first_name }} {{ $application->user->last_name }} -
                        <span class="badge bg-{{ $application->status == 'approved' ? 'success' : ($application->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    
                    <div class="actions">
                        <form action="{{ route('organization.opportunities.removeApplicant', [$opportunity->id, $application->id]) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>

                        <a href="{{ route('organization.certificates.create', ['user' => $application->user->id, 'opportunity' => $opportunity->id]) }}" class="btn btn-success btn-sm">
                            إصدار شهادة
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection