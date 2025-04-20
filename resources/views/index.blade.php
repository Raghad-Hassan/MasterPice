@include('component.header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 610px; overflow: hidden;">
    <div class="carousel-inner" style="height: 100%;">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('assets/img/IMG.jpg') }}" alt="First slide" style="object-fit: cover; width: 100%; height: 100%;">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('assets/img/موضوع_عن_العمل_التطوعي1.jpg') }}" alt="Second slide" style="object-fit: cover; width: 100%; height: 100%;">
        </div>
        {{-- <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('assets/img/index3.jpg') }}" alt="Third slide" style="object-fit: cover; width: 100%; height: 100%;">
        </div> --}}
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container mt-5 py-5">
    <div class="text-center mb-5"> 
        <h2 style="font-size: 50px; color: #005364; font-weight: 100px;">أهداف المنصة</h2>
    </div>

    <div class="row align-items-center">
        <div class="col-md-6 text-end">
            <div class="d-flex justify-content-end align-items-center mb-4">
                <h2 class="counter me-2" id="volunteerCounter">0</h2>
                <p class="counter-text m-0">متطوع و متطوعة</p>
            </div>
            
            <p class="paragraph-text">
                العمل التطوعي سمة المجتمعات الحيوية، لدوره في تفعيل طاقات المجتمع، 
                وإثراء الوطن بمنجزات أبنائه وسواعدهم.
            </p>
            <p class="paragraph-text">
                عبر منصة "معا" للعمل التطوعي يمكنك أن تتطوع في المكان والزمان، والمجال 
                الذي يناسب خبراتك ومهاراتك.
            </p>
            <p class="paragraph-text">كن جزءاً من المجتمع الأردني النشط</p>
            <p class="paragraph-text">انضم إلى ركب <span style="color:#02d3ac;">مليون</span> متطوع و متطوعة</p>
        </div>

        <div class="col-md-6">
            <img src="{{ asset('assets/img/jordan3.png') }}" alt="Project Image" class="img-fluid">
        </div>
        
    </div>
</div>

<div class="container-fluid mt-5 py-5" style="background-color: #f1f5f8; border-radius: 10px;">

    <div class="text-center mb-5"> 
        <h2 style="font-size: 50px; color: #005364; font-weight: 100px;">لماذا تختار منصة "معاً" </h2>
    </div>
    
    <div class="row g-4">
        <div class="col-md-3">
            <div class="info-box">
                <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h4>سهولة الاستخدام</h4>
                <p>واجهة بسيطة وسهلة للتطوع بكل سهولة وسرعة.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <div class="icon"><i class="fas fa-briefcase"></i></div>
                <h4>فرص متنوعة</h4>
                <p>مجالات متعددة تناسب جميع المهارات والخبرات.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h4>مجتمع متعاون</h4>
                <p>الانضمام إلى شبكة من المتطوعين المبدعين.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <div class="icon"><i class="fas fa-chart-line"></i></div>
                <h4>تطوير المهارات</h4>
                <p>اكتسب خبرات جديدة وطوّر مهاراتك الشخصية والمهنية.</p>
            </div>
        </div>
    </div>
</div>

@include('conferences.show')

<div class="container-fluid mt-5 py-5" style="background-color: #f1f5f8; border-radius: 10px;">

    <div class="text-center mb-5"> 
        <h2 style="font-size: 50px; color: #005364; font-weight: 100px;"> بنك الفرص التطوعية</h2>
    </div>
    <div class="content">
        <p>شارك معنا بفكرة تساهم في تفعيل العمل التطوعي وتتيح مشاركة المتطوعين من خلال فكرتك التي سوف تتبناها الجهات لتكون أنت الرائد والمرجع في تنفيذها</p>
        <a  href="{{ route('بنك') }}">
            <button class="btn-outline">شاركنا الفكرة</button>
        </a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@include('component.footer')
