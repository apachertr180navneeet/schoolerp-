<aside class="main-sidebar" id="mainSidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="32">
            <h3><b>Shiksha</b> Mitra</h3>
        </a>
    </div>

    @php
    $route = Route::current() ? Route::current()->getName() : '';
    @endphp

    <ul class="sidebar-menu">
        <li class="nav-item {{ ($route == 'dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->role == 'Admin')
        <li class="nav-item {{ Request::is('*users*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-people-fill"></i><span>User Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('user.view') }}" class="nav-link"><i class="bi bi-dot"></i>View Users</a></li>
                <li><a href="{{ route('users.add') }}" class="nav-link"><i class="bi bi-dot"></i>Add User</a></li>
            </ul>
        </li>
        @endif

        <li class="nav-item {{ (Request::is('*profile*') || Request::is('*school*')) ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-building-gear"></i><span>School & Profile</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('school.profile.view') }}" class="nav-link"><i class="bi bi-dot"></i>School Master Profile</a></li>
                <li><a href="{{ route('profile.view') }}" class="nav-link"><i class="bi bi-dot"></i>Your Profile</a></li>
                <li><a href="{{ route('password.view') }}" class="nav-link"><i class="bi bi-dot"></i>Change Password</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*admission*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-person-plus-fill"></i><span>Admissions & CRM</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('admission.enquiry.view') }}" class="nav-link"><i class="bi bi-dot"></i>Enquiry Pipeline</a></li>
                <li><a href="{{ route('admission.enquiry.add') }}" class="nav-link"><i class="bi bi-dot"></i>Log New Enquiry</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*setup*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-sliders2"></i><span>Academic Master</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('student.class.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Class</a></li>
                <li><a href="{{ route('student.section.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Section</a></li>
                <li><a href="{{ route('student.year.view') }}" class="nav-link"><i class="bi bi-dot"></i>Academic Year</a></li>
                <li><a href="{{ route('student.group.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Group / Stream</a></li>
                <li><a href="{{ route('student.shift.view') }}" class="nav-link"><i class="bi bi-dot"></i>School Shift</a></li>
                <li><a href="{{ route('fee.category.view') }}" class="nav-link"><i class="bi bi-dot"></i>Fee Category</a></li>
                <li><a href="{{ route('fee.amount.view') }}" class="nav-link"><i class="bi bi-dot"></i>Fee Structure Amount</a></li>
                <li><a href="{{ route('exam.type.view') }}" class="nav-link"><i class="bi bi-dot"></i>Exam Type / Terms</a></li>
                <li><a href="{{ route('school.subject.view') }}" class="nav-link"><i class="bi bi-dot"></i>Subjects Master</a></li>
                <li><a href="{{ route('assign.subject.view') }}" class="nav-link"><i class="bi bi-dot"></i>Class Subject Assignment</a></li>
                <li><a href="{{ route('designation.view') }}" class="nav-link"><i class="bi bi-dot"></i>Staff Designations</a></li>
            </ul>
        </li>

        <li class="nav-item {{ (Request::is('*student*') || Request::is('*certificate*')) && !Request::is('*timetable*') && !Request::is('*attendance*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-mortarboard-fill"></i><span>Student Lifecycle</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('student.registration.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Directory</a></li>
                <li><a href="{{ route('student.attendance.view') }}" class="nav-link"><i class="bi bi-dot"></i>Daily Attendance</a></li>
                <li><a href="{{ route('certificate.tc.view') }}" class="nav-link"><i class="bi bi-dot"></i>Transfer Certificate (TC)</a></li>
                <li><a href="{{ route('certificate.bonafide.view') }}" class="nav-link"><i class="bi bi-dot"></i>Bonafide Certificate</a></li>
                <li><a href="{{ route('roll.generate.view') }}" class="nav-link"><i class="bi bi-dot"></i>Roll Number Generate</a></li>
                <li><a href="{{ route('registration.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Registration Fee</a></li>
                <li><a href="{{ route('monthly.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Monthly Tuition Fee</a></li>
                <li><a href="{{ route('exam.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Examination Fee</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*academic*') || Request::is('*timetable*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-calendar3"></i><span>Timetable & Schedule</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('academic.timetable.view') }}" class="nav-link"><i class="bi bi-dot"></i>Class Timetable</a></li>
                <li><a href="{{ route('academic.timetable.add') }}" class="nav-link"><i class="bi bi-dot"></i>Add Period Slot</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*employee*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-person-workspace"></i><span>HR & Staff</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('employee.registration.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Directory</a></li>
                <li><a href="{{ route('employee.salary.view') }}" class="nav-link"><i class="bi bi-dot"></i>Staff Salary Setup</a></li>
                <li><a href="{{ route('employee.leave.view') }}" class="nav-link"><i class="bi bi-dot"></i>Staff Leave Requests</a></li>
                <li><a href="{{ route('employee.attendance.view') }}" class="nav-link"><i class="bi bi-dot"></i>Staff Attendance</a></li>
                <li><a href="{{ route('employee.monthly.salary') }}" class="nav-link"><i class="bi bi-dot"></i>Monthly Payroll</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*mark*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-award-fill"></i><span>Exams & Marks</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('marks.entry.add') }}" class="nav-link"><i class="bi bi-dot"></i>Marks Entry</a></li>
                <li><a href="{{ route('marks.entry.edit') }}" class="nav-link"><i class="bi bi-dot"></i>Marks Edit</a></li>
                <li><a href="{{ route('marks.entry.grade') }}" class="nav-link"><i class="bi bi-dot"></i>Grading System (CBSE)</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*account*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-wallet-fill"></i><span>Fee & Accounts</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('student.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Fee Collection</a></li>
                <li><a href="{{ route('account.salary.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Salary Payouts</a></li>
                <li><a href="{{ route('other.cost.view') }}" class="nav-link"><i class="bi bi-dot"></i>Campus Expenses & Costs</a></li>
            </ul>
        </li>

        <li class="nav-section">Operations & Logistics</li>

        <li class="nav-item {{ Request::is('*library*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-book-half"></i><span>Library</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('library.book.view') }}" class="nav-link"><i class="bi bi-dot"></i>Book Catalog & Stock</a></li>
                <li><a href="{{ route('library.issue.view') }}" class="nav-link"><i class="bi bi-dot"></i>Circulation Counter</a></li>
            </ul>
        </li>

        <li class="nav-item {{ Request::is('*transport*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-bus-front-fill"></i><span>Transport Fleet</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('transport.vehicle.view') }}" class="nav-link"><i class="bi bi-dot"></i>Vehicles & Buses</a></li>
                <li><a href="{{ route('transport.route.view') }}" class="nav-link"><i class="bi bi-dot"></i>Routes & Stoppages</a></li>
                <li><a href="{{ route('transport.student.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Allocations</a></li>
            </ul>
        </li>

        <li class="nav-section">Reports & Analytics</li>

        <li class="nav-item {{ Request::is('*report*') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Reports & MIS</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('monthly.profit.view') }}" class="nav-link"><i class="bi bi-dot"></i>Financial Profit & Loss</a></li>
                <li><a href="{{ route('marksheet.generate.view') }}" class="nav-link"><i class="bi bi-dot"></i>CBSE Marksheet Generate</a></li>
                <li><a href="{{ route('attendance.report.view') }}" class="nav-link"><i class="bi bi-dot"></i>Attendance Analytics</a></li>
                <li><a href="{{ route('student.result.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Result Records</a></li>
                <li><a href="{{ route('student.idcard.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student ID Card Generator</a></li>
            </ul>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="{{ route('profile.view') }}" data-bs-toggle="tooltip" title="My Profile"><i class="bi bi-person-circle"></i></a>
        <a href="{{ route('school.profile.view') }}" data-bs-toggle="tooltip" title="School Configuration"><i class="bi bi-gear-fill"></i></a>
        <a href="{{ route('admin.logout') }}" data-bs-toggle="tooltip" title="Sign Out"><i class="bi bi-box-arrow-right"></i></a>
    </div>
</aside>

<script>
function toggleSubmenu(el) {
    var item = el.closest('.nav-item');
    item.classList.toggle('active');
    var submenu = item.querySelector('.nav-submenu');
    if (submenu) {
        submenu.style.maxHeight = submenu.style.maxHeight ? null : submenu.scrollHeight + 'px';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.nav-item.active').forEach(function (item) {
        var sub = item.querySelector('.nav-submenu');
        if (sub) sub.style.maxHeight = sub.scrollHeight + 'px';
    });
});
</script>
