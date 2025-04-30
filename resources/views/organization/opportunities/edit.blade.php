@extends('organization.layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">{{ isset($opportunity) ? 'تعديل الفرصة' : 'إضافة فرصة جديدة' }}</h1>
        <a href="{{ route('organization.opportunities.index') }}" class="btn btn-outline-secondary">
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ isset($opportunity) ? 'تحديث' : 'حفظ' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection