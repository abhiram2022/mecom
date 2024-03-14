<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
   public function AllCategory(){

         $categories=Category::latest()->get();

         return view('backend.category.category_all',compact('categories'));
   }

   public function AddCategory(){
    return view('backend.category.category_add');
   }

   public function StoreCategory(Request $request){
        $request->validate([
           'category_name'=>'required'
        ]);
         if($request->file('category_image')){
            $image=$request->file('category_image');
            $gen_name=hexdec(uniqid()).".".$image->getClientOriginalExtension();
            $image->move(public_path('/upload/category'),$gen_name);
            $path_url="/upload/category/".$gen_name;

            Category::insert([
              'category_name'=>$request->category_name,
               'category_slug'=>strtolower(str_replace(' ', '-', $request->category_name)),
               'category_image'=>$path_url
          ]);
            $notification=[
            'message'=>'Categories added successfully with image..',
            'alert-type'=>'success'
            ];

         }
         else{
             Category::insert([
               'category_name'=>$request->category_name,
               'category_slug'=>strtolower(str_replace(' ', '-', $request->category_name)),
          ]);
              $notification=[
            'message'=>'Categories added successfully Without Image..',
            'alert-type'=>'success'
            ];

         }

       return redirect('/all/category')->with($notification);    

   }

    public function EditCategory($id){
        $category=Category::FindOrFail($id);
        return view('backend.category.category_edit',compact('category'));

    }

    public function UpdateCategory(Request $request){
        $id=$request->id;
        $category=Category::FindOrFail($id);
        $category_name=$request->category_name;
        $category_slug=strtolower(str_replace(' ','-',$category_name));

        if($request->file('category_image')){
             if(file_exists($category->category_image)){
             unlink($category->category_image);
             }

            $image=$request->file('category_image');
            $name_gen=hexdec(uniqid()).".".$image->getClientOriginalExtension();
            $image->move(public_path('/upload/category'),$name_gen);
            $path_url='/upload/category/'.$name_gen;
            
             Category::whereId($id)->update([
             'category_name'=>$category_name,
             'category_slug'=> $category_slug,
             'category_image'=>$path_url
            ]);

            $notification=[
            'message'=>'Categories Updated successfully, With Image ',
            'alert-type'=>'success'
            ];
        }
        else{
            Category::whereId($id)->update([
             'category_name'=>$category_name,
             'category_slug'=> $category_slug
            ]);

            $notification=[
            'message'=>'Categories Updated successfully, Without Image ',
            'alert-type'=>'success'
            ];

        }
        return redirect()->back()->with($notification);

    }

    public function DeleteCategory($id){
          $category=Category::FindOrFail($id);

          // dd($category);
          if(file_exists($category->category_image)){
            unlink($category->category_image);
          }
          Category::whereId($id)->delete();
           $notification=[
            'message'=>'Categories Deleted successfully. ',
            'alert-type'=>'success'
            ];

           return redirect('/all/category')->with($notification);

    }


}
