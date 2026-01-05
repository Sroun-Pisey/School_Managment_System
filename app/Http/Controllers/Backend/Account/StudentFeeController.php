<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\FeeCategoryAmount;

use App\Models\StudentYear;
use App\Models\StudentClass;
use DB;
use PDF;

use App\Models\AccountStudentFee;
use App\Models\FeeCategory;

class StudentFeeController extends Controller
{
    public function StudentFeeView(){

        $data['allData'] = AccountStudentFee::orderBy('id','desc')->get(); 
        return view('Backend.account.student_fee.student_fee_view',$data);


    }//End Method


    public function StudentFeeAdd(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['study_types'] = FeeCategory::all();
        return view('Backend.account.student_fee.student_fee_add',$data);

    }//End Method


    public function StudentFeeGetStudent(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $study_type_id = $request->study_type_id;
        $date = date('Y-m',strtotime($request->date));    
        
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        if ($study_type_id != '') {
            $where[] = ['study_type_id', 'like', $study_type_id . '%'];
        }
        
        $data = AssignStudent::with(['discount'])->where($where)->get();
        
        $html['thSource']  = '<th>ID No</th>';
        $html['thSource'] .= '<th>Student Name</th>';
        $html['thSource'] .= '<th>Father Name</th>';
        $html['thSource'] .= '<th>Original Fee </th>';
        $html['thSource'] .= '<th>Discount Amount</th>';
        $html['thSource'] .= '<th>Fee (This Student)</th>';
        $html['thSource'] .= '<th>Select</th>';

        foreach ($data as $key => $std) {

            if ($study_type_id == 1) {
                // Registration Fee Calculation
                $regiStrationFee = FeeCategoryAmount::where('fee_category_id', 1)
                                ->where('class_id', $std->class_id)
                                ->first();
            } elseif ($study_type_id == 2) {
                // Monthly Fee Calculation
                $regiStrationFee = FeeCategoryAmount::where('fee_category_id', 2)
                                ->where('class_id', $std->class_id)
                                ->first();
            } else {
                continue; // Skip if fee_category_id doesn't match
            }

        $accountStudentFees = AccountStudentFee::where('student_id',$std->student_id)->where('year_id',$std->year_id)->where('class_id',$std->class_id)->where('fee_category_id',$study_type_id)->where('date',$date)->first();

        if($accountStudentFees !=null) {
        $checked = 'checked';
        }else{
        $checked = '';
        }  	 	 
        $color = 'success';
        $html[$key]['tdSource']  = '<td>'.$std['student']['id_no']. '<input type="hidden" name="fee_category_id" value= " '.$study_type_id.' " >'.'</td>';

        $html[$key]['tdSource']  .= '<td>'.$std['student']['name']. '<input type="hidden" name="year_id" value= " '.$std->year_id.' " >'.'</td>';

        $html[$key]['tdSource']  .= '<td>'.$std['student']['fname']. '<input type="hidden" name="class_id" value= " '.$std->class_id.' " >'.'</td>';

        $html[$key]['tdSource']  .= '<td>'.$regiStrationFee->amount.'$'.'<input type="hidden" name="date" value= " '.$date.' " >'.'</td>';

        $html[$key]['tdSource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';

        $originalFee = $regiStrationFee->amount;
        $discount = $std['discount']['discount'];
        $discountableFee = $discount/100*$originalFee;
        $finalFee = (int)$originalFee-(int)$discountableFee;    	 	 

        $html[$key]['tdSource'] .='<td>'. '<input type="text" name="amount[]" value="'.$finalFee.' " class="form-control" readonly'.'</td>';

        $html[$key]['tdSource'] .='<td>'.'<input type="hidden" name="student_id[]" value="'.$std->student_id.'">'.'<input type="checkbox" name="checkManage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>'; 

        }  
        return response()->json(@$html);

    }//End Method



    public function StudentFeeStore(Request $request){
        
        $date = date('Y-m',strtotime($request->date));

        AccountStudentFee::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('fee_category_id',$request->fee_category_id)->where('date',$request->date)->delete();

        $checkData = $request->checkManage;

        if ($checkData !=null) {
            for ($i=0; $i <count($checkData) ; $i++) { 
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            } // end for loop
        } // end if 

        if (!empty(@$data) || empty($checkData)) {

        $notification = array(
            'message' => 'Well Done Data Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('student.fee.view')->with($notification);
        }else{

            $notification = array(
            'message' => 'Sorry Data not Saved',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

        } 

    } // end method 
}
