<!-- الشريط العلوي المبسط -->
<div class="navbar">
    <div class="navbar-left">
        <button class="toggle-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.profile.show') }}" class="profile-link">
            @if(Auth::user() && Auth::user()->profile_image)
                <img src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" 
                     alt="صورة المستخدم" class="profile-image">
            @else
                <img src="https://via.placeholder.com/150" 
                     alt="صورة المستخدم" class="profile-image">
            @endif
            <span class="profile-name">مدير النظام</span>
        </a>
    </div>
</div>