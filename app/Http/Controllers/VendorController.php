<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class VendorController extends Controller
{
    
    public function VendorDashboard(){
    return view('vendor/index');
    }
    public function VendorLogin(){
        return view('vendor/vendor_login');
    }

    public function VendorDestory(Request $request){
      Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
     
    }

    public function VendorProfile(){
      $id=Auth::User()->id;
      $vendorData=User::find($id);
      return view('vendor/vendor_profile_view',compact('vendorData'));

    }
     public function VendorProfileStore(Request $request){
      // dd($request);
      $id=Auth::User()->id;
      $vendorData=User::find($id);
      $vendorData->name=$request->name;
      $vendorData->email=$request->email;
      $vendorData->phone=$request->phone;
      $vendorData->address=$request->address;
      $vendorData->vendor_join=$request->vendor_join;
      $vendorData->vendor_short_info=$request->vendor_short_info;
      if($request->file('photo')){
        $file=$request->file('photo');
        @unlink(public_path('upload/vendor_images/'.$vendorData->photo));
        $filename=date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/vendor_images'),$filename);
        $vendorData['photo']=$filename;

      }
      $vendorData->save();
      $notification=array([
       "message"=>"Vendor Profile Updated SuccessFully..",
       "alert-type"=>"success"
      ]);
      return back()->with($notification);

    }
    public function VendorChangePassword(){
      return view('vendor/change_password');
    }
    public function VendorUpdatePassword(Request $request){
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

    Public function BecomeVendor(){
      return view('auth/become_vendor');
    }
    public function VendorRegister(Request $request){
      // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
         //password=> \\Rules\Password::defaults()
        $user = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'status'=>'inactive',
            'role'=>'vendor'
        ]);

        // event(new Registered($user));
 
        // Auth::login($user);
        $notification=[
          'message'=>'Vendor Request Added Successfully..',
           'alert-type'=>'success'];

        return redirect()->route('vendor.login')->with($notification);
    }

}
