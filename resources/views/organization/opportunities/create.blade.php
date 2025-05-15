@extends('organization.layouts.app')

@section('content')
<style>
    /* تنسيقات السايدبار والمحتوى الرئيسي */
    body {
        font-family: 'Tajawal', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
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
    
    
    .main-wrapper {
        display: flex;
        min-height: 100vh;
        position: relative;
    }
    
    .sidebar {
        background: linear-gradient(180deg, #005364 0%, #019f87 100%);
        width: 250px;
        color: white;
        position: fixed;
        right: 0;
        top: 0;
        bottom: 0;
        box-shadow: -2px 0 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    
    .main-content {
        flex: 1;
        padding: 20px;
        margin-right: 150px;
        position: relative;
        z-index: 1;
      
        box-sizing: border-box;
    }
    
    /* تنسيقات النموذج */
    .opportunity-form {
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        width: 100%;
        box-sizing: border-box;
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .form-header h2 {
       color: #005364;
        font-weight: 700;
        font-size: 1.8rem;
    }
    
    .form-header p {
       color: #64748b;
        font-size: 1rem;
    }
    
    .section-title {
        color: #005364;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid#019f87;
        font-size: 1.3rem;
    }
    
    .form-label {
        font-weight: 600;
        color:#019f87;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control, 
    .form-select {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s;
        width: 100%;
        box-sizing: border-box;
        font-size: 0.95rem;
    }
    
    .form-control:focus, 
    .form-select:focus {
        border-color:#019f87;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        outline: none;
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .col-md-6 {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #019f87, #005364);
        color: white;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #018f77, #004354);
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background-color: #e0e0e0;
        color: #005364;
        border: 1px solid #019f87;
    }
    
    .btn-secondary:hover {
        background-color: #d0d0d0;
    }
    
    .text-muted {
        color: #6c757d;
        font-size: 0.875rem;
    }
    
    @media (max-width: 992px) {
        body {
            padding-right: 0;
        }
        
        .sidebar {
            width: 70px;
        }
        
        .main-content {
            margin-right: 70px;
            max-width: calc(100% - 70px);
            padding: 15px;
        }
    }
    
    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }
        
        .main-content {
            margin-right: 0;
            max-width: 100%;
            padding: 15px;
        }
        
        .form-header h2 {
            font-size: 1.5rem;
        }
        
        .section-title {
            font-size: 1.1rem;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .btn-secondary {
            margin-left: 0;
        }
    }
</style>

<div class="main-wrapper">
    <!-- السايدبار (يجب أن يكون موجوداً في ملف الـ layout) -->
    
    <div class="main-content">
        <div class="opportunity-form">

             <div class="page-header">
        <h1 class="page-title">{{ isset($opportunity) ? 'تعديل الفرصة' : 'إضافة فرصة جديدة' }}</h1>
        <a href="{{ route('organization.opportunities.index') }}" class="btn back-btn">
            <i class="fas fa-arrow-right"></i> العودة للقائمة
        </a>
    </div>

            <div class="form-header">
                <h2>إضافة فرصة تطوع جديدة</h2>
                <p>املأ النموذج أدناه لإنشاء فرصة تطوع جديدة للمتطوعين</p>
            </div>
            
            <form action="{{ route('organization.opportunities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="section-title">معلومات أساسية</h4>
                        
                        <!-- العنوان -->
                        <div class="mb-4">
                            <label class="form-label">العنوان*</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="أدخل عنوان الفرصة">
                        </div>

                        <!-- الوصف -->
                        <div class="mb-4">
                            <label class="form-label">الوصف*</label>
                            <textarea name="description" class="form-control" rows="5" required placeholder="أدخل وصفًا تفصيليًا للفرصة">{{ old('description') }}</textarea>
                        </div>

                        <!-- الصورة -->
                        <div class="mb-4">
                            <label class="form-label">صورة الفرصة</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">الصيغ المقبولة: JPEG, PNG, GIF - الحد الأقصى للحجم: 5MB</small>
                        </div>

                        <!-- التصنيف -->
                        <div class="mb-4">
                            <label class="form-label">التصنيف*</label>
                            <select name="category" class="form-select" required>
                                <option value="" disabled selected>اختر تصنيفًا</option>
                                <option value="entrepreneurship">ريادة</option>
                                <option value="environment">بيئية</option>
                                <option value="health">صحة</option>
                                <option value="arts">فنون</option>
                                <option value="education">تعليم</option>
                                <option value="sports">رياضة</option>
                                <option value="other">أخرى</option>
                            </select>
                        </div>
                        
                        <h4 class="section-title mt-5">معلومات الموقع</h4>
                        
                        <!-- الموقع -->
                        <div class="mb-4">
                            <label class="form-label">الموقع*</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location') }}" required placeholder="أدخل العنوان التفصيلي">
                        </div>

                        <!-- المدينة -->
                        <div class="mb-4">
                            <label class="form-label">المحافظة*</label>
                            <select name="city" class="form-select" required>
                                <option value="" disabled selected>اختر المحافظة</option>
                                <option value="amman">عمان</option>
                                <option value="zarqa">الزرقاء</option>
                                <option value="irbid">إربد</option>
                                <option value="ajloun">عجلون</option>
                                <option value="mafraq">المفرق</option>
                                <option value="kareem">الكرك</option>
                                <option value="madaba">مادبا</option>
                                <option value="tafilah">الطفيلة</option>
                                <option value="maan">معان</option>
                                <option value="batn">البتراء</option>
                                <option value="jerash">جرش</option>
                                <option value="aqaba">العقبة</option>
                            </select>
                        </div>

                        <!-- وسائل النقل -->
                        <div class="mb-4">
                            <label class="form-label">وسائل النقل</label>
                            <select name="transportation" class="form-select">
                                <option value="available">متاحة</option>
                                <option value="unavailable">غير متاحة</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 class="section-title">التوقيت والتاريخ</h4>
                        
                        <!-- تاريخ البداية -->
                        <div class="mb-4">
                            <label class="form-label">تاريخ البداية*</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                        </div>

                        <!-- تاريخ النهاية -->
                        <div class="mb-4">
                            <label class="form-label">تاريخ النهاية*</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                        </div>

                        <!-- وقت البداية -->
                        <div class="mb-4">
                            <label class="form-label">وقت البداية</label>
                            <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
                        </div>

                        <!-- وقت النهاية -->
                        <div class="mb-4">
                            <label class="form-label">وقت النهاية</label>
                            <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}">
                        </div>

                        <!-- أيام العمل -->
                        <div class="mb-4">
                            <label class="form-label">أيام العمل*</label>
                            <input type="text" name="days" class="form-control" value="{{ old('days') }}" required placeholder="مثال: السبت إلى الأربعاء">
                        </div>
                        
                        <h4 class="section-title mt-5">متطلبات المتطوعين</h4>
                        
                        <!-- عدد ساعات التطوع -->
                        <div class="mb-4">
                            <label class="form-label">عدد ساعات التطوع*</label>
                            <input type="number" name="volunteer_hours" class="form-control" value="{{ old('volunteer_hours') }}" required>
                        </div>

                        <!-- عدد المتطوعين المطلوب -->
                        <div class="mb-4">
                            <label class="form-label">عدد المتطوعين المطلوب*</label>
                            <input type="number" name="total_volunteers" class="form-control" value="{{ old('total_volunteers', 10) }}" min="1" required>
                        </div>

                        <!-- الحد الأدنى للساعات -->
                        <div class="mb-4">
                            <label class="form-label">الحد الأدنى للساعات*</label>
                            <input type="number" name="min_hours" class="form-control" value="{{ old('min_hours', 1) }}" min="1" required>
                        </div>

                        <!-- الحد الأقصى للساعات -->
                        <div class="mb-4">
                            <label class="form-label">الحد الأقصى للساعات*</label>
                            <input type="number" name="max_hours" class="form-control" value="{{ old('max_hours', 10) }}" min="1" required>
                        </div>
                        
                        <h4 class="section-title mt-5">إحصائيات</h4>
                        
                        <!-- عدد المشاركين -->
                        <div class="mb-4">
                            <label class="form-label">عدد المشاركين الحاليين</label>
                            <input type="number" name="current_participants" class="form-control" value="{{ old('current_participants', 0) }}" min="0">
                        </div>

                        <!-- العدد الإجمالي للمشاركين -->
                        <div class="mb-4">
                            <label class="form-label">العدد الإجمالي للمشاركين*</label>
                            <input type="number" name="total_participants" class="form-control" value="{{ old('total_participants', 0) }}" min="0" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">العدد الإجمالي ساعات*</label>
                            <input type="number" name="total_hours" class="form-control" value="{{ old('total_hours', 0) }}" min="0" required>
                        </div>

                        <!-- الجنس المطلوب -->
                        <div class="mb-4">
                            <label class="form-label">الجنس*</label>
                            <select name="gender" class="form-select" required>
                                <option value="all">للجميع</option>
                                <option value="male">للذكور فقط</option>
                                <option value="female">للإناث فقط</option>
                            </select>
                        </div>

                        <!-- حالة الفرصة -->
                        <div class="mb-4">
                            <label class="form-label">حالة الفرصة*</label>
                            <select name="status" class="form-select" required>
                                <option value="available">متاحة</option>
                                <option value="full">ممتلئة</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> حفظ الفرصة
                    </button>
                    <a href="{{ route('organization.opportunities.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection