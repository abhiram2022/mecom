<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class AdminController extends Controller
{

    public function AdminDashboard(){
    return view('admin/index');
    }
    public function AdminLogin(){
        return view('admin/admin_login');
        
    }

    public function AdminDestory(Request $request){
      Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
     
    }

    public function AdminProfile(){
      $id=Auth::User()->id;
      $adminData=User::find($id);
      return view('admin/admin_profile_view',compact('adminData'));

    }
     public function AdminProfileStore(Request $request){
      $id=Auth::User()->id;
      $adminData=User::find($id);
      $adminData->name=$request->name;
      $adminData->email=$request->email;
      $adminData->phone=$request->phone;
      $adminData->address=$request->address;
      if($request->file('photo')){
        $file=$request->file('photo');
        @unlink(public_path('upload/admin_images/'.$adminData->photo));
        $filename=date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'),$filename);
        $adminData['photo']=$filename;

      }
      $adminData->save();
      $notification=array([
       "message"=>"Admin Profile Updated SuccessFully..",
       "alert-type"=>"success"
      ]);
      return back()->with($notification);

    }
    public function AdminChangePassword(){
      return view('admin/change_password');
    }
    public function AdminUpdatePassword(Request $request){
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
             return back()->with(['status'=>"password Updated successfully..."]);

    }

    public function InActiveVendor(){
      $vendorData=User::where('status','inactive')->where('role','vendor')->latest()->get();
      return view('admin.inactive_vendor',compact('vendorData'));
    }
    public function ActiveVendor(){
      $vendorData=User::where('status','active')->where('role','vendor')->latest()->get();
      return view('admin.active_vendor',compact('vendorData'));
    }
    public function ActiveId($id){
       $vendor=User::FindOrFail($id);
       User::whereId($id)->update([
       'status'=>'active']
       );
      $notification=[
                  'message'=>'Vender Activated..',
                 'alert-type'=>'success'
                 ];
      return redirect()->route('active.vendor')->with($notification);
    }
    public function InActiveId($id){
       $vendor=User::FindOrFail($id);
       User::whereId($id)->update([
       'status'=>'inactive']
       );
      $notification=[
                  'message'=>'Vender InActivated..',
                 'alert-type'=>'success'
                 ];
      return redirect()->route('inactive.vendor')->with($notification);
    }
}
