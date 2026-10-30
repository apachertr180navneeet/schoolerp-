<aside class="main-sidebar" id="mainSidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="35">
            <h3><b>Shiksha</b> Mitra</h3>
        </a>
    </div>

    @php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    @endphp

    <ul class="sidebar-menu">
        <li class="nav-item {{ ($route == 'dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="bi bi-speedometer2"></i><span>Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->role == 'Admin')
        <li class="nav-item {{ str_starts_with($prefix, '/users') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-people"></i><span>Manage User</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('user.view') }}" class="nav-link"><i class="bi bi-dot"></i>View User</a></li>
                <li><a href="{{ route('users.add') }}" class="nav-link"><i class="bi bi-dot"></i>Add User</a></li>
            </ul>
        </li>
        @endif

        <li class="nav-item {{ str_starts_with($prefix, '/profile') || str_starts_with($prefix, '/school') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-person-badge"></i><span>School & Profile</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('school.profile.view') }}" class="nav-link"><i class="bi bi-dot"></i>School Master Profile</a></li>
                <li><a href="{{ route('profile.view') }}" class="nav-link"><i class="bi bi-dot"></i>Your Profile</a></li>
                <li><a href="{{ route('password.view') }}" class="nav-link"><i class="bi bi-dot"></i>Change Password</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/admissions') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-person-plus"></i><span>Admissions & CRM</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('admission.enquiry.view') }}" class="nav-link"><i class="bi bi-dot"></i>Enquiry Pipeline</a></li>
                <li><a href="{{ route('admission.enquiry.add') }}" class="nav-link"><i class="bi bi-dot"></i>Log New Enquiry</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/setups') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-gear"></i><span>Setup Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('student.class.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Class</a></li>
                <li><a href="{{ route('student.section.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Section</a></li>
                <li><a href="{{ route('student.year.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Year</a></li>
                <li><a href="{{ route('student.group.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Group</a></li>
                <li><a href="{{ route('student.shift.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Shift</a></li>
                <li><a href="{{ route('fee.category.view') }}" class="nav-link"><i class="bi bi-dot"></i>Fee Category</a></li>
                <li><a href="{{ route('fee.amount.view') }}" class="nav-link"><i class="bi bi-dot"></i>Fee Category Amount</a></li>
                <li><a href="{{ route('exam.type.view') }}" class="nav-link"><i class="bi bi-dot"></i>Exam Type</a></li>
                <li><a href="{{ route('school.subject.view') }}" class="nav-link"><i class="bi bi-dot"></i>School Subject</a></li>
                <li><a href="{{ route('assign.subject.view') }}" class="nav-link"><i class="bi bi-dot"></i>Assign Subject</a></li>
                <li><a href="{{ route('designation.view') }}" class="nav-link"><i class="bi bi-dot"></i>Designation</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/students') || str_starts_with($prefix, '/certificates') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-mortarboard"></i><span>Student Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('student.registration.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Registration</a></li>
                <li><a href="{{ route('student.attendance.view') }}" class="nav-link"><i class="bi bi-dot"></i>Daily Attendance</a></li>
                <li><a href="{{ route('certificate.tc.view') }}" class="nav-link"><i class="bi bi-dot"></i>Transfer Certificate (TC)</a></li>
                <li><a href="{{ route('certificate.bonafide.view') }}" class="nav-link"><i class="bi bi-dot"></i>Bonafide Certificate</a></li>
                <li><a href="{{ route('roll.generate.view') }}" class="nav-link"><i class="bi bi-dot"></i>Roll Generate</a></li>
                <li><a href="{{ route('registration.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Registration Fee</a></li>
                <li><a href="{{ route('monthly.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Monthly Fee</a></li>
                <li><a href="{{ route('exam.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Exam Fee</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/academic') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-calendar3"></i><span>Academics & Timetable</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('academic.timetable.view') }}" class="nav-link"><i class="bi bi-dot"></i>Class Timetable</a></li>
                <li><a href="{{ route('academic.timetable.add') }}" class="nav-link"><i class="bi bi-dot"></i>Add Period Slot</a></li>
            </ul>
        </li>

        <li class="nav-section">Operations</li>

        <li class="nav-item {{ str_starts_with($prefix, '/library') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-book"></i><span>Library Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('library.book.view') }}" class="nav-link"><i class="bi bi-dot"></i>Book Catalog</a></li>
                <li><a href="{{ route('library.issue.view') }}" class="nav-link"><i class="bi bi-dot"></i>Circulation Counter</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/transport') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-bus-front"></i><span>Transport Fleet</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('transport.vehicle.view') }}" class="nav-link"><i class="bi bi-dot"></i>Vehicles & Fleet</a></li>
                <li><a href="{{ route('transport.route.view') }}" class="nav-link"><i class="bi bi-dot"></i>Bus Routes</a></li>
                <li><a href="{{ route('transport.student.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Allocations</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/employees') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-people"></i><span>Employee Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('employee.registration.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Registration</a></li>
                <li><a href="{{ route('employee.salary.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Salary</a></li>
                <li><a href="{{ route('employee.leave.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Leave</a></li>
                <li><a href="{{ route('employee.attendance.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Attendance</a></li>
                <li><a href="{{ route('employee.monthly.salary') }}" class="nav-link"><i class="bi bi-dot"></i>Monthly Salary</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/marks') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-pencil-square"></i><span>Marks Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('marks.entry.add') }}" class="nav-link"><i class="bi bi-dot"></i>Marks Entry</a></li>
                <li><a href="{{ route('marks.entry.edit') }}" class="nav-link"><i class="bi bi-dot"></i>Marks Edit</a></li>
                <li><a href="{{ route('marks.entry.grade') }}" class="nav-link"><i class="bi bi-dot"></i>Marks Grade</a></li>
            </ul>
        </li>

        <li class="nav-item {{ str_starts_with($prefix, '/accounts') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-wallet2"></i><span>Accounts Management</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('student.fee.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Fee</a></li>
                <li><a href="{{ route('account.salary.view') }}" class="nav-link"><i class="bi bi-dot"></i>Employee Salary</a></li>
                <li><a href="{{ route('other.cost.view') }}" class="nav-link"><i class="bi bi-dot"></i>Other Cost</a></li>
            </ul>
        </li>

        <li class="nav-section">Reports</li>

        <li class="nav-item {{ str_starts_with($prefix, '/reports') ? 'active' : '' }}">
            <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-file-earmark-bar-graph"></i><span>Reports</span><i class="bi bi-chevron-down"></i>
            </a>
            <ul class="nav-submenu">
                <li><a href="{{ route('monthly.profit.view') }}" class="nav-link"><i class="bi bi-dot"></i>Monthly-Yearly Profit</a></li>
                <li><a href="{{ route('marksheet.generate.view') }}" class="nav-link"><i class="bi bi-dot"></i>MarkSheet Generate</a></li>
                <li><a href="{{ route('attendance.report.view') }}" class="nav-link"><i class="bi bi-dot"></i>Attendance Report</a></li>
                <li><a href="{{ route('student.result.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student Result</a></li>
                <li><a href="{{ route('student.idcard.view') }}" class="nav-link"><i class="bi bi-dot"></i>Student ID Card</a></li>
            </ul>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="{{ route('profile.view') }}" data-bs-toggle="tooltip" title="Profile"><i class="bi bi-person"></i></a>
        <a href="{{ route('password.view') }}" data-bs-toggle="tooltip" title="Settings"><i class="bi bi-gear"></i></a>
        <a href="{{ route('admin.logout') }}" data-bs-toggle="tooltip" title="Logout"><i class="bi bi-box-arrow-right"></i></a>
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
