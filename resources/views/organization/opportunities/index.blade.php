@extends('organization.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">قائمة فرص التطوع</h2>
        <a href="{{ route('organization.opportunities.create') }}" class="btn btn-primary">
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
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
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
                                <div class="d-flex gap-2">
                                    <a href="{{ route('organization.opportunities.edit', $opportunity->id) }}" 
                                       class="btn btn-sm btn-outline-warning"
                                       title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('organization.opportunities.destroy', $opportunity->id) }}" 
                                          method="POST"
                                          class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="حذف"
                                                onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- الترقيم (Pagination) -->
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
    // تأكيد الحذف مع SweetAlert (اختياري)
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا الإجراء!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
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