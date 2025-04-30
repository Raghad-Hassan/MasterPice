@extends('organization.layouts.app')

@section('content')
    <h1>التعليقات</h1>

    <table class="table">
        <thead>
            <tr>
                <th>اسم المعلق</th>
                <th>التعليق</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
