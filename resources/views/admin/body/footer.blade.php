<footer class="main-footer mt-5 pt-4 border-top">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 text-muted small">
        <div>
            <span>&copy; {{ date('Y') }} <a href="{{ route('dashboard') }}" class="text-decoration-none fw-bold text-dark">Shiksha Mitra</a> Public School ERP. All rights reserved.</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span><i class="bi bi-shield-check text-success me-1"></i>Secure Enterprise Edition</span>
            <span>Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
        </div>
    </div>
</footer>
