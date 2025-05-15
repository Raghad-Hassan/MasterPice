@extends('organization.layouts.app')

@section('content')
<style>
    .dashboard-container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    
    .dashboard-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #019f87;
    }
    
    .table-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead {
        background: linear-gradient(135deg, #005364, #019f87);
        color: white;
    }
    
    .table th {
        border: none;
        padding: 15px;
        font-weight: 600;
    }
    
    .table td {
        padding: 12px 15px;
        vertical-align: middle;
        border-color: #f1f1f1;
    }
    
    .table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }
    
    .btn-primary {
        background-color: #019f87;
        border: none;
        padding: 8px 15px;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background-color:#019f87;
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(41, 128, 185, 0.3);
    }
    
    .alert-success {
        background-color: #d4edda;
        color:#019f87;
        border-color: #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        border: 1px solid transparent;
    }
    
    .empty-message {
        color: #7f8c8d;
        text-align: center;
        padding: 20px;
    }
    
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px;
        }
        
        .table th, .table td {
            padding: 8px 10px;
        }
    }
</style>

<div class="dashboard-container">
    <h2 class="dashboard-title">الأفكار الموافق عليها</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>المستخدم</th>
                    <th>المدينة</th>
                    <th>تاريخ الإنشاء</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($approvedIdeas as $idea)
                    <tr>
                        <td>{{ $idea->title }}</td>
                        <td>{{ $idea->user?->first_name }} {{ $idea->user?->last_name }}</td>
                        <td>{{ $idea->city }}</td>
                        <td>{{ $idea->created_at ? $idea->created_at->format('Y-m-d') : 'غير متوفر' }}</td>
                        <td>
                            <a href="{{ route('organization.approved-ideas.show', $idea->id) }}" class="btn btn-sm btn-primary">عرض</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty-message">لا توجد أفكار موافق عليها حالياً.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection