@extends('admin.layouts.app')

@section('title', 'تعديل المؤتمر')

@section('content')
<div class="page-header">
    <h1>تعديل المؤتمر</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">الرئيسية</a> / 
        <a href="{{ route('admin.annual-conferences.index') }}">المؤتمرات السنوية</a> / 
        تعديل
    </div>
</div>

<div class="form-section">
    <form action="{{ route('admin.annual-conferences.update', $conference->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
       
        <div class="form-group">
            <label for="title">اسم المؤتمر</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $conference->title }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

         <div class="form-group">
            <label for="activities">الأنشطة</label>
            <input type="text" class="form-control" id="activities" name="activities" value="{{ $conference->activities }}" required>
            @error('activities')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">وصف المؤتمر</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $conference->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date">تاريخ المؤتمر</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($conference->date)->format('Y-m-d') }}" required>
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location">مكان المؤتمر</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $conference->location }}" required>
                    @error('location')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="expected_participants">عدد المشاركين المتوقع</label>
                    <input type="number" class="form-control" id="expected_participants" name="expected_participants" value="{{ $conference->expected_participants }}" required>
                    @error('expected_participants')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">حالة المؤتمر</label>
                   <select class="form-control" id="status" name="status" required>
                    <option value="active" {{ $conference->status == 'active' ? 'selected' : '' }}>نشط</option>
                    <option value="pending" {{ $conference->status == 'pending' ? 'selected' : '' }}>قيد التنفيذ</option>
                    <option value="done" {{ $conference->status == 'done' ? 'selected' : '' }}>منتهي</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="organizations_count">عدد المنظمات المشاركة</label>
                    <input type="number" class="form-control" id="organizations_count" name="organizations_count" value="{{ $conference->organizations_count }}" required>
                    @error('organizations_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="workshops">ورش العمل</label>
                    <input type="text" class="form-control" id="workshops" name="workshops" value="{{ $conference->workshops }}" required>
                    @error('workshops')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> حفظ التعديلات
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
    .current-image {
        margin-bottom: 15px;
    }
    
    .current-image img {
        border-radius: 6px;
        margin-bottom: 10px;
    }
    
    .form-check {
        display: flex;
        align-items: center;
    }
    
    .form-check-input {
        margin-left: 10px;
    }
</style>
@endsection
