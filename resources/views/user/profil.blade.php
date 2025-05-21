@include('component.header')
<link href="{{ asset('assets/css/profil.css') }}" rel="stylesheet">
<div class="profile-container">
    <!-- رأس البروفايل -->
    <div class="profile-header">
        <img src="{{ Auth::user()->profile_image ?? asset('default-profile.jpg') }}" alt="صورة البروفايل" class="profile-image">

        <div class="profile-info">
            <h1 class="profile-name">{{ Auth::user()->name }}</h1>
            <p class="profile-title">متطوع نشيط منذ {{ Auth::user()->created_at->format('Y') }}</p>
            
            <h1>{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</h1>


            <!-- إحصائيات سريعة -->
            <div style="display: flex; gap: 20px; margin-top: 20px;">
                <div>
                    <div style="font-size: 1.2rem; font-weight: 600;">{{ $volunteerHours }}</div>
                    <div style="color: #666;">ساعة تطوع</div>
                </div>
                <div>
                    <div style="font-size: 1.2rem; font-weight: 600;">{{ $completedProjects }}</div>
                    <div style="color: #666;">مشروع</div>
                </div>
                <div>
                    <div style="font-size: 1.2rem; font-weight: 600;">{{ $certificatesCount }}</div>
                    <div style="color: #666;">شهادة</div>
                </div>
            </div>
        </div>
        <button class="edit-profile" onclick="window.location.href='{{ route('profile.edit') }}'">
            <i class="fas fa-edit"></i> تعديل البروفايل
        </button>
    </div>
    
    <!-- النبذة الشخصية -->
    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-user" style="margin-left: 10px;"></i>
            نبذة عني
        </h2>
        <p class="bio-text">{{ Auth::user()->bio ?? 'نبذة غير متوفرة' }}</p>
    </div>
    

    

    <!-- النشاطات التطوعية -->
    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-hands-helping" style="margin-left: 10px;"></i>
            نشاطاتي التطوعية
        </h2>
        
        <div class="stats-container">
          <div class="stat-card">
            <div class="stat-number">{{ $volunteerHours }}</div>
            <div class="stat-label">ساعة تطوع</div>
        </div>

           <div class="stat-card">
            <div class="stat-number">{{ $completedProjects }}</div>
            <div class="stat-label">مشاريع شاركت بها</div>
        </div>
        
            <div class="stat-card">
                <div class="stat-number">{{ $completedProjects }}</div>
                <div class="stat-label">جمعيات تعاونت معها</div>
            </div>
        </div>
    </div>
    
    <!-- آخر الأنشطة -->
    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-history" style="margin-left: 10px;"></i>
            آخر الأنشطة
        </h2>
        <ul class="activity-list">
            @forelse($recentActivities as $activity)
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-hand-holding-heart"></i> 
                    </div>
                    <div class="activity-details">
                        <h3 class="activity-title">{{ $activity->opportunity->title }}</h3>
                        <p class="activity-date">
                            {{ $activity->created_at->format('Y-m-d') }} - 
                            {{ $activity->opportunity->location ?? 'لا يوجد مكان محدد' }}
                        </p>
                    </div>
                </li>
            @empty
                <li>لا توجد أنشطة مسجلة بعد.</li>
            @endforelse
        </ul>
    </div>
    
    
    <!-- شهادات التطوع -->
<div class="profile-section">
    <h2 class="section-title">
        <i class="fas fa-award" style="margin-left: 10px;"></i>
        شهادات التطوع
    </h2>

    <div class="certificates-grid">
        @forelse($certificates as $certificate)
            <div class="certificate-card">
                <img src="{{ asset('storage/' . $certificate->image_path) }}" alt="شهادة التطوع" class="certificate-image">
                <div class="certificate-info">
                    <h3 class="certificate-title">{{ $certificate->title }}</h3>
                    <p class="certificate-org">
                        {{ $certificate->organization }}<br>
                        <span class="certificate-date">
                            {{ \Carbon\Carbon::parse($certificate->issue_date)->format('Y-m-d') }}
                        </span>
                    </p>
                    <a href="{{ asset('storage/' . $certificate->image_path) }}" download class="download-btn">
                        <i class="fas fa-download"></i> تنزيل الشهادة
                    </a>
                </div>
            </div>
        @empty
            <p>لا توجد شهادات حالياً.</p>
        @endforelse
    </div>
</div>


</div>

@include('component.footer')