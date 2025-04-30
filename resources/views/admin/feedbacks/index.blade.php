@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">آراء المستخدمين</h2>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المستخدم</th>
                    <th>الرسالة</th>
                    <th>تاريخ الإرسال</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $feedback->user->first_name }} {{ $feedback->user->last_name }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">لا يوجد أي آراء حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
