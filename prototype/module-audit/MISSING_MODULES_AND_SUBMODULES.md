# Missing Modules and Submodules Specification

This document details the missing and incomplete modules across the 55-module School ERP specification, prioritized for upcoming implementation sprints.

---

## Group A: Core Administration

### Module 5: System Administration
- **Submodules Missing:**
  - Audit Trail / Activity Logbook
  - Database Backup & Restore Utility
  - System Environment & Maintenance Mode Toggle
- **Required Fields & Components:** User ID, IP address, Action type (Create/Update/Delete), Timestamp, Changes JSON diff table; One-click DB Dump button, automated retention setting.
- **Dependencies:** User & Access Management (`users`).
- **Priority:** P3

---

## Group B: Admission & Student Management

### Module 7: Admission Management
- **Submodules Missing:**
  - Public Online Admission Application Portal
  - Application Document Verification Desk
  - Merit List & Entrance Test Assessment
- **Required Fields & Components:** Applicant personal info, previous school marksheets, transfer certificate upload, Aadhaar/ID number; Approval/Rejection buttons with notification triggers.
- **Dependencies:** Admission CRM (`admission_enquiries`), Student SIS (`assign_students`).
- **Priority:** P2

### Module 8: Student Information System (SIS)
- **Submodules Incomplete:**
  - Emergency Contacts & Medical History Directory
  - Student Document Vault (Birth Certificate, Caste Certificate, Previous SLC)
- **Required Fields & Components:** Blood group, known allergies, emergency doctor contact, file upload with preview for certificates.
- **Dependencies:** `users`, `assign_students`.
- **Priority:** P1

---

## Group C: Academics & Teaching

### Module 11: Curriculum Management
- **Submodules Missing:**
  - CBSE / State Board Subject Syllabus Builder
  - Chapter & Unit Progression Tracker
- **Required Fields & Components:** Class, Subject, Term (Term 1 / Term 2), Chapter Number, Chapter Title, Expected Teaching Hours, Status toggle (Completed / In Progress).
- **Dependencies:** `school_subjects`, `student_classes`.
- **Priority:** P2

### Module 12: Academic Planning
- **Submodules Missing:**
  - Annual Academic Calendar & School Holiday Master
  - Teacher Weekly Lesson Planner
- **Required Fields & Components:** Event title, start date, end date, holiday type (National, Gazetted, Institutional), lesson objective, pedagogical resources.
- **Dependencies:** `school_settings`, `users`.
- **Priority:** P2

### Module 14: Classroom & Teaching Management
- **Submodules Missing:**
  - Teacher Daily Classroom Diary
  - Classroom Substitute / Proxy Teacher Allocator
- **Required Fields & Components:** Date, class, period, absent teacher, substitute teacher selector, topic covered notes.
- **Dependencies:** `timetables`, `users`.
- **Priority:** P2

### Module 15: Homework & Assignment Management
- **Submodules Missing:**
  - Homework Assignment Publisher
  - Student Submission & Evaluation Tracker
- **Required Fields & Components:** Class, section, subject, submission deadline, attachment upload (PDF/Image), evaluation marks & teacher remarks.
- **Dependencies:** `student_classes`, `student_sections`, `school_subjects`.
- **Priority:** P1

### Module 16: Learning Resource Management
- **Submodules Missing:**
  - Digital Question Bank & Practice Papers
  - Study Notes & E-Books Repository
- **Required Fields & Components:** Subject, Class, Chapter, Document title, Download counter, file attachment.
- **Dependencies:** `school_subjects`.
- **Priority:** P2

---

## Group D: Attendance & Smart Attendance

### Module 18: Leave Management
- **Submodules Incomplete:**
  - Student Leave Request Portal & Parent Submission
- **Required Fields & Components:** Student selector, parent reason, start date, end date, medical certificate attachment, Class teacher approval button.
- **Dependencies:** `users`, `student_attendances`.
- **Priority:** P2

### Module 19: Biometric & Smart Attendance
- **Submodules Missing:**
  - RFID / Biometric Device Hardware API Connector
- **Required Fields & Components:** Device IP, port, device serial, sync schedule cron, punch log viewer.
- **Dependencies:** `student_attendances`, `employee_attendances`.
- **Priority:** P3

---

## Group E: Examinations & Assessment

### Module 20: Examination Setup
- **Submodules Incomplete:**
  - Exam Datesheet / Schedule Matrix
  - Student Admit Card (Hall Ticket) Generator
- **Required Fields & Components:** Exam term, date, timing, room number, invigilator teacher, printable PDF admit card with student photo.
- **Dependencies:** `exam_types`, `student_classes`.
- **Priority:** P2

### Module 24: Online Examination System
- **Submodules Missing:**
  - MCQ Online Test Creator
  - Student Online Exam Interface & Auto-Grader
- **Required Fields & Components:** Question title, 4 options, correct answer key, marks per question, countdown timer, auto-submission.
- **Dependencies:** `exam_types`, `student_marks`.
- **Priority:** P3

