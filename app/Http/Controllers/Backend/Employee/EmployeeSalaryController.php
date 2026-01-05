<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
use App\Models\EmployeeAttendance;

class EmployeeSalaryController extends Controller
{
    public function SalaryView(){
        $data['allData'] = User::where('usertype','Employee')->get();
        //dd( $data['allData']);
        return view('Backend.employee.employee_salary.employee_salary_view',$data);

}//End Method

    public function EmployeeIncrement($id){
        $data['editData'] = User::find($id);
        return view('Backend.employee.employee_salary.employee_salary_increment',$data);

    }//End Method

    public function SalaryStore(Request $request,$id){
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d',strtotime($request->effected_salary));
        $salaryData->save();

        $notification = array(
            'message' => 'Employee Salary Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.salary.view')->with($notification);
    }//End Method


    public function SalaryDetails($id){
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
        //dd($data['salary_log']->toArray());
        return view('Backend.employee.employee_salary.employee_salary_details',$data);
    }//End Method

}
