@include('component.header')
<style>
    * {
        font-family: 'Cairo', sans-serif;
    }
    
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #eef1f4;
        color: #333;
        direction: rtl;
        margin: 0;
        padding: 0;
        margin-top: 50px
    }
    
    .conference-container {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-image: url('{{ asset('assets/img/22.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #fff;
        box-shadow: 0 0 12px rgba(39, 139, 115, 0.1);
        position: relative;
        min-height: 100vh;
        margin-top: 60px;
    }
    
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7); /* تخفيض العتامة لتكون 0.5 بدلاً من 0.7 */
        z-index: 1;
       
    }
    
    .conference-content {
        position: relative;
        z-index: 2;
    }
    
    .stat-card {
        background: rgba(255,255,255,0.9);
        padding: 20px;
        border-radius: 5px;
        margin: 10px;
        position: relative; /* إضافة */
        z-index: 3; /* إضافة */
    }
    
    .btn-custom {
        background-color: #02d3ac;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        position: relative; 
        z-index: 3;  
    }
    
    .btn-custom:hover {
        background-color: #019f87;
    }
    
    .text-content {
        position: relative;
        z-index: 3;
        background-color: rgba(0,0,0,0.3); 
        padding: 15px;
        border-radius: 8px;
    }
</style>

<div class="conference-container">
    <!-- طبقة مظللة فوق الصورة فقط -->
    <div class="overlay"></div>

    <div class="conference-content">
        <!-- النص داخل القسم -->
        <div class="container text-right" style="max-width: 800px; margin: 0 auto;">
            <!-- العنوان والوصف -->
            <div class="text-content">
                <h2 style="font-size: 40px; color: #fff; font-weight: 100; text-align: right;">المؤتمر التطوعي السنوي</h2>
                <p style="color: #fff; font-size: 18px; text-align: right; margin-bottom: 30px;">
                    إقامة حدث تطوعي سنوي يجمع المتطوعين والمنظمات لمناقشة القضايا الهامة وتبادل الخبرات.
                </p>
            </div>
            
            <!-- قسم التاريخ والمكان -->
            <div class="text-content" style="margin-bottom: 20px;">
                <h4 style="color: #fff; text-align: right; margin-bottom: 15px;">التاريخ والمكان:</h4>
                @isset($conferences)
                    <p style="color: #fff; text-align: right; margin: 10px 0;">التاريخ: {{ $conferences->date ?? 'غير محدد' }}</p>
                    <p style="color: #fff; text-align: right; margin: 10px 0;">المكان: {{ $conferences->location ?? 'غير محدد' }}</p>
                @else
                    <p style="color: #fff; text-align: right;">لا توجد بيانات متاحة</p>
                @endisset
            </div>
            
            <!-- قسم الأهداف -->
            <div class="text-content">
                <h4 style="color: #fff; text-align: right; margin-bottom: 15px;">الأهداف:</h4>
                <ul style="color: #fff; text-align: right; list-style-position: inside; padding-right: 0;">
                    <li style="margin-bottom: 8px;">مناقشة القضايا التطوعية الرئيسية.</li>
                    <li style="margin-bottom: 8px;">تعزيز التعاون بين المنظمات والمتطوعين.</li>
                    <li style="margin-bottom: 8px;">فتح فرص للتشبيك وتبادل الخبرات.</li>
                </ul>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="container mt-5 text-center" style="position: relative; z-index: 3;">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <h3 style="color:#02d3ac;">{{ $conferenceStats->volunteers_count ?? 0 }}+</h3>
                        <p style="color: #005364;">متطوعون</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h3 style="color:#02d3ac;">{{ $conferenceStats->organizations_count ?? 0 }}+</h3>
                        <p style="color: #003b47;">منظمة مشاركة</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h3 style="color:#02d3ac;">{{ $conferenceStats->workshops_count ?? 0 }}+</h3>
                        <p style="color: #003b47;">فعاليات وورش عمل</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5" id="register" style="position: relative; z-index: 3;">
            <div class="text-content">
                <h2 class="text-center mb-4" style="color: #fff;">كيف يمكنك المشاركة؟</h2>
                <p class="text-center" style="color: #fff;">انضم إلى الشبكة التطوعية من خلال التسجيل في الفعالية التي تناسب اهتماماتك ومهاراتك. سنرسل لك تفاصيل الحدث فور التسجيل!</p>
                
                @if(isset($conferences) && count($conferences) > 0)

                @foreach($conferences as $conference)
                <div class="conferences-card">
                    <h3>{{ $conference->title }}</h3>
                    <p>{{ $conference->date }}</p>
                    <a href="{{ route('conferences.register.form', $conference->id) }}" class="btn btn-primary">
                        سجل في المؤتمر
                    </a>
                </div>
                @endforeach
                @else
                    <p style="color: #fff; text-align: center;">لا توجد مؤتمرات متاحة حالياً</p>
                @endif

            </div>
        </div>
    </div>
</div>