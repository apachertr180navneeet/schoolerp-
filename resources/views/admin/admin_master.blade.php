<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">
    <title>Shiksha Mitra - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @livewireStyles
</head>
<body>
<div class="wrapper">
    @include('admin.body.sidebar')
    @include('admin.body.header')
    <div class="content-wrapper">
        @yield('admin')
    </div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// Delete confirmation
$(document).on('click','#delete',function(e){
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "Delete This Data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = $(this).attr("href");
            Swal.fire('Deleted!','Your file has been deleted.','success');
        }
    });
});

// Toastr notifications
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}";
    switch(type){
        case 'info': toastr.info("{{ Session::get('message') }}"); break;
        case 'success': toastr.success("{{ Session::get('message') }}"); break;
        case 'warning': toastr.warning("{{ Session::get('message') }}"); break;
        case 'error': toastr.error("{{ Session::get('message') }}"); break;
    }
@endif

// Sidebar toggle
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.querySelector('.main-sidebar').classList.toggle('show');
    document.getElementById('sidebarOverlay').classList.toggle('show');
});
document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
    document.querySelector('.main-sidebar').classList.remove('show');
    this.classList.remove('show');
});

// Auto-init Bootstrap tooltips
document.addEventListener('DOMContentLoaded', function() {
    [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (el) {
        return new bootstrap.Tooltip(el);
    });
});
</script>

@stack('scripts')
@livewireScripts
</body>
</html>
