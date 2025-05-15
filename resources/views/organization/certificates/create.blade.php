@extends('organization.layouts.app')

@section('content')
<style>
    .certificate-container {
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 30px auto;
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
    
    
    .certificate-title {
        color: #005364;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #019f87;
    }
    
    .form-label {
        color: #005364;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 20px;
    }
    
    .form-control:focus {
        border-color: #019f87;
        box-shadow: 0 0 0 0.2rem rgba(1, 159, 135, 0.25);
        outline: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #019f87, #005364);
        border: none;
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 8px;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #018f77, #004354);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(1, 159, 135, 0.3);
    }
    
    @media (max-width: 768px) {
        .certificate-container {
            padding: 20px;
        }
        
        .certificate-title {
            font-size: 1.3rem;
        }
    }
</style>

<div class="certificate-container">
     <div class="page-header">
        <h1 class="page-title">{{ isset($opportunity) ? 'تعديل الفرصة' : 'إضافة فرصة جديدة' }}</h1>
        <a href="{{ route('organization.opportunities.index') }}" class="btn back-btn">
            <i class="fas fa-arrow-right"></i> العودة للقائمة
        </a>
    </div>
    <h4 class="certificate-title">إصدار شهادة التطوع</h4>

     @if(session('success'))
        <div class="alert alert-success">
            تم منح الشهادة بنجاح!
        </div>
    @endif


    <form action="{{ route('organization.certificates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="volunteer_opportunities_id" value="{{ $opportunityId }}">

        <div class="mb-3">
            <label for="title" class="form-label">عنوان الشهادة</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="organization" class="form-label">اسم المؤسسة</label>
            <input type="text" name="organization" class="form-control" 
                   value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="issue_date" class="form-label">تاريخ الإصدار</label>
            <input type="date" name="issue_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">صورة الشهادة (اختياري)</label>
            <input type="file" name="image_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">حفظ الشهادة</button>
    </form>
</div>
@endsection