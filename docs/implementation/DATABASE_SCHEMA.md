# Shiksha Mitra School ERP — Database Schema Reference

**Database Engine:** MySQL 8.4  
**Database Name:** `school_erp`  
**Migration Count:** 21 Executed Migrations  

---

## Core Domain Schema

### 1. `school_settings`
- `id` (bigint, PK)
- `school_name` (varchar 255)
- `tagline` (varchar 255, nullable)
- `affiliation_no` (varchar 100, nullable)
- `school_code` (varchar 100, nullable)
- `board` (varchar 100, default 'CBSE')
- `email` (varchar 255, nullable)
- `phone` (varchar 50, nullable)
- `alt_phone` (varchar 50, nullable)
- `website` (varchar 255, nullable)
- `address` (varchar 500, nullable)
- `city` (varchar 100, nullable)
- `state` (varchar 100, nullable)
- `pincode` (varchar 20, nullable)
- `logo` (varchar 255, nullable)
- `principal_name` (varchar 255, nullable)
- `principal_signature` (varchar 255, nullable)
- `academic_session_start` (varchar 20, default 'April')
- `academic_session_end` (varchar 20, default 'March')
- `created_at`, `updated_at` (timestamps)

### 2. `student_sections`
- `id` (bigint, PK)
- `name` (varchar 255)
- `capacity` (int, default 40)
- `created_at`, `updated_at` (timestamps)

### 3. `student_attendances`
- `id` (bigint, PK)
- `student_id` (int, references users.id)
- `class_id` (int, references student_classes.id)
- `date` (date)
- `attend_status` (varchar 50: Present, Absent, Leave)
- `created_at`, `updated_at` (timestamps)

### 4. `admission_enquiries`
- `id` (bigint, PK)
- `candidate_name` (varchar 255)
- `parent_name` (varchar 255)
- `phone` (varchar 50)
- `email` (varchar 255, nullable)
- `class_id` (int, references student_classes.id)
- `source` (varchar 100, default 'Walk-in')
- `status` (varchar 50, default 'New')
- `enquiry_date` (date)
- `notes` (text, nullable)
- `created_at`, `updated_at` (timestamps)

### 5. `timetables`
- `id` (bigint, PK)
- `class_id` (int, references student_classes.id)
- `section_id` (int, references student_sections.id, nullable)
- `subject_id` (int, references school_subjects.id)
- `teacher_id` (int, references users.id)
- `day` (varchar 50: Monday through Saturday)
- `start_time` (varchar 50)
- `end_time` (varchar 50)
- `room_no` (varchar 100, nullable)
- `created_at`, `updated_at` (timestamps)

### 6. `books` & `book_issues`
- `books`: `id`, `accession_no`, `title`, `author`, `isbn`, `publisher`, `category`, `rack_no`, `total_copies`, `available_copies`, `created_at`, `updated_at`
- `book_issues`: `id`, `book_id`, `student_id`, `issue_date`, `due_date`, `return_date`, `status`, `fine_amount`, `created_at`, `updated_at`

### 7. `transport_vehicles`, `transport_routes`, `student_transports`
- `transport_vehicles`: `id`, `vehicle_no`, `vehicle_model`, `driver_name`, `driver_phone`, `driver_license`, `capacity`, `route_id`, `created_at`, `updated_at`
- `transport_routes`: `id`, `route_name`, `start_point`, `end_point`, `stoppages`, `fare`, `created_at`, `updated_at`
- `student_transports`: `id`, `student_id`, `route_id`, `pickup_point`, `monthly_fare`, `created_at`, `updated_at`

### 8. `homeworks` & `homework_submissions`
- `homeworks`: `id`, `class_id`, `section_id`, `subject_id`, `teacher_id`, `title`, `description`, `homework_date`, `assigned_date`, `submission_date`, `due_date`, `max_marks`, `attachment`, `created_at`, `updated_at`
- `homework_submissions`: `id`, `homework_id`, `student_id`, `submission_date`, `submitted_at`, `attachment`, `student_notes`, `status`, `marks`, `marks_obtained`, `evaluation_remarks`, `remarks`, `created_at`, `updated_at`

