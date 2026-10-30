<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountControllere;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;

use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\ExamFeeController;

use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;

use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Marks\GradeController;

use App\Http\Controllers\Backend\DefaultController;

use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;

use App\Http\Controllers\Backend\Report\ProfiteController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Report\AttenReportController;
use App\Http\Controllers\Backend\Report\ResultReportController;
use App\Http\Controllers\Backend\Setup\SchoolSettingController;
use App\Http\Controllers\Backend\Setup\StudentSectionController;
use App\Http\Controllers\Backend\Student\StudentAttendanceController;
use App\Http\Controllers\Backend\Admission\AdmissionEnquiryController;
use App\Http\Controllers\Backend\Academic\TimetableController;
use App\Http\Controllers\Backend\Student\CertificateController;
use App\Http\Controllers\Backend\Library\LibraryController;
use App\Http\Controllers\Backend\Transport\TransportController;
use App\Http\Controllers\Backend\Academic\HomeworkController;
use App\Http\Controllers\Backend\Communication\NoticeController;
use App\Http\Controllers\Backend\FrontOffice\VisitorController;
use App\Http\Controllers\Backend\Inventory\InventoryController;
use App\Http\Controllers\Backend\Exam\ExamScheduleController;
use App\Http\Controllers\Backend\Hostel\HostelController;
use App\Http\Controllers\Backend\Student\StudentMedicalController;
use App\Http\Controllers\Backend\Student\StudentLeaveController;
use App\Http\Controllers\Backend\System\ActivityLogController;
use App\Http\Controllers\Backend\Portal\PortalController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'],function(){
   
   


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');
 
 
Route::group(['middleware' => 'auth'],function(){


 // User Management All Routes 

Route::prefix('users')->group(function(){

Route::get('/view', [UserController::class, 'UserView'])->name('user.view');

Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');

Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');

Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');

Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');

}); 

/// User Profile and Change Password 
Route::prefix('profile')->group(function(){

Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

}); 



/// User Profile and Change Password 
Route::prefix('setups')->group(function(){

// Student Class Routes 
Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');

Route::get('student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');

Route::post('student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');

Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');

Route::post('student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');

Route::get('student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');

// Student Year Routes 

Route::get('student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');

Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');

Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');

Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');

Route::post('student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');

Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');


// Student Group Routes 

Route::get('student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');

Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');

Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');

Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');

Route::post('student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');

Route::get('student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');

// Student Shift Routes 

Route::get('student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');

Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');

Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');

Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');

Route::post('student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');

Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');


// Fee Category Routes 

Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');

Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');

Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.category');

Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');

Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCategoryUpdate'])->name('update.fee.category');

Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');

// Fee Category Amount Routes 

Route::get('fee/amount/view', [FeeAmountControllere::class, 'ViewFeeAmount'])->name('fee.amount.view');

Route::get('fee/amount/add', [FeeAmountControllere::class, 'AddFeeAmount'])->name('fee.amount.add');

Route::post('fee/amount/store', [FeeAmountControllere::class, 'StoreFeeAmount'])->name('store.fee.amount');

Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountControllere::class, 'EditFeeAmount'])->name('fee.amount.edit');

Route::post('fee/amount/update/{fee_category_id}', [FeeAmountControllere::class, 'UpdateFeeAmount'])->name('update.fee.amount');

Route::get('fee/amount/details/{fee_category_id}', [FeeAmountControllere::class, 'DetailsFeeAmount'])->name('fee.amount.details');


// Exam Type Routes 

Route::get('exam/type/view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');

Route::get('exam/type/add', [ExamTypeController::class, 'ExamTypeAdd'])->name('exam.type.add');

Route::post('exam/type/store', [ExamTypeController::class, 'ExamTypeStore'])->name('store.exam.type');

Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');

Route::post('exam/type/update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('update.exam.type');

Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');


// School Subject All Routes 

Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSubject'])->name('school.subject.view');

Route::get('school/subject/add', [SchoolSubjectController::class, 'SubjectAdd'])->name('school.subject.add');

Route::post('school/subject/store', [SchoolSubjectController::class, 'SubjectStore'])->name('store.school.subject');

Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'SubjectEdit'])->name('school.subject.edit');

Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'SubjectUpdate'])->name('update.school.subject');

Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'SubjectDelete'])->name('school.subject.delete');


// Assign Subject Routes 

Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');

Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');

Route::post('assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');

Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');

Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');

Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'DetailsAssignSubject'])->name('assign.subject.details');


