<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\MultiImage;
use Carbon\Carbon;
class ProductController extends Controller
{
    
    public function AllProduct(){
     $products=Product::latest()->get();        
     return view('backend.product.product_all',compact('products'));
    }
    public function AddProduct(){
       $brands=Brand::latest()->get();
       $categories=Category::latest()->get();
       // $subcategories=Subcategory::latest()->get();
       $vendors=User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.product.product_add',compact('brands','categories','vendors'));
    }
    
    public function EditProduct($id){
       $products = Product::findOrFail($id);
       $vendors = User::where('status','active')->where('role','vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $multiImgs = MultiImage::where('product_id',$id)->get();
        return view('backend.product.product_edit',compact('brands','categories','vendors','products','subcategory','multiImgs'));
    }// End Method 
     public function DeleteProduct($id){
       $product = Product::findOrFail($id);
        $res=$product->delete();
        $notification=['success'=>'product Deleted Successfully','alert-type'=>'success']; 
       return redirect()->back()->with($notification);
    }// End Method 
    public function ActiveProduct($id){
       $product = Product::findOrFail($id);
        $res=$product->whereId($product ->id)->update([
            'status'=>1
        ]);
        $notification=['success'=>'Product Active  Status Updated','alert-type'=>'success']; 
       return redirect()->back()->with($notification);
    }// End Method 
    public function InactiveProduct($id){
       $product = Product::findOrFail($id);
         $res=$product->whereId($product ->id)->update([
            'status'=>0
        ]);
        $notification=['success'=>'Product Inactive Status Updated','alert-type'=>'success']; 
       return redirect()->back()->with($notification);
    }// End Method 
    

   public function StoreProduct(Request $request){
     // dd($request);
      $request->validate([
        'brand_id'=>'required',
      'category_id'=>'required',
      'subcategory_id'=>'required',
      'product_name'=>'required',
      'product_tags'=>'required',
      'product_size'=>'required',
      'product_color'=>'required',
      'selling_price'=>'required',
       'product_qty'=>'required',
      'short_desc'=>'required',
      'long_desc'=>'required',

      'vendor_id'=>'required',
    ]);

     $img= $request->file('product_thambnail');
     $name_gen=hexdec(uniqid()).".".$img->getClientOriginalExtension();
     $img->move(public_path('upload/product/thambnail/'),$name_gen);
     $path_url='upload/product/thambnail/'.$name_gen;
     $product_id=Product::insertGetId([
      'brand_id'=>$request->brand_id,
      'category_id'=>$request->brand_id,
      'subcategory_id'=>$request->subcategory_id,
      'product_name'=>$request->product_name,
      'product_slug'=>str_replace(' ', '-',strtolower($request->product_name)) ,
      'product_thambnail'=>$path_url,

      'product_code' => $request->product_code,
      'product_tags'=>$request->product_tags,
       'product_color'=>$request->product_color,
      'product_size'=>$request->product_size,
      'selling_price'=>$request->selling_price,
      
      'discount_price' => $request->discount_price,
       'product_qty'=>$request->product_qty,
      'short_desc'=>$request->short_desc,
      'long_desc'=>$request->long_desc,


            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals, 

      'vendor_id'=>$request->vendor_id,
      'status'=>0,
      'created_at'=>Carbon::now()

     ]);
     //Multiple image
     $images=$request->file('multi_img');
     foreach ($images as $image) {
        $image_name=hexdec(uniqid()).".".$image->getClientOriginalExtension();
        $image->move(public_path('upload/product/multi-img'),$image_name);
        $path_img='upload/product/multi-img'.$image_name;
          MultiImage::insert([
          'product_id'=>$product_id,
          'photo_name'=>$path_img,
          'created_at'=>Carbon::now(),
          ]);
     }
     
     $notification=['success'=>'product added Successfully','alert-type'=>'success'];      
     return redirect()->route('all.product')->with($notification);
   }

    public function UpdateProduct(Request $request)
    {
        // dd($request);
        $product_id = $request->id;
        $products=Product::findOrFail($request->product_id);
             Product::whereId($product_id)->update([
            'brand_id'=>$request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc, 

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals, 


            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(), 

        ]);


         $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification); 

}


 public function UpdateProductThambnail(Request $request){
          // dd($request);
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
        $image->move(public_path('upload/products/thambnail/'),$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

         if (file_exists($oldImage)) {
           unlink($oldImage);
        }

        Product::whereId($pro_id)->update([

            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 
    // Multi Image Update 
    public function UpdateProductMultiimage(Request $request){

        $imgs = $request->multi_img;

        foreach($imgs as $id => $img ){
            $imgDel = MultiImage::findOrFail($id);
            if(file_exists($imgDel->photo_name))
                 unlink($imgDel->photo_name);

        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        $img->move(public_path('upload/products/multi-image/'),$make_name);
        $uploadPath = 'upload/products/multi-image/'.$make_name;

        MultiImage::where('id',$id)->update([
            'photo_name' => $uploadPath,
            'updated_at' => Carbon::now(),

        ]); 
        } // end foreach

         $notification = array(
            'message' => 'Product Multi Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

   public function MulitImageDelelte($id)
   {     
      $oldImg = MultiImage::findOrFail($id);
        if(file_exists($oldImg->photo_name)){
        unlink($oldImg->photo_name);
        }
        MultiImage::whereId($id)->delete();

        $notification = array(
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

   }

}
