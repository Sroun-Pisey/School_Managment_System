<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\DiscountStudent;
use App\Models\AssignStudent;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\FeeCategoryAmount;
use App\Models\StudentShift;
use DB;
use PDF;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;

class EmployeeAttendanceController extends Controller
{
    public function AttendanceView(){
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        //$data['allData'] = EmployeeAttendance::orderBy('id','desc')->get();
        return view('Backend.employee.employee_attendance.employee_attendance_view',$data);

    }//End Method



    public function AttendanceAdd(){
        $data['employees'] = User::where('usertype','employee')->get();
        return view('Backend.employee.employee_attendance.employee_attendance_add',$data);

    }//End Method



    public function AttendanceStore(Request $request){

        EmployeeAttendance::where('date', date('Y-m-d',strtotime($request->date)))->delete();
        $countEmployee = count($request->employee_id);
        for ($i=0; $i <$countEmployee; $i++){
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }//End For Loop

        $notification = array(
            'message' => 'Employee Attendance Data Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.attendance.view')->with($notification);

    }//End Method


    public function AttendanceEdit($date){
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
        $data['employees']  = User::where('usertype','employee')->get();
        return view('Backend.employee.employee_attendance.employee_attendance_edit',$data);

    }//End Method


    public function AttendanceDetails($date){
        $data['details'] = EmployeeAttendance::where('date',$date)->get();
        return view('Backend.employee.employee_attendance.employee_attendance_details',$data);


    }//End Method

    public function AttendanceDelete($date) {
    $attend = EmployeeAttendance::where('date', $date)->first();

    if ($attend) {
        $attend->delete();

        $notification = array(
            'message' => 'Employee Attendance Deleted Successfully',
            'alert-type' => 'success'
        );
    } else {
        $notification = array(
            'message' => 'Attendance record not found',
            'alert-type' => 'error'
        );
    }

    return redirect()->route('employee.attendance.view')->with($notification);
}//End Method


}
