{{-- resources/views/ideas/index.blade.php --}}

@include('component.header')

<!-- animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
   
    .idea-card {
        background-color: #fdfdfd;
        transition: transform 0.2s ease-in-out;
        height: 95%;
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

    .modal-content {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .modal-title {
        color: #0d6efd;
        font-weight: bold;
        font-size: 1.4rem;
    }

    #idea-description {
        font-size: 1rem;
        color: #444;
        margin-bottom: 1rem;
    }

    .modal-body strong {
        color: #333;
    }

    .modal-body span {
        color: #555;
    }

    .idea-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    @media (max-width: 767px) {
        .idea-card {
            margin-bottom: 20px;
        }

        .modal-dialog {
            max-width: 95%;
            margin-left: 
        }
    }
</style>

@include('ideas.create')
<div class="container">
    <h2 class="mt-1 text-center">الأفكار المضافة</h2>

    <div class="row">
        @forelse($ideas as $idea)
            <div class="col-md-4 mb-4 d-flex">
                <div class="idea-card border p-3 rounded shadow w-100">
                    @if($idea->image)
                        <img src="{{ asset('storage/' . $idea->image) }}" alt="صورة الفكرة" class="idea-img img-fluid mb-2 rounded">
                    @else
                        <img src="https://via.placeholder.com/300" alt="صورة الفكرة" class="idea-img img-fluid mb-2 rounded">
                    @endif

                    <h5 class="idea-title">{{ $idea->title ?? 'فكرة بدون عنوان' }}</h5>
                    <p class="idea-author">
                        اقترحها: {{ $idea->user->first_name ?? 'غير معروف' }} {{ $idea->user->last_name ?? '' }}
                    </p>
                    
                    <div class="idea-footer d-flex justify-content-between mt-auto">
                        <!-- لايك  -->
                        <button class="like-btn btn btn-outline-danger" onclick="increaseLike(this, {{ $idea->id }})" title="أحببت الفكرة!">
                            <i class="fa-solid fa-heart me-1"></i>
                            <span class="like-count">{{ $idea->likes->count() }}</span> 
                        </button>
                        

                        <!-- زر عرض التفاصيل -->
                        <button class="eye-btn btn btn-outline-primary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#ideaModal" 
                        onclick="setIdeaDetails(
                            '{{ $idea->title }}',
                            '{{ $idea->user->name }}',
                            '{{ $idea->idea_description }}',
                            '{{ $idea->idea_goals }}', 
                            '{{ $idea->idea_region }}',
                            '{{ $idea->city }}',
                            '{{ $idea->duration_days }}',
                            '{{ $idea->related_entities }}'
                        )"
                        title="عرض تفاصيل الفكرة">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    

                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">لا توجد أفكار حالياً.</p>
        @endforelse
    </div>
</div>


<!-- Modal لعرض التفاصيل -->
<div class="modal fade" id="ideaModal" tabindex="-1" aria-labelledby="ideaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered animate__animated animate__fadeInDown">
        <div class="modal-content text-end">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- وصف الفكرة -->
                <p id="idea-description"></p>

                <!-- أهداف الفكرة -->
                <p><strong>أهداف الفكرة:</strong> <span id="idea-goals"></span></p>

                <div class="row">
                    <div class="col">
                        <strong>المنطقة المقترحة:</strong> <span id="city"></span>
                    </div>
                    <div class="col">
                        <strong>مجال الفكرة:</strong> <span id="idea-field"></span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <strong>المدة (أيام):</strong> <span id="duration_days"></span>
                    </div>
                    <div class="col">
                        <strong>الجهات المعنية:</strong> <span id="related_entities"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>


<script>

// ملف app.js أو أي ملف JavaScript آخر
// دالة لتحديث محتويات الـ Modal
function setIdeaDetails(title, userName, ideaDescription, ideaGoals, ideaRegion, field, ideaDuration, relatedEntities) {
    // تحديث الـ Modal بمحتويات الفكرة
    document.getElementById('modal-title').innerText = title;  // اسم الفكرة
    document.getElementById('idea-description').innerText = ideaDescription;  // وصف الفكرة
    document.getElementById('idea-goals').innerText = ideaGoals;  // أهداف الفكرة
    document.getElementById('city').innerText = ideaRegion;  // المدينة
    document.getElementById('idea-field').innerText = field;  // مجال الفكرة
    document.getElementById('duration_days').innerText = ideaDuration;  // مدة الفكرة (الأيام)
    document.getElementById('related_entities').innerText = relatedEntities;  // الجهات المعنية
}

    function increaseLike(button, ideaId) {
    const likeCountElement = button.querySelector('.like-count');

    fetch(`/idea/${ideaId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // حماية من الـ CSRF
        },
    })
    .then(response => response.json())
    .then(data => {
        likeCountElement.textContent = data.likes_count;  // تحديث عدد الإعجابات
        if (data.message === 'إعجاب تم') {
            button.classList.add('liked');  // إضافة تأثير أو تغيير الشكل عند الإعجاب
        } else {
            button.classList.remove('liked');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
@include('component.footer')
