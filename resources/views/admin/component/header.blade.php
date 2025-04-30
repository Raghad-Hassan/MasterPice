<!-- الشريط العلوي -->
<div class="navbar">
    <div class="navbar-left">
        <div class="toggle-btn">
            <i class="fas fa-bars"></i>
        </div>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="بحث...">
        </div>
    </div>
    <div class="navbar-right">
        <div class="notifications">
            <i class="fas fa-bell"></i>
            <span class="badge">3</span>
        </div>
        <a href="{{ route('admin.profile.show') }}" class="user-profile d-flex align-items-center text-decoration-none text-dark">
            @if(Auth::user() && Auth::user()->profile_image)
    <img src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}"
         alt="صورة المستخدم"
         style="width: 40px; height: 40px; border-radius: 50%;">
@else
    <img src="https://via.placeholder.com/150"
         alt="صورة المستخدم"
         style="width: 40px; height: 40px; border-radius: 50%;">
@endif

            <span class="ms-2">مدير النظام</span>
        </a>
        
    </div>
</div>