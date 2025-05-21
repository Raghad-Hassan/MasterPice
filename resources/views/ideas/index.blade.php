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
                        <!-- زر لايك -->
                        <button class="like-btn btn btn-outline-danger" onclick="increaseLike(this, {{ $idea->id }})" title="أحببت الفكرة!">
                            <i class="fa-solid fa-heart me-1"></i>
                            <span class="like-count">{{ $idea->likes->count() }}</span>
                        </button>

                        <!-- زر عرض التفاصيل -->
                        <button class="eye-btn btn btn-outline-primary view-idea"
                            data-bs-toggle="modal"
                            data-bs-target="#ideaModal"
                            data-title="{{ $idea->title }}"
                            data-description="{{ $idea->idea_description }}"
                            data-goals="{{ $idea->idea_goals }}"
                            data-region="{{ $idea->idea_goals }}"
                            data-field="{{ $idea->city }}"
                            data-duration="{{ $idea->duration_days }}"
                            data-entities="{{ $idea->related_entities }}"
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
     <div class="d-flex justify-content-center">
        {{ $ideas->links() }}
    </div> 
</div>


<!-- Modal لعرض التفاصيل -->
<div class="modal fade" id="ideaModal" tabindex="-1" aria-labelledby="ideaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;"> <!-- تحديد العرض هنا -->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #eee;">
                <h5 class="modal-title fs-4 fw-bold text-dark" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- صورة الفكرة -->
                <div class="text-center mb-4">
                    <img id="modal-image" src="" class="img-fluid rounded" style="max-height: 250px; width: auto;" alt="صورة الفكرة">
                </div>
                
                <!-- وصف الفكرة -->
                <div class="card mb-3 border-light shadow-sm" style="border-radius: 10px;">
                    <div class="card-header bg-transparent border-bottom" style="padding: 0.75rem 1rem;">
                        <h6 class="mb-0 fw-bold text-dark">وصف الفكرة</h6>
                    </div>
                    <div class="card-body" style="padding: 1rem;">
                        <p class="mb-0 text-secondary" id="idea-description" style="text-align: right; direction: rtl;"></p>
                    </div>
                </div>
                
                <!-- أهداف الفكرة -->
                <div class="card mb-3 border-light shadow-sm" style="border-radius: 10px;">
                    <div class="card-header bg-transparent border-bottom" style="padding: 0.75rem 1rem;">
                        <h6 class="mb-0 fw-bold text-dark">أهداف الفكرة</h6>
                    </div>
                    <div class="card-body" style="padding: 1rem;">
                        <p class="mb-0 text-secondary" id="idea-goals" style="text-align: right; direction: rtl;"></p>
                    </div>
                </div>
                
                <!-- معلومات الفكرة -->
                <div class="card mb-3 border-light shadow-sm" style="border-radius: 10px;">
                    <div class="card-header bg-transparent border-bottom" style="padding: 0.75rem 1rem;">
                        <h6 class="mb-0 fw-bold text-dark">المعلومات الأساسية</h6>
                    </div>
                    <div class="card-body" style="padding: 1rem;">
                        <div class="row" style="direction: rtl; text-align: right;">
                            <div class="col-md-6 mb-2">
                                <p class="mb-1 text-muted"><small>مجال الفكرة:</small></p>
                                <p id="idea_goals" class="fw-medium" style="text-align: right;">غير محدد</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="mb-1 text-muted"><small>المنطقة المقترحة:</small></p>
                                <p id="idea-field" class="fw-medium" style="text-align: right;">غير محدد</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="mb-1 text-muted"><small>المدة (أيام):</small></p>
                                <p id="duration_days" class="fw-medium" style="text-align: right;">غير محدد</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="mb-1 text-muted"><small>الجهات المعنية:</small></p>
                                <p id="related_entities" class="fw-medium" style="text-align: right;">غير محدد</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="float: left;">
                    <i class="fas fa-times me-1"></i> إغلاق
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.view-idea');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const ideaCard = this.closest('.idea-card');
                const imageSrc = ideaCard.querySelector('img')?.src || 'https://via.placeholder.com/300';
                
                document.getElementById('modal-title').innerText = this.dataset.title || 'لا يوجد عنوان';
                document.getElementById('idea-description').innerText = this.dataset.description || 'لا يوجد وصف متاح';
                document.getElementById('idea-goals').innerText = this.dataset.goals || 'لا يوجد أهداف محددة';
                document.getElementById('idea_goals').textContent = this.dataset.region || 'غير محدد';
                document.getElementById('idea-field').textContent = this.dataset.field || 'غير محدد';
                document.getElementById('duration_days').textContent = this.dataset.duration || 'غير محدد';
                document.getElementById('related_entities').textContent = this.dataset.entities || 'لا يوجد جهات معينة';
                document.getElementById('modal-image').src = imageSrc;
            });
        });
    });

  function increaseLike(button, ideaId) {
        const likeCountElement = button.querySelector('.like-count');

        fetch(`/idea/${ideaId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

<style>
    /* ستايلات المودال المحسنة */
    #ideaModal .modal-content {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border: none;
        width
    }
    
    #ideaModal .modal-header {
        padding: 1rem;
        background-color: #f8f9fa !important;
    }
    
    #ideaModal .modal-body {
        padding: 1rem;
    }
    
    #modal-image {
        max-height: 250px;
        width: auto;
        object-fit: contain;
        border-radius: 8px;
        margin: 0 auto;
    }
    
    /* تنسيقات البطاقات */
    #ideaModal .card {
        border: 1px solid #f1f1f1;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 1rem;
    }
    
    #ideaModal .card-header {
        background-color: transparent;
        border-bottom: 1px solid #eee;
        padding: 0.75rem 1rem;
    }
    
    #ideaModal .card-body {
        padding: 1rem;
    }
    
    /* تأثيرات الحركة */
    .animate__animated.animate__fadeInDown {
        animation-duration: 0.3s;
    }
    
    /* تنسيقات النصوص */
    #ideaModal .text-muted {
        font-size: 0.85rem;
        color: #6c757d !important;
    }
    
    #ideaModal .fw-medium {
        font-weight: 500;
        color: #495057;
    }
</style>

@include('component.footer')
