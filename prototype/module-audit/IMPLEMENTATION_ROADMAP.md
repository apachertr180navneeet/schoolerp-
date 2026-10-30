# Implementation Roadmap: School ERP Enterprise Sprints

**Project:** Shiksha Mitra — Single-School ERP Software  
**Curriculum Alignment:** CBSE + State Board Standards  
**Audit Date:** 2026-10-31  

---

## 1. Roadmap Overview & Completed Milestones

```
[ Phase 0: Polish ] ➔ [ Phase 1: Core Operations ] ➔ [ Phase 2: Academic & Noticeboard ] ➔ [ Phase 3: Portals & Integrations ]
    ✓ COMPLETED              ✓ COMPLETED                      NEXT SPRINT                         UPCOMING
```

### Completed Sprints (Phases 0 & 1):
- [x] **Navigation & Shell Polish (P0)**: Header notification modal connected, footer link updated, Bootstrap Icons CDN integrated, Plus Jakarta Sans typography applied, and executive dashboard overhauled.
- [x] **School Master Profile (P0)**: Configured institutional CBSE affiliation code, board, logo, official seal, and campus contact details.
- [x] **Academic Master Sections (P0)**: Sections A, B, C, D with capacity controls linked to student assignment.
- [x] **Admission Enquiry & Pipeline CRM (P1)**: Leads pipeline, stage metrics (New, Contacted, Assessment Scheduled, Admitted).
- [x] **Student Daily Attendance System (P1)**: Daily roster attendance marking (Present, Absent, Leave), logs, and detailed attendance summary.
- [x] **Class Timetable Matrix (P1)**: Weekly period matrix across Monday–Saturday with teacher and room assignments.
- [x] **Board-Compliant Certificates (P1)**: Formal Transfer Certificate (TC/SLC) and Bonafide Certificate PDF generators.
- [x] **Library Management System (P1)**: Catalog stock inventory and circulation counter with automated overdue fine calculation.
- [x] **Transport Fleet Management (P1)**: School buses, transit routes, key stoppages, and student bus subscription allocations.

---

## 2. Phase 2: Academic Workflows, Communication & Store (Next Sprint)

### Target Sprint Duration: Sprint 3

| Module ID | Module & Feature | Description & Implementation Tasks | Priority |
| :--- | :--- | :--- | :--- |
| **Module 15** | **Homework & Assignment Management** | Create `homeworks` and `homework_submissions` tables.<br>Build homework creator for teachers (class, section, subject, deadline, attachment).<br>Build submission evaluator with marks and feedback. | **P1** |
| **Module 42** | **Communication & Noticeboard** | Create `notices` table.<br>Build campus notice publisher with target audience filter (All, Teachers, Parents, Specific Class).<br>Display live noticeboard widget on dashboard. | **P1** |
| **Module 43** | **Front Office & Visitor Management** | Create `visitors` table.<br>Build visitor check-in, purpose of visit, person to meet, and printable Visitor Gate Pass. | **P2** |
| **Module 36** | **Inventory & Store Procurement** | Create `inventory_items` and `inventory_transactions` tables.<br>Manage school supplies (stationery, science lab supplies, sports gear) with inward/outward stock ledger. | **P2** |
| **Module 20** | **Exam Datesheet & Admit Cards** | Create `exam_schedules` table.<br>Generate printable examination datesheets and student admit cards (hall tickets) with exam rules. | **P2** |
| **Module 28** | **Fee Defaulters & Reminder Register** | Build automated fee defaulters list with overdue months and fine penalties.<br>Add one-click template reminder generator. | **P2** |

---

## 3. Phase 3: Dedicated Portals, Online Exam & E-Learning

### Target Sprint Duration: Sprint 4

| Module ID | Module & Feature | Description & Implementation Tasks | Priority |
| :--- | :--- | :--- | :--- |
| **Module 41** | **Teacher Workspace Portal** | Dedicated portal interface for teachers to manage daily class attendance, enter exam marks, and assign homework. | **P2** |
| **Module 40** | **Student Self-Service Portal** | Dedicated student portal to view personal class timetable, download homework, check attendance history, and view report cards. | **P2** |
| **Module 39** | **Parent Portal** | Dedicated parent portal to track student academic progress, view attendance logs, and download fee receipts. | **P2** |
| **Module 24** | **Online Examination System** | Create `online_exams` and `exam_questions` tables.<br>Build MCQ online quiz interface with countdown timer and automated score calculation. | **P3** |
| **Module 16** | **Learning Resource Library** | Digital study notes, syllabus PDFs, and previous years' question papers repository. | **P3** |
| **Module 51** | **Learning Management System (LMS)** | Online video lecture lessons and chapter progression tracker. | **P3** |
| **Module 38** | **Hostel & Dormitory Management** | Hostel building, room numbers, bed allocation, and mess menu scheduler. | **P3** |

---

## 4. Phase 4: Integrations, Compliance & System Administration

### Target Sprint Duration: Sprint 5

| Module ID | Module & Feature | Description & Implementation Tasks | Priority |
| :--- | :--- | :--- | :--- |
| **Module 5** | **System Administration & Audit Log** | Detailed user audit logbook recording record creation, updates, and deletes with IP and timestamp.<br>Automated database backup trigger. | **P3** |
| **Module 53** | **Government & Compliance (UDISE+)** | Standardized data export formatted for UDISE+ and CBSE OASIS regulatory submission. | **P2** |
| **Module 52** | **Third-Party Gateways & APIs** | Configuration interface for SMS gateways (Twilio, Textlocal), WhatsApp Cloud API, and Payment Gateways (Razorpay, Paytm). | **P3** |
| **Module 44** | **Website CMS & News Banner** | Public school landing website CMS with news ticker, event calendar, and photo gallery. | **P3** |
| **Module 54** | **Alumni Network Management** | Alumni directory, graduation year batch records, and alumni reunion announcements. | **P3** |
| **Module 46–50**| **Student Welfare & Medical** | Health checkup records, campus infirmary visit logs, and confidential student counselling notes. | **P3** |

---

## 5. Technical Validation Plan

Before releasing each phase to production:
1. **Automated Feature Tests**: Every new module must include dedicated feature tests in `tests/Feature/` asserting HTTP 200 responses for list, add, and store actions.
2. **Database Seeder Parity**: All new models must be registered with realistic demo data in `database/seeders/DatabaseSeeder.php`.
3. **Role & Permission Guarding**: Every route must be protected by authentication and role middleware.
4. **Zero Link Degradation**: Run link integrity tests to guarantee no placeholder `#` or dead routes exist.