### 9. `notices`
- `id` (bigint, PK)
- `title` (varchar 255)
- `notice_type` (varchar 100: Circular, Holiday, Exam, Event, Urgent)
- `message` (text)
- `notice_message` (text, nullable)
- `notice_date` (date, nullable)
- `publish_date` (date, nullable)
- `expiry_date` (date, nullable)
- `target_audience` (varchar 100: All, Students, Teachers, Parents)
- `attachment` (varchar 255, nullable)
- `is_active` (boolean, default true)
- `created_by` / `posted_by` (int, references users.id)
- `created_at`, `updated_at` (timestamps)

### 10. `visitors`
- `id` (bigint, PK)
- `pass_no` / `pass_number` (varchar 255)
- `name` / `visitor_name` (varchar 255)
- `phone` (varchar 50)
- `email` (varchar 255, nullable)
- `purpose` (varchar 255)
- `to_meet` / `person_to_meet` (varchar 255)
- `id_proof_type` (varchar 100)
- `id_proof_number` (varchar 100, nullable)
- `check_in` / `in_time` (timestamp / time)
- `check_out` / `out_time` (timestamp / time, nullable)
- `number_of_persons` / `no_of_persons` (int, default 1)
- `notes` (text, nullable)
- `created_at`, `updated_at` (timestamps)

### 11. `inventory_categories`, `inventory_items`, `inventory_issues`
- `inventory_categories`: `id`, `name`, `created_at`, `updated_at`
- `inventory_items`: `id`, `category_id`, `item_name`, `item_code`, `unit`, `quantity`, `min_quantity_alert`, `unit_price`, `description`, `created_at`, `updated_at`
- `inventory_issues`: `id`, `item_id`, `user_id`, `quantity_issued`, `issue_date`, `return_date`, `status`, `remarks`, `created_at`, `updated_at`

### 12. `exam_schedules`
- `id` (bigint, PK)
- `exam_type_id` (int, references exam_types.id)
- `class_id` (int, references student_classes.id)
- `subject_id` (int, references school_subjects.id)
- `exam_date` (date)
- `start_time` (varchar 50)
- `end_time` (varchar 50)
- `room_no` (varchar 100)
- `max_marks` (double, default 100)
- `pass_marks` (double, default 33)
- `created_at`, `updated_at` (timestamps)

### 13. `hostel_rooms` & `student_hostels`
- `hostel_rooms`: `id`, `hostel_name`, `room_no`, `room_type`, `capacity`, `cost_per_bed`, `description`, `created_at`, `updated_at`
- `student_hostels`: `id`, `student_id`, `room_id`, `allotment_date`, `status` (Occupied/Vacated), `remarks`, `created_at`, `updated_at`

### 14. `student_medicals`
- `id` (bigint, PK)
- `student_id` (int, references users.id)
- `blood_group` (varchar 10, nullable)
- `height_cm` (double, nullable)
- `weight_kg` (double, nullable)
- `known_allergies` (varchar 255, nullable)
- `emergency_contact_name` (varchar 255, nullable)
- `emergency_contact_phone` (varchar 50, nullable)
- `medical_conditions` (text, nullable)
- `last_checkup_date` (date, nullable)
- `created_at`, `updated_at` (timestamps)

### 15. `student_leaves`
- `id` (bigint, PK)
- `student_id` (int, references users.id)
- `class_id` (int, references student_classes.id)
- `start_date` (date)
- `end_date` (date)
- `reason` (varchar 255)
- `status` (varchar 50: Pending, Approved, Rejected)
- `approved_by` (int, references users.id, nullable)
- `remarks` (text, nullable)
- `created_at`, `updated_at` (timestamps)

### 16. `activity_logs`
- `id` (bigint, PK)
- `user_id` (int, nullable)
- `user_name` (varchar 255, nullable)
- `action_type` (varchar 50: LOGIN, CREATE, UPDATE, DELETE, ALLOTMENT, RETURN)
- `module` (varchar 100)
- `description` (varchar 255)
- `ip_address` (varchar 50, nullable)
- `created_at`, `updated_at` (timestamps)

