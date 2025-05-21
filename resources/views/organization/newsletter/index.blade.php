@extends('organization.layouts.app') {{-- غيّري حسب اسم ملف القالب الرئيسي --}}

@section('content')
    <h1 class="mb-4">المشتركين في النشرة البريدية</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>البريد الإلكتروني</th>
                <th>تاريخ الاشتراك</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $index => $sub)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sub->email }}</td>
                    <td>{{ $sub->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
