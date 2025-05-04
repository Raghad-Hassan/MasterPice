{{-- resources/views/ideas/index.blade.php --}}

@include('component.header')

<!-- animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@include('ideas.create')
<div class="container">
    <h2 class="mt-4 text-center mb-4" style="color: #005364;">الأفكار المضافة</h2>

    <div class="row mt-3 mb-5">
        @forelse($ideas as $idea)
            <div class="col-md-4 mb-4 d-flex">
                <div class="idea-card border p-3 rounded shadow w-100">
                    @if($idea->image)
                    <img src="{{ asset('storage/' . $idea->image) }}" alt="صورة الفكرة">
                @else
                    <img src="https://via.placeholder.com/300" alt="صورة افتراضية">
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


function setIdeaDetails(title, userName, ideaDescription, ideaGoals, ideaRegion, field, ideaDuration, relatedEntities) {
   
    document.getElementById('modal-title').innerText = title;  
    document.getElementById('idea-description').innerText = ideaDescription;  
    document.getElementById('idea-goals').innerText = ideaGoals; 
    document.getElementById('city').innerText = ideaRegion; 
    document.getElementById('idea-field').innerText = field;  
    document.getElementById('duration_days').innerText = ideaDuration;  
    document.getElementById('related_entities').innerText = relatedEntities;  
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
        likeCountElement.textContent = data.likes_count;  
        if (data.message === 'إعجاب تم') {
            button.classList.add('liked');  
        } else {
            button.classList.remove('liked');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
@include('component.footer')
