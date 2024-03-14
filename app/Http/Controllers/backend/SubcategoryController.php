<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
class SubcategoryController extends Controller
{
    
    public function AllSubCategory(){
     $subcategories=Subcategory::latest()->get();        
     return view('backend.subcategory.subcategory_all',compact('subcategories'));
    }

     public function AddSubCategory()
    {
        $categories=Category::orderBy('category_name','ASC')->get();
        return view('backend.subcategory.subcategory_add',compact('categories'));
    }
    public function StoreSubCategory(Request $request){
        // dd($request);
        $request->validate([
         'category_name'=>'required',
         'subcategory_name'=>'required'
        ]);
       Subcategory::insert([
                            'category_id'=>intval($request->category_name),
                            'subcategory_name'=>$request->subcategory_name
                           ]);
            
       $notification=[
        'message'=>'Sub Category added Syccessfully',
        'alert-type'=>'success'
       ];
       return redirect()->back()->with($notification);
    }
    public function EditSubCategory($id){
        // dd($request);
        $categories=Category::orderBy('category_name','ASC')->get();
        $subcategory=Subcategory::FindOrFail($id);
       return view('backend.subcategory.subcategory_edit',compact('subcategory','categories'));
    }
    public function UpdateSubCategory(Request $request){
        // dd($request);
        $id=$request->id;
        $subcategory=Subcategory::FindOrFail($id);
        $request->validate([
         'category_name'=>'required',
         'subcategory_name'=>'required'
        ]);
       Subcategory::whereId($id)->update([
                            'category_id'=>intval($request->category_name),
                            'subcategory_name'=>$request->subcategory_name
                           ]);
            
       $notification=[
        'message'=>'Sub Category Updated Syccessfully',
        'alert-type'=>'success'
       ];
       return redirect()->back()->with($notification);
    }
   public function DeleteSubCategory($id){
    $Subcategory=Subcategory::FindOrFail($id);
     $Subcategory->delete();
      $notification=[
        'message'=>'Sub Category Deleted Syccessfully',
        'alert-type'=>'success'
       ];
       return redirect()->back()->with($notification);

   }

   public function GetSubCategory($category_id){
      $subcat=Subcategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
       return json_encode($subcat);
   }

}
