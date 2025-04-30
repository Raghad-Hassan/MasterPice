@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">قائمة المستخدمين</h2>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">إضافة مستخدم</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الإيميل</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
