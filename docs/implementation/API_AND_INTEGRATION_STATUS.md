# Shiksha Mitra School ERP — API & Integration Status

**Generated:** 2026-10-31  
**Project:** Shiksha Mitra School ERP  

---

## 1. Document & PDF Generation Integrations

All formal documents are rendered to PDF using `barryvdh/laravel-dompdf` (DomPDF 3.x), strictly adhering to CBSE institutional publication standards.

| Document / Certificate | Endpoint Route | Output Format | Security & Watermarking |
| :--- | :--- | :--- | :--- |
| **Transfer Certificate (TC)** | `GET /certificates/tc/pdf/{student_id}` | PDF Stream | CBSE Affiliation watermark, principal signature line, serial tracking number |
| **Bonafide Certificate** | `GET /certificates/bonafide/pdf/{student_id}` | PDF Stream | Verification statement, academic year seal, passport size photo placeholder |
| **Admit Card / Hall Ticket** | `GET /exam/schedule/admitcard/pdf` | PDF Stream | Class timetable grid, student roll number, invigilator signature, code of conduct |
| **Visitor Gate Pass** | `GET /frontoffice/visitor/gatepass/{id}` | PDF Stream | Security badge format, barcode/pass reference, time stamp, check-out confirmation |
| **CBSE Marksheet** | `GET /reports/marksheet/get` | PDF / Printable | Grading scale (A1 through E), scholastic and co-scholastic marks table |

---

## 2. Portals Architecture

The system provides 3 specialized, role-tailored workspaces built into the layout:

1. **Parent Portal (`/portal/parent`)**:
   - Live attendance rate indicator (e.g. 94.2%)
   - Student homework pipeline with upcoming deadlines
   - Outstanding and paid fee receipts
   - School circulars and event calendar

2. **Student Portal (`/portal/student`)**:
   - Active homework submission desk
   - Published term examination results and grades
   - Circulars and holiday notifications

3. **Teacher Portal (`/portal/teacher`)**:
   - Quick homework assigner and evaluator
   - Pending student leave request approval counter
   - Class timetable view

---

## 3. Asynchronous Data Endpoints (AJAX)

The application provides AJAX endpoints for live dependent dropdowns:

- `GET /students/year/class/wise`: Returns class and year-filtered student list for roll number generation and fee collection.
- `GET /students/reg/fee/classwisedata`: Dynamic calculation of registration fee per student class.
- `GET /students/monthly/fee/classwisedata`: Dynamic tuition fee calculation per student class.
- `GET /students/exam/fee/classwisedata`: Dynamic exam fee calculation.
- `GET /employee/attendance/getemployee`: Attendance roster loader by date.
- `GET /accounts/account/salary/getemployee`: Payroll employee monthly calculation endpoint.
