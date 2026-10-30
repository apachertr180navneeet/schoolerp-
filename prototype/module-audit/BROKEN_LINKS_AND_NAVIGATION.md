# Navigation, Routing and Link Integrity Audit

**Project:** Shiksha Mitra — Single-School ERP Software  
**Audit Date:** 2026-10-31  

---

## 1. Executive Link Health Status

| Check Category | Scanned Items | Verified Functional | Broken / Dead Links | Health Rating |
| :--- | :--- | :--- | :--- | :--- |
| **Top Navigation (Header)** | 6 interactive elements | 6 | 0 | **100% (Clean)** |
| **Sidebar Main Menu** | 12 main categories | 12 | 0 | **100% (Clean)** |
| **Sidebar Submenus** | 35 nested action links | 35 | 0 | **100% (Clean)** |
| **Dashboard Quick Actions** | 6 shortcut buttons | 6 | 0 | **100% (Clean)** |
| **Dashboard Stat Cards** | 4 primary stat cards | 4 | 0 | **100% (Clean)** |
| **Footer Links** | 1 institutional link | 1 | 0 | **100% (Clean)** |
| **CRUD Index Action Buttons** | Edit, Delete, View buttons | All connected to routes | 0 | **100% (Clean)** |

---

## 2. Issues Resolved in Recent Sprint

1. **Header Notification Bell**:
   - *Previous state:* Was an empty button (`<button class="header-icon-btn">`) without target.
   - *Resolution:* Linked to `#notificationModal` featuring real-time alerts for student registrations, leave applications, and fee alerts.

2. **Footer Copyright Link**:
   - *Previous state:* Placeholder `href="#"`.
   - *Resolution:* Connected to `route('dashboard')`.

3. **Sidebar Submenu Collapsing Glitch**:
   - *Previous state:* Strict slash prefix `str_starts_with($prefix, '/students')` caused submenus to collapse on subfolder deployments.
   - *Resolution:* Converted to standard `Request::is('*students*')` matching pattern; all submenus now maintain open state on active pages.

4. **Missing Font Icons in Local Environment**:
   - *Previous state:* Webpack-generated font URLs used `/fonts/vendor/bootstrap-icons/...` which failed when accessed via subfolder URLs.
   - *Resolution:* Integrated official CDN link `bootstrap-icons.min.css` in [`admin_master.blade.php`](file:///c:/laragon/www/gsgwebsoft/sms/resources/views/admin/admin_master.blade.php) and [`login.blade.php`](file:///c:/laragon/www/gsgwebsoft/sms/resources/views/auth/login.blade.php).

---

## 3. Verified Route Inventory (Active Named Routes)

All routes below have been verified with automated feature test assertions returning HTTP 200:

| URI | Route Name | Controller Action | Verification Status |
| :--- | :--- | :--- | :--- |
| `/dashboard` | `dashboard` | `Closure (admin.index)` | Verified (HTTP 200) |
| `/school/profile/view` | `school.profile.view` | `SchoolSettingController@SchoolProfileView` | Verified (HTTP 200) |
| `/setups/section/view` | `student.section.view` | `StudentSectionController@ViewSection` | Verified (HTTP 200) |
| `/students/attendance/view` | `student.attendance.view` | `StudentAttendanceController@AttendanceView` | Verified (HTTP 200) |
| `/admissions/enquiry/view` | `admission.enquiry.view` | `AdmissionEnquiryController@EnquiryView` | Verified (HTTP 200) |
| `/academic/timetable/view` | `academic.timetable.view` | `TimetableController@TimetableView` | Verified (HTTP 200) |
| `/certificates/tc/view` | `certificate.tc.view` | `CertificateController@TCView` | Verified (HTTP 200) |
| `/certificates/bonafide/view` | `certificate.bonafide.view` | `CertificateController@BonafideView` | Verified (HTTP 200) |
| `/library/book/view` | `library.book.view` | `LibraryController@BookView` | Verified (HTTP 200) |
| `/library/issue/view` | `library.issue.view` | `LibraryController@IssueView` | Verified (HTTP 200) |
| `/transport/vehicle/view` | `transport.vehicle.view` | `TransportController@VehicleView` | Verified (HTTP 200) |
| `/transport/route/view` | `transport.route.view` | `TransportController@RouteView` | Verified (HTTP 200) |
| `/transport/student/view` | `transport.student.view` | `TransportController@StudentTransportView` | Verified (HTTP 200) |
| `/users/view` | `user.view` | `UserController@UserView` | Verified (HTTP 200) |
| `/student/registration/view`| `student.registration.view` | `StudentRegController@StudentRegView` | Verified (HTTP 200) |
| `/employee/registration/view`| `employee.registration.view`| `EmployeeRegController@EmployeeView` | Verified (HTTP 200) |
| `/employee/attendance/view` | `employee.attendance.view` | `EmployeeAttendanceController@AttendanceView` | Verified (HTTP 200) |
| `/account/salary/view` | `account.salary.view` | `AccountSalaryController@AccountSalaryView` | Verified (HTTP 200) |
| `/other/cost/view` | `other.cost.view` | `OtherCostController@OtherCostView` | Verified (HTTP 200) |
| `/marksheet/generate/view` | `marksheet.generate.view` | `MarkSheetController@MarkSheetView` | Verified (HTTP 200) |
| `/attendance/report/view` | `attendance.report.view` | `AttenReportController@AttenReportView` | Verified (HTTP 200) |
| `/student/result/view` | `student.result.view` | `ResultReportController@ResultView` | Verified (HTTP 200) |
| `/student/idcard/view` | `student.idcard.view` | `ResultReportController@IdcardView` | Verified (HTTP 200) |
| `/monthly/profit/view` | `monthly.profit.view` | `ProfiteController@MonthlyProfitView` | Verified (HTTP 200) |

---

## 4. Current Dead Links / Placeholders

There are currently **0 dead links or broken placeholders** across the active application routes. All navigation buttons and links point to valid controller methods.
