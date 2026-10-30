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
    }
}
