<?php

namespace App\Http\Controllers\Backend\Account;

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
use App\Models\AccountEmployeeSalary;

class AccountSalaryController extends Controller
{
    public function AccountSalaryView(){

        $data['allData'] = AccountEmployeeSalary::orderBy('id','desc')->get();
        return view('Backend.account.employee_salary.employee_salary_view',$data);


    }//End Method


    public function AccountSalaryAdd(){

        return view('Backend.account.employee_salary.employee_salary_add');


    }//End Method


    public function AccountSalaryGetEmployee(Request $request){

        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
            }
        
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($allStudent);
        $html['thSource']  = '<th>SL</th>';
        $html['thSource'] .= '<th>ID NO</th>';
        $html['thSource'] .= '<th>Employee Name</th>';
        $html['thSource'] .= '<th>Basic Salary</th>';
        $html['thSource'] .= '<th>Salary This Month</th>';
        $html['thSource'] .= '<th>Select</th>';


        foreach ($data as $key => $attend) {

            $account_salary = AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where('date',$date)->first();

            if($account_salary !=null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }   

            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status','Absent'));

            
        $html[$key]['tdSource']  = '<td>'.($key+1).'</td>';
        $html[$key]['tdSource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'" >'.'</td>';

        $html[$key]['tdSource'] .= '<td>'.$attend['user']['name'].'</td>';
        $html[$key]['tdSource'] .= '<td>'.$attend['user']['salary'].'</td>';


        $salary = (float)$attend['user']['salary'];
        $salaryperday = (float)$salary/30;
        $totalSalaryMinus = (float)$absentCount*(float)$salaryperday;
        $totalSalary = (float)$salary-(float)$totalSalaryMinus;

        $html[$key]['tdSource'] .='<td>'.$totalSalary.'<input type="hidden" name="amount[]" value="'.$totalSalary.'" >'.'</td>';


        $html[$key]['tdSource'] .='<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkManage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>'; 

        }  // end foreach
        return response()->json(@$html);

    } //End Method


    public function AccountSalaryStore(Request $request){

        $date = date('Y-m', strtotime($request->date));

        AccountEmployeeSalary::where('date',$date)->delete();

        $checkData = $request->checkManage;

        if ($checkData !=null) {
            for ($i=0; $i <count($checkData) ; $i++) { 
                $data = new AccountEmployeeSalary(); 
                $data->date = $date; 
                $data->employee_id = $request->employee_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            } 
        } // end if 

        if (!empty(@$data) || empty($checkData)) {

        $notification = array(
            'message' => 'Well Done Data Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('account.salary.view')->with($notification);
        }else{

            $notification = array(
            'message' => 'Sorry Data not Saved',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

        } 

    } // end method 

}
