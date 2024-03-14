<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
class BrandController extends Controller
{

    public function AllBrand(){
        $brands=Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    }

    public function AddBrand(Request $request){
      return view('backend.brand.brand_add'); 
    }

    public function StoreBrand(Request $request){
       // dd($request->file('brand_image'));

         $image=$request->file('brand_image');
         $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
         // $slug = strtolower(str_replace(' ', '-', $image->getClientOriginalName()));
        
            // Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);

          $image->move(public_path('upload/brand/'),$name_gen);
           $save_url = "upload/brand/" . $name_gen;
        Brand::Insert(
        [
          'brand_name'=>$request->brand_name,
          'brand_image'=>$save_url,
          'brand_slug'=> strtolower(str_replace(' ', '-',$request->brand_name))
        ]);
        $notification=[
          'message'=>'Brand Added Successfully',
          'alert-type'=>'success',

        ];
        return  redirect()->route('all.brand')->with($notification);
       }


    public function EditBrand($id){
        $brand=Brand::FindOrFail($id);
     return view('backend.brand.brand_edit',compact('brand'));
    }

     public function UpdateBrand(Request $request){
        $id=$request->id;
        $brand=Brand::FindOrFail($id);

          if($request->file('brand_image')){
              $image=$request->file('brand_image');              
              if(file_exists($brand->brand_image)){
                unlink($brand->brand_image);
              }
              $name_gen=hexdec(uniqid()).".".$image->getClientOriginalExtension();
              $image->move(public_path('upload/brand/'),$name_gen);
              $save_url='upload/brand/'.$name_gen;
              Brand::whereId($brand->id)->update([
                'brand_name'=>$request->brand_name,
                'brand_image'=>$save_url,
                'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name))

              ]);
              $notification=[
              'message'=>'Brand Added Successfully With Image',
              'alert-type'=>'success',
              ];

          }
          else{
                Brand::whereId($brand->id)->update([
                'brand_name'=>$request->brand_name,
                'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name))
            ]);
            $notification=[
              'message'=>'Brand Added Successfully Without Image',
              'alert-type'=>'success',
              ];
          }


        return back()->with($notification);

     }
    public function DeleteBrand($id){
        $brand=Brand::FindOrFail($id);
        Brand::whereId($brand->id)->delete();
        $image=$brand->brand_image;
        if(file_exists($brand->brand_image)){
            unlink($image);
        }
        $notification=[
              'message'=>'Brand Delected Successfully..',
              'alert-type'=>'success',
              ];
     return redirect('/all/brand')->with($notification);
    }


}
