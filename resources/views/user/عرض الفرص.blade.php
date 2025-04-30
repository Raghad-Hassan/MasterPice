@include('component.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('assets/css/عرض الفرص.css') }}">
<div id="content">
<div class="volunteer-browser container mt-5 pt-5">
    <h2 class="section-title container mt-4 pt-4">تصفح فرص التطوع</h2>
    
    <!-- الفئات -->
    <div class="categories container mt-4 pt-4">
        <div class="category active" data-category="all"><i class="fas fa-th-large"></i><p>الكل</p></div>
        <div class="category" data-category="entrepreneurship"><i class="fas fa-lightbulb"></i><p>ريادة</p></div>
        <div class="category" data-category="environment"><i class="fas fa-seedling"></i><p>بيئية</p></div>
        <div class="category" data-category="health"><i class="fas fa-heartbeat"></i><p>صحة</p></div>
        <div class="category" data-category="arts"><i class="fas fa-palette"></i><p>فنون</p></div>
        <div class="category" data-category="education"><i class="fas fa-book"></i><p>تعليم</p></div>
        <div class="category" data-category="sports"><i class="fas fa-futbol"></i><p>رياضة</p></div>
    </div>

    <!-- الفلاتر -->
    <div class="filters container mt-4">
        <div class="row g-3 d-flex justify-content-center">
            <div class="col-md-2">
                <select class="form-select" id="organization">
                    <option value="">الجهة المنظمة</option>
                    <option value="ngo">جمعيات</option>
                    <option value="company">شركات</option>
                    <option value="team">فرق تطوعية</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select" id="location">
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
                <select class="form-select" id="hours">
                    <option value="">عدد الساعات المطلوبة</option>
                    <option value="1">أقل من 5 ساعات</option>
                    <option value="5-10">5 - 10 ساعات</option>
                    <option value="10">أكثر من 10 ساعات</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select" id="gender">
                    <option value="">الجنس</option>
                    <option value="all">للجميع</option>
                    <option value="male">للذكور فقط</option>
                    <option value="female">للإناث فقط</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <select class="form-select" id="registration_status">
                    <option value="">حالة التسجيل</option>
                    <option value="available">متاح</option>
                    <option value="full">ممتلئ</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <button class="btn btn-primary w-100" id="filter-button">تصفية</button>
            </div>
        </div>
    </div>

    <!-- فلترة الفرص -->
    <div class="opportunity-filters container mt-4">
        <div class="filter-options">
            <span class="filter-option active" data-type="new">الفرص الجديدة</span>
            <span class="filter-option" data-type="ending_soon">ينتهي قريبًا</span>
            <span class="filter-option" data-type="past">الفرص السابقة</span>
            <span class="filter-option" data-type="all">جميع الفرص</span>
        </div>
        <div class="filter-line"></div>
    </div>

    <!-- قائمة الفرص -->
    <div id="opportunity-list" class="container mt-4">
        @include('user.opportunities_list', ['opportunities' => $opportunities])
    </div>
</div>
</div>
@include('component.footer')

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Category filter
    const categories = document.querySelectorAll('.category');
    categories.forEach(category => {
        category.addEventListener('click', function() {
            categories.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            applyFilters();
        });
    });

    // Opportunity type filter (new, ending soon, past, all)
    const filterOptions = document.querySelectorAll('.filter-option');
    filterOptions.forEach(option => {
        option.addEventListener('click', function() {
            filterOptions.forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            applyFilters();
        });
    });

    // Filter button click
    const filterButton = document.getElementById('filter-button');
    if (filterButton) {
        filterButton.addEventListener('click', applyFilters);
    }

    function applyFilters() {
        const activeCategory = document.querySelector('.category.active').dataset.category;
        const activeFilter = document.querySelector('.filter-option.active').dataset.type;
        const organization = document.getElementById('organization').value;
        const location = document.getElementById('location').value;
        const hours = document.getElementById('hours').value;
        const gender = document.getElementById('gender').value;
        const registrationStatus = document.getElementById('registration_status').value;

        // Get all opportunity cards
        const cards = document.querySelectorAll('.opportunity-card');
        const now = new Date();
        
        cards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardEndDate = new Date(card.dataset.endDate);
            const cardStatus = card.dataset.status;
            const cardGender = card.dataset.gender;
            const cardOrganization = card.dataset.organization;
            const cardLocation = card.dataset.location;
            const cardHours = parseInt(card.dataset.hours);
            
            // Calculate days remaining
            const timeDiff = cardEndDate - now;
            const daysRemaining = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            // Default to show
            let shouldShow = true;

            // Apply category filter
            if (activeCategory !== 'all' && cardCategory !== activeCategory) {
                shouldShow = false;
            }

            // Apply opportunity type filter
            switch (activeFilter) {
                case 'new':
                    if (daysRemaining > 7) shouldShow = shouldShow && true;
                    else shouldShow = false;
                    break;
                case 'ending_soon':
                    if (daysRemaining <= 3 && daysRemaining >= 0) shouldShow = shouldShow && true;
                    else shouldShow = false;
                    break;
                case 'past':
                    if (daysRemaining < 0) shouldShow = shouldShow && true;
                    else shouldShow = false;
                    break;
                case 'all':
                default:
                    // Show all
                    break;
            }

            // Apply organization filter
            if (organization && cardOrganization !== organization) {
                shouldShow = false;
            }

            // Apply location filter
            if (location && cardLocation !== location) {
                shouldShow = false;
            }

            // Apply hours filter
            if (hours) {
                if (hours === '1' && cardHours >= 5) shouldShow = false;
                else if (hours === '5-10' && (cardHours < 5 || cardHours > 10)) shouldShow = false;
                else if (hours === '10' && cardHours <= 10) shouldShow = false;
            }

            // Apply gender filter
            if (gender && cardGender !== gender && cardGender !== 'all') {
                shouldShow = false;
            }

            // Apply registration status filter
            if (registrationStatus) {
                if (registrationStatus === 'available' && cardStatus !== 'available') shouldShow = false;
                else if (registrationStatus === 'full' && cardStatus !== 'full') shouldShow = false;
            }

            // Show/hide card based on filters
            card.style.display = shouldShow ? 'block' : 'none';
        });
    }

    // Register function
    window.register = function(oppId, userId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(`/opportunity/${oppId}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('تم التسجيل بنجاح!');
                // Refresh the list or update UI
                applyFilters();
            } else {
                alert(data.message || 'حدث خطأ أثناء التسجيل');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء التسجيل');
        });
    };
});


</script>