<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Gallery;
class ShopController extends Controller
{
    //
    public function index(Request $request){
        
        if($request->get("page_order")){
            $products = Products::take($request->get("page_order"))->get();
            $total_product = Products::get()->toArray();
            return view('Front.store',compact('products','total_product'));
        }else{
            $products = Products::take(9)->get();
            $total_product = Products::get()->toArray();
            return view('Front.store',compact('products','total_product'));
        }
    }

    public function details(Request $request,$slug){
        if($slug){
            // echo '<pre>';
            $product = Products::where('slug', $slug)->first();
            if($product){
            // // $product = Products::with('gallery')->where('slug',$slug)->first()->toArray();
            // print_r($product);
            // die();
            return view('Front.storeDetails',compact('product'));
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
}
