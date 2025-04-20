@include('component.header')
<link rel="stylesheet" href="{{ asset('assets/css/عرض الفرص.css') }}">

<div class="volunteer-browser container mt-5 pt-5">
    <h2 class="section-title container mt-4 pt-4">تصفح فرص التطوع</h2>
    <div class="categories container mt-4 pt-4">
        <div class="category active"><i class="fas fa-th-large"></i><p>الكل</p></div>
        <div class="category"><i class="fas fa-lightbulb"></i><p>ريادة</p></div>
        <div class="category"><i class="fas fa-seedling"></i><p>بيئية</p></div>
        <div class="category"><i class="fas fa-heartbeat"></i><p>صحة</p></div>
        <div class="category"><i class="fas fa-palette"></i><p>فنون</p></div>
        <div class="category"><i class="fas fa-book"></i><p>تعليم</p></div>
        <div class="category"><i class="fas fa-futbol"></i><p>رياضة</p></div>
    </div>

    <div class="filters container mt-4">
        <div class="row g-3 d-flex justify-content-center">
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">الجهة المنظمة</option>
                    <option value="ngo">جمعيات</option>
                    <option value="company">شركات</option>
                    <option value="team">فرق تطوعية</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">المحافظة</option>
                    <option value="amman">عمان</option>
                    <option value="zarqa">الزرقاء</option>
                    <option value="irbid">إربد</option>
                    <option value="ajloun">عجلون</option>
                    <option value="mafraq">المفرق</option>
                    <option value="kareem">الكرك</option>
                    <option value="madaba">مادبا</option>
                    <option value="tafilah">الطفيلة</option>
                    <option value="ma'an">معان</option>
                    <option value="batn">البتراء</option>
                    <option value="jerash">جرش</option>
                    <option value="aqaba">العقبة</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">عدد الساعات المطلوبة</option>
                    <option value="1">أقل من 5 ساعات</option>
                    <option value="2">5 - 10 ساعات</option>
                    <option value="3">أكثر من 10 ساعات</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">الجنس</option>
                    <option value="all">للجميع</option>
                    <option value="male">للذكور فقط</option>
                    <option value="female">للإناث فقط</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">حالة التسجيل</option>
                    <option value="available">متاح</option>
                    <option value="full">ممتلئ</option>
                </select>
            </div>
        </div>
    </div>
    
    
</div>

<div class="opportunity-filters container mt-4">
    <div class="filter-options">
        <span class="filter-option active">الفرص الجديدة</span>
        <span class="filter-option">ينتهي قريبًا</span>
        <span class="filter-option">الفرص السابقة</span>
        <span class="filter-option">جميع الفرص</span>
    </div>
    <div class="filter-line"></div>
</div>


<div class="container mt-4">
    <div class="row">
        <!-- بطاقة فرصة -->
        <div class="col-md-4">
            <a href="{{ route('opportunit-details') }}" class="card-link" style="text-decoration: none; color: inherit;">
                <div class="opportunity-card">
                    <img src="https://via.placeholder.com/300" alt="صورة الفرصة" class="opportunity-img">
                    <div class="opportunity-details">
                        <h5 class="opportunity-title">فرصة تطوعية في التعليم</h5>
                        <p class="opportunity-description">تعال وساهم في تعليم الأطفال المحتاجين في منطقتك.</p>
                        <p class="opportunity-info"><i class="fas fa-calendar-alt"></i> 10 أبريل 2025</p>
                        <p class="opportunity-info"><i class="fas fa-map-marker-alt"></i> عمان، الأردن</p>
        
                        <div class="participants-container">
                            <p class="participants-text">
                                المشاركين: <span class="current-participants" id="currentParticipants">1</span> من <span class="total-participants">15</span>
                            </p>
                            <div class="progress-bar">
                                <div class="progress" id="progressBar" style="width: 7%;"></div>
                            </div>
                        </div>
        
                        <button class="register-btn" onclick="registerParticipant(event)">سجل الآن</button>
                    </div>
                </div>
            </a>
        </div>
        
        

        <!-- بطاقة فرصة ثانية -->
        <div class="col-md-4">
            <a href="{{ route('opportunit-details') }}" style="text-decoration: none; color: inherit;">
                <div class="opportunity-card">
                    <img src="https://via.placeholder.com/300" alt="صورة الفرصة" class="opportunity-img">
                    <div class="opportunity-details">
                        <h5 class="opportunity-title">حملة تنظيف الشواطئ</h5>
                        <p class="opportunity-description">انضم إلينا في تنظيف شواطئ العقبة وحماية البيئة.</p>
                        <p class="opportunity-info"><i class="fas fa-calendar-alt"></i> 15 مايو 2025</p>
                        <p class="opportunity-info"><i class="fas fa-map-marker-alt"></i> العقبة، الأردن</p>
        
                        <!-- عدد المشاركين وشريط التقدم -->
                        <div class="participants-container">
                            <p class="participants-text">المشاركين: <span class="current-participants">3</span> من <span class="total-participants">20</span></p>
                            <div class="progress-bar">
                                <div class="progress" style="width: 15%;"></div>
                            </div>
                        </div>
        
                        <button class="register-btn" onclick="registerParticipant(event)">سجل الآن</button>

                    </div>
                </div>
            </a>
        </div>
        
    </div>
</div>


@include('component.footer')