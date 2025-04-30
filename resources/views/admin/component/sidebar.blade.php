<!-- الشريط الجانبي -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>لوحة التحكم</h2>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>الرئيسية</span>
            </a>
        </li>

        <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fas fa-users"></i>
                <span>إدارة المستخدمين</span>
            </a>
        </li>

        <li class="{{ request()->is('admin/organizations*') ? 'active' : '' }}">
            <a href="{{ route('admin.organizations.index') }}" class="nav-link">
                <i class="fas fa-building"></i>
                <span>إدارة المؤسسات</span>
            </a>
        </li>


        <li class="{{ request()->is('admin/annual-conferences*') ? 'active' : '' }}">
            <a href="{{ route('admin.annual-conferences.index') }}" class="nav-link">
                <i class="fas fa-shopping-cart"></i>
                <span>المؤتمر السنوي</span>
            </a>
        </li>
        
        <li class="{{ request()->is('admin/statistics*') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span><a href="{{ route('admin.statistics') }}"class="nav-link">عرض المشاركين في المؤتمر السنوي</a></span>
        </li>
        
        <li class="{{ request()->is('admin/ideas*') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span><a href="{{ route('admin.ideas.index') }}"class="nav-link"> بنك الافكار</span>
        </li>

        <li class="{{ request()->is('admin/feedbacks*') ? 'active' : '' }}">
            <i class="fas fa-comments"></i>
            <span><a href="{{ route('admin.feedbacks.index') }}" class="nav-link">آراء المستخدمين</a></span>
        </li>

        <li class="{{ request()->is('admin/newsletter*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i>
            <span>
                <a href="{{ route('admin.newsletter.index') }}" class="nav-link">النشرة البريدية</a>
            </span>
        </li>


        <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            <span>الإعدادات</span>
        </li>

        <!-- زر تسجيل الخروج -->
        <li>
            <form action="{{ route('logout') }}" method="POST" class="nav-link">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</div>
