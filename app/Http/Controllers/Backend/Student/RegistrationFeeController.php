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

class RegistrationFeeController extends Controller
{
    public function RegFeeView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['study_types'] = FeeCategory::all();
        return view('Backend.student.registration_fee.registration_fee_view',$data);


    }//End Method


    public function RegFeeClassData(Request $request) {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $study_type_id = $request->study_type_id;

        $where = [];

        if ($year_id != '') {
            $where[] = ['year_id', 'like', $year_id . '%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }
        if ($study_type_id != '') {
            $where[] = ['study_type_id', 'like', $study_type_id . '%'];
        }

        $allStudent = AssignStudent::with(['discount'])->where($where)->get();

        $html['thSource']  = '<th>SL</th>';
        $html['thSource'] .= '<th>ID No</th>';
        $html['thSource'] .= '<th>Student Name</th>';
        $html['thSource'] .= '<th>original Amount</th>';
        $html['thSource'] .= '<th>Discount</th>';
        $html['thSource'] .= '<th>Student Fee</th>';
        $html['thSource'] .= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {
            if ($study_type_id == 1) {
                // Registration Fee Calculation
                $feeAmount = FeeCategoryAmount::where('fee_category_id', 1)
                                ->where('class_id', $v->class_id)
                                ->first();
            } elseif ($study_type_id == 2) {
                // Monthly Fee Calculation
                $feeAmount = FeeCategoryAmount::where('fee_category_id', 2)
                                ->where('class_id', $v->class_id)
                                ->first();
            } else {
                continue; // Skip if fee_category_id doesn't match
            }

            $color = 'success';
            $originalFee = $feeAmount->amount;
            $discount = $v['discount']['discount'];
            $discountedAmount = $discount / 100 * $originalFee;
            $finalFee = (float)$originalFee - (float)$discountedAmount;

            $html[$key]['tdSource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdSource'] .= '<td>' . $v['student']['id_no'] . '</td>';
            $html[$key]['tdSource'] .= '<td>' . $v['student']['name'] . '</td>';
            $html[$key]['tdSource'] .= '<td>' . $feeAmount->amount . '</td>';
            $html[$key]['tdSource'] .= '<td>' . $discount . '%</td>';
            $html[$key]['tdSource'] .= '<td>' . $finalFee . '$</td>';
            $html[$key]['tdSource'] .= '<td>';

            if ($study_type_id == 1) {
                $html[$key]['tdSource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blank" href="' 
                                            . route("student.registration.fee.payslip", ['class_id' => $v->class_id, 'student_id' => $v->student_id]) 
                                            . '">Fee Slip</a>';
            } elseif ($study_type_id == 2) {
                $html[$key]['tdSource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blank" href="' 
                                            . route("student.monthly.fee.payslip", ['class_id' => $v->class_id, 'student_id' => $v->student_id, 'month' => $request->month]) 
                                            . '">Fee Slip</a>';
            }

            $html[$key]['tdSource'] .= '</td>';
        }

        return response()->json($html);
    }





    public function RegFeePayslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $allStudent['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();

        $pdf = PDF::loadView('Backend.student.registration_fee.registration_fee_pdf', $allStudent);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


    }//End Method
}


