@extends('admin.layouts.app')

@section('title', 'المشاركين في المؤتمر')

@section('content')

<style>
    thead {
        background-color:#deefeb;
        color: white;
    }

    thead :hover{
        background-color: #deefeb;
    }
    .custom-badge {
        background-color: #02d3ac;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.85rem;
        margin: 2px;
        display: inline-block;
    }

    table td, table th {
        vertical-align: middle !important;
    }

    /* تخصيص الجدول */
    table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border: 1px solid #dee2e6;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #005364;
        text-align: center;
    }

    /* تخصيص صفوف الجدول */
    table tbody tr {
        background-color: #f8f9fa;
    }
    /* تخصيص عنوان الجدول */
    h2 {
        color: #005364;
        font-size: 2rem;
        font-weight: 700;
    }

</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center">المشاركين في المؤتمر: {{ $conference->title }}</h2>

    <!-- جدول المشاركين -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم الكامل</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>مجال الاهتمام</th>
                    <th>المدينة</th>
                    <th>تفاصيل الخبرة السابقة</th>
                    <th>المهارات</th>
                    <th>سبب المشاركة</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $registration->full_name }}</td>
                        <td>{{ $registration->email }}</td>
                        <td>{{ $registration->phone }}</td>
                        <td>{{ $registration->interest_field }}</td>
                        <td>{{ $registration->city }}</td>
                        <td>{{ $registration->previous_experience ? 'نعم' : 'لا' }}</td>
                        {{-- <td>
                            @foreach(json_decode($registration->skills) as $skill)
                                <span class="custom-badge">{{ $skill }}</span>
                            @endforeach 
                        </td> --}}
                        <td>
                            @foreach(is_array($registration->skills) ? $registration->skills : json_decode($registration->skills) as $skill)
                                <span class="custom-badge">{{ $skill }}</span>
                            @endforeach
                        </td>
                        
                        <td>{{ $registration->participation_reason }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
