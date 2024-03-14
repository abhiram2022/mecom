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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VendorProductController extends Controller
{
    public function VendorAllProduct(){
        /**
         * undocumented constant
         **/
        $id=Auth::user()->id;
        // dd($id);
        $products=Product::where('vendor_id',$id)->latest()->get();
        return view('backend.product.vendor_product_all',compact('products'));
    }
     public function VendorAddProduct(){
        $id=Auth::user()->id;
       $brands=Brand::latest()->get();
       $categories=Category::latest()->get();
       // $subcategories=Subcategory::latest()->get();
       $vendors=User::where('status','active')->where('role','vendor')->where('id',$id)->get();
        return view('backend.product.vendor_product_add',compact('brands','categories','vendors'));
    }
}
