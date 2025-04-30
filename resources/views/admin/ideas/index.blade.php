@extends('admin.layouts.app')

@section('content')
<!-- animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    .idea-card {
        background-color: #fdfdfd;
        transition: transform 0.2s ease-in-out;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .idea-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .idea-title {
        font-weight: bold;
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .idea-author {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .like-btn,
    .eye-btn {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .like-btn:hover {
        background-color: #dc3545;
        color: white;
    }

    .eye-btn:hover {
        background-color: #0d6efd;
        color: white;
    }

    .idea-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .user-name {
    display: inline-block; 
    margin-left: 5px; 
}


    @media (max-width: 767px) {
        .idea-card {
            margin-bottom: 20px;
        }
    }
</style>

<div class="container">
    <h2 class="mt-5 text-center">الأفكار المضافة</h2>

    <div class="row">
        @forelse($ideas as $idea)
            <div class="col-md-4 mb-4 d-flex">
                <div class="idea-card border p-3 rounded shadow w-100">
                    @if($idea->image)
                        <img src="{{ asset('storage/' . $idea->image) }}" alt="صورة الفكرة" class="idea-img img-fluid mb-2 rounded">
                    @else
                        <img src="https://via.placeholder.com/300" alt="صورة الفكرة" class="idea-img img-fluid mb-2 rounded">
                    @endif

                    <div class="mb-2">
                        <span class="badge bg-primary">{{ $idea->field }}</span>
                    </div>

                    <h5 class="idea-title">{{ $idea->description ?? 'فكرة بدون عنوان' }}</h5>

                    @if($idea->idea_description)
                        <p class="text-muted">{{ \Illuminate\Support\Str::limit($idea->idea_description, 100) }}</p>
                    @endif

                    @if($idea->related_entities)
                        <p><strong>الجهات المعنية:</strong> {{ $idea->related_entities }}</p>
                    @endif

                    <td>
                        <strong>اقترحها:</strong> 
                        <span class="user-name">
                            {{ $idea->user?->first_name }} {{ $idea->user?->last_name }}
                        </span>
                    </td>



                    <div class="idea-footer d-flex justify-content-between mt-auto">
                        <form action="{{ route('admin.ideas.approve', $idea->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" title="موافقة الفكرة">
                                <i class="fa-solid fa-check me-1"></i> موافقة
                            </button>
                        </form>

                        <form action="{{ route('admin.ideas.reject', $idea->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" title="رفض الفكرة">
                                <i class="fa-solid fa-times me-1"></i> رفض
                            </button>
                        </form>

                        <a href="{{ route('admin.ideas.edit', $idea->id) }}" class="eye-btn btn btn-outline-primary" title="عرض تفاصيل الفكرة">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">لا توجد أفكار حالياً.</p>
        @endforelse
    </div>
</div>
@endsection
