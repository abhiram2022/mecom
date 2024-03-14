<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use app\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function UserDashboard()

    {
       $id= Auth::user()->id;
       $userData=User::find($id);
        return view('/index',compact('userData'));
    }


    public function UserProfileStore(Request $request){
      dd($request);
      $id=Auth::user()->id;
      $userData=User::find($id);
      $userData->name=$request->name;
      $userData->email=$request->email;
      $userData->phone=$request->phone;
      $userData->address=$request->address;
      if($request->file('photo')){
        $file=$request->file('photo');
        @unlink(public_path('upload/user_images/'.$userData->photo));
        $filename=date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/user_images'),$filename);
        $userData['photo']=$filename;

      }
      $userData->save();
      $notification=array([
       "message"=>"User Profile Updated SuccessFully..",
       "alert-type"=>"success"
      ]);
      return back()->with($notification);

    }
    public function UserChangePassword(){
      return view('user/user_change_password');
    }
    public function UserUpdatePassword(Request $request){
             $request->validate([
              "old_password"=>"required",
              "confirm_password"=>"required|same:new_password"
             ]);
             if(!Hash::check($request->old_password,Auth::user()->password)){
              return back()->with(['error'=>'old password does not match ..!']);
             }

             User::whereId(Auth::user()->id)->update([
             "password"=>Hash::make($request->new_password)
             ]);
             return back()->with(['status'=>" User password Updated successfully..."]);

    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function UserLogout(Request $request){
      Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
     
    }

}
