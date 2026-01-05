<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        $data['allData'] = User::where('usertype','Admin')->get();
        return view('Backend.user.view_user',$data);


    }//End Method

    public function UserAdd(){
        return view('Backend.user.add_user');

    }//End Method

    public function UserStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message' => 'User Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')->with($notification);

    }//End Method


    public function UserEdit($id){
        $editData = User::find($id);
        return view('Backend.user.edit_user',compact('editData'));


    }//End Method

    public function UserUpdate(Request $request,$id){
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->save();

        $notification = array(
            'message' => 'User Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);


    }//End Method

    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();
        
        $notification = array(
            'message' => 'User Delete Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    }//End Method
}
