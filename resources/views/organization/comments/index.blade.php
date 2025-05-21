@extends('organization.layouts.app') {{-- أو حسب ملف الـ layout الخاص بالمؤسسة --}}

@section('content')
<div class="container">
    <h2 class="mb-4">جميع التعليقات</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المستخدم</th>
                <th>الفرصة التطوعية</th>
                <th>التعليق</th>
                <th>تاريخ الإضافة</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comments as $comment)
                <tr>
                    <td>{{ $comment->user->name ?? 'مجهول' }}</td>
                    <td>{{ $comment->opportunity->title ?? 'غير معروفة' }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">لا توجد تعليقات بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
