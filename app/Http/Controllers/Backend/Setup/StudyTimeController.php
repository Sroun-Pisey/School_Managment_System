<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudyTime;
use Illuminate\Http\Request;

class StudyTimeController extends Controller
{
    public function ViewStudyTime(){
        $data['allData'] = StudyTime::orderBy('id','desc')->get();
        return view('Backend.setup.time_study.view_time_study',$data);

    }//End Method


    public function StudyTimeAdd(){
        return view('Backend.setup.time_study.add_time_study');

    }//End Method


    public function StudyTimeStore(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:study_times,name',
        ]);
        $data = new StudyTime();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Study Time Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('study.time.view')->with($notification);

    }//End Method


    public function StudyTimeEdit($id){
        $editData = StudyTime::find($id);
        return view('Backend.setup.time_study.edit_time_study',compact('editData'));

    }//End Method


    public function StudyTimeUpdate(Request $request,$id){
        $data = StudyTime::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id

        ]);
        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Study Time Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('study.time.view')->with($notification);

    }//End Method


    public function StudyTimeDelete($id) {
        $user = StudyTime::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Study Time Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('study.time.view')->with($notification);
    }//End Method
}
