<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileView(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('Backend.user.view_profile',compact('user'));

    }//End Method


    public function ProfileEdit(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('Backend.user.edit_profile',compact('editData'));

    }//End Method


    public function ProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email  = $request->email ;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('profile.view')->with($notification);

    }//End Method


    public function PasswordView(){
        return view('Backend.user.edit_password');


    }//End Method

    public function PasswordUpdate(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword,)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newpassword);
            $user->save();

            session()->flash('message','Password Update Successfully');
            return redirect()->back();
        }else{
            session()->flash('message','Odl Password id not  match');
            return redirect()->back();
        }


    }//End Method
}