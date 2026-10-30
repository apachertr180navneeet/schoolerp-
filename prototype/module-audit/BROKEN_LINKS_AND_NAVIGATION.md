# School ERP Prototype — Broken Links & Navigation Audit

**Audit Date:** 2026-10-31  
**Project:** Shiksha Mitra (Single-School ERP)  
**Location:** `c:\laragon\www\gsgwebsoft\sms`  

---

## 1. Overview & Findings Summary

This document catalogues all broken links, unrouted menu destinations, dead placeholder buttons (`href="#"`), missing breadcrumbs, and UI navigation discrepancies discovered across the School ERP prototype and Laravel application views.

---

## 2. Broken Internal Links & Placeholder Elements

| # | File / View Path | UI Component | Existing Code / Route | Issue Description | Severity | Recommended Fix |
|---|---|---|---|---|---|---|
| 1 | `resources/views/admin/body/header.blade.php` (Line 16) | Top Header Notification Bell | `<button class="header-icon-btn" title="Notifications">` | Icon has no click handler or modal popover attached. Red indicator dot is static. | Medium | Connect to Bootstrap popover or dedicated Notification Center dropdown with simulated alerts. |
| 2 | `resources/views/admin/body/footer.blade.php` (Line 3) | Footer Copyright Link | `<a href="#">Shiksha Mitra</a>` | Placeholder `href="#"`. Clicking scrolls page to top. | Low | Change `href="#"` to `href="{{ route('dashboard') }}"` or remove anchor. |
| 3 | `resources/views/layouts/app.blade.php` (Line 26) | Navigation Bar Toggle | `<a class="nav-link dropdown-toggle" href="#">` | Unused Jetstream navbar fragment retains dead hash anchor. | Low | Remove redundant legacy layout or connect to profile route. |
| 4 | `resources/views/admin/body/sidebar.blade.php` (Lines 23, 34, 44, 62, 75, 88, 99, 112) | Sidebar Accordion Menu Parents | `<a href="#" onclick="toggleSubmenu(this); return false;">` | 8 Parent categories use `href="#"`. While JS handles click, accessibility screen readers report dead links. | Low | Replace `href="#"` with `href="javascript:void(0)"` or native HTML `<button>` elements with `aria-expanded`. |
| 5 | `resources/views/backend/student/student_reg/student_details_pdf.blade.php` | PDF Header & Image Links | `<img src="{{ url('upload/no_image.jpg') }}">` | If photo directory `public/upload/student_images` has no photo, fallback image must be verified to exist in public root. | Medium | Ensure fallback `public/upload/no_image.jpg` asset is always present. |
| 6 | `resources/views/backend/report/marksheet/marksheet_view.blade.php` | Term Selection Dropdown | `<select name="exam_type_id">` | In initial blank state, clicking search before choosing year or exam shows a raw error if validation isn't handled gracefully in JS. | Medium | Add client-side validation toast before sending GET request. |

---

## 3. Missing Page Destinations & Dead End Actions

| Module | Location | Action / Button | Expected Target | Actual Result | Required Action |
|---|---|---|---|---|---|
| **Student Management** | `student_view.blade.php` | "Import Students" Button | Student Excel/CSV Bulk Importer | Missing | Implement file upload modal and importer controller. |
| **Student Management** | `student_view.blade.php` | "Export Roster" Button | Excel/CSV student list download | Missing | Add CSV export route and controller method. |
| **Fee Collection** | `student_fee_view.blade.php` | "Print Fee Receipt" | PDF thermal or A4 receipt voucher | Only raw tabular display is generated; individual receipt print is missing | Add print receipt Blade template and PDF stream response. |
| **Employee Attendance** | `employee_attendance_view.blade.php` | "Monthly Attendance Summary" | Aggregated monthly attendance matrix per staff member | Only date-wise list exists; monthly calendar grid view is missing | Build monthly summary view with staff rows and date columns. |
| **User Profile** | `admin/body/header.blade.php` | "Account Settings" | Two-factor authentication, security logs, session revocation | Only basic profile & password edit forms exist | Integrate 2FA and active session view into user settings. |

---

## 4. Navigation Inconsistencies & Breadcrumb Gaps

1. **Lack of Hierarchical Breadcrumbs:**
   - Inner management views (e.g., `setups/student/class/add`, `marks/marks/entry/edit`) render a title card without breadcrumb navigation (`Home > Academics > Classes > Add`).
   - *Fix:* Introduce a shared breadcrumb component in `admin.admin_master` populated via Blade sections (`@section('breadcrumb')`).

2. **Role-Based Navigation Gaps:**
   - Currently, only two role variants are considered in `sidebar.blade.php`: `Admin` (sees `Manage User`) and all other roles.
   - Teachers, Accountants, Principals, and Students do not have customized navigation trees.
   - *Fix:* Extend sidebar navigation with role-based visibility conditions (`@if(Auth::user()->role == 'Teacher')`).

3. **Active Menu State Detection:**
   - Nested submenus use URI prefix string matching (`str_starts_with($prefix, '/students')`). When query parameters or sub-routes deviate, active highlights can collapse on page reload.
   - *Fix:* Bind active classes explicitly using `Route::is('student.*')` or `request()->is('students/*')`.

---

## 5. Mobile & Tablet Responsiveness Checks

- **Sidebar Toggle on Mobile:**
  - Sidebar collapse works via `#sidebarToggle` and `.sidebar-overlay` overlay backdrop.
  - However, data tables with 10+ columns (such as `student_view.blade.php` and `assign_subject_view.blade.php`) cause horizontal overflow on viewport widths under 768px.
  - *Fix:* Wrap all table markup in `<div class="table-responsive">` with custom horizontal scrollbars.
