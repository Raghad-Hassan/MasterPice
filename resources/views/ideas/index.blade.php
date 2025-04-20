{{-- resources/views/ideas/index.blade.php --}}

@extends('admin.layouts.app')

@section('styles')
<style>
    /* التنسيق العام للصفحة */
    .container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    h2 {
        color: #050606;
        font-weight: 700;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #3498db;
    }
    h2:hover {
        color: #010b0b;
    }
    
    /* كروت الأفكار */
    .idea-card {
        background-color: #8e2020;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .idea-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .idea-img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        border-radius: 8px 8px 0 0 !important;
    }
    
    .idea-title {
        color: #2980b9;
        font-weight: 600;
        margin-top: 10px;
        flex-grow: 1;
    }
    
    .idea-author {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }
    
    .idea-footer {
        margin-top: auto;
    }
    
    /* أزرار التفاعل */
    .like-btn, .eye-btn {
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    
    .like-btn:hover {
        background-color: #e74c3c;
        color: white !important;
    }
    
    .eye-btn:hover {
        background-color: #3498db;
        color: white !important;
    }
    
    /* المودال */
    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
        background-color: #3498db;
        color: rgb(210, 47, 47);
        border-radius: 10px 10px 0 0 !important;
    }
    
    .modal-title {
        font-weight: 600;
        width: 100%;
        text-align: center;
    }
    
    .modal-body {
        padding: 20px;
        color: #34495e;
    }
    
    .modal-body strong {
        color: #2c3e50;
    }
    
    /* التجاوب مع الشاشات الصغيرة */
    @media (max-width: 768px) {
        .idea-img {
            height: 150px;
        }
        
        .idea-title {
            font-size: 1rem;
        }
        
        .modal-dialog {
            margin: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2 class="mt-5 text-center" style="color: #010b0b">الأفكار المضافة</h2>

    <div class="row">
        @forelse($ideas as $idea)
            <div class="col-md-4 mb-4">
                <div class="idea-card border p-3 rounded shadow">
                    @if($idea->image)
                        <img src="{{ asset('storage/' . $idea->image) }}" alt="صورة الفكرة" class="idea-img img-fluid mb-2 rounded">
                    @else
                        <img src="https://via.placeholder.com/300" alt="صورة الفكرة" class="idea-img img-fluid mb-2 rounded">
                    @endif

                    <h5 class="idea-title">{{ $idea->title ?? 'فكرة بدون عنوان' }}</h5>
                    <p class="idea-author">اقترحها: {{ $idea->user->name }}</p>
                    <div class="idea-footer d-flex justify-content-between">
                        <!-- لايك وهمي -->
                        <button class="like-btn btn btn-outline-danger" onclick="increaseLike(this, 1)">
                            <i class="fa-solid fa-heart me-1"></i>
                            <span class="like-count">12</span>
                        </button>

                        <!-- زر عرض التفاصيل -->
                        <button class="eye-btn btn btn-outline-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ideaModal" 
                            onclick="setIdeaDetails(
                                '{{ $idea->title }}',
                                '{{ $idea->proposer_name }}',
                                '{{ $idea->idea_description }}',
                                '{{ $idea->idea_region }}',
                                '{{ $idea->field }}',
                                '{{ $idea->idea_duration }}',
                                '{{ $idea->idea_authorities }}'
                            )">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center" style="color: #010b0b">لا توجد أفكار حالياً.</p>
        @endforelse
    </div>
</div>

<!-- Modal لعرض التفاصيل -->
<div class="modal fade" id="ideaModal" tabindex="-1" aria-labelledby="ideaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-end">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
            </div>
            <div class="modal-body" id="modal-body">
                <p id="idea-description"></p>
                <div class="row">
                    <div class="col">
                        <strong>المنطقة المقترحة:</strong> <span id="idea-location"></span>
                    </div>
                    <div class="col">
                        <strong>مجال الفكرة:</strong> <span id="idea-field"></span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <strong>المدة (أيام):</strong> <span id="idea-duration"></span>
                    </div>
                    <div class="col">
                        <strong>الجهات المعنية:</strong> <span id="idea-authority"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function setIdeaDetails(title, proposer, description, region, field, duration, authority) {
        document.getElementById('modal-title').innerText = title + ' - ' + proposer;
        document.getElementById('idea-description').innerText = 'وصف الفكرة: ' + description;
        document.getElementById('idea-location').innerText = region;
        document.getElementById('idea-field').innerText = field;
        document.getElementById('idea-duration').innerText = duration;
        document.getElementById('idea-authority').innerText = authority;
    }

    function increaseLike(btn, amount) {
        let countSpan = btn.querySelector('.like-count');
        let current = parseInt(countSpan.innerText);
        countSpan.innerText = current + amount;
    }
</script>
@endsection