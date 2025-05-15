<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تفاصيل الفرصة التطوعية</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('assets/css/opportunit-details.css') }}" rel="stylesheet">
    <style>
        /* تنسيقات عامة */
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* تنسيقات التبويبات */
        .tabs-section {
            display: flex;
            margin: 30px 0 20px;
            border-bottom: 1px solid #ddd;
        }
        
        .tab {
            padding: 12px 25px;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }
        
        .tab.active {
            color: #02d3ac;
            border-bottom-color: #02d3ac;
        }
        
        /* تنسيقات التعليقات */
        .comments-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .comment-form {
            margin-bottom: 30px;
        }
        
        #comment-input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
            transition: all 0.3s;
        }
        
        #comment-input:focus {
            border-color: #02d3ac;
            outline: none;
            box-shadow: 0 0 0 3px rgba(2, 211, 172, 0.1);
        }
        
        #submit-comment {
            background-color: #02d3ac;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            margin-top: 15px;
        }
        
        #submit-comment:hover {
            background-color: #02b797;
            transform: translateY(-2px);
        }
        
        .comments-list {
            margin-top: 30px;
        }
        
        .comment-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-right: 4px solid #02d3ac;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .comment-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .comment-author {
            font-weight: 700;
            color: #02d3ac;
            font-size: 16px;
        }
        
        .comment-date {
            font-size: 12px;
            color: #6c757d;
        }
        
        .comment-text {
            color: #495057;
            line-height: 1.7;
            font-size: 15px;
        }
        
        .no-comments {
            text-align: center;
            padding: 30px;
            color: #6c757d;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .error-message {
            color: #dc3545;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

@include('component.header')

<div class="container">
    <div class="top-links">
        <a href="{{ route('index') }}">الصفحة الرئيسية</a>
        <a href="#">/ </a>
        <a href="#">تفاصيل الفرصة التطوعية</a>
    </div>

    <h1 class="title">{{ $opportunity->organization->organization_name }}</h1>
    <input type="hidden" id="opportunity-id" value="{{ $opportunity->id }}">

    <div class="opportunity-details">
        <div class="image-container">
            @if($opportunity->image)
                <img src="{{ asset('images/' . $opportunity->image) }}" alt="صورة الفرصة" width="200">
            @else
                <img src="{{ asset('images/default-opportunity.jpg') }}" alt="صورة افتراضية" width="200">
            @endif
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
            <form action="{{ route('user.registerOpportunity') }}" method="POST">
                @csrf
                <input type="hidden" name="opportunity_id" value="{{ $opportunity->id }}">
                <button type="submit" class="register-btn">سجل الآن</button>
            </form>
        </div>
    </div>

    <input type="hidden" id="opportunity-id" value="{{ $opportunity->id }}">

    <div class="tabs-section">
        <div class="tab active" data-tab="opportunity">الفرصة</div>
        <div class="tab" data-tab="comments">التعليقات</div>
    </div>

    <div class="tabs-content">
        <!-- سيتم تعبئة المحتوى هنا بالجافاسكريبت -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const content = document.querySelector('.tabs-content');
    const opportunityId = document.getElementById('opportunity-id').value;
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

    // دالة لجلب التعليقات
    const fetchComments = async () => {
        try {
            const response = await fetch(`/organization/opportunity-comments/${opportunityId}`);
            if (!response.ok) throw new Error('فشل في جلب التعليقات');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('خطأ في جلب التعليقات:', error);
            throw error;
        }
    };

    // دالة لعرض التعليقات
    const renderComments = (comments) => {
        if (!Array.isArray(comments)) {
            return `
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    حدث خطأ في تحميل التعليقات
                </div>
            `;
        }

        if (comments.length === 0) {
            return `
                <div class="no-comments">
                    <i class="far fa-comment-dots" style="font-size: 24px;"></i>
                    <p>لا توجد تعليقات حتى الآن. كن أول من يعلق!</p>
                </div>
            `;
        }

        return comments.map(comment => `
            <div class="comment-item">
                <div class="comment-header">
                    <span class="comment-author">
                        <i class="fas fa-user"></i> ${comment.user?.first_name || ''} ${comment.user?.last_name || 'مستخدم'}

                    </span>
                    <span class="comment-date">
                        <i class="far fa-clock"></i> ${new Date(comment.created_at).toLocaleString('ar-EG')}
                    </span>
                </div>
                <div class="comment-text">${comment.comment}</div>
            </div>
        `).join('');
    };

    // دالة عرض محتوى الفرصة
    const renderOpportunityContent = () => {
        content.innerHTML = `
                    <h3>المعرفة المكتسبة من هذه الفرصة</h3>
                    <p>
                    1. التواصل الفعال – القدرة على التفاعل بوضوح ولباقة مع الآخرين، سواء كانوا مستفيدين أو أعضاء في الفريق.<br>
                    2. العمل الجماعي – التعاون مع الآخرين لتحقيق أهداف المبادرة بكفاءة وروح إيجابية.<br>
                    3. المسؤولية والانضباط – الالتزام بالمواعيد والمهام الموكلة، وتحمل المسؤولية تجاه العمل التطوعي.<br>
                    4. التعاطف والإنسانية – القدرة على فهم مشاعر واحتياجات الآخرين والتعامل معهم بلطف واحترام.<br>
                    5. حل المشكلات والتكيف – المرونة في مواجهة التحديات وإيجاد حلول إبداعية أثناء العمل التطوعي.
                    </p>
                    <h3>متطلبات الفرصة</h3>
                    <p>
                    - الالتزام بأخلاقيات العمل التطوعي (الاحترام، السرية، الإخلاص).<br>
                    - الالتزام بإجراءات السلامة أثناء توزيع الوجبات والتعامل مع المستفيدين.<br>
                    - تعزيز روح التعاون والتكافل بين المتطوعين والمجتمع.
                    </p>
                    <h3>خطة الفرصة التطوعية</h3>
                    <p>
                    1. تحديد الأنشطة التطوعية:<br>
                    - توزيع وجبات الإفطار: تجهيز وتوزيع الوجبات على المحتاجين.<br>
                    - تجهيز السلال الغذائية: جمع التبرعات العينية وإعداد الطرود الغذائية.<br>
                    - تنظيم الفعاليات المجتمعية: مثل الإفطارات الجماعية والأنشطة التوعوية.<br><br>
                    2. جدولة العمل:<br>
                    - تقسيم الفرق إلى مجموعات حسب المناطق والمهام.<br>
                    - وضع جدول زمني يحدد مواعيد العمل وأماكن التوزيع.<br><br>
                    3. متابعة الأداء والتقييم:<br>
                    - مراجعة الإنجازات يوميًا لتحديد مدى تحقيق الأهداف.<br>
                    - تقديم التغذية الراجعة لتحسين الأداء في الأيام القادمة.
                    </p>
                `;
    };

    // دالة عرض محتوى التعليقات
    const renderCommentsContent = async () => {
        content.innerHTML = `
            <div class="comments-container">
                <div class="comment-form">
                    <textarea id="comment-input" rows="4" placeholder="اكتب تعليقك هنا..."></textarea>
                    <button id="submit-comment">
                        <i class="fas fa-paper-plane"></i> إرسال التعليق
                    </button>
                    <div id="error-message"></div>
                </div>
                <div class="comments-list" id="comments-section"></div>
            </div>
        `;

        try {
            const comments = await fetchComments();
            document.getElementById('comments-section').innerHTML = renderComments(comments);
        } catch (error) {
            document.getElementById('comments-section').innerHTML = `
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    ${error.message || 'حدث خطأ في تحميل التعليقات'}
                </div>
            `;
        }

        // إرسال تعليق جديد
        document.getElementById('submit-comment').addEventListener('click', async () => {
            const errorElement = document.getElementById('error-message');
            errorElement.textContent = '';
            
            if (!isLoggedIn) {
                window.location.href = '/login';
                return;
            }

            const commentInput = document.getElementById('comment-input');
            const comment = commentInput.value.trim();

            if (!comment) {
                errorElement.textContent = 'الرجاء إدخال نص التعليق';
                return;
            }

            try {
                const response = await fetch('/organization/opportunity-comments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        opportunity_id: opportunityId,
                        comment: comment
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'حدث خطأ أثناء إرسال التعليق');
                }

                // تحديث قائمة التعليقات
                const updatedComments = await fetchComments();
                document.getElementById('comments-section').innerHTML = renderComments(updatedComments);
                commentInput.value = '';
                
            } catch (error) {
                console.error('Error:', error);
                errorElement.textContent = error.message || 'حدث خطأ غير متوقع';
            }
        });
    };

    // تبديل التبويبات
    tabs.forEach(tab => {
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

    // عرض محتوى الفرصة افتراضيًا
    renderOpportunityContent();
});
</script>


@include('component.footer')

</body>
</html>