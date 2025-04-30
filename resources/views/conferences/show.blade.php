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
        padding: 10px;
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
        background-color: rgba(0, 0, 0, 0.7); 
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
        color: white;
    }
    
    .text-content {
        position: relative;
        z-index: 3;
        background-color: rgba(0,0,0,0.3); 
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>

@if(isset($conferences) && count($conferences) > 0)
    @foreach($conferences as $conference)
    <div class="conference-container" style="background-image: url('{{ asset('assets/img/22.jpg') }}');">
        <div class="overlay"></div>

        <div class="overlay" style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0, 0, 0, 0.5);"></div>

        <div class="conference-content" style="position: relative; z-index: 2; padding: 100px 0;">

            <div class="container text-right" style="max-width: 800px; margin: 0 auto;">

                <div class="text-content">
                    <h2 style="font-size: 40px; color: #fff; font-weight: 100; text-align: right;">
                        {{ $conference->title }}
                    </h2>
                    <p style="color: #fff; font-size: 18px; text-align: right; margin-bottom: 30px;">
                        {{ $conference->description }}
                    </p>
                </div>

                <div class="text-content" style="margin-bottom: 20px;">
                    <h4 style="color: #fff; text-align: right; margin-bottom: 15px;">التاريخ والمكان:</h4>
                    <p style="color: #fff; text-align: right; margin: 10px 0;">التاريخ: {{ $conference->date ?? 'غير محدد' }}</p>
                    <p style="color: #fff; text-align: right; margin: 10px 0;">المكان: {{ $conference->location ?? 'غير محدد' }}</p>
                </div>

                <div class="text-content">
                    <h4 style="color: #fff; text-align: right; margin-bottom: 15px;">الأنشطة والفعاليات:</h4>
                    <p style="color: #fff; text-align: right;">
                        {{ $conference->activities ?? 'لا توجد أنشطة' }}
                    </p>
                </div>

            </div>

            <!-- Statistics Section -->
            <div class="container mt-5 text-center" style="position: relative; z-index: 3;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3 style="color:#02d3ac;">{{ $conference->expected_participants ?? 0 }}+</h3>
                            <p style="color: #005364;">متطوعون</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3 style="color:#02d3ac;">{{ $conference->organizations_count ?? 0 }}+</h3>
                            <p style="color: #003b47;">منظمة مشاركة</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3 style="color:#02d3ac;">{{ $conference->workshops ?? 0 }}+</h3>
                            <p style="color: #003b47;">فعاليات وورش عمل</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- زر التسجيل -->
            <div class="container mt-5" id="register" style="position: relative; z-index: 3;">
                <div class="text-content">
                    <h2 class="text-center mb-4" style="color: #fff;">كيف يمكنك المشاركة؟</h2>
                    <p class="text-center" style="color: #fff;">انضم إلى الشبكة التطوعية من خلال التسجيل في الفعالية التي تناسب اهتماماتك ومهاراتك. سنرسل لك تفاصيل الحدث فور التسجيل!</p>

                    <div class="conferences-card text-center">
                        <a href="{{ route('conferences.register.form', $conference->id) }}" class="btn-custom">
                            سجل في المؤتمر
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @endforeach
@else
<div class="conference-container" style="background-image: url('{{ asset('assets/img/22.jpg') }}');">
    <div class="overlay"></div>

    <div class="overlay" style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0, 0, 0, 0.5);"></div>

    <div class="conference-content" style="position: relative; z-index: 2; padding: 100px 0;">

        <div class="container text-right" style="max-width: 800px; margin: 0 auto;">

            <div class="text-content">

                <p style="color: #f4f4f4; text-align: center; font-size: 50px;padding: 100px; border-radius: 5px;">
                    لا يوجد مؤتمر سنوي متاح
                </p>                    
            </div>
        </div>
    </div>   
</div>



@endif







    