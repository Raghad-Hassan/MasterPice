<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/opportunit-details.css') }}" rel="stylesheet">
    <title>تفاصيل الفرصة</title>
</head>
<body>

@include('component.header')

<div class="container">
    <h1 class="title">{{ $opportunity->organization->organization_name }}</h1>

    {{-- @foreach ($organization->volunteerOpportunities as $opportunity) --}}
        <div class="opportunity-details">
            <div class="image-container">
                <img src="{{ asset('assets/img/'.$opportunity->image) }}" class="opportunity-img" alt="{{ $opportunity->title }}">
                <div class="description-container">
                    <p class="description-title">وصف الفرصة</p>
                    <div class="divider"></div>
                    <p class="description-text">{{ $opportunity->description }}</p>
                </div>
            </div>
            <div class="info-container">
                <p><strong>عدد ساعات التطوع:</strong> {{ $opportunity->volunteer_hours }} ساعات</p>
                <p><strong>الموقع:</strong> {{ $opportunity->location }}</p>
                <p><strong>التاريخ:</strong> من {{ $opportunity->start_date }} إلى {{ $opportunity->end_date }}</p>
                <p><strong>الأيام:</strong> {{ $opportunity->days }}</p>
                <p><strong>الساعات:</strong> {{ $opportunity->start_time }} - {{ $opportunity->end_time }}</p>
                <p><strong>الحد الأدنى للساعات:</strong> {{ $opportunity->min_hours }} ساعات</p>
                <p><strong>الحد الأعلى للساعات:</strong> {{ $opportunity->max_hours }} ساعات</p>
                <p><strong>وسائل النقل:</strong> {{ $opportunity->transportation == 'available' ? 'متاحة' : 'غير متاحة' }}</p>
                <p><strong>عدد المتطوعين:</strong> {{ $opportunity->current_volunteers }} من {{ $opportunity->total_volunteers }}</p>
                <button class="register-btn">سجل الآن</button>
            </div>
        </div>

        <!-- input مخفي لحفظ ID الفرصة -->
        <input type="hidden" id="opportunity-id" value="{{ $opportunity->id }}">
    {{-- @endforeach --}}
</div>

<div class="sustainable-goals">
    <p class="sustainable-goals-title">أهداف التنمية المستدامة</p>

    <div class="goals-images">
        <img src="{{ asset('assets/img/التنميه.png') }}" alt="هدف 1">
        <img src="{{ asset('assets/img/التنميه 2.png') }}" alt="هدف 2">
    </div>

    <div class="tabs-section">
        <div class="tab active" data-tab="opportunity">الفرصة</div>
        <div class="tab" data-tab="comments">التعليقات</div>
    </div>

    <div class="tabs-content">
        <!-- هنا يتم تعبئة المحتوى بالجافاسكربت -->
    </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab');
    const content = document.querySelector('.tabs-content');
    const opportunityId = document.getElementById('opportunity-id')?.value;

    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }}; // تحقق من حالة تسجيل الدخول

    const renderOpportunityContent = () => {
        content.innerHTML = `
            <h3>المعرفة المكتسبة من هذه الفرصة</h3>
            <p>ستتعلم مهارات قيادية وتواصل فعال بالإضافة إلى العمل الجماعي ضمن فريق تطوعي.</p>
        `;
    };

    const renderCommentsContent = () => {
        content.innerHTML = `
            <textarea id="comment-input" rows="4" placeholder="اكتب تعليقك هنا..." style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
            <button id="submit-comment" style="margin-top: 10px; padding: 10px 20px; background-color: #02d3ac; color: white; border: none; border-radius: 5px; cursor: pointer;">إرسال التعليق</button>
            <div id="comments-section" style="margin-top: 20px;"></div>
        `;

        const submitBtn = document.getElementById('submit-comment');
        const commentInput = document.getElementById('comment-input');
        const commentsSection = document.getElementById('comments-section');

        submitBtn.addEventListener('click', () => {
            if (!isLoggedIn) {
                window.location.href = '/login'; // إذا المستخدم مش مسجل دخول، يحوله لتسجيل الدخول
                return;
            }

            const comment = commentInput.value.trim();
            console.log(comment);
            if (comment) {
                fetch('/opportunity-comments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        opportunity_id: opportunityId,
                        comment: comment
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ. حاول لاحقاً.');
                });
            }
        });
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            if (tab.dataset.tab === 'opportunity') {
                renderOpportunityContent();
            } else {
                renderCommentsContent();
            }
        });
    });

    // أول تحميل عرض محتوى الفرصة
    renderOpportunityContent();
});
</script>

@include('component.footer')

</body>
</html>