---

## Group F: Fees & Finance

### Module 27: Discounts & Scholarships
- **Submodules Incomplete:**
  - Formal Merit & Need-based Scholarship Schemes Master
- **Required Fields & Components:** Scholarship name, criteria, concession amount/percentage, parent income verification document upload.
- **Dependencies:** `discount_students`, `fee_categories`.
- **Priority:** P2

### Module 28: Outstanding & Fee Reports
- **Submodules Incomplete:**
  - Automated Fee Defaulters Register
  - WhatsApp / SMS Due Fee Reminder Blast
- **Required Fields & Components:** Defaulter student list, overdue months, fine penalty, one-click template reminder sender.
- **Dependencies:** `account_student_fees`.
- **Priority:** P2

---

## Group G: HR & Staff Development

### Module 33: Staff Performance & Training
- **Submodules Missing:**
  - Teacher Annual Performance Appraisal
  - Faculty Training & Workshop Logbook
- **Required Fields & Components:** Employee, evaluation criteria (Class management, Board results, Punctuality), score out of 100, Principal remarks.
- **Dependencies:** `users`, `designations`.
- **Priority:** P3

---

## Group H: Operations & Logistics

### Module 36: Inventory & Store Procurement
- **Submodules Missing:**
  - Store Item Master & Inventory Ledger
  - Vendor Directory & Purchase Order Management
- **Required Fields & Components:** Item name, category (Stationery, Lab, Sports, Uniform), unit of measurement, current stock, minimum alert level, vendor contact.
- **Dependencies:** `account_other_costs`.
- **Priority:** P2

### Module 37: Assets & Maintenance
- **Submodules Missing:**
  - Fixed Asset Register (Desks, Computers, Lab instruments)
  - Campus Maintenance & Repair Tickets
- **Required Fields & Components:** Asset tag ID, purchase date, cost, depreciation rate, location room, repair status.
- **Dependencies:** `account_other_costs`.
- **Priority:** P3

### Module 38: Hostel Management
- **Submodules Missing:**
  - Hostel Building, Rooms & Bed Allocation
  - Mess Menu & Resident Gate Pass
- **Required Fields & Components:** Room number, room type (AC/Non-AC), bed capacity, student occupant, daily meal schedule, gate pass out/in time.
- **Dependencies:** `users`.
- **Priority:** P3

---

## Group I: Portals & Multi-Role Communication

### Modules 39, 40, 41: Dedicated Portals
- **Submodules Missing:**
  - Parent Self-Service Portal (Child attendance, Fee receipts, Report cards)
  - Student Portal (Assignments, Timetable, Study notes)
  - Teacher Desk (Class attendance roster, Marks entry, Diary)
- **Required Fields & Components:** Role-tailored dashboards and navigation sidebars.
- **Dependencies:** Laravel Jetstream auth roles.
- **Priority:** P2

### Module 42: Communication & Notifications
- **Submodules Missing:**
  - Institutional Noticeboard & Circulars
  - SMS & WhatsApp Gateway Broadcast Engine
- **Required Fields & Components:** Circular title, target audience (All, Parents, Teachers, Specific Class), publication date, PDF attachment, SMS delivery status log.
- **Dependencies:** `users`, `student_classes`.
- **Priority:** P1

---

## Group J: Front Office & Web

### Module 43: Front Office & Visitor Management
- **Submodules Missing:**
  - Visitor Check-in & Gate Pass Print
  - Postal Dispatch & Inward Document Register
- **Required Fields & Components:** Visitor name, phone number, person to meet, purpose of visit, check-in time, check-out time, pass number.
- **Dependencies:** `school_settings`.
- **Priority:** P2

### Modules 44 & 45: Website CMS & Public Admissions
- **Submodules Missing:**
  - School Public Website CMS (News, Gallery, Faculty list)
  - Public Online Admission Intake Application
- **Required Fields & Components:** Banner slides, news ticker, photo albums, public applicant form.
- **Dependencies:** `school_settings`, `admission_enquiries`.
- **Priority:** P3

---

## Group K & L: Welfare, Compliance & Analytics

### Modules 46–50: Student Welfare & Activities
- **Submodules Missing:**
  - Health & Infirmary Checkup Logbook
  - Campus Security Incident Register
  - Sports Houses & Extracurricular Awards
  - PTM Slot Appointment Scheduler
  - Student Counselling & Special Education Notes
- **Dependencies:** `users`.
- **Priority:** P3

### Modules 51–54: LMS, APIs & Compliance
- **Submodules Missing:**
  - E-Learning Video Lessons & SCORM Modules
  - Third-Party API Key Manager (Razorpay, Twilio, WhatsApp Cloud API)
  - Government UDISE+ and CBSE OASIS Data Exporter
  - Alumni Directory & Reunion Registry
- **Dependencies:** `users`, `school_settings`.
- **Priority:** P2 / P3
