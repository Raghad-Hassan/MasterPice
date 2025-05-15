@extends('organization.layouts.app')

@section('content')
<style>
    .form-container {
        margin-right: 20px;
        padding: 30px;
        background-color: #f8fafc;
        min-height: 100vh;
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
    
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 25px;
    }
    
    .card-header {
        background: linear-gradient(135deg, #019f87, #005364);
        color: white;
        font-weight: 600;
        padding: 15px 20px;
        border-radius: 10px 10px 0 0 !important;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .form-label {
        font-weight: 600;
        color: #005364;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #019f87;
        box-shadow: 0 0 0 0.25rem rgba(1, 159, 135, 0.25);
    }
    
    .img-thumbnail {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px;
        transition: all 0.3s ease;
    }
    
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #019f87, #005364);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(1, 159, 135, 0.3);
    }
    
    .form-check-input:checked {
        background-color: #019f87;
        border-color: #019f87;
    }
    
    @media (max-width: 768px) {
        .form-container {
            margin-right: 0;
            padding: 20px;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .back-btn {
            width: 100%;
        }
    }
</style>

<div class="form-container">
    <div class="page-header">
        <h1 class="page-title">{{ isset($opportunity) ? 'تعديل الفرصة' : 'إضافة فرصة جديدة' }}</h1>
        <a href="{{ route('organization.opportunities.index') }}" class="btn back-btn">
            <i class="fas fa-arrow-right"></i> العودة للقائمة
        </a>
    </div>

    <form action="{{ isset($opportunity) ? route('organization.opportunities.update', $opportunity) : route('organization.opportunities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($opportunity))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">معلومات أساسية</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان الفرصة</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $opportunity->title ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">وصف الفرصة</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="5" required>{{ old('description', $opportunity->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">التصنيف</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled selected>اختر تصنيف الفرصة</option>
                                <option value="ريادة" {{ old('category', $opportunity->category ?? '') == 'ريادة' ? 'selected' : '' }}>ريادة</option>
                                <option value="بيئية" {{ old('category', $opportunity->category ?? '') == 'بيئية' ? 'selected' : '' }}>بيئية</option>
                                <option value="صحة" {{ old('category', $opportunity->category ?? '') == 'صحة' ? 'selected' : '' }}>صحة</option>
                                <option value="فنون" {{ old('category', $opportunity->category ?? '') == 'فنون' ? 'selected' : '' }}>فنون</option>
                                <option value="تعليم" {{ old('category', $opportunity->category ?? '') == 'تعليم' ? 'selected' : '' }}>تعليم</option>
                                <option value="رياضة" {{ old('category', $opportunity->category ?? '') == 'رياضة' ? 'selected' : '' }}>رياضة</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">صورة الفرصة</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if(isset($opportunity) && $opportunity->image_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $opportunity->image_path) }}" width="100" class="img-thumbnail">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">التفاصيل</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="location" class="form-label">الموقع</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   value="{{ old('location', $opportunity->location ?? '') }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">تاريخ البدء</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                       value="{{ old('start_date', isset($opportunity) ? $opportunity->start_date->format('Y-m-d') : '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" 
                                       value="{{ old('end_date', isset($opportunity) ? $opportunity->end_date->format('Y-m-d') : '') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="working_days" class="form-label">أيام العمل</label>
                            <input type="text" class="form-control" id="working_days" name="working_days" 
                                   value="{{ old('working_days', $opportunity->working_days ?? '') }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_time" class="form-label">وقت البدء</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" 
                                       value="{{ old('start_time', $opportunity->start_time ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_time" class="form-label">وقت الانتهاء</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" 
                                       value="{{ old('end_time', $opportunity->end_time ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="total_hours" class="form-label">إجمالي الساعات</label>
                                <input type="number" class="form-control" id="total_hours" name="total_hours" 
                                       value="{{ old('total_hours', $opportunity->total_hours ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="min_hours" class="form-label">الحد الأدنى</label>
                                <input type="number" class="form-control" id="min_hours" name="min_hours" 
                                       value="{{ old('min_hours', $opportunity->min_hours ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="max_hours" class="form-label">الحد الأقصى</label>
                                <input type="number" class="form-control" id="max_hours" name="max_hours" 
                                       value="{{ old('max_hours', $opportunity->max_hours ?? '') }}" required>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="transportation_available" 
                                   name="transportation_available" value="1"
                                   {{ old('transportation_available', $opportunity->transportation_available ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="transportation_available">وسائل النقل متاحة</label>
                        </div>

                        <div class="mb-3">
                            <label for="max_volunteers" class="form-label">العدد الأقصى للمتطوعين</label>
                            <input type="number" class="form-control" id="max_volunteers" name="max_volunteers" 
                                   value="{{ old('max_volunteers', $opportunity->max_volunteers ?? '') }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn submit-btn">
                        <i class="fas fa-save"></i> {{ isset($opportunity) ? 'تحديث' : 'حفظ' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection