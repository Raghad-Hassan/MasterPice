@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">قائمة المشتركين بالنشرة البريدية</h2>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>البريد الإلكتروني</th>
                    <th>تاريخ الاشتراك</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscriptions as $subscription)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subscription->email }}</td>
                        <td>{{ $subscription->subscribed_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">لا يوجد مشتركين بعد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
