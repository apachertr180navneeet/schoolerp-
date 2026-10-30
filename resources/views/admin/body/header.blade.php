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
        <button class="header-icon-btn" title="Notifications" data-bs-toggle="modal" data-bs-target="#notificationModal">
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

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fs-6 fw-bold" id="notificationModalLabel"><i class="bi bi-bell-fill me-2"></i>Notifications & Alerts</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="list-group list-group-flush">
                    <a href="{{ route('student.registration.view') }}" class="list-group-item list-group-item-action p-3 d-flex gap-3 align-items-start border-bottom">
                        <div class="rounded-circle bg-primary-subtle text-primary p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-plus-fill fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-1 fw-bold fs-6">New Student Registration</h6>
                                <small class="text-muted">Today</small>
                            </div>
                            <p class="mb-0 text-muted small">Aarav Gupta enrolled into Class 10 (Morning Shift).</p>
                        </div>
                    </a>
                    <a href="{{ route('employee.leave.view') }}" class="list-group-item list-group-item-action p-3 d-flex gap-3 align-items-start border-bottom">
                        <div class="rounded-circle bg-warning-subtle text-warning p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-calendar-event-fill fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-1 fw-bold fs-6">Leave Application Pending</h6>
                                <small class="text-muted">Yesterday</small>
                            </div>
                            <p class="mb-0 text-muted small">Sunita Rao requested 1 day Medical Treatment leave.</p>
                        </div>
                    </a>
                    <a href="{{ route('student.fee.view') }}" class="list-group-item list-group-item-action p-3 d-flex gap-3 align-items-start border-bottom">
                        <div class="rounded-circle bg-success-subtle text-success p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-currency-rupee fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-1 fw-bold fs-6">Fee Payment Received</h6>
                                <small class="text-muted">2 days ago</small>
                            </div>
                            <p class="mb-0 text-muted small">Monthly fee collection processed for 12 students.</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="modal-footer bg-light py-2 justify-content-between">
                <small class="text-muted">Showing recent 3 alerts</small>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
