<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\ExamType;
use App\Models\SchoolSubject;
use App\Models\AssignSubject;
use App\Models\Designation;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\EmployeeSallaryLog;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;
use App\Models\EmployeeAttendance;
use App\Models\StudentMarks;
use App\Models\MarksGrade;
use App\Models\AccountStudentFee;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\SchoolSetting;
use App\Models\StudentSection;
use App\Models\StudentAttendance;
use App\Models\AdmissionEnquiry;
use App\Models\Timetable;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\TransportVehicle;
use App\Models\TransportRoute;
use App\Models\StudentTransport;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Notice;
use App\Models\Visitor;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\InventoryIssue;
use App\Models\ExamSchedule;
use App\Models\HostelRoom;
use App\Models\StudentHostel;
use App\Models\StudentMedical;
use App\Models\StudentLeave;
use App\Models\ActivityLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // -------------------------------------------------------------
        // 1. ADMIN & OPERATOR USERS
        // -------------------------------------------------------------
        $admin = User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin User',
                'usertype' => 'Admin',
                'role' => 'Admin',
                'password' => Hash::make('123456'),
                'code' => '123456',
                'mobile' => '9876543210',
                'address' => 'Admin Block, Campus 1',
                'gender' => 'Male',
                'religion' => 'Hindu',
                'status' => 1,
            ]
        );

        $operator = User::updateOrCreate(
            ['email' => 'operator@mail.com'],
            [
                'name' => 'Operator User',
                'usertype' => 'Admin',
                'role' => 'Operator',
                'password' => Hash::make('123456'),
                'code' => '123456',
                'mobile' => '9876543211',
                'address' => 'IT Department, Ground Floor',
                'gender' => 'Female',
                'religion' => 'Hindu',
                'status' => 1,
            ]
        );

        // -------------------------------------------------------------
        // 2. SETUP MODULE: YEARS, CLASSES, GROUPS, SHIFTS
        // -------------------------------------------------------------
        $years = [];
        foreach (['2024', '2025', '2026'] as $yearName) {
            $years[$yearName] = StudentYear::updateOrCreate(['name' => $yearName]);
        }

        $classes = [];
        $classList = [
            'Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5',
            'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10'
        ];
        foreach ($classList as $className) {
            $classes[$className] = StudentClass::updateOrCreate(['name' => $className]);
        }

        $groups = [];
        foreach (['General', 'Science', 'Commerce', 'Arts'] as $groupName) {
            $groups[$groupName] = StudentGroup::updateOrCreate(['name' => $groupName]);
        }

        $shifts = [];
        foreach (['Morning', 'Day'] as $shiftName) {
            $shifts[$shiftName] = StudentShift::updateOrCreate(['name' => $shiftName]);
        }

        // -------------------------------------------------------------
        // 3. SETUP MODULE: DESIGNATIONS & LEAVE PURPOSES
        // -------------------------------------------------------------
        $designations = [];
        $desigList = [
            'Principal', 'Headmaster', 'Senior Teacher',
            'Assistant Teacher', 'Accountant', 'Computer Operator', 'Lab Assistant'
        ];
        foreach ($desigList as $desigName) {
            $designations[$desigName] = Designation::updateOrCreate(['name' => $desigName]);
        }

        $leavePurposes = [];
        $purposeList = ['Sick Leave', 'Casual Leave', 'Family Emergency', 'Maternity Leave', 'Medical Treatment'];
        foreach ($purposeList as $pName) {
            $leavePurposes[$pName] = LeavePurpose::updateOrCreate(['name' => $pName]);
        }

        // -------------------------------------------------------------
        // 4. SETUP MODULE: FEE CATEGORIES & AMOUNTS
        // -------------------------------------------------------------
        $feeCategories = [];
        $feeList = ['Registration Fee', 'Monthly Fee', 'Exam Fee', 'Library Fee', 'Sports Fee'];
        foreach ($feeList as $feeName) {
            $feeCategories[$feeName] = FeeCategory::updateOrCreate(['name' => $feeName]);
        }

        // Set fee amounts across classes
        foreach ($classes as $className => $classObj) {
            // Registration Fee: 500 to 1400 based on class
            $regAmt = 500 + ($classObj->id * 50);
            FeeCategoryAmount::updateOrCreate(
                ['fee_category_id' => $feeCategories['Registration Fee']->id, 'class_id' => $classObj->id],
                ['amount' => $regAmt]
            );

            // Monthly Fee: 800 to 1700
            $monthAmt = 800 + ($classObj->id * 80);
            FeeCategoryAmount::updateOrCreate(
                ['fee_category_id' => $feeCategories['Monthly Fee']->id, 'class_id' => $classObj->id],
                ['amount' => $monthAmt]
            );

            // Exam Fee: 300 to 600
            $examAmt = 300 + ($classObj->id * 30);
            FeeCategoryAmount::updateOrCreate(
                ['fee_category_id' => $feeCategories['Exam Fee']->id, 'class_id' => $classObj->id],
                ['amount' => $examAmt]
            );
        }

        // -------------------------------------------------------------
        // 5. SETUP MODULE: EXAM TYPES, SUBJECTS & ASSIGN SUBJECTS
        // -------------------------------------------------------------
        $examTypes = [];
        foreach (['1st Term Exam', '2nd Term Exam', 'Final Exam'] as $examName) {
            $examTypes[$examName] = ExamType::updateOrCreate(['name' => $examName]);
        }

        $subjects = [];
        $subjList = ['English', 'Mathematics', 'General Science', 'Social Studies', 'Hindi', 'Computer Science'];
        foreach ($subjList as $subjName) {
            $subjects[$subjName] = SchoolSubject::updateOrCreate(['name' => $subjName]);
        }

        // Assign subjects to classes (Class 8, 9, 10)
        foreach (['Class 8', 'Class 9', 'Class 10'] as $cName) {
            $targetClass = $classes[$cName];
            foreach ($subjects as $sName => $sObj) {
                AssignSubject::updateOrCreate(
                    ['class_id' => $targetClass->id, 'subject_id' => $sObj->id],
                    [
                        'full_mark' => 100,
                        'pass_mark' => 33,
                        'subjective_mark' => ($sName === 'Mathematics' || $sName === 'Computer Science') ? 60 : 70
                    ]
                );
            }
        }

        // -------------------------------------------------------------
        // 6. SETUP MODULE: MARKS GRADES
        // -------------------------------------------------------------
        $grades = [
            ['grade_name' => 'A+', 'grade_point' => '5.0', 'start_marks' => '80', 'end_marks' => '100', 'start_point' => '5.0', 'end_point' => '5.0', 'remarks' => 'Outstanding'],
            ['grade_name' => 'A',  'grade_point' => '4.0', 'start_marks' => '70', 'end_marks' => '79',  'start_point' => '4.0', 'end_point' => '4.99', 'remarks' => 'Very Good'],
            ['grade_name' => 'A-', 'grade_point' => '3.5', 'start_marks' => '60', 'end_marks' => '69',  'start_point' => '3.5', 'end_point' => '3.99', 'remarks' => 'Good'],
            ['grade_name' => 'B',  'grade_point' => '3.0', 'start_marks' => '50', 'end_marks' => '59',  'start_point' => '3.0', 'end_point' => '3.49', 'remarks' => 'Satisfactory'],
            ['grade_name' => 'C',  'grade_point' => '2.0', 'start_marks' => '40', 'end_marks' => '49',  'start_point' => '2.0', 'end_point' => '2.99', 'remarks' => 'Acceptable'],
            ['grade_name' => 'D',  'grade_point' => '1.0', 'start_marks' => '33', 'end_marks' => '39',  'start_point' => '1.0', 'end_point' => '1.99', 'remarks' => 'Pass'],
            ['grade_name' => 'F',  'grade_point' => '0.0', 'start_marks' => '0',  'end_marks' => '32',  'start_point' => '0.0', 'end_point' => '0.99', 'remarks' => 'Fail'],
        ];
        foreach ($grades as $g) {
            MarksGrade::updateOrCreate(['grade_name' => $g['grade_name']], $g);
        }

        // -------------------------------------------------------------
        // 7. EMPLOYEE MODULE: EMPLOYEES, SALARY LOGS, ATTENDANCE, LEAVE
        // -------------------------------------------------------------
        $employeeData = [
            [
                'name' => 'Dr. Rajesh Sharma',
                'email' => 'rajesh.sharma@school.com',
                'mobile' => '9820011223',
                'address' => '42 Green Park, City Center',
                'gender' => 'Male',
                'religion' => 'Hindu',
                'fname' => 'Om Prakash Sharma',
                'mname' => 'Kailash Sharma',
                'dob' => '1978-04-12',
                'join_date' => '2019-06-01',
                'designation_id' => $designations['Principal']->id,
                'salary' => 65000,
            ],
            [
                'name' => 'Priya Verma',
                'email' => 'priya.verma@school.com',
                'mobile' => '9820022334',
                'address' => '15 Nehru Nagar, Sector 4',
                'gender' => 'Female',
                'religion' => 'Hindu',
                'fname' => 'Ramesh Verma',
                'mname' => 'Sunita Verma',
                'dob' => '1985-08-20',
                'join_date' => '2020-07-15',
                'designation_id' => $designations['Senior Teacher']->id,
                'salary' => 45000,
            ],
            [
                'name' => 'Amit Patel',
                'email' => 'amit.patel@school.com',
                'mobile' => '9820033445',
                'address' => '78 Patel Colony, Ring Road',
                'gender' => 'Male',
                'religion' => 'Hindu',
                'fname' => 'Bharat Patel',
                'mname' => 'Geeta Patel',
                'dob' => '1988-11-05',
                'join_date' => '2021-01-10',
                'designation_id' => $designations['Senior Teacher']->id,
                'salary' => 42000,
            ],
            [
                'name' => 'Sunita Rao',
                'email' => 'sunita.rao@school.com',
                'mobile' => '9820044556',
                'address' => '22 Shanti Vihar, North Extension',
                'gender' => 'Female',
                'religion' => 'Hindu',
                'fname' => 'Krishna Rao',
                'mname' => 'Laxmi Rao',
                'dob' => '1992-02-14',
                'join_date' => '2022-04-01',
                'designation_id' => $designations['Assistant Teacher']->id,
                'salary' => 32000,
            ],
            [
                'name' => 'Manoj Kumar',
                'email' => 'manoj.kumar@school.com',
                'mobile' => '9820055667',
                'address' => '89 Railway Colony, East Gate',
                'gender' => 'Male',
                'religion' => 'Hindu',
                'fname' => 'Surendra Kumar',
                'mname' => 'Kamla Devi',
                'dob' => '1990-09-25',
                'join_date' => '2021-08-01',
                'designation_id' => $designations['Accountant']->id,
                'salary' => 28000,
            ],
            [
                'name' => 'Anita Joshi',
                'email' => 'anita.joshi@school.com',
                'mobile' => '9820066778',
                'address' => '33 Model Town, Phase 2',
                'gender' => 'Female',
                'religion' => 'Hindu',
                'fname' => 'Harish Joshi',
                'mname' => 'Meena Joshi',
                'dob' => '1995-12-08',
                'join_date' => '2023-01-15',
                'designation_id' => $designations['Computer Operator']->id,
                'salary' => 24000,
            ],
        ];

        $employees = [];
        $empCode = 2001;
        foreach ($employeeData as $idx => $emp) {
            $id_no = 'EMP' . str_pad($idx + 1, 4, '0', STR_PAD_LEFT);
            $userEmp = User::updateOrCreate(
                ['email' => $emp['email']],
                array_merge($emp, [
                    'usertype' => 'employee',
                    'role' => 'Employee',
                    'code' => (string)$empCode++,
                    'id_no' => $id_no,
                    'password' => Hash::make('123456'),
                    'status' => 1,
                ])
            );
            $employees[] = $userEmp;

            // Employee Salary Log
            EmployeeSallaryLog::updateOrCreate(
                ['employee_id' => $userEmp->id],
                [
                    'previous_salary' => $emp['salary'],
                    'present_salary' => $emp['salary'],
                    'increment_salary' => 0,
                    'effected_salary' => $emp['join_date'],
                ]
            );
        }

        // Employee Attendance (past 5 working days)
        $attendanceDates = ['2026-10-26', '2026-10-27', '2026-10-28', '2026-10-29', '2026-10-30'];
        foreach ($attendanceDates as $attDate) {
            foreach ($employees as $key => $emp) {
                $status = ($key === 3 && $attDate === '2026-10-28') ? 'Leave' : (($key === 4 && $attDate === '2026-10-29') ? 'Absent' : 'Present');
                EmployeeAttendance::updateOrCreate(
                    ['employee_id' => $emp->id, 'date' => $attDate],
                    ['attend_status' => $status]
                );
            }
        }

        // Employee Leave
        EmployeeLeave::updateOrCreate(
            ['employee_id' => $employees[3]->id, 'start_date' => '2026-10-28'],
            [
                'leave_purpose_id' => $leavePurposes['Medical Treatment']->id,
                'end_date' => '2026-10-28',
            ]
        );
        EmployeeLeave::updateOrCreate(
            ['employee_id' => $employees[1]->id, 'start_date' => '2026-10-12'],
            [
                'leave_purpose_id' => $leavePurposes['Casual Leave']->id,
                'end_date' => '2026-10-14',
            ]
        );

        // -------------------------------------------------------------
        // 8. STUDENT MODULE: STUDENTS, ENROLLMENTS & DISCOUNTS
        // -------------------------------------------------------------
        $studentData = [
            ['name' => 'Aarav Gupta',     'fname' => 'Sanjay Gupta',    'mname' => 'Pooja Gupta',     'gender' => 'Male',   'class' => 'Class 10', 'group' => 'Science',  'shift' => 'Morning', 'discount' => 10],
            ['name' => 'Ananya Singh',    'fname' => 'Vikram Singh',    'mname' => 'Neeta Singh',     'gender' => 'Female', 'class' => 'Class 10', 'group' => 'Science',  'shift' => 'Morning', 'discount' => 20],
            ['name' => 'Rohan Mehta',     'fname' => 'Dinesh Mehta',    'mname' => 'Shobha Mehta',    'gender' => 'Male',   'class' => 'Class 10', 'group' => 'Commerce', 'shift' => 'Day',     'discount' => 0],
            ['name' => 'Diya Sharma',     'fname' => 'Alok Sharma',     'mname' => 'Ritu Sharma',     'gender' => 'Female', 'class' => 'Class 10', 'group' => 'Arts',     'shift' => 'Day',     'discount' => 15],
            ['name' => 'Kabir Kapoor',    'fname' => 'Rohit Kapoor',    'mname' => 'Maya Kapoor',     'gender' => 'Male',   'class' => 'Class 9',  'group' => 'Science',  'shift' => 'Morning', 'discount' => 0],
            ['name' => 'Isha Malhotra',   'fname' => 'Varun Malhotra',  'mname' => 'Sangeeta M.',     'gender' => 'Female', 'class' => 'Class 9',  'group' => 'Commerce', 'shift' => 'Morning', 'discount' => 10],
            ['name' => 'Aditya Verma',    'fname' => 'Deepak Verma',    'mname' => 'Anjali Verma',    'gender' => 'Male',   'class' => 'Class 9',  'group' => 'General',  'shift' => 'Day',     'discount' => 25],
            ['name' => 'Sneha Nair',      'fname' => 'Mohan Nair',      'mname' => 'Radha Nair',      'gender' => 'Female', 'class' => 'Class 8',  'group' => 'General',  'shift' => 'Morning', 'discount' => 0],
            ['name' => 'Vihaan Choudhary','fname' => 'Kishore C.',      'mname' => 'Sarita C.',       'gender' => 'Male',   'class' => 'Class 8',  'group' => 'General',  'shift' => 'Day',     'discount' => 5],
            ['name' => 'Tanvi Saxena',    'fname' => 'Pankaj Saxena',   'mname' => 'Kavita Saxena',   'gender' => 'Female', 'class' => 'Class 5',  'group' => 'General',  'shift' => 'Morning', 'discount' => 0],
            ['name' => 'Aryan Joshi',     'fname' => 'Naveen Joshi',    'mname' => 'Rekha Joshi',     'gender' => 'Male',   'class' => 'Class 5',  'group' => 'General',  'shift' => 'Morning', 'discount' => 10],
            ['name' => 'Pari Agrawal',    'fname' => 'Suresh Agrawal',  'mname' => 'Bhavna Agrawal',  'gender' => 'Female', 'class' => 'Class 1',  'group' => 'General',  'shift' => 'Day',     'discount' => 0],
        ];

        $currentYear = $years['2026'];
        $studentsAssigned = [];

        foreach ($studentData as $i => $s) {
            $studentNum = $i + 1;
            $email = 'student' . $studentNum . '@school.com';
            $id_no = '2026' . str_pad($studentNum, 4, '0', STR_PAD_LEFT);

            $studentUser = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $s['name'],
                    'fname' => $s['fname'],
                    'mname' => $s['mname'],
                    'gender' => $s['gender'],
                    'religion' => 'Hindu',
                    'mobile' => '98100' . str_pad($studentNum, 5, '0', STR_PAD_LEFT),
                    'address' => 'Flat #' . ($studentNum * 12) . ', School Road, City',
                    'dob' => '2010-06-15',
                    'usertype' => 'Student',
                    'role' => 'Student',
                    'code' => (string)(3000 + $studentNum),
                    'id_no' => $id_no,
                    'password' => Hash::make('123456'),
                    'status' => 1,
                ]
            );

            // Assign Student
            $classObj = $classes[$s['class']];
            $groupObj = $groups[$s['group']];
            $shiftObj = $shifts[$s['shift']];

            $assign = AssignStudent::updateOrCreate(
                ['student_id' => $studentUser->id, 'year_id' => $currentYear->id],
                [
                    'class_id' => $classObj->id,
                    'group_id' => $groupObj->id,
                    'shift_id' => $shiftObj->id,
                    'roll' => $studentNum,
                ]
            );

            // Discount Student
            DiscountStudent::updateOrCreate(
                ['assign_student_id' => $assign->id],
                [
                    'fee_category_id' => $feeCategories['Registration Fee']->id,
                    'discount' => $s['discount'],
                ]
            );

            $studentsAssigned[] = [
                'user' => $studentUser,
                'assign' => $assign,
                'class' => $classObj,
            ];
        }

        // -------------------------------------------------------------
        // 9. MARKS MODULE: STUDENT MARKS
        // -------------------------------------------------------------
        // Add marks for Class 10 and Class 9 students in 1st Term Exam
        $exam1 = $examTypes['1st Term Exam'];
        $class10Subjects = AssignSubject::where('class_id', $classes['Class 10']->id)->get();
        $sampleMarks = [88, 92, 75, 84, 69, 95, 78, 85, 90, 82];

        foreach ($studentsAssigned as $idx => $st) {
            if ($st['class']->name === 'Class 10' || $st['class']->name === 'Class 9') {
                $assignedSubjs = AssignSubject::where('class_id', $st['class']->id)->get();
                foreach ($assignedSubjs as $sIdx => $asSubj) {
                    $score = $sampleMarks[($idx + $sIdx) % count($sampleMarks)];
                    StudentMarks::updateOrCreate(
                        [
                            'student_id' => $st['user']->id,
                            'year_id' => $currentYear->id,
                            'class_id' => $st['class']->id,
                            'assign_subject_id' => $asSubj->id,
                            'exam_type_id' => $exam1->id,
                        ],
                        [
                            'id_no' => $st['user']->id_no,
                            'marks' => $score,
                        ]
                    );
                }
            }
        }

        // -------------------------------------------------------------
        // 10. ACCOUNTS MODULE: STUDENT FEES, EMPLOYEE SALARY, OTHER COSTS
        // -------------------------------------------------------------
        // Student Fee Payments (Monthly Fee for 2026-09 and 2026-10)
        foreach ($studentsAssigned as $st) {
            $feeAmount = FeeCategoryAmount::where('fee_category_id', $feeCategories['Monthly Fee']->id)
                ->where('class_id', $st['class']->id)
                ->value('amount') ?? 1000;

            AccountStudentFee::updateOrCreate(
                [
                    'student_id' => $st['user']->id,
                    'year_id' => $currentYear->id,
                    'class_id' => $st['class']->id,
                    'fee_category_id' => $feeCategories['Monthly Fee']->id,
                    'date' => '2026-10',
                ],
                [
                    'amount' => $feeAmount,
                ]
            );

            AccountStudentFee::updateOrCreate(
                [
                    'student_id' => $st['user']->id,
                    'year_id' => $currentYear->id,
                    'class_id' => $st['class']->id,
                    'fee_category_id' => $feeCategories['Registration Fee']->id,
                    'date' => '2026-04',
                ],
                [
                    'amount' => 500,
                ]
            );
        }

        // Employee Salaries Paid (for 2026-09 and 2026-10)
        foreach ($employees as $emp) {
            AccountEmployeeSalary::updateOrCreate(
                ['employee_id' => $emp->id, 'date' => '2026-09'],
                ['amount' => $emp->salary]
            );
            AccountEmployeeSalary::updateOrCreate(
                ['employee_id' => $emp->id, 'date' => '2026-10'],
                ['amount' => $emp->salary]
            );
        }

        // Other Costs (School Expenses)
        $costs = [
            ['date' => '2026-10-05', 'amount' => 4500,  'description' => 'Office stationery, paper reams and printer toner cartridges'],
            ['date' => '2026-10-12', 'amount' => 12500, 'description' => 'Science laboratory equipment and chemical supplies'],
            ['date' => '2026-10-18', 'amount' => 8200,  'description' => 'Annual sports day ground preparation and banner printing'],
            ['date' => '2026-10-22', 'amount' => 3800,  'description' => 'High-speed broadband internet and router maintenance'],
            ['date' => '2026-10-27', 'amount' => 6400,  'description' => 'Campus electrical maintenance and LED tube replacements'],
        ];

        foreach ($costs as $c) {
            AccountOtherCost::updateOrCreate(['date' => $c['date'], 'description' => $c['description']], $c);
        }

        // -------------------------------------------------------------
        // 9. SCHOOL PROFILE MASTER SETUP
        // -------------------------------------------------------------
        SchoolSetting::updateOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Shiksha Mitra Public School',
                'school_code' => 'SMPS-1029',
                'affiliation_no' => 'CBSE/AFF/2026/8942',
                'board' => 'CBSE',
                'phone' => '+91 98765 43210',
                'email' => 'principal@shikshamitra.edu.in',
                'address' => 'Campus 1, Vidya Marg, Knowledge Park III, Education City - 201306',
                'principal_name' => 'Dr. Rajesh Sharma',
                'academic_session' => '2026-2027',
            ]
        );

        // -------------------------------------------------------------
        // 10. STUDENT SECTIONS MASTER
        // -------------------------------------------------------------
        $sections = [];
        foreach (['A', 'B', 'C', 'D'] as $secName) {
            $sections[$secName] = StudentSection::updateOrCreate(
                ['name' => $secName],
                ['capacity' => 40]
            );
        }

        // -------------------------------------------------------------
        // 11. STUDENT DAILY ATTENDANCE (Past 5 weekdays)
        // -------------------------------------------------------------
        $attendanceDates = ['2026-10-26', '2026-10-27', '2026-10-28', '2026-10-29', '2026-10-30'];
        foreach ($attendanceDates as $attDate) {
            foreach ($studentsAssigned as $st) {
                // Determine realistic status
                $rand = rand(1, 10);
                $status = ($rand == 10) ? 'Leave' : (($rand >= 8) ? 'Absent' : 'Present');

                StudentAttendance::updateOrCreate(
                    [
                        'date' => $attDate,
                        'student_id' => $st['user']->id,
                        'class_id' => $st['class']->id,
                    ],
                    [
                        'year_id' => $currentYear->id,
                        'section_id' => $sections['A']->id,
                        'attend_status' => $status,
                    ]
                );
            }
        }

        // -------------------------------------------------------------
        // 12. ADMISSION ENQUIRIES & PIPELINE CRM
        // -------------------------------------------------------------
        $enquiries = [
            [
                'enquiry_no' => 'ENQ-2026-1001',
                'student_name' => 'Ananya Deshmukh',
                'parent_name' => 'Sanjay Deshmukh',
                'mobile' => '9823456781',
                'email' => 'sanjay.deshmukh@gmail.com',
                'class_id' => $classes['Class 1']->id,
                'enquiry_date' => '2026-10-20',
                'source' => 'Walk-in',
                'status' => 'Admitted',
                'notes' => 'Admission formalities completed, registration fee submitted.',
            ],
            [
                'enquiry_no' => 'ENQ-2026-1002',
                'student_name' => 'Devansh Mathur',
                'parent_name' => 'Vikram Mathur',
                'mobile' => '9871122334',
                'email' => 'vikram.m@outlook.com',
                'class_id' => $classes['Class 9']->id,
                'enquiry_date' => '2026-10-22',
                'source' => 'Website Online Form',
                'status' => 'Assessment Scheduled',
                'notes' => 'Maths & Science written assessment scheduled for Saturday 10:00 AM.',
            ],
            [
                'enquiry_no' => 'ENQ-2026-1003',
                'student_name' => 'Rhea Choudhury',
                'parent_name' => 'Amitabh Choudhury',
                'mobile' => '9810987654',
                'email' => 'amitabh.c@yahoo.com',
                'class_id' => $classes['Class 5']->id,
                'enquiry_date' => '2026-10-25',
                'source' => 'Referral',
                'status' => 'Contacted',
                'notes' => 'Parent inquired about school bus routes and extra-curricular clubs.',
            ],
            [
                'enquiry_no' => 'ENQ-2026-1004',
                'student_name' => 'Kabir Sengupta',
                'parent_name' => 'Prabir Sengupta',
                'mobile' => '9822334455',
                'email' => 'prabir.sen@gmail.com',
                'class_id' => $classes['Class 6']->id,
                'enquiry_date' => '2026-10-28',
                'source' => 'Social Media Campaign',
                'status' => 'New',
                'notes' => 'Inquiry received via Facebook lead campaign; requested brochure.',
            ],
            [
                'enquiry_no' => 'ENQ-2026-1005',
                'student_name' => 'Meera Nair',
                'parent_name' => 'Gopalan Nair',
                'mobile' => '9833445566',
                'email' => 'gopalan.nair@corp.com',
                'class_id' => $classes['Class 10']->id,
                'enquiry_date' => '2026-10-29',
                'source' => 'Walk-in',
                'status' => 'Contacted',
                'notes' => 'Parent transfer from Bangalore; board marks verification pending.',
            ],
            [
                'enquiry_no' => 'ENQ-2026-1006',
                'student_name' => 'Aarav Singhania',
                'parent_name' => 'Deepak Singhania',
                'mobile' => '9844556677',
                'email' => 'deepak.s@gmail.com',
                'class_id' => $classes['Class 2']->id,
                'enquiry_date' => '2026-10-30',
                'source' => 'Newspaper Ad',
                'status' => 'New',
                'notes' => 'Called reception regarding fee concessions for siblings.',
            ],
        ];

        foreach ($enquiries as $enq) {
            AdmissionEnquiry::updateOrCreate(['enquiry_no' => $enq['enquiry_no']], $enq);
        }

        // -------------------------------------------------------------
        // 13. ACADEMIC TIMETABLE
        // -------------------------------------------------------------
        $timetableSchedule = [
            ['day' => 'Monday', 'start' => '08:30:00', 'end' => '09:15:00', 'sub' => 'Mathematics', 'room' => 'Room 201'],
            ['day' => 'Monday', 'start' => '09:15:00', 'end' => '10:00:00', 'sub' => 'Physics',     'room' => 'Physics Lab'],
            ['day' => 'Monday', 'start' => '10:15:00', 'end' => '11:00:00', 'sub' => 'Chemistry',   'room' => 'Chemistry Lab'],
            ['day' => 'Monday', 'start' => '11:00:00', 'end' => '11:45:00', 'sub' => 'English',     'room' => 'Room 201'],
            ['day' => 'Tuesday', 'start' => '08:30:00', 'end' => '09:15:00', 'sub' => 'Biology',    'room' => 'Biology Lab'],
            ['day' => 'Tuesday', 'start' => '09:15:00', 'end' => '10:00:00', 'sub' => 'Mathematics','room' => 'Room 201'],
            ['day' => 'Tuesday', 'start' => '10:15:00', 'end' => '11:00:00', 'sub' => 'History',    'room' => 'Room 201'],
            ['day' => 'Wednesday', 'start' => '08:30:00', 'end' => '09:15:00', 'sub' => 'Computer Science', 'room' => 'Computer Lab 1'],
            ['day' => 'Wednesday', 'start' => '09:15:00', 'end' => '10:00:00', 'sub' => 'Physics',   'room' => 'Room 201'],
            ['day' => 'Thursday', 'start' => '08:30:00', 'end' => '09:15:00', 'sub' => 'Hindi',      'room' => 'Room 201'],
            ['day' => 'Thursday', 'start' => '09:15:00', 'end' => '10:00:00', 'sub' => 'Mathematics','room' => 'Room 201'],
            ['day' => 'Friday', 'start' => '08:30:00', 'end' => '09:15:00', 'sub' => 'Geography',   'room' => 'Room 201'],
            ['day' => 'Friday', 'start' => '09:15:00', 'end' => '10:00:00', 'sub' => 'General Science', 'room' => 'Room 201'],
        ];

        $teacherUser = $employees[0] ?? $admin;

        foreach ($timetableSchedule as $i => $slot) {
            $subj = $subjects[$slot['sub']] ?? $subjects['Mathematics'];
            Timetable::updateOrCreate(
                [
                    'class_id' => $classes['Class 10']->id,
                    'day' => $slot['day'],
                    'period_no' => $i + 1,
                ],
                [
                    'section_id' => $sections['A']->id,
                    'subject_id' => $subj->id,
                    'teacher_id' => $teacherUser->id,
                    'start_time' => $slot['start'],
                    'end_time' => $slot['end'],
                    'room_no' => $slot['room'],
                ]
            );
        }

        // -------------------------------------------------------------
        // 14. LIBRARY CATALOG & BOOK CIRCULATION
        // -------------------------------------------------------------
        $booksList = [
            ['title' => 'Concepts of Physics (Vol 1 & 2)', 'author' => 'Dr. H.C. Verma', 'isbn' => '978-8177091878', 'category' => 'Science', 'rack_no' => 'Shelf S-01', 'qty' => 12],
            ['title' => 'Mathematics for Class 10 (RD Sharma)', 'author' => 'Dr. R.D. Sharma', 'isbn' => '978-9390234110', 'category' => 'Mathematics', 'rack_no' => 'Shelf M-02', 'qty' => 15],
            ['title' => 'NCERT Exemplar Problems - Science', 'author' => 'NCERT Council', 'isbn' => '978-8174507921', 'category' => 'Science', 'rack_no' => 'Shelf S-03', 'qty' => 20],
            ['title' => 'Oxford Student Atlas for India', 'author' => 'Oxford University Press', 'isbn' => '978-0190128913', 'category' => 'Social Studies', 'rack_no' => 'Shelf G-01', 'qty' => 10],
            ['title' => 'The Discovery of India', 'author' => 'Jawaharlal Nehru', 'isbn' => '978-0143031031', 'category' => 'General Reference', 'rack_no' => 'Shelf H-04', 'qty' => 6],
            ['title' => 'Python Programming for Beginners', 'author' => 'Sumita Arora', 'isbn' => '978-8177002012', 'category' => 'Computer Science', 'rack_no' => 'Shelf C-02', 'qty' => 8],
            ['title' => 'High School English Grammar & Composition', 'author' => 'Wren & Martin', 'isbn' => '978-9352530144', 'category' => 'Languages', 'rack_no' => 'Shelf L-01', 'qty' => 18],
        ];

        $createdBooks = [];
        foreach ($booksList as $idx => $b) {
            $createdBooks[] = Book::updateOrCreate(
                ['accession_no' => 'ACC-' . (1001 + $idx)],
                [
                    'isbn' => $b['isbn'],
                    'title' => $b['title'],
                    'author' => $b['author'],
                    'publisher' => 'Academic Publishing',
                    'category' => $b['category'],
                    'rack_no' => $b['rack_no'],
                    'total_copies' => $b['qty'],
                    'available_copies' => $b['qty'] - 1, // 1 issued
                    'price' => 350.00,
                ]
            );
        }

        // Active book issues
        foreach (array_slice($studentsAssigned, 0, 3) as $k => $st) {
            if (isset($createdBooks[$k])) {
                BookIssue::updateOrCreate(
                    [
                        'book_id' => $createdBooks[$k]->id,
                        'user_id' => $st['user']->id,
                        'issue_date' => '2026-10-15',
                    ],
                    [
                        'due_date' => '2026-10-29',
                        'return_date' => ($k == 0) ? '2026-10-28' : null,
                        'status' => ($k == 0) ? 'Returned' : 'Issued',
                        'fine_amount' => ($k == 1) ? 20 : 0, // overdue fine
                    ]
                );
            }
        }

        // -------------------------------------------------------------
        // 15. TRANSPORT FLEET, ROUTES & STUDENT ALLOCATIONS
        // -------------------------------------------------------------
        $route1 = TransportRoute::updateOrCreate(
            ['route_name' => 'Route 1 - Civil Lines & Metro Station'],
            [
                'start_point' => 'Civil Lines Chowk',
                'end_point' => 'Main Campus Gate 1',
                'fare' => 1400.00,
            ]
        );

        $route2 = TransportRoute::updateOrCreate(
            ['route_name' => 'Route 2 - Sector 15 & Knowledge Park'],
            [
                'start_point' => 'Sector 15 Market',
                'end_point' => 'Main Campus Gate 2',
                'fare' => 1200.00,
            ]
        );

        $route3 = TransportRoute::updateOrCreate(
            ['route_name' => 'Route 3 - Model Town & Shastri Nagar'],
            [
                'start_point' => 'Model Town Park',
                'end_point' => 'Main Campus Gate 1',
                'fare' => 1500.00,
            ]
        );

        $bus1 = TransportVehicle::updateOrCreate(
            ['vehicle_no' => 'DL-01-SM-1044'],
            [
                'vehicle_model' => 'Tata Starbus 42-Seater',
                'driver_name' => 'Mohan Lal Sharma',
                'driver_phone' => '9871100223',
                'driver_license' => 'DL-COM-2018-9941',
                'capacity' => 42,
            ]
        );

        $bus2 = TransportVehicle::updateOrCreate(
            ['vehicle_no' => 'DL-01-SM-2088'],
            [
                'vehicle_model' => 'Ashok Leyland Sunshine 38-Seater',
                'driver_name' => 'Ramesh Chander',
                'driver_phone' => '9810055442',
                'driver_license' => 'DL-COM-2016-8812',
                'capacity' => 38,
            ]
        );

        $bus3 = TransportVehicle::updateOrCreate(
            ['vehicle_no' => 'DL-01-SM-3012'],
            [
                'vehicle_model' => 'Force Traveller 24-Seater AC',
                'driver_name' => 'Gurpreet Singh',
                'driver_phone' => '9899112233',
                'driver_license' => 'DL-COM-2020-4415',
                'capacity' => 24,
            ]
        );

        // Assign transport to students
        foreach (array_slice($studentsAssigned, 0, 4) as $idx => $st) {
            $assignedRoute = ($idx % 2 == 0) ? $route1 : $route2;
            StudentTransport::updateOrCreate(
                ['student_id' => $st['user']->id],
                [
                    'route_id' => $assignedRoute->id,
                    'pickup_point' => ($idx % 2 == 0) ? 'Metro Station Gate 2' : 'Sector 15 Market',
                    'monthly_fare' => $assignedRoute->fare,
                ]
            );
        }

        // -------------------------------------------------------------
        // 17. HOMEWORK & SUBMISSIONS
        // -------------------------------------------------------------
        $firstClass = reset($classes);
        $firstSubject = reset($subjects);
        $hw1 = Homework::updateOrCreate(
            ['title' => 'Linear Equations Exercise 4.2 Solutions'],
            [
                'class_id' => $firstClass->id,
                'subject_id' => $firstSubject->id,
                'teacher_id' => $admin->id,
                'description' => 'Complete questions 1 through 10 in your math homework notebook showing all working steps.',
                'assigned_date' => now()->toDateString(),
                'due_date' => now()->addDays(2)->toDateString(),
                'homework_date' => now()->toDateString(),
                'submission_date' => now()->addDays(2)->toDateString(),
                'max_marks' => 20,
            ]
        );

        $hw2 = Homework::updateOrCreate(
            ['title' => 'Chemical Reactions Lab Observations'],
            [
                'class_id' => $firstClass->id,
                'subject_id' => $firstSubject->id,
                'teacher_id' => $admin->id,
                'description' => 'Draw diagrams and state the law of conservation of mass from the acid-base experiment.',
                'assigned_date' => now()->toDateString(),
                'due_date' => now()->addDays(3)->toDateString(),
                'homework_date' => now()->toDateString(),
                'submission_date' => now()->addDays(3)->toDateString(),
                'max_marks' => 15,
            ]
        );

        if (!empty($studentsAssigned)) {
            $sampleStudent = $studentsAssigned[0]['user'];
            HomeworkSubmission::updateOrCreate(
                ['homework_id' => $hw1->id, 'student_id' => $sampleStudent->id],
                [
                    'submitted_at' => now(),
                    'status' => 'Graded',
                    'marks_obtained' => 18,
                    'remarks' => 'Well attempted! Neat diagrams.',
                ]
            );
        }

        // -------------------------------------------------------------
        // 18. NOTICES & CIRCULARS
        // -------------------------------------------------------------
        Notice::updateOrCreate(
            ['title' => 'CBSE Board Examination Pre-Board Schedule 2026'],
            [
                'notice_type' => 'Circular',
                'target_audience' => 'All',
                'publish_date' => now()->toDateString(),
                'expiry_date' => now()->addDays(30)->toDateString(),
                'message' => 'The pre-board examination for classes 9 and 10 will commence on 15th November 2026. Detailed datesheets have been uploaded.',
                'is_active' => 1,
                'created_by' => $admin->id,
            ]
        );

        Notice::updateOrCreate(
            ['title' => 'Annual Sports Meet & Inter-House Relay Carnival'],
            [
                'notice_type' => 'Event',
                'target_audience' => 'Students',
                'publish_date' => now()->toDateString(),
                'expiry_date' => now()->addDays(20)->toDateString(),
                'message' => 'Selections for the Annual Sports meet track and field events will take place this Thursday during zero period.',
                'is_active' => 1,
                'created_by' => $admin->id,
            ]
        );

        Notice::updateOrCreate(
            ['title' => 'Winter Vacation & Holiday Announcement'],
            [
                'notice_type' => 'Holiday',
                'target_audience' => 'All',
                'publish_date' => now()->toDateString(),
                'expiry_date' => now()->addDays(60)->toDateString(),
                'message' => 'The school will observe winter recess starting 25th December 2026 through 5th January 2027.',
                'is_active' => 1,
                'created_by' => $admin->id,
            ]
        );

        // -------------------------------------------------------------
        // 19. FRONT OFFICE VISITORS
        // -------------------------------------------------------------
        Visitor::updateOrCreate(
            ['pass_number' => 'GP-2026-1001'],
            [
                'name' => 'Vikram Singhania',
                'phone' => '9811223344',
                'purpose' => 'New Admission Enquiry for Class 6',
                'person_to_meet' => 'Principal Office',
                'id_proof_type' => 'Aadhaar Card',
                'id_proof_number' => '9988-7766-5544',
                'check_in' => now()->subHours(2),
                'check_out' => now()->subMinutes(30),
                'number_of_persons' => 2,
            ]
        );

        Visitor::updateOrCreate(
            ['pass_number' => 'GP-2026-1002'],
            [
                'name' => 'Dr. Rajesh Khanna',
                'phone' => '9822334455',
                'purpose' => 'CBSE Affiliation Inspector Visit',
                'person_to_meet' => 'Director Administration',
                'id_proof_type' => 'Driving License',
                'id_proof_number' => 'DL-04-2015-00129',
                'check_in' => now()->subMinutes(45),
                'number_of_persons' => 1,
            ]
        );

        // -------------------------------------------------------------
        // 20. INVENTORY CATEGORIES, ITEMS & ISSUES
        // -------------------------------------------------------------
        $catStationery = InventoryCategory::updateOrCreate(['name' => 'Stationery & Paper']);
        $catLab = InventoryCategory::updateOrCreate(['name' => 'Science & Computer Lab']);
        $catSports = InventoryCategory::updateOrCreate(['name' => 'Sports Equipment']);

        $item1 = InventoryItem::updateOrCreate(
            ['item_code' => 'INV-STAT-01'],
            [
                'category_id' => $catStationery->id,
                'item_name' => 'A4 Copier Paper Rim 75 GSM (JK Copier)',
                'unit' => 'Rim',
                'quantity' => 150,
                'min_quantity_alert' => 20,
                'unit_price' => 280,
                'description' => 'Standard white photocopy and exam paper sheets',
            ]
        );

        $item2 = InventoryItem::updateOrCreate(
            ['item_code' => 'INV-LAB-02'],
            [
                'category_id' => $catLab->id,
                'item_name' => 'HDMI High Speed Cable 5M',
                'unit' => 'Pcs',
                'quantity' => 25,
                'min_quantity_alert' => 5,
                'unit_price' => 450,
                'description' => 'For smart classrooms and auditorium projection',
            ]
        );

        $item3 = InventoryItem::updateOrCreate(
            ['item_code' => 'INV-SPRT-03'],
            [
                'category_id' => $catSports->id,
                'item_name' => 'Cosco Synthetic Basketball Size 7',
                'unit' => 'Pcs',
                'quantity' => 18,
                'min_quantity_alert' => 4,
                'unit_price' => 950,
                'description' => 'Standard match regulation basketballs',
            ]
        );

        InventoryIssue::updateOrCreate(
            ['item_id' => $item1->id, 'user_id' => $admin->id],
            [
                'quantity_issued' => 10,
                'issue_date' => now()->toDateString(),
                'status' => 'Issued',
                'remarks' => 'Issued for midterm exam question paper printing',
            ]
        );

        // -------------------------------------------------------------
        // 21. EXAM SCHEDULES / DATESHEET
        // -------------------------------------------------------------
        $firstExamType = reset($examTypes);
        ExamSchedule::updateOrCreate(
            [
                'exam_type_id' => $firstExamType->id,
                'class_id' => $firstClass->id,
                'subject_id' => $firstSubject->id,
            ],
            [
                'exam_date' => now()->addDays(7)->toDateString(),
                'start_time' => '09:00',
                'end_time' => '12:00',
                'room_no' => 'Exam Hall 101',
                'max_marks' => 80,
                'pass_marks' => 27,
            ]
        );

        // -------------------------------------------------------------
        // 22. HOSTEL ROOMS & ALLOTMENTS
        // -------------------------------------------------------------
        $room1 = HostelRoom::updateOrCreate(
            ['room_no' => 'H1-101'],
            [
                'hostel_name' => 'Boys Hostel - Raman Wing',
                'room_type' => 'Standard AC (3-Seater)',
                'capacity' => 3,
                'cost_per_bed' => 3500,
                'description' => 'Equipped with study desk, wardrobe and attached bath.',
            ]
        );

        $room2 = HostelRoom::updateOrCreate(
            ['room_no' => 'H2-201'],
            [
                'hostel_name' => 'Girls Hostel - Sarojini Wing',
                'room_type' => 'Standard AC (2-Seater)',
                'capacity' => 2,
                'cost_per_bed' => 4200,
                'description' => '2-seater air conditioned room with balcony.',
            ]
        );

        if (!empty($studentsAssigned)) {
            StudentHostel::updateOrCreate(
                ['student_id' => $studentsAssigned[0]['user']->id],
                [
                    'room_id' => $room1->id,
                    'allotment_date' => now()->subMonths(2)->toDateString(),
                    'status' => 'Occupied',
                    'remarks' => 'Allotted Bed 1 near window.',
                ]
            );
        }

        // -------------------------------------------------------------
        // 23. STUDENT MEDICAL HEALTH RECORDS
        // -------------------------------------------------------------
        $bloodGroups = ['O+', 'B+', 'A+', 'AB+'];
        foreach (array_slice($studentsAssigned, 0, 5) as $idx => $st) {
            StudentMedical::updateOrCreate(
                ['student_id' => $st['user']->id],
                [
                    'blood_group' => $bloodGroups[$idx % count($bloodGroups)],
                    'height_cm' => 140 + ($idx * 3.5),
                    'weight_kg' => 38 + ($idx * 2.5),
                    'known_allergies' => ($idx == 0) ? 'Peanut Allergy' : 'None reported',
                    'emergency_contact_name' => $st['user']->fname ?? 'Guardian',
                    'emergency_contact_phone' => $st['user']->mobile ?? '9876543210',
                    'medical_conditions' => ($idx == 1) ? 'Mild Asthmatic, carries inhaler' : 'Normal',
                    'last_checkup_date' => now()->subMonth()->toDateString(),
                ]
            );
        }

        // -------------------------------------------------------------
        // 24. STUDENT LEAVES
        // -------------------------------------------------------------
        if (count($studentsAssigned) >= 2) {
            StudentLeave::updateOrCreate(
                ['student_id' => $studentsAssigned[1]['user']->id],
                [
                    'class_id' => $firstClass->id,
                    'start_date' => now()->toDateString(),
                    'end_date' => now()->addDays(2)->toDateString(),
                    'reason' => 'Viral fever and doctor prescribed rest',
                    'status' => 'Pending',
                ]
            );

            StudentLeave::updateOrCreate(
                ['student_id' => $studentsAssigned[0]['user']->id],
                [
                    'class_id' => $firstClass->id,
                    'start_date' => now()->subDays(5)->toDateString(),
                    'end_date' => now()->subDays(3)->toDateString(),
                    'reason' => 'Sister wedding ceremony out of town',
                    'status' => 'Approved',
                    'approved_by' => $admin->id,
                    'remarks' => 'Leave approved by Class Teacher',
                ]
            );
        }

        // -------------------------------------------------------------
        // 25. SYSTEM AUDIT ACTIVITY LOGS
        // -------------------------------------------------------------
        ActivityLog::updateOrCreate(
            ['description' => 'System administrator logged in from office network'],
            [
                'user_id' => $admin->id,
                'user_name' => $admin->name,
                'action_type' => 'LOGIN',
                'module' => 'Authentication',
                'ip_address' => '127.0.0.1',
            ]
        );

        ActivityLog::updateOrCreate(
            ['description' => 'Generated CBSE Marks Grade thresholds matrix'],
            [
                'user_id' => $admin->id,
                'user_name' => $admin->name,
                'action_type' => 'CREATE',
                'module' => 'Examinations',
                'ip_address' => '127.0.0.1',
            ]
        );

        ActivityLog::updateOrCreate(
            ['description' => 'Dispatched monthly fee invoices for Session 2026'],
            [
                'user_id' => $admin->id,
                'user_name' => $admin->name,
                'action_type' => 'CREATE',
                'module' => 'Accounts',
                'ip_address' => '127.0.0.1',
            ]
        );
    }
}
