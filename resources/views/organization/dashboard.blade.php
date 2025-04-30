@extends('organization.layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">لوحة تحكم فرص التطوع</h1>

        <!-- عرض الفرص المتاحة -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>الفرص المتاحة</h3>
            </div>
            {{-- <div class="card-body">
                @if($availableOpportunities->isEmpty())
                    <p>لا توجد فرص تطوع متاحة حالياً.</p>
                @else
                    <ul class="list-group">
                        @foreach($availableOpportunities as $opportunity)
                            <li class="list-group-item">
                                <h5>{{ $opportunity->title }}</h5>
                                <p><strong>الموقع:</strong> {{ $opportunity->location }}</p>
                                <p><strong>عدد المتطوعين الحاليين:</strong> {{ $opportunity->current_volunteers }}</p>
                                <a href="{{ route('organization.opportunity.show', $opportunity->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div> --}}

        <!-- عرض الفرص الممتلئة -->
        {{-- <div class="card mb-4">
            <div class="card-header">
                <h3>الفرص الممتلئة</h3>
            </div>
            <div class="card-body">
                @if($fullOpportunities->isEmpty())
                    <p>لا توجد فرص ممتلئة حالياً.</p>
                @else
                    <ul class="list-group">
                        @foreach($fullOpportunities as $opportunity)
                            <li class="list-group-item">
                                <h5>{{ $opportunity->title }}</h5>
                                <p><strong>الموقع:</strong> {{ $opportunity->location }}</p>
                                <p><strong>عدد المتطوعين:</strong> {{ $opportunity->total_volunteers }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div> --}}

        <!-- عرض عدد المتطوعين الإجمالي -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>إجمالي عدد المتطوعين</h3>
            </div>
            {{-- <div class="card-body">
                <p>إجمالي عدد المتطوعين الذين تقدموا للفرص: <strong>{{ $totalVolunteers }}</strong></p>
            </div>
        </div> --}}

        <!-- عرض التعليقات -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>التعليقات</h3>
            </div>
            {{-- <div class="card-body">
                @if($comments->isEmpty())
                    <p>لا توجد تعليقات على الفرص حالياً.</p>
                @else
                    <ul class="list-group">
                        @foreach($comments as $comment)
                            <li class="list-group-item">
                                <p><strong>تعليق:</strong> {{ $comment->comment }}</p>
                                <p><small>تم التعليق في: {{ $comment->created_at->diffForHumans() }}</small></p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div> --}}
        </div>
    </div>
@endsection
