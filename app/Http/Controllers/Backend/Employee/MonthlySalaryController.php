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

class MonthlySalaryController extends Controller
{
    public function MonthlySalaryView(){
        return view('Backend.employee.monthly_salary.monthly_salary_view');

    }//End Method


    public function MonthlySalaryGet(Request $request){
        
        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }
        
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($allStudent);
        $html['tdSource']  = '<th>SL</th>';
        $html['tdSource'] .= '<th>Employee Name</th>';
        $html['tdSource'] .= '<th>Basic Salary</th>';
        $html['tdSource'] .= '<th>Salary This Month</th>';
        $html['tdSource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status','Absent'));

            $html['thSource']  = '<th>SL</th>';
            $html['thSource'] .= '<th>Employee Name</th>';
            $html['thSource'] .= '<th>Salary</th>';
            $html['thSource'] .= '<th>Part Time</th>';
            $html['thSource'] .= '<th>Part Time</th>';

            $color = 'success';
            $html[$key]['tdSource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdSource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdSource'] .= '<td>'.$attend['user']['salary'].'</td>';
            
            
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;
            $totalSalaryMinus = (float)$absentCount*(float)$salaryperday;
            $totalSalary = (float)$salary-(float)$totalSalaryMinus;

            $html[$key]['tdSource'] .='<td>'.$totalSalary.'$'.'</td>';
            $html[$key]['tdSource'] .='<td>';
            $html[$key]['tdSource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'">Fee Slip</a>';
            $html[$key]['tdSource'] .= '</td>';

        }  
    return response()->json(@$html);


} // END Method 


    public function MonthlySalaryPayslip(Request $request,$employee_id){
        $id = EmployeeAttendance::where('employee_id',$employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id->employee_id)->get();

        $pdf = PDF::loadView('Backend.employee.monthly_salary.monthly_salary_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
        
        }



}
