@include('component.header')
<link href="{{ asset('assets/css/opportunit-details.css') }}" rel="stylesheet">
<div class="container">
        <h1 class="title">فرصة تطوعية في التعليم</h1>
        <div class="opportunity-details">
            <div class="image-container">
                
                 <img src="{{ asset('assets/img/IMG.jpg') }}" class="opportunity-img">
                <div class="description-container">
                    <p class="description-title">وصف الفرصة</p>
                    <div class="divider"></div>
                    <p class="description-text">هذه الفرصة التطوعية تهدف إلى دعم الأطفال في المدارس المحتاجة، حيث سيقوم المتطوعون بتقديم المساعدة في التدريس وتعليم المهارات الأساسية للطلاب. هذه فرصة رائعة للمساهمة في بناء مستقبل أفضل للأطفال.</p>
                </div>
            </div>
            <div class="info-container">
                <p><strong>عدد ساعات التطوع</strong> 10 ساعات</p>
                <div class="divider"></div>
                <p><strong>الموقع</strong> عمان</p>
                <p><strong>التاريخ</strong> من 5 أبريل إلى 10 أبريل</p>
                <p><strong>الأيام</strong> الأحد - الخميس</p>
                <p><strong>الساعات</strong> 9:00 صباحًا - 3:00 مساءً</p>
                <div class="divider"></div>
                <p><strong>الحد الأدنى للساعات</strong> 5 ساعات</p>
                <div class="small-divider"></div>
                <p><strong>الحد الأعلى للساعات</strong> 15 ساعة</p>
                <div class="small-divider"></div>
                <p><strong>وسائل النقل</strong> غير متاحة</p>
                <div class="divider"></div>
                <p><strong>عدد المتطوعين</strong> 7 من 20</p>
                <button class="register-btn">سجل الآن</button>
            </div>
        </div>
        
       

    </div>
    <div class="sustainable-goals">
        <p class="sustainable-goals-title">أهداف التنمية المستدامة</p>
        <div class="goals-images">
          
           <img src="{{ asset('assets/img/التنميه.png') }}" alt="هدف 1">
              <img src="{{ asset('assets/img/التنميه 2.png') }}" alt="هدف 2">
            
        </div>

        <div class="tabs-section">
            <div class="tab active">الفرصة</div>
            <div class="tab">التعليقات</div>
        </div>
        
        <div class="tabs-content">
            
        </div>
        
        <script>
            window.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab');
            const content = document.querySelector('.tabs-content');

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

            const renderCommentsContent = () => {
                content.innerHTML = `
                    <textarea id="comment-input" rows="4" placeholder="اكتب تعليقك هنا..." style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
                    <button id="submit-comment" style="margin-top: 10px; padding: 10px 20px; background-color: #02d3ac; color: white; border: none; border-radius: 5px; cursor: pointer;">إرسال التعليق</button>
                    <div id="comments-section" style="margin-top: 20px;"></div>
                `;

                const submitBtn = document.getElementById('submit-comment');
                const commentInput = document.getElementById('comment-input');
                const commentsSection = document.getElementById('comments-section');

                submitBtn.addEventListener('click', () => {
                    const comment = commentInput.value.trim();
                    if (comment) {
                        const commentDiv = document.createElement('div');
                        commentDiv.style.cssText = 'background: #f8f8f8; padding: 15px; border-radius: 5px; margin-bottom: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); width: 30%;';
                        commentDiv.textContent = comment;
                        commentsSection.appendChild(commentDiv);
                        commentInput.value = '';
                    }
                });
            };

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    if (index === 0) {
                        renderOpportunityContent();
                    } else {
                        renderCommentsContent();
                    }
                });
            });

            // تشغيل التبويب الأول تلقائيًا
            renderOpportunityContent();
        });

        </script>
   
   @include('component.footer')