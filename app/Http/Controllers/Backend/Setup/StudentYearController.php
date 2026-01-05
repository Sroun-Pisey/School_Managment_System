<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewYear(){
        $data['allData'] = StudentYear::orderBy('id','desc')->get();
        return view('Backend.setup.year.view_year',$data);
    }//End Method

    public function StudentYearAdd(){
        return view('Backend.setup.year.add_year');
    }//End Method


    public function StudentYearStore(Request $request){

        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);
        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);

        }//End Method

        public function StudentYearEdit($id){
        $editData = StudentYear::find($id);
        return view('Backend.setup.year.edit_year',compact('editData'));

    }//End Method

    public function StudentYearUpdate(Request $request,$id){
        $data = StudentYear::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id

        ]);
        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);

    }//End Method

    public function StudentYearDelete($id) {
        $user = StudentYear::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Year Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }//End Method

}
