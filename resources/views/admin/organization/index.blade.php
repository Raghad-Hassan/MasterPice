@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">المؤسسات</h2>

        <a href="{{ route('admin.organizations.create') }}" class="btn btn-primary mb-3">إضافة مؤسسة جديدة</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المؤسسة</th>
                    <th>اسم المدير</th>
                    <th>الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>القطاع</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizations as $organization)
                    <tr>
                        <td>{{ $organization->id }}</td>
                        <td>{{ $organization->organization_name }}</td>
                        <td>{{ $organization->first_name }} {{ $organization->last_name }}</td>
                        <td>{{ $organization->phone }}</td>
                        <td>{{ $organization->email }}</td>
                        <td>{{ $organization->sector }}</td>
                        <td>
                            <a href="{{ route('admin.organizations.edit', $organization->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('admin.organizations.destroy', $organization->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
