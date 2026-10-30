<header class="main-header">
    <div class="header-left">
        <button class="sidebar-toggle d-lg-none" id="sidebarToggle" type="button" title="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>
        <button class="sidebar-toggle d-none d-lg-flex" id="sidebarToggleDesktop" type="button" title="Toggle Sidebar" onclick="document.querySelector('.main-sidebar').classList.toggle('collapsed');">
            <i class="bi bi-chevron-left"></i>
        </button>
        <div class="header-brand d-none d-md-flex">
            <div class="brand-dot"></div>
            <span class="brand-text">Shiksha Mitra</span>
            <span class="brand-badge">Admin</span>
        </div>
    </div>
    <div class="header-right">
        <button class="header-icon-btn" title="Notifications">
            <i class="bi bi-bell"></i>
            <span class="notification-dot"></span>
        </button>
        <button class="header-icon-btn d-none d-sm-flex" title="Fullscreen" onclick="toggleFullscreen()">
            <i class="bi bi-arrows-fullscreen"></i>
        </button>
        <div class="dropdown">
            <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar-wrap">
                    <img src="{{ (!empty(Auth::user()->image)) ? url('upload/user_images/'.Auth::user()->image) : url('upload/no_image.jpg') }}" alt="">
                    <span class="user-status"></span>
                </div>
                <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                <i class="bi bi-chevron-down d-none d-md-inline"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 0.65rem; min-width: 220px; overflow: hidden;">
                <li>
                    <div class="d-flex align-items-center gap-3 px-3 py-3 bg-light">
                        <img src="{{ (!empty(Auth::user()->image)) ? url('upload/user_images/'.Auth::user()->image) : url('upload/no_image.jpg') }}" alt="" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-semibold" style="font-size:0.9rem;">{{ Auth::user()->name }}</h6>
                            <small class="text-muted" style="font-size:0.75rem;">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider my-0"></li>
                <li><a class="dropdown-item py-2" href="{{ route('profile.view') }}"><i class="bi bi-person me-2"></i>My Profile</a></li>
                <li><a class="dropdown-item py-2" href="{{ route('password.view') }}"><i class="bi bi-key me-2"></i>Change Password</a></li>
                <li><hr class="dropdown-divider my-0"></li>
                <li><a class="dropdown-item py-2 text-danger" href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</header>

<script>
function toggleFullscreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
}
</script>
