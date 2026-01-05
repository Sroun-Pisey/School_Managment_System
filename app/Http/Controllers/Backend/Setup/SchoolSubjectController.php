<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject(){
        $data['allData'] = SchoolSubject::orderBy('id','desc')->get();
        return view('Backend.setup.school_subject.view_school_subject',$data);
    }//End Method


    public function AddSubject(){
        return view('Backend.setup.school_subject.add_school_subject');

    }//End Method


    public function StoreSubject(Request $request){

        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);

    }//End Method


    public function SchoolSubjectEdit($id){
        $editData = SchoolSubject::find($id);
        return view('Backend.setup.school_subject.edit_school_subject',compact('editData'));

    }//End Method


    public function SchoolSubjectUpdate(Request $request,$id){
        $data = SchoolSubject::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id

        ]);
        
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);

    }//End Method


    public function SchoolSubjectDelete($id) {
        $user = SchoolSubject::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Subject Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }//End Method
}
