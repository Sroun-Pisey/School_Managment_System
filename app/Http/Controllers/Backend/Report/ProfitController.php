<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use PDF;

class ProfitController extends Controller
{
    public function MonthlyProfitView(){
        return view('Backend.report.profit.profit_view');

    }


    public function MonthlyProfitDatewais(Request $request){

        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date));
        $sDate = date('Y-m-d',strtotime($request->start_date));
        $eDate = date('Y-m-d',strtotime($request->end_date));
        
        $student_fee = AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $other_cost = AccountOtherCost::whereBetween('date',[$sDate,$eDate])->sum('amount'); 

        $emp_salary = AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $total_cost = $other_cost+$emp_salary;
        $profit = $student_fee-$total_cost;  
        
        $html['thSource']  = '<th>Student Fee</th>';
        $html['thSource'] .= '<th>Other Cost</th>';
        $html['thSource'] .= '<th>Employee Salary</th>';
        $html['thSource'] .= '<th>Total Cost</th>';
        $html['thSource'] .= '<th>Profit </th>';
        $html['thSource'] .= '<th>Action</th>';

        $color = 'success';
        $html['tdSource']  = '<td>'.$student_fee.' $</td>';
        $html['tdSource']  .= '<td>'.$other_cost.' $</td>';
        $html['tdSource']  .= '<td>'.$emp_salary.' $</td>';
        $html['tdSource']  .= '<td>'.$total_cost.' $</td>';
        $html['tdSource']  .= '<td>'.$profit.' $</td>';
        $html['tdSource'] .='<td>';
        $html['tdSource'] .='<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blanks" href="'.route("report.profit.pdf").'?start_date='.$sDate.'&end_date='.$eDate.'">Pay Slip</a>';
        $html['tdSource'] .= '</td>';

        return response()->json(@$html); 

    } // end method



    
    public function MonthlyProfitPdf(Request $request){

        $data['start_date'] = date('Y-m',strtotime($request->start_date));
        $data['end_date'] = date('Y-m',strtotime($request->end_date));
        $data['sDate'] = date('Y-m-d',strtotime($request->start_date));
        $data['eDate'] = date('Y-m-d',strtotime($request->end_date));

        $pdf = PDF::loadView('Backend.report.profit.profit_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }// end method
}
