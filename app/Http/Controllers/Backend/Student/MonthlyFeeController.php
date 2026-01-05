<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;
use DB;
use PDF;

class MonthlyFeeController extends Controller
{
    public function MonthlyFeeView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['study_types'] = FeeCategory::where('id','2')->get();
        return view('Backend.student.monthly_fee.monthly_fee_view',$data);
    }//End Method


    public function MonthlyFeeClassData(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $study_type_id = $request->study_type_id;
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        if ($study_type_id !='') {
            $where[] = ['study_type_id','like',$study_type_id.'%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        // dd($allStudent);
        $html['thSource']  = '<th>SL</th>';
        $html['thSource'] .= '<th>ID No</th>';
        $html['thSource'] .= '<th>Student Name</th>';
        $html['thSource'] .= '<th>Part Time Fee</th>';
        $html['thSource'] .= '<th>Discount </th>';
        $html['thSource'] .= '<th>Student Fee </th>';
        $html['thSource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {
            $regiStrationFee = FeeCategoryAmount::where('fee_category_id','2')->where('class_id',$v->class_id)->first();
            $color = 'success';
            $html[$key]['tdSource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdSource'] .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdSource'] .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdSource'] .= '<td>'.$regiStrationFee->amount.'</td>';
            $html[$key]['tdSource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';
            
            $originalFee = $regiStrationFee->amount;
            $discount = $v['discount']['discount'];
            $discountTableFee = $discount/100*$originalFee;
            $finalFee = (float)$originalFee-(float)$discountTableFee;

            $html[$key]['tdSource'] .='<td>'.$finalFee.'$'.'</td>';
            $html[$key]['tdSource'] .='<td>';
            $html[$key]['tdSource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.monthly.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.' ">Fee Slip</a>';
            $html[$key]['tdSource'] .= '</td>';

        }  
        return response()->json(@$html);

    }// end method 



    public function MonthlyFeePayslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['month'] = $request->month;

        $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();

        $pdf = PDF::loadView('Backend.student.monthly_fee.monthly_fee_pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


    }//End Method



}