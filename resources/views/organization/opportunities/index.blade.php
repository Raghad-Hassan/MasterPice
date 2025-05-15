@extends('organization.layouts.app')

@section('content')
<style>
    .opportunities-container {
        margin-right: 20px;
        padding: 25px;
        background-color: #f8fafc;
        min-height: 100vh;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eaeaea;
    }
    
    .page-title {
        color: #005364;
        font-weight: 700;
        margin: 0;
    }
    
    .add-btn {
        background: linear-gradient(135deg, #019f87, #005364);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(1, 159, 135, 0.3);
    }
    
    .alert {
        border-radius: 8px;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead {
        background: linear-gradient(135deg, #019f87, #005364);
        color: white;
    }
    
    .table th {
        padding: 15px;
        font-weight: 600;
        border: none;
    }
    
    .table td {
        padding: 15px;
        vertical-align: middle;
        border-color: #f0f0f0;
    }
    
    .table tr:last-child td {
        border-bottom: none;
    }
    
    .table tr:hover td {
        background-color: #f9f9f9;
    }
    
    .badge {
        padding: 6px 10px;
        font-weight: 500;
        border-radius: 4px;
        font-size: 0.85rem;
    }
    
    .bg-success {
        background-color: #019f87 !important;
    }
    
    .action-btn {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
    }
    
    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }
    
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: white;
    }
    
    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-outline-info {
        color: #17a2b8;
        border-color: #17a2b8;
    }
    
    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: white;
    }
    
    .pagination {
        margin-top: 25px;
    }
    
    .page-item.active .page-link {
        background-color: #019f87;
        border-color: #019f87;
    }
    
    .page-link {
        color: #019f87;
    }
    
    @media (max-width: 768px) {
        .opportunities-container {
            margin-right: 0;
            padding: 15px;
        }
        
        .action-btns {
            flex-direction: column;
            gap: 5px;
        }
        
        .action-btn {
            width: 100%;
        }
    }
</style>

<div class="opportunities-container">
    <div class="page-header">
        <h2 class="page-title">قائمة فرص التطوع</h2>
        <a href="{{ route('organization.opportunities.create') }}" class="btn btn-primary add-btn">
            <i class="fas fa-plus"></i> إضافة فرصة جديدة
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($opportunities->isEmpty())
        <div class="alert alert-info">
            لا توجد فرص تطوعية متاحة حالياً.
        </div>
    @else
        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="20%">العنوان</th>
                        <th width="30%">الوصف</th>
                        <th width="20%">المكان</th>
                        <th width="15%">الحالة</th>
                        <th width="15%">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($opportunities as $opportunity)
                        <tr>
                            <td>{{ $opportunity->title }}</td>
                            <td>{{ Str::limit($opportunity->description, 70) }}</td>
                            <td>{{ $opportunity->location }}</td>
                            <td>
                                <span class="badge bg-{{ $opportunity->status == 'available' ? 'success' : 'danger' }}">
                                    {{ $opportunity->status == 'available' ? 'متاحة' : 'مكتملة' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 action-btns">
                                    <a href="{{ route('organization.opportunities.edit', $opportunity->id) }}" 
                                       class="btn btn-sm btn-outline-warning action-btn"
                                       title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('organization.opportunities.destroy', $opportunity->id) }}" 
                                          method="POST"
                                          class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger action-btn"
                                                title="حذف"
                                                onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('organization.opportunities.showApplicants', $opportunity->id) }}" 
                                       class="btn btn-sm btn-outline-info action-btn"
                                       title="عرض المتطوعين">
                                        <i class="fas fa-users"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($opportunities->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $opportunities->links() }}
            </div>
        @endif
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا الإجراء!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#019f87',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، احذفه!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection