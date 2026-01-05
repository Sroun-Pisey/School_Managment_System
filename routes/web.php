<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Setup\StudyTimeController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Report\AttendanceReportController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\Backend\Report\ResultReportController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'],function(){


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
// Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');

});


// User Management All Routes
Route::prefix('user')->group(function(){
Route::controller(UserController::class)->group(function () {
    Route::get('/view', 'UserView')->name('user.view');
    Route::get('/add', 'UserAdd')->name('user.add');
    Route::post('/store', 'UserStore')->name('user.store');
    Route::get('/edit/{id}', 'UserEdit')->name('user.edit');

    Route::post('/update/{id}', 'UserUpdate')->name('user.update');
    Route::get('/delete/{id}', 'UserDelete')->name('user.delete');
});
});//End Prefix User


// User Profile And Change Password All Routes
Route::prefix('profile')->group(function(){
Route::controller(ProfileController::class)->group(function () {
    Route::get('/view', 'ProfileView')->name('profile.view');
    Route::get('/edit', 'ProfileEdit')->name('profile.edit');
    Route::post('/store', 'ProfileStore')->name('profile.store');
    
    Route::get('/password/view', 'PasswordView')->name('password.view');
    Route::post('/password/update', 'PasswordUpdate')->name('password.update');
});
});//End Prefix Profile


// Setup Management All Routes
Route::prefix('setup')->group(function(){
Route::controller(StudentClassController::class)->group(function () {
    Route::get('/student/class/view', 'ViewStudent')->name('student.class.view');
    Route::get('/student/class/add', 'StudentClassAdd')->name('student.class.add');
    Route::post('/store/student/class', 'StudentClassStore')->name('store.student.class');
    Route::get('/student/class/edit/{id}', 'StudentClassEdit')->name('student.class.edit');
    Route::post('/update/student/class/{id}', 'StudentClassUpdate')->name('update.student.class');
    Route::get('/student/class/delete/{id}', 'StudentClassDelete')->name('student.class.delete');
});


//Student Year All Routes
Route::controller(StudentYearController::class)->group(function () {
    Route::get('/student/year/view', 'ViewYear')->name('student.year.view');
    Route::get('/student/year/add', 'StudentYearAdd')->name('student.year.add');
    Route::post('/store/student/year', 'StudentYearStore')->name('store.student.year');
    Route::get('/student/year/edit/{id}', 'StudentYearEdit')->name('student.year.edit');
    Route::post('/update/student/year/{id}', 'StudentYearUpdate')->name('update.student.year');
    Route::get('/student/year/delete/{id}', 'StudentYearDelete')->name('student.year.delete');
});


Route::controller(StudyTimeController::class)->group(function () {
    Route::get('/study/time/view', 'ViewStudyTime')->name('study.time.view');
    Route::get('/study/time/add', 'StudyTimeAdd')->name('study.time.add');
    Route::post('/store/study/time', 'StudyTimeStore')->name('store.study.time');
    Route::get('/study/time/edit/{id}', 'StudyTimeEdit')->name('study.time.edit');
    Route::post('/update/study/time/{id}', 'StudyTimeUpdate')->name('update.study.time');
    Route::get('/study/time/delete/{id}', 'StudyTimeDelete')->name('study.time.delete');
});


//Fee Category All Routes
Route::controller(FeeCategoryController::class)->group(function () {
    Route::get('/fee/category/view', 'ViewFeeCat')->name('fee.category.view');
    Route::get('/fee/category/add', 'FeeCatAdd')->name('fee.category.add');
    Route::post('/store/fee/category', 'FeeCatStore')->name('store.fee.category');
    Route::get('/fee/category/edit/{id}', 'FeeCatEdit')->name('fee.category.edit');
    Route::post('/update/fee/category/{id}', 'FeeCatUpdate')->name('update.fee.category');
    Route::get('/fee/category/delete/{id}', 'FeeCatDelete')->name('fee.category.delete');
});


//Fee Amount All Routes
Route::controller(FeeAmountController::class)->group(function () {
    Route::get('/fee/amount/view', 'ViewFeeAmount')->name('fee.amount.view');
    Route::get('/fee/amount/add', 'AddFeeAmount')->name('fee.amount.add');
    Route::post('/store/fee/amount', 'StoreFeeAmount')->name('store.fee.amount');
    Route::get('/fee/amount/edit/{id}', 'FeeAmountEdit')->name('fee.amount.edit');
    Route::post('/update/fee/amount/{fee_category_id}', 'FeeAmountUpdate')->name('update.fee.amount');
    Route::get('/fee/amount/details/{fee_category_id}', 'FeeAmountDetails')->name('fee.amount.details');
});


//School Subject All Routes
Route::controller(SchoolSubjectController::class)->group(function () {
    Route::get('/school/subject/view', 'ViewSchoolSubject')->name('school.subject.view');
    Route::get('/school/subject/add', 'AddSubject')->name('school.subject.add');
    Route::post('/store/school/subject', 'StoreSubject')->name('store.school.subject');
    Route::get('/school/subject/edit/{id}', 'SchoolSubjectEdit')->name('school.subject.edit');
    Route::post('/update/school/subject/{id}', 'SchoolSubjectUpdate')->name('update.school.subject');
    Route::get('/school/subject/delete/{id}', 'SchoolSubjectDelete')->name('school.subject.delete');
});



//Designation All Routes
Route::controller(DesignationController::class)->group(function () {
    Route::get('/designation/view', 'ViewDesignation')->name('designation.view');
    Route::get('/designation/add', 'AddDesignation')->name('designation.add');
    Route::post('/store/designation', 'StoreDesignation')->name('store.designation');
    Route::get('/designation/edit/{id}', 'DesignationEdit')->name('designation.edit');
    Route::post('/update/designation/{id}', 'DesignationUpdate')->name('update.designation');
    Route::get('/designation/delete/{id}', 'DesignationDelete')->name('designation.delete');
});
});//End Prefix setup


//Registration All Routes
Route::prefix('student')->group(function(){
Route::controller(StudentRegController::class)->group(function () {
    Route::get('/registration/view', 'StudentRegView')->name('student.registration.view');
    Route::get('/registration/add', 'StudentRegAdd')->name('student.registration.add');
    Route::post('/store/student/registration', 'StudentRegStore')->name('store.student.registration');
    Route::get('/year/class/wise', 'StudentClassYearWise')->name('student.year.class.wise');
    Route::get('/reg/edit/{student_id}', 'StudentRegEdit')->name('student.registration.edit');
    Route::post('/reg/update/{student_id}', 'StudentRegUpdate')->name('update.student.registration');
    Route::get('/reg/promotion/{student_id}', 'StudentRegPromotion')->name('student.registration.promotion');
    Route::post('/reg/update/promotion/{student_id}', 'StudentUpdatePromotion')->name('promotion.student.registration');
    Route::get('/reg/details/{student_id}', 'StudentRegDetails')->name('student.registration.details');
});


//Roll Registration All Routes
Route::controller(RegistrationFeeController::class)->group(function () {
    Route::get('/reg/fee/view', 'RegFeeView')->name('registration.fee.view');
    Route::get('/reg/fee/classwisedata', 'RegFeeClassData')->name('student.registration.fee.classwise.get');
    Route::get('/reg/fee/payslip', 'RegFeePayslip')->name('student.registration.fee.payslip');
});



//Roll Monthly Fee All Routes
Route::controller(MonthlyFeeController::class)->group(function () {
    Route::get('/monthly/fee/view', 'MonthlyFeeView')->name('monthly.fee.view');
    Route::get('/monthly/fee/classwisedata', 'MonthlyFeeClassData')->name('student.monthly.fee.classwise.get');
    Route::get('/monthly/fee/payslip', 'MonthlyFeePayslip')->name('student.monthly.fee.payslip');
});
});//End Prefix Student


//Employee Registration All Routes
Route::prefix('employee')->group(function(){
Route::controller(EmployeeRegController::class)->group(function () {
    Route::get('/registration/view', 'EmployeeView')->name('employee.registration.view');
    Route::get('/reg/employee/add', 'EmployeeAdd')->name('employee.registration.add');
    Route::post('/reg/employee/store', 'EmployeeStore')->name('store.employee.registration');
    Route::get('/reg/employee/edit/{id}', 'EmployeeEdit')->name('employee.registration.edit');
    Route::post('/reg/employee/update/{id}', 'EmployeeUpdate')->name('update.employee.registration');
    Route::get('/reg/employee/details/{id}', 'EmployeeDetails')->name('employee.registration.details');
});//Employee Registration


//Employee Salary All Routes
Route::controller(EmployeeSalaryController::class)->group(function () {
    Route::get('/salary/view', 'SalaryView')->name('employee.salary.view');
    Route::get('/salary/employee/increment/{id}', 'EmployeeIncrement')->name('employee.salary.increment');
    Route::post('/salary/employee/store/{id}', 'SalaryStore')->name('update.increment.store');
    Route::get('/salary/employee/details/{id}', 'SalaryDetails')->name('employee.increment.details');

});



//Employee Salary All Routes
Route::controller(EmployeeLeaveController::class)->group(function () {
    Route::get('/leave/view', 'LeaveView')->name('employee.leave.view');
    Route::get('/leave/employee/add', 'LeaveAdd')->name('employee.leave.add');
    Route::post('/leave/employee/store', 'LeaveStore')->name('store.employee.leave');
    Route::get('/leave/employee/edit{id}', 'LeaveEdit')->name('employee.leave.edit');
    Route::post('/leave/employee/update{id}', 'LeaveUpdate')->name('update.employee.leave');
    Route::get('/leave/employee/delete{id}', 'LeaveDelete')->name('employee.leave.delete');


});



//Employee Attendance All Routes
Route::controller(EmployeeAttendanceController::class)->group(function () {
    Route::get('/attendance/view', 'AttendanceView')->name('employee.attendance.view');
    Route::get('/attendance/add', 'AttendanceAdd')->name('employee.attendance.add');
    Route::post('/attendance/store', 'AttendanceStore')->name('store.employee.attendance');
    Route::get('/attendance/edit{date}', 'AttendanceEdit')->name('employee.attendance.edit');
    Route::get('/attendance/details{date}', 'AttendanceDetails')->name('employee.attendance.details');
    Route::get('/attendance/delete{date}', 'AttendanceDelete')->name('employee.attendance.delete');

});



//Employee Monthly Salary All Routes
Route::controller(MonthlySalaryController::class)->group(function () {
    Route::get('/monthly/salary/view', 'MonthlySalaryView')->name('employee.monthly.salary');
    Route::get('/monthly/salary/get', 'MonthlySalaryGet')->name('employee.monthly.salary.get');
    Route::get('/monthly/salary/payslip/{employee_id}', 'MonthlySalaryPayslip')->name('employee.monthly.salary.payslip');


});
});//End Prefix Employee


//Accounts Management All Routes
Route::prefix('accounts')->group(function(){
Route::controller(StudentFeeController::class)->group(function () {
    Route::get('student/fee/view', 'StudentFeeView')->name('student.fee.view');
    Route::get('student/fee/add', 'StudentFeeAdd')->name('student.fee.add');
    Route::get('student/fee/getstudent', 'StudentFeeGetStudent')->name('account.fee.getstudent');
    Route::post('student/fee/store', 'StudentFeeStore')->name('account.fee.store');
    
});


//Employee Salary All Routes
Route::controller(AccountSalaryController::class)->group(function () {
    Route::get('account/salary/view', 'AccountSalaryView')->name('account.salary.view');
    Route::get('account/salary/add', 'AccountSalaryAdd')->name('account.salary.add');
    Route::get('account/salary/getemployee', 'AccountSalaryGetEmployee')->name('account.salary.getemployee');
    Route::post('account/salary/store', 'AccountSalaryStore')->name('account.salary.store');


});



//Other Cost All Routes
Route::controller(OtherCostController::class)->group(function () {
    Route::get('other/cost/view', 'OtherCostView')->name('other.cost.view');
    Route::get('other/cost/add', 'OtherCostAdd')->name('other.cost.add');
    Route::post('other/cost/store', 'OtherCostStore')->name('store.other.cost');
    Route::get('other/cost/edit{id}', 'OtherCostEdit')->name('edit.other.cost');
    Route::post('other/cost/update{id}', 'OtherCostUpdate')->name('update.other.cost');
    Route::get('/other/cost/delete/{id}', 'OtherCostDelete')->name('delete.other.cost');

});
});//End Prefix Accounts Management



//Report Management All Routes
Route::prefix('reports')->group(function(){
Route::controller(ProfitController::class)->group(function () {
    Route::get('monthly/profit/view', 'MonthlyProfitView')->name('monthly.profit.view');
    Route::get('monthly/profit/datewais', 'MonthlyProfitDatewais')->name('report.profit.datewais.get');
    Route::get('monthly/profit/pdf', 'MonthlyProfitPdf')->name('report.profit.pdf');

});


//Attendance Report All Routes
Route::controller(AttendanceReportController::class)->group(function () {
    Route::get('attendance/report/view', 'AttendanceReportView')->name('attendance.report.view');
    Route::get('report/attendance/get', 'AttendanceReportGet')->name('report.attendance.get');
});
});//End Prefix Report Management



Route::controller(DefaultController::class)->group(function () {
    Route::get('/marks/getsubject', 'GetSubject')->name('marks.getsubject');
    Route::get('/student/marks/getstudents', 'GetStudents')->name('student.marks.getstudents');
    
});


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

});

require __DIR__.'/auth.php';

}); // Prevent Back Middleware
