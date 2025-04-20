@extends('admin.layouts.app')

@section('title', 'إنشاء مؤتمر جديد')

@section('content')
<div class="page-header">
    <h1>إنشاء مؤتمر جديد</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">الرئيسية</a> / 
        <a href="{{ route('admin.annual-conferences.index') }}">المؤتمرات السنوية</a> / 
        إنشاء جديد
    </div>
</div>

<div class="form-section">
    <form action="{{ route('admin.annual-conferences.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- حقل العنوان -->
        <div class="form-group">
            <label for="title">اسم المؤتمر</label>
            <input type="text" class="form-control" id="title" name="title" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- حقل الوصف -->
        <div class="form-group">
            <label for="description">وصف المؤتمر</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <!-- حقل التاريخ -->
                <div class="form-group">
                    <label for="date">تاريخ المؤتمر</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <!-- حقل الموقع -->
                <div class="form-group">
                    <label for="location">مكان المؤتمر</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                    @error('location')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <!-- حقل عدد المشاركين -->
                <div class="form-group">
                    <label for="expected_participants">عدد المشاركين المتوقع</label>
                    <input type="number" class="form-control" id="expected_participants" name="expected_participants" required>
                    @error('expected_participants')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <!-- حقل حالة المؤتمر -->
                <div class="form-group">
                    <label for="status">حالة المؤتمر</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active">نشط</option>
                        <option value="pending">قيد التنفيذ</option>
                        <option value="inactive">منتهي</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <!-- حقل عدد المنظمات المشاركة -->
                <div class="form-group">
                    <label for="organizations_count">عدد المنظمات المشاركة</label>
                    <input type="number" class="form-control" id="organizations_count" name="organizations_count" required>
                    @error('organizations_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <!-- حقل ورش العمل -->
                <div class="form-group">
                    <label for="workshops">ورش العمل</label>
                    <input type="text" class="form-control" id="workshops" name="workshops" required>
                    @error('workshops')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

       

        <div class="form-actions mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> حفظ
            </button>
            <a href="{{ route('admin.annual-conferences.index') }}" class="btn btn-outline">
                <i class="fas fa-times"></i> إلغاء
            </a>
        </div>
    </form>
</div>

@endsection

@section('styles')
<style>
    .form-section {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--primary);
    }
    
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
    }
    
    .text-danger {
        color: #e53e3e;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-start;
        gap: 15px;
        margin-top: 30px;
    }
    
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding: 0 10px;
    }
</style>
@endsection 