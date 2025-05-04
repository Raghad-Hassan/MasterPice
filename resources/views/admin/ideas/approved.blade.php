@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>الأفكار الموافق عليها</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
                @forelse($ideas as $idea)
                    <tr>
                        <td>{{ $idea->title }}</td>
                        <td> {{ $idea->user?->first_name }} {{ $idea->user?->last_name }}</td>
                        <td>{{ $idea->city }}</td>
                        <td>
                            {{ $idea->created_at ? $idea->created_at->format('Y-m-d') : 'غير متوفر' }}
                        </td>
                        
                        <td>
                            <a href="{{ route('admin.ideas.edit', $idea->id) }}" class="btn btn-sm btn-primary">تعديل</a>

                            <form action="{{ route('admin.ideas.delete', $idea->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف الفكرة؟');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">لا توجد أفكار موافق عليها حالياً.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