// Designation All Routes 

Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');

Route::get('designation/add', [DesignationController::class, 'DesignationAdd'])->name('designation.add');

Route::post('designation/store', [DesignationController::class, 'DesignationStore'])->name('store.designation');

Route::get('designation/edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');

Route::post('designation/update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('update.designation');

Route::get('designation/delete/{id}', [DesignationController::class, 'DesignationDelete'])->name('designation.delete');


}); 


/// Student Registration Routes  
Route::prefix('students')->group(function(){

Route::get('/reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');

Route::get('/reg/Add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');

Route::post('/reg/store', [StudentRegController::class, 'StudentRegStore'])->name('store.student.registration');
 
Route::get('/year/class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');

Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');

Route::post('/reg/update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('update.student.registration');

Route::get('/reg/promotion/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');

Route::post('/reg/update/promotion/{student_id}', [StudentRegController::class, 'StudentUpdatePromotion'])->name('promotion.student.registration');

Route::get('/reg/details/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');

// Student Roll Generate Routes 
Route::get('/roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');

Route::get('/reg/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');

Route::post('/roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');

// Registration Fee Routes 
Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');

Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');

Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePayslip'])->name('student.registration.fee.payslip');


// Monthly Fee Routes 
Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');

Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');

Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePayslip'])->name('student.monthly.fee.payslip');

// Exam Fee Routes 
Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');

Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');

Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePayslip'])->name('student.exam.fee.payslip');

}); 



/// Employee Registration Routes
Route::prefix('employees')->group(function(){

Route::get('reg/employee/view', [EmployeeRegController::class, 'EmployeeView'])->name('employee.registration.view');

Route::get('reg/employee/add', [EmployeeRegController::class, 'EmployeeAdd'])->name('employee.registration.add');

Route::post('reg/employee/store', [EmployeeRegController::class, 'EmployeeStore'])->name('store.employee.registration');
 
Route::get('reg/employee/edit/{id}', [EmployeeRegController::class, 'EmployeeEdit'])->name('employee.registration.edit');

Route::post('reg/employee/update/{id}', [EmployeeRegController::class, 'EmployeeUpdate'])->name('update.employee.registration');

Route::get('reg/employee/details/{id}', [EmployeeRegController::class, 'EmployeeDetails'])->name('employee.registration.details');

// Employee Salary All Routes 
Route::get('salary/employee/view', [EmployeeSalaryController::class, 'SalaryView'])->name('employee.salary.view');

Route::get('salary/employee/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');

Route::post('salary/employee/store/{id}', [EmployeeSalaryController::class, 'SalaryStore'])->name('update.increment.store');

Route::get('salary/employee/details/{id}', [EmployeeSalaryController::class, 'SalaryDetails'])->name('employee.salary.details');


// Employee Leave All Routes 
Route::get('leave/employee/view', [EmployeeLeaveController::class, 'LeaveView'])->name('employee.leave.view');

Route::get('leave/employee/add', [EmployeeLeaveController::class, 'LeaveAdd'])->name('employee.leave.add');

Route::post('leave/employee/store', [EmployeeLeaveController::class, 'LeaveStore'])->name('store.employee.leave');

Route::get('leave/employee/edit/{id}', [EmployeeLeaveController::class, 'LeaveEdit'])->name('employee.leave.edit');

Route::post('leave/employee/update/{id}', [EmployeeLeaveController::class, 'LeaveUpdate'])->name('update.employee.leave');

Route::get('leave/employee/delete/{id}', [EmployeeLeaveController::class, 'LeaveDelete'])->name('employee.leave.delete');


// Employee Attendance All Routes 
Route::get('attendance/employee/view', [EmployeeAttendanceController::class, 'AttendanceView'])->name('employee.attendance.view');

Route::get('attendance/employee/add', [EmployeeAttendanceController::class, 'AttendanceAdd'])->name('employee.attendance.add');

Route::post('attendance/employee/store', [EmployeeAttendanceController::class, 'AttendanceStore'])->name('store.employee.attendance');

Route::get('attendance/employee/edit/{date}', [EmployeeAttendanceController::class, 'AttendanceEdit'])->name('employee.attendance.edit');

Route::get('attendance/employee/details/{date}', [EmployeeAttendanceController::class, 'AttendanceDetails'])->name('employee.attendance.details');


// Employee Monthly Salary All Routes 
Route::get('monthly/salary/view', [MonthlySalaryController::class, 'MonthlySalaryView'])->name('employee.monthly.salary');

Route::get('monthly/salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');

Route::get('monthly/salary/payslip/{employee_id}', [MonthlySalaryController::class, 'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');


}); 


/// Marks Management Routes  
Route::prefix('marks')->group(function(){

Route::get('marks/entry/add', [MarksController::class, 'MarksAdd'])->name('marks.entry.add');

Route::post('marks/entry/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store'); 

Route::get('marks/entry/edit', [MarksController::class, 'MarksEdit'])->name('marks.entry.edit'); 

Route::get('marks/getstudents/edit', [MarksController::class, 'MarksEditGetStudents'])->name('student.edit.getstudents');

Route::post('marks/entry/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');  

// Marks Entry Grade 

Route::get('marks/grade/view', [GradeController::class, 'MarksGradeView'])->name('marks.entry.grade');

Route::get('marks/grade/add', [GradeController::class, 'MarksGradeAdd'])->name('marks.grade.add');

Route::post('marks/grade/store', [GradeController::class, 'MarksGradeStore'])->name('store.marks.grade');

Route::get('marks/grade/edit/{id}', [GradeController::class, 'MarksGradeEdit'])->name('marks.grade.edit');

Route::post('marks/grade/update/{id}', [GradeController::class, 'MarksGradeUpdate'])->name('update.marks.grade');

}); 
 
Route::get('marks/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');

Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');





/// Account Management Routes  
Route::prefix('accounts')->group(function(){

Route::get('student/fee/view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');

Route::get('student/fee/add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');

Route::get('student/fee/getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('account.fee.getstudent'); 

Route::post('student/fee/store', [StudentFeeController::class, 'StudentFeeStore'])->name('account.fee.store'); 

// Employee Salary Routes
Route::get('account/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');

Route::get('account/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');

Route::get('account/salary/getemployee', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');

Route::post('account/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');

// Other Cost Rotues 

Route::get('other/cost/view', [OtherCostController::class, 'OtherCostView'])->name('other.cost.view');

Route::get('other/cost/add', [OtherCostController::class, 'OtherCostAdd'])->name('other.cost.add');

Route::post('other/cost/store', [OtherCostController::class, 'OtherCostStore'])->name('store.other.cost');

Route::get('other/cost/edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('edit.other.cost');

Route::post('other/cost/update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('update.other.cost');

}); 




/// Report Management All Routes  
Route::prefix('reports')->group(function(){

Route::get('monthly/profit/view', [ProfiteController::class, 'MonthlyProfitView'])->name('monthly.profit.view');

Route::get('monthly/profit/datewais', [ProfiteController::class, 'MonthlyProfitDatewais'])->name('report.profit.datewais.get');

Route::get('monthly/profit/pdf', [ProfiteController::class, 'MonthlyProfitPdf'])->name('report.profit.pdf');

// MarkSheet Generate Routes 
Route::get('marksheet/generate/view', [MarkSheetController::class, 'MarkSheetView'])->name('marksheet.generate.view');

Route::get('marksheet/generate/get', [MarkSheetController::class, 'MarkSheetGet'])->name('report.marksheet.get');


// Attendance Report Routes 
Route::get('attendance/report/view', [AttenReportController::class, 'AttenReportView'])->name('attendance.report.view');

Route::get('report/attendance/get', [AttenReportController::class, 'AttenReportGet'])->name('report.attendance.get');

// Student Result Report Routes 
Route::get('student/result/view', [ResultReportController::class, 'ResultView'])->name('student.result.view');

Route::get('student/result/get', [ResultReportController::class, 'ResultGet'])->name('report.student.result.get');

// Student ID Card Routes 
Route::get('student/idcard/view', [ResultReportController::class, 'IdcardView'])->name('student.idcard.view');

Route::get('student/idcard/get', [ResultReportController::class, 'IdcardGet'])->name('report.student.idcard.get');

}); 


/// School Profile & Master Settings Routes
Route::prefix('school')->group(function(){
    Route::get('/profile/view', [SchoolSettingController::class, 'SchoolProfileView'])->name('school.profile.view');
    Route::post('/profile/update', [SchoolSettingController::class, 'SchoolProfileUpdate'])->name('school.profile.update');
});

/// Section Setup Routes
Route::prefix('setups')->group(function(){
    Route::get('/section/view', [StudentSectionController::class, 'ViewSection'])->name('student.section.view');
    Route::get('/section/add', [StudentSectionController::class, 'AddSection'])->name('student.section.add');
    Route::post('/section/store', [StudentSectionController::class, 'StoreSection'])->name('student.section.store');
    Route::get('/section/edit/{id}', [StudentSectionController::class, 'EditSection'])->name('student.section.edit');
    Route::post('/section/update/{id}', [StudentSectionController::class, 'UpdateSection'])->name('student.section.update');
    Route::get('/section/delete/{id}', [StudentSectionController::class, 'DeleteSection'])->name('student.section.delete');
});

/// Student Attendance Routes
Route::prefix('students/attendance')->group(function(){
    Route::get('/view', [StudentAttendanceController::class, 'AttendanceView'])->name('student.attendance.view');
    Route::get('/add', [StudentAttendanceController::class, 'AttendanceAdd'])->name('student.attendance.add');
    Route::post('/store', [StudentAttendanceController::class, 'AttendanceStore'])->name('student.attendance.store');
    Route::get('/edit/{date}/{class_id}', [StudentAttendanceController::class, 'AttendanceEdit'])->name('student.attendance.edit');
    Route::get('/details/{date}/{class_id}', [StudentAttendanceController::class, 'AttendanceDetails'])->name('student.attendance.details');
});

/// Admission CRM & Enquiries Routes
Route::prefix('admissions/enquiry')->group(function(){
    Route::get('/view', [AdmissionEnquiryController::class, 'EnquiryView'])->name('admission.enquiry.view');
    Route::get('/add', [AdmissionEnquiryController::class, 'EnquiryAdd'])->name('admission.enquiry.add');
    Route::post('/store', [AdmissionEnquiryController::class, 'EnquiryStore'])->name('admission.enquiry.store');
    Route::get('/edit/{id}', [AdmissionEnquiryController::class, 'EnquiryEdit'])->name('admission.enquiry.edit');
    Route::post('/update/{id}', [AdmissionEnquiryController::class, 'EnquiryUpdate'])->name('admission.enquiry.update');
    Route::post('/status/{id}', [AdmissionEnquiryController::class, 'EnquiryStatusUpdate'])->name('admission.enquiry.status');
    Route::get('/delete/{id}', [AdmissionEnquiryController::class, 'EnquiryDelete'])->name('admission.enquiry.delete');
});

/// Academic Timetable Routes
Route::prefix('academic/timetable')->group(function(){
    Route::get('/view', [TimetableController::class, 'TimetableView'])->name('academic.timetable.view');
    Route::get('/add', [TimetableController::class, 'TimetableAdd'])->name('academic.timetable.add');
    Route::post('/store', [TimetableController::class, 'TimetableStore'])->name('academic.timetable.store');
    Route::get('/delete/{id}', [TimetableController::class, 'TimetableDelete'])->name('academic.timetable.delete');
});

/// Student Certificate (TC & Bonafide) Routes
Route::prefix('certificates')->group(function(){
    Route::get('/tc/view', [CertificateController::class, 'TCView'])->name('certificate.tc.view');
    Route::get('/tc/pdf/{student_id}', [CertificateController::class, 'TCPDF'])->name('certificate.tc.pdf');
    Route::get('/bonafide/view', [CertificateController::class, 'BonafideView'])->name('certificate.bonafide.view');
    Route::get('/bonafide/pdf/{student_id}', [CertificateController::class, 'BonafidePDF'])->name('certificate.bonafide.pdf');
});

/// Library Management Routes
Route::prefix('library')->group(function(){
    Route::get('/book/view', [LibraryController::class, 'BookView'])->name('library.book.view');
    Route::get('/book/add', [LibraryController::class, 'BookAdd'])->name('library.book.add');
    Route::post('/book/store', [LibraryController::class, 'BookStore'])->name('library.book.store');
    Route::get('/book/edit/{id}', [LibraryController::class, 'BookEdit'])->name('library.book.edit');
    Route::post('/book/update/{id}', [LibraryController::class, 'BookUpdate'])->name('library.book.update');
    Route::get('/book/delete/{id}', [LibraryController::class, 'BookDelete'])->name('library.book.delete');

    Route::get('/issue/view', [LibraryController::class, 'IssueView'])->name('library.issue.view');
    Route::get('/issue/add', [LibraryController::class, 'IssueAdd'])->name('library.issue.add');
    Route::post('/issue/store', [LibraryController::class, 'IssueStore'])->name('library.issue.store');
    Route::get('/issue/return/{id}', [LibraryController::class, 'IssueReturn'])->name('library.issue.return');
});

/// Transport Management Routes
Route::prefix('transport')->group(function(){
    Route::get('/vehicle/view', [TransportController::class, 'VehicleView'])->name('transport.vehicle.view');
    Route::get('/vehicle/add', [TransportController::class, 'VehicleAdd'])->name('transport.vehicle.add');
    Route::post('/vehicle/store', [TransportController::class, 'VehicleStore'])->name('transport.vehicle.store');
    Route::get('/vehicle/edit/{id}', [TransportController::class, 'VehicleEdit'])->name('transport.vehicle.edit');
    Route::post('/vehicle/update/{id}', [TransportController::class, 'VehicleUpdate'])->name('transport.vehicle.update');
    Route::get('/vehicle/delete/{id}', [TransportController::class, 'VehicleDelete'])->name('transport.vehicle.delete');

    Route::get('/route/view', [TransportController::class, 'RouteView'])->name('transport.route.view');
    Route::get('/route/add', [TransportController::class, 'RouteAdd'])->name('transport.route.add');
    Route::post('/route/store', [TransportController::class, 'RouteStore'])->name('transport.route.store');
    Route::get('/route/edit/{id}', [TransportController::class, 'RouteEdit'])->name('transport.route.edit');
    Route::post('/route/update/{id}', [TransportController::class, 'RouteUpdate'])->name('transport.route.update');
    Route::get('/route/delete/{id}', [TransportController::class, 'RouteDelete'])->name('transport.route.delete');

    Route::get('/student/view', [TransportController::class, 'StudentTransportView'])->name('transport.student.view');
    Route::get('/student/add', [TransportController::class, 'StudentTransportAdd'])->name('transport.student.add');
    Route::post('/student/store', [TransportController::class, 'StudentTransportStore'])->name('transport.student.store');
    Route::get('/student/delete/{id}', [TransportController::class, 'StudentTransportDelete'])->name('transport.student.delete');
});

/// Homework & Assignment Routes
Route::prefix('academic/homework')->group(function(){
    Route::get('/view', [HomeworkController::class, 'HomeworkView'])->name('homework.view');
    Route::get('/add', [HomeworkController::class, 'HomeworkAdd'])->name('homework.add');
    Route::post('/store', [HomeworkController::class, 'HomeworkStore'])->name('homework.store');
    Route::get('/submissions/{id}', [HomeworkController::class, 'HomeworkSubmissions'])->name('homework.submissions');
    Route::post('/grade/{id}', [HomeworkController::class, 'HomeworkGradeStore'])->name('homework.grade.store');
    Route::get('/delete/{id}', [HomeworkController::class, 'HomeworkDelete'])->name('homework.delete');
});

/// Notice & Circular Routes
Route::prefix('communication/notice')->group(function(){
    Route::get('/view', [NoticeController::class, 'NoticeView'])->name('notice.view');
    Route::get('/add', [NoticeController::class, 'NoticeAdd'])->name('notice.add');
    Route::post('/store', [NoticeController::class, 'NoticeStore'])->name('notice.store');
    Route::get('/delete/{id}', [NoticeController::class, 'NoticeDelete'])->name('notice.delete');
});

/// Front Office & Visitor Routes
Route::prefix('frontoffice/visitor')->group(function(){
    Route::get('/view', [VisitorController::class, 'VisitorView'])->name('visitor.view');
    Route::get('/add', [VisitorController::class, 'VisitorAdd'])->name('visitor.add');
    Route::post('/store', [VisitorController::class, 'VisitorStore'])->name('visitor.store');
    Route::get('/checkout/{id}', [VisitorController::class, 'VisitorCheckOut'])->name('visitor.checkout');
    Route::get('/gatepass/{id}', [VisitorController::class, 'VisitorGatePass'])->name('visitor.gatepass');
    Route::get('/delete/{id}', [VisitorController::class, 'VisitorDelete'])->name('visitor.delete');
});

/// Inventory & Asset Store Routes
Route::prefix('inventory')->group(function(){
    Route::get('/item/view', [InventoryController::class, 'ItemView'])->name('inventory.item.view');
    Route::get('/item/add', [InventoryController::class, 'ItemAdd'])->name('inventory.item.add');
    Route::post('/item/store', [InventoryController::class, 'ItemStore'])->name('inventory.item.store');
    Route::get('/item/delete/{id}', [InventoryController::class, 'ItemDelete'])->name('inventory.item.delete');

    Route::get('/issue/view', [InventoryController::class, 'IssueView'])->name('inventory.issue.view');
    Route::get('/issue/add', [InventoryController::class, 'IssueAdd'])->name('inventory.issue.add');
    Route::post('/issue/store', [InventoryController::class, 'IssueStore'])->name('inventory.issue.store');
    Route::get('/issue/return/{id}', [InventoryController::class, 'IssueReturn'])->name('inventory.issue.return');
});

/// Examination Datesheet & Admit Card Routes
Route::prefix('exam/schedule')->group(function(){
    Route::get('/view', [ExamScheduleController::class, 'DatesheetView'])->name('exam.schedule.view');
    Route::get('/add', [ExamScheduleController::class, 'DatesheetAdd'])->name('exam.schedule.add');
    Route::post('/store', [ExamScheduleController::class, 'DatesheetStore'])->name('exam.schedule.store');
    Route::get('/delete/{id}', [ExamScheduleController::class, 'DatesheetDelete'])->name('exam.schedule.delete');

    Route::get('/admitcard/view', [ExamScheduleController::class, 'AdmitCardView'])->name('exam.admitcard.view');
    Route::get('/admitcard/pdf', [ExamScheduleController::class, 'AdmitCardPdf'])->name('exam.admitcard.pdf');
});

/// Hostel & Boarding Routes
Route::prefix('hostel')->group(function(){
    Route::get('/room/view', [HostelController::class, 'RoomView'])->name('hostel.room.view');
    Route::get('/room/add', [HostelController::class, 'RoomAdd'])->name('hostel.room.add');
    Route::post('/room/store', [HostelController::class, 'RoomStore'])->name('hostel.room.store');

    Route::get('/allotment/view', [HostelController::class, 'AllotmentView'])->name('hostel.allotment.view');
    Route::get('/allotment/add', [HostelController::class, 'AllotmentAdd'])->name('hostel.allotment.add');
    Route::post('/allotment/store', [HostelController::class, 'AllotmentStore'])->name('hostel.allotment.store');
    Route::get('/allotment/vacate/{id}', [HostelController::class, 'AllotmentVacate'])->name('hostel.allotment.vacate');
});

/// Student Health & Medical Records Routes
Route::prefix('students/medical')->group(function(){
    Route::get('/view', [StudentMedicalController::class, 'MedicalView'])->name('student.medical.view');
    Route::get('/edit/{student_id}', [StudentMedicalController::class, 'MedicalEdit'])->name('student.medical.edit');
    Route::post('/update/{student_id}', [StudentMedicalController::class, 'MedicalUpdate'])->name('student.medical.update');
});

/// Student Leave Routes
Route::prefix('students/leave')->group(function(){
    Route::get('/view', [StudentLeaveController::class, 'LeaveView'])->name('student.leave.view');
    Route::get('/add', [StudentLeaveController::class, 'LeaveAdd'])->name('student.leave.add');
    Route::post('/store', [StudentLeaveController::class, 'LeaveStore'])->name('student.leave.store');
    Route::get('/approve/{id}', [StudentLeaveController::class, 'LeaveApprove'])->name('student.leave.approve');
    Route::get('/reject/{id}', [StudentLeaveController::class, 'LeaveReject'])->name('student.leave.reject');
});

/// System Audit & Activity Logs Routes
Route::prefix('system')->group(function(){
    Route::get('/activity/log', [ActivityLogController::class, 'LogView'])->name('system.activity.log');
});

/// Portals (Parent, Student, Teacher) Routes
Route::prefix('portal')->group(function(){
    Route::get('/parent', [PortalController::class, 'ParentDashboard'])->name('portal.parent.dashboard');
    Route::get('/student', [PortalController::class, 'StudentDashboard'])->name('portal.student.dashboard');
    Route::get('/teacher', [PortalController::class, 'TeacherDashboard'])->name('portal.teacher.dashboard');
});


 

}); // End Middleare Auth Route 

});  // Prevent Back Middleare