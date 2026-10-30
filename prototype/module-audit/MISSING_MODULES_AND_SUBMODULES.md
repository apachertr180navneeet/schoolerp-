# School ERP — Missing Modules & Submodules Specification

**Audit Date:** 2026-10-31  
**Project:** Single-School ERP Software (CBSE + State Board)  
**Location:** `c:\laragon\www\gsgwebsoft\sms`  

---

## Overview

This report details all **missing modules, incomplete submodules, and unbuilt features** discovered during the audit of the School ERP system. Each entry includes required UI components, data structures, validations, and recommended implementation priority (**P0: Immediate, P1: High, P2: Medium, P3: Low**).

---

## Group A: Core Administration

### Module 1: Dashboard Management
* **Submodule:** Role-Specific Dashboards (Principal, Teacher, Accountant, Student, Parent)
  * **Missing Feature:** Role-adaptive landing dashboards with customized metrics.
  * **Required UI Components:** KPI scorecards (Attendance %, Due Fees ₹, Today's Classes, Pending Leaves), Calendar widget, Quick action buttons, Recent Activity timeline.
  * **Actions & Validations:** Role detection on login (`Auth::user()->role`), redirect to respective dashboard controller.
  * **Dependencies:** User & Access Management (Module 4).
  * **Priority:** P1

### Module 2: School Profile & Configuration
* **Submodule:** School Master Profile & Affiliation Setup
  * **Missing Feature:** Centralized institution settings page.
  * **Required UI Components:** School Name, Registration/Affiliation No. (CBSE/State Board), School Code, Address, Contact details, Principal signature upload, School logo/seal upload, Academic session selector.
  * **Actions & Validations:** File validation (max 2MB, png/jpg), required affiliation code format validation.
  * **Dependencies:** Setup Management.
  * **Priority:** P1

### Module 5: System Administration
* **Submodule:** Backup, Audit Trail & Activity Logs
  * **Missing Feature:** Admin system maintenance dashboard.
  * **Required UI Components:** Database one-click backup button, Download backup archive, Restore file upload, Activity log table (User, Action, Timestamp, IP Address, Affected Table).
  * **Actions & Validations:** Automatic nightly cron trigger, role permission check (Admin only).
  * **Dependencies:** Core Administration.
  * **Priority:** P2

---

## Group B: Admission & Student Management

### Module 6: Admission Enquiry & CRM
* **Submodule:** Enquiry Management & Prospectus Sales
  * **Missing Feature:** Lead tracking pipeline from initial visit to admission.
  * **Required UI Components:** Lead Intake form (Student Name, Parent Contact, Previous School, Class Applied), Enquiry Status Pipeline badges (New, Contacted, Campus Visit, Form Purchased, Registered, Admitted, Rejected), Follow-up reminder scheduler, Call notes accordion.
  * **Actions & Validations:** Phone & email validation, auto-reminder notification.
  * **Dependencies:** Student Information System (Module 8).
  * **Priority:** P1

### Module 7: Admission Management
* **Submodule:** Application Screening & Merit List
  * **Missing Feature:** Formal admission processing workspace.
  * **Required UI Components:** Application review queue, Entrance test score entry, Document verification checklist (Birth Certificate, Transfer Certificate, Marksheet, Aadhar Card, Caste Certificate), One-click Convert to Enrolled Student.
  * **Actions & Validations:** Duplicate check (phone/Aadhar), status transition workflow.
  * **Dependencies:** Admission CRM (Module 6), Student Master (Module 8).
  * **Priority:** P1

### Module 8: Student Information System (SIS)
* **Submodule:** Student Documents & Extended Profile
  * **Missing Feature:** Comprehensive student bio-data and digital document locker.
  * **Required UI Components:** Multi-tab student profile (General Info, Parents & Guardians, Emergency Contacts, Health & Medical/Blood Group, Previous School Records, Document Locker with file previews).
  * **Actions & Validations:** Secure PDF/image upload, Aadhar verification format, blood group dropdown.
  * **Dependencies:** Existing Student Registration.
  * **Priority:** P1

### Module 9: Enrollment & Student Lifecycle
* **Submodule:** Section Assignment & School Leaving Certificate (SLC/TC)
  * **Missing Feature:** Transfer, Section Migration, and Withdrawal workflow.
  * **Required UI Components:** Bulk Section Transfer interface, Student Withdrawal request form, Due clearance checklist (Library, Fees, Sports, Lab), Auto-generated Transfer Certificate (TC) with serial number, reason for leaving, conduct rating.
  * **Actions & Validations:** Fee clearance lock before TC generation.
  * **Dependencies:** Fee Management (Module 26), Library (Module 35).
  * **Priority:** P1

### Module 10: Student ID & Document Management
* **Submodule:** Institutional Certificate Generator
  * **Missing Feature:** Formal certificate creation center.
  * **Required UI Components:** Template picker for Bonafide Certificate, Character Certificate, Study Certificate, Fee Paid Certificate; Customizable header/footer text; Print & PDF download.
  * **Actions & Validations:** Auto-populate student variables (`{{ name }}`, `{{ class }}`, `{{ roll }}`).
  * **Dependencies:** Student Master (Module 8).
  * **Priority:** P2

---

## Group C: Academics & Teaching

### Module 11: Curriculum Management
* **Submodule:** Board Curriculum & Syllabus Mapping
  * **Missing Feature:** Curriculum and chapter breakdown manager.
  * **Required UI Components:** Board selection (CBSE / State Board), Subject chapter list, Topic breakdown, Weightage allocation, Prescribed textbook catalogue.
  * **Actions & Validations:** Topic progress percentage completion tracker.
  * **Dependencies:** Academic Master Setup (Module 3).
  * **Priority:** P2

### Module 12: Academic Planning
* **Submodule:** Lesson Planning & Academic Calendar
  * **Missing Feature:** Teacher annual lesson plan and school event calendar.
  * **Required UI Components:** Academic calendar view (holidays, terms, exam windows), Teacher lesson plan builder (Objectives, Teaching Aids, Assessment plan), Admin review & approval buttons.
  * **Actions & Validations:** Date clash validation with official holidays.
  * **Dependencies:** Curriculum Management (Module 11).
  * **Priority:** P2

### Module 13: Timetable Management
* **Submodule:** Class & Teacher Timetable Scheduler
  * **Missing Feature:** Master weekly schedule builder.
  * **Required UI Components:** Visual drag-and-drop or grid timetable matrix (Monday to Saturday, Periods 1–8), Class-wise view, Teacher-wise schedule, Room/Lab assignment, Proxy/Substitute teacher allocation widget for absent staff.
  * **Actions & Validations:** Conflict detector (alert when a teacher or room is double-booked).
  * **Dependencies:** Staff Attendance (Module 31), Academic Master (Module 3).
  * **Priority:** P1

### Module 14: Classroom & Teaching Management
* **Submodule:** Daily Teacher Logbook / Classroom Diary
  * **Missing Feature:** Daily classroom record.
  * **Required UI Components:** Class diary entry form (Topics taught today, Homework assigned, Student remarks), Principal signature/acknowledgement toggle.
  * **Actions & Validations:** Daily lock after school hours.
  * **Dependencies:** Timetable (Module 13).
  * **Priority:** P2

### Module 15: Homework & Assignment Management
* **Submodule:** Digital Homework Portal
  * **Missing Feature:** Assignment creation, student submission, and grading.
  * **Required UI Components:** Homework creation modal (Class, Subject, Title, Description, Attachment, Submission Due Date), Student submission status tracker, Teacher evaluation & remarks box, SMS notification trigger.
  * **Actions & Validations:** Late submission flag.
  * **Dependencies:** Student Portal (Module 40), Teacher Portal (Module 41).
  * **Priority:** P2

### Module 16: Learning Resource Management
* **Submodule:** Digital Study Materials & Question Bank
  * **Missing Feature:** E-content repository for students and teachers.
  * **Required UI Components:** Document upload by Class & Subject, Categorization (Notes, Question Bank, Sample Papers, Video Links), Search & Download counter.
  * **Actions & Validations:** File type filters (.pdf, .docx, .pptx, max 25MB).
  * **Dependencies:** Academics.
  * **Priority:** P3

---

## Group D: Attendance & Leave

### Module 17: Student Attendance
* **Submodule:** Daily Period-wise & Day-wise Student Attendance
  * **Missing Feature:** Fast daily attendance entry interface for teachers.
  * **Required UI Components:** Quick Class & Section selector, Student roster with 1-click status toggles (P: Present, A: Absent, L: Leave, HD: Half Day), Mark All Present button, Real-time summary header (Total, Present, Absent %), Absentee SMS dispatch button.
  * **Actions & Validations:** Duplicate date check per section, date lock for past dates.
  * **Dependencies:** Student Management (Module 8).
  * **Priority:** P0

### Module 18: Leave Management
* **Submodule:** Student & Parent Leave Requests
  * **Missing Feature:** Online student leave application workflow.
  * **Required UI Components:** Parent leave submission form (Start Date, End Date, Reason, Medical Certificate upload), Class Teacher & Principal approval/rejection action buttons with reason notes.
  * **Actions & Validations:** Auto-sync approved leaves with daily attendance register.
  * **Dependencies:** Student Attendance (Module 17).
  * **Priority:** P1

### Module 19: Biometric & Smart Attendance
* **Submodule:** Biometric Device & RFID Synchronization
  * **Missing Feature:** Machine hardware connector.
  * **Required UI Components:** Device IP & port configuration, Biometric machine sync log, RFID card swipe listener, Real-time punch log table.
  * **Actions & Validations:** Network timeout retry logic, unrecognized card alarm.
  * **Dependencies:** Staff Attendance (Module 31), Student Attendance (Module 17).
  * **Priority:** P3

---

## Group E: Examinations & Results

### Module 20: Examination Setup
* **Submodule:** Exam Datesheet & Admit Card (Hall Ticket) Generator
  * **Missing Feature:** Timetable of exams and student hall ticket printing.
  * **Required UI Components:** Exam datesheet table (Date, Day, Time slot, Subject, Room), Hall Ticket generator with student photo, roll number, exam guidelines, and barcode.
  * **Actions & Validations:** Fee dues check before hall ticket issuance.
  * **Dependencies:** Examination Setup (Existing).
  * **Priority:** P1

### Module 24: Online Examination System
* **Submodule:** Online Quiz & MCQ Assessment
  * **Missing Feature:** Computer-based test environment.
  * **Required UI Components:** Question paper creator (Multiple Choice, True/False, Short Answer), Timed test engine for students, Auto-grading & instant scorecard generator.
  * **Actions & Validations:** Timer auto-submit, window blur / tab-switch warning count.
  * **Dependencies:** Student Portal (Module 40).
  * **Priority:** P3

---

## Group F: Fees & Finance

### Module 25: Fee Configuration (Advanced)
* **Submodule:** Late Fines & Installment Configuration
  * **Missing Feature:** Automatic fine calculation rules and term installment slabs.
  * **Required UI Components:** Fine rule builder (Grace days, Fixed fine ₹ or Per-day fine ₹), Multi-installment breakdown (Quarterly, Bi-monthly, Half-Yearly).
  * **Actions & Validations:** Non-negative fine amounts, date range validation.
  * **Dependencies:** Fee Category (Existing).
  * **Priority:** P1

### Module 26: Student Billing & Collection (Advanced)
* **Submodule:** Payment Gateway & Thermal Receipt Generator
  * **Missing Feature:** Online payment and professional voucher receipt printing.
  * **Required UI Components:** Online payment gateway integration (Razorpay / UPI / Netbanking), Dual-copy printable fee receipt (Student Copy & School Copy), Partial payment installment adjustment.
  * **Actions & Validations:** Payment webhook verification, transaction ID uniqueness.
  * **Dependencies:** Student Fee Collection (Existing).
  * **Priority:** P1

### Module 28: Outstanding & Fee Reports
* **Submodule:** Fee Defaulters Register & Reminder Notices
  * **Missing Feature:** Fee collection recovery dashboard.
  * **Required UI Components:** Defaulters list filtered by Class, Days overdue, and Balance amount; 1-click WhatsApp/SMS fee reminder sender; Daily cashbook collection register.
  * **Actions & Validations:** Export to Excel/PDF.
  * **Dependencies:** Student Fee Collection (Existing).
  * **Priority:** P1

---

## Group G: HR & Payroll

### Module 32: Payroll Management (Statutory Deductions)
* **Submodule:** PF, ESI, TDS & Allowances Breakdown
  * **Missing Feature:** Indian statutory payroll compliance calculation.
  * **Required UI Components:** Salary component builder (Basic, DA, HRA, Conveyance, Special Allowance; Deductions: PF, ESI, Professional Tax, TDS), Automated salary sheet generation, Bank transfer NEFT/RTGS statement export.
  * **Actions & Validations:** Statutory cap validation.
  * **Dependencies:** Employee Salary (Existing).
  * **Priority:** P2

### Module 33: Staff Performance & Training
* **Submodule:** Teacher Appraisal & Training Records
  * **Missing Feature:** Annual staff performance review.
  * **Required UI Components:** Teacher self-appraisal form, Principal rating scorecard, Professional training program participation logs.
  * **Actions & Validations:** Confidential score calculation.
  * **Dependencies:** Employee Management (Existing).
  * **Priority:** P3

---

## Group H: School Operations

### Module 34: Transport Management
* **Submodule:** Vehicles, Routes, Drivers & GPS Tracking
  * **Missing Feature:** Comprehensive school bus fleet operations.
  * **Required UI Components:** Vehicle master (Bus No., RC, Fitness date, Insurance date, Pollution certificate), Driver & Conductor directory, Route & stop manager with pickup times and fare slabs, Student transport allocation, GPS live location map view.
  * **Actions & Validations:** Vehicle capacity limit check, expiry date alerts for insurance/fitness.
  * **Dependencies:** Student Master (Module 8), Fee Management (Module 26).
  * **Priority:** P1

### Module 35: Library Management
* **Submodule:** Book Cataloguing, Issue & Return Counter
  * **Missing Feature:** Complete school library circulation system.
  * **Required UI Components:** Book catalog (Accession No., ISBN, Title, Author, Publisher, Category, Shelf No., Total Copies), Book Issue & Return counter with barcode scanner support, Overdue fine calculator, Member ledger (Students & Staff).
  * **Actions & Validations:** Maximum book issue limit per student, lost book penalty fee.
  * **Dependencies:** Student Master (Module 8), Employee Master (Module 30).
  * **Priority:** P1

### Module 36: Inventory & Procurement
* **Submodule:** Item Master, Stock Inward/Outward & Vendors
  * **Missing Feature:** School store and consumables inventory.
  * **Required UI Components:** Item categories (Stationery, Uniforms, Sports, Lab supplies), Vendor directory, Purchase orders, Stock inward register, Department issue log.
  * **Actions & Validations:** Low stock alerts when quantity drops below reorder level.
  * **Dependencies:** Accounts (Existing).
  * **Priority:** P2

### Module 37: Assets & Maintenance
* **Submodule:** Fixed Asset Register & Repair Work Orders
  * **Missing Feature:** Physical infrastructure maintenance tracker.
  * **Required UI Components:** Asset registry (Desks, Computers, Projectors, Lab gear, ACs), Maintenance service ticket logging, AMC contract renewals.
  * **Actions & Validations:** Depreciation calculation.
  * **Dependencies:** Inventory (Module 36).
  * **Priority:** P3

### Module 38: Hostel Management
* **Submodule:** Rooms, Beds, Mess & Gate Passes
  * **Missing Feature:** Boarding school hostel administration.
  * **Required UI Components:** Hostel building, Room & Bed allocation matrix, Mess menu schedule, Student outpass / gate pass issuance with parent approval.
  * **Actions & Validations:** Bed occupancy collision check.
  * **Dependencies:** Student Master (Module 8), Fee Management (Module 26).
  * **Priority:** P3

---

## Group I: Portals & Communication

### Module 39: Parent Portal
* **Submodule:** Parent Web / Mobile App View
  * **Missing Feature:** Dedicated parent self-service dashboard.
  * **Required UI Components:** Child profile selector (for multi-child parents), Academic report cards, Daily attendance calendar, Fee payment with instant download receipt, Teacher messages.
  * **Actions & Validations:** Secure parent OTP login.
  * **Dependencies:** Student Master, Fees, Attendance.
  * **Priority:** P1

### Module 40: Student Portal
* **Submodule:** Student Learning & Records View
  * **Missing Feature:** Student self-service dashboard.
  * **Required UI Components:** My Timetable, Homework assignments, Online report card, Digital ID card, Study materials.
  * **Actions & Validations:** Read-only access to academic history.
  * **Dependencies:** Academics, Homework, Examinations.
  * **Priority:** P1

### Module 41: Teacher Portal
* **Submodule:** Teacher Workplace Desk
  * **Missing Feature:** Teacher-specific workbench.
  * **Required UI Components:** Today's class timetable, 1-click student attendance, Homework posting, Marks entry shortcut, Personal leave apply.
  * **Actions & Validations:** Restrict data edit rights to assigned classes only.
  * **Dependencies:** Academics, Attendance, Marks.
  * **Priority:** P1

### Module 42: Communication & Notifications
* **Submodule:** SMS, WhatsApp & Email Broadcast Gateway
  * **Missing Feature:** Automated and manual communication center.
  * **Required UI Components:** Compose circular / notice modal, Target recipient filter (All School, Specific Class, Fee Defaulters, Staff), Message template library, Delivery log with status (Sent, Delivered, Failed).
  * **Actions & Validations:** Character limit counter for SMS, DLT template approval match for Indian telecom compliance.
  * **Dependencies:** Integrations (Module 52).
  * **Priority:** P1

---

## Group J: Front Office & Website

### Module 43: Front Office & Visitor Management
* **Submodule:** Visitor Pass, Call Log & Postal Dispatch
  * **Missing Feature:** Reception desk management.
  * **Required UI Components:** Visitor entry form (Name, Purpose, Person to meet, In/Out time, Photo capture), Printable thermal visitor pass, Inward/outward courier register, Phone call logs.
  * **Actions & Validations:** Mandatory phone number & host employee selection.
  * **Dependencies:** Employee Management.
  * **Priority:** P2

### Module 44: Website CMS & Public Portal
* **Submodule:** School Public Website CMS
  * **Missing Feature:** School frontend portal.
  * **Required UI Components:** Homepage banner sliders, Principal's message, News & events bulletin, Photo gallery albums, Mandatory public disclosure page (CBSE bye-laws).
  * **Actions & Validations:** Content publish/unpublish toggles.
  * **Dependencies:** Events (Module 49).
  * **Priority:** P3

### Module 45: Online Admission Website
* **Submodule:** Public Prospective Admission Portal
  * **Missing Feature:** External application intake website.
  * **Required UI Components:** Public registration form, Document upload, Online application fee payment, Application tracking number lookup.
  * **Actions & Validations:** Captcha verification, payment gateway integration.
  * **Dependencies:** Admission CRM (Module 6).
  * **Priority:** P2

---

## Group K: Student Welfare & Activities

### Module 46: Health & Medical
* **Submodule:** Student Health Records & Infirmary Log
  * **Missing Feature:** Medical clinic logbook.
  * **Required UI Components:** Annual health checkup records (Height, Weight, Vision, Dental, BMI), Infirmary daily visit log (Symptoms, First aid given, Doctor remarks, Parent notification toggle).
  * **Actions & Validations:** Medical allergy alert badge on student profile.
  * **Dependencies:** Student Master (Module 8).
  * **Priority:** P3

### Module 47: Security & Safety
* **Submodule:** Gate Security, CCTV & Incident Logging
  * **Missing Feature:** School campus security desk.
  * **Required UI Components:** Disciplinary incident reporting form, Camera directory, Emergency evacuation contact directory.
  * **Actions & Validations:** Incident severity classification (Low, Medium, High).
  * **Dependencies:** Front Office (Module 43).
  * **Priority:** P3

### Module 48: Sports & Extracurricular Activities
* **Submodule:** Houses, Teams & Event Achievements
  * **Missing Feature:** Sports and clubs administration.
  * **Required UI Components:** School Houses setup (Red, Blue, Green, Yellow), Student house allocation, Sports event participant registration, Certificate & trophy records.
  * **Actions & Validations:** Student eligibility check.
  * **Dependencies:** Student Master (Module 8).
  * **Priority:** P3

### Module 49: Events & Parent-Teacher Meetings (PTM)
* **Submodule:** PTM Slot Booking & Event Organizer
  * **Missing Feature:** Meeting scheduling and cultural event management.
  * **Required UI Components:** PTM date and time slot configurator, Parent appointment booking, Teacher notes & feedback log per meeting.
  * **Actions & Validations:** Prevent double-booking of parent time slots.
  * **Dependencies:** Communication (Module 42).
  * **Priority:** P2

### Module 50: Student Counselling & Welfare
* **Submodule:** Confidential Counselling Notes & SEN Tracker
  * **Missing Feature:** Psychological and career counselling desk.
  * **Required UI Components:** Confidential counselling session logs, Special Educational Needs (SEN) student profile, Action plan & progress milestones.
  * **Actions & Validations:** Strict privacy access restricted to School Counsellor and Principal only.
  * **Dependencies:** Student Master (Module 8).
  * **Priority:** P3

---

## Group L: Learning, Integration & Reporting

### Module 51: Learning Management System (LMS)
* **Submodule:** Online Course Modules & Video Classes
  * **Missing Feature:** Asynchronous e-learning hub.
  * **Required UI Components:** Course video uploader, Chapter attachments, Discussion thread for student queries, Quiz checkpoint.
  * **Actions & Validations:** Video player with progress tracking.
  * **Dependencies:** Academics.
  * **Priority:** P3

### Module 52: Integrations & APIs
* **Submodule:** External Service Gateways
  * **Missing Feature:** Third-party gateway configuration UI.
  * **Required UI Components:** SMS Gateway API keys, WhatsApp Business API credentials, Payment Gateway webhook secrets, Video class integration (Zoom / Google Meet).
  * **Actions & Validations:** Test connection ping button.
  * **Dependencies:** System Administration (Module 5).
  * **Priority:** P2

### Module 53: Government & Compliance
* **Submodule:** UDISE+ & Board Compliance Data Export
  * **Missing Feature:** Official education department data formats.
  * **Required UI Components:** UDISE+ student data export in pre-formatted CSV/Excel, RTE (Right to Education) 25% quota monitoring register, CBSE OASIS compliance data.
  * **Actions & Validations:** Mandatory government field checks (Aadhar, APAAR/PEN ID, Mother tongue, Category).
  * **Dependencies:** Student Master (Module 8).
  * **Priority:** P2

### Module 54: Alumni Management
* **Submodule:** Alumni Directory & Reunion Portal
  * **Missing Feature:** Graduated student tracking.
  * **Required UI Components:** Alumni directory by graduation year, Higher education & employment updates, Alumni event announcements.
  * **Actions & Validations:** Verification of past student enrollment.
  * **Dependencies:** Student Master (Module 8).
  * **Priority:** P3

### Module 55: Reports & MIS
* **Submodule:** Executive MIS & Analytics Dashboard
  * **Missing Feature:** High-level school operational intelligence.
  * **Required UI Components:** Multi-dimensional charts (Annual Financial Inflow vs Outflow, Class-wise Academic Pass %, Staff Retention Rate, Gender & Demographic ratios), Custom report generator with column picker and export to PDF/Excel.
  * **Actions & Validations:** Date-range filters, role permission gating.
  * **Dependencies:** Accounts, Academics, HR.
  * **Priority:** P1

