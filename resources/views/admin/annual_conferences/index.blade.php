@extends('admin.layouts.app')

@section('title', 'المؤتمرات السنوية')

@section('content')

<style>
   
    .btn-outline-primary {
        border: 2px solid #02d3ac;  
        color: #02d3ac; 
        background-color: transparent; 
        font-weight: bold; 
        padding:  1px 6px; 
        border-radius: 5px; 
        font-size: 14px;  
        transition: background-color 0.3s, color 0.3s;
    }
    
   
    .btn-outline-primary:hover {
        background-color:#02d3ac; 
        color: white; 
        border-color: #02d3ac; 
    }
    
    
    .btn-danger {
        background-color: #dc3545;
        border: 2px solid #dc3545;
        color: white;
        font-weight: bold;
        padding: 7px 6px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        margin-top: 10px;
    }
    
 
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
    }
    
   
    .pagination .page-item.active .page-link {
        background-color: #005364;
        border-color: #005364;
    }
    
    .pagination .page-link {
        color: #005364;
        font-size: 14px;
        padding: 6px 12px;
    }
    
 
    .pagination .page-item.active .page-link:hover {
        background-color: #004d49;
        border-color: #004d49;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    
    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    
    .pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .pagination .page-link {
        color: var(--primary);
    }
    
    form {
        display: inline;
    }
    
    .status.active {
        color: green; 
    }

    .status.pending {
        color: orange; 
    }

    .status.inactive {
        color: red; 
    }
</style>

<div class="page-header">
    <h1>المؤتمرات السنوية</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">الرئيسية</a> / المؤتمرات السنوية
    </div>
</div>

<div class="table-section">
    <div class="table-header">
        <h2>قائمة المؤتمرات</h2>
        <a href="{{ route('admin.annual-conferences.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إنشاء مؤتمر جديد
        </a>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم المؤتمر</th>
                <th>التاريخ</th>
                <th>المكان</th>
                <th>عدد المشاركين</th>
                <th>عدد المنظمات</th>
                <th>الأنشطة</th>
                <th>ورش العمل</th>
                <th>الحالة</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conferences as $conference)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->date }}</td>
                    <td>{{ $conference->location }}</td>
                    <td>{{ $conference->expected_participants }}</td>
                    <td>{{ $conference->organizations_count }}</td>
                    <td>{{ $conference->activities }}</td>
                    <td>{{ $conference->workshops }}</td>
                    <td>
                        <span class="status {{ $conference->status == 'active' ? 'active' : ($conference->status == 'pending' ? 'pending' : 'inactive') }}">
                            {{ $conference->status == 'active' ? 'نشط' : ($conference->status == 'pending' ? 'قيد التنفيذ' : 'منتهي') }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.annual-conferences.edit', $conference->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('admin.annual-conferences.destroy', $conference->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا المؤتمر؟')">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
