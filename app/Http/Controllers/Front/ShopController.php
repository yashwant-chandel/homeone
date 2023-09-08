<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Gallery;
class ShopController extends Controller
{
    //
    public function index(Request $request) {
        if ($request->get("page_order")) {
            $products = Products::where('quantity', '>', 0)
                ->take($request->get("page_order"))
                ->get();
    
            $total_product = Products::where('quantity', '>', 0)
                ->get()
                ->toArray();
    
            return view('Front.store', compact('products', 'total_product'));
        } else {
            $products = Products::where('quantity', '>', 0)
                ->take(9)
                ->get();
    
            $total_product = Products::where('quantity', '>', 0)
                ->get()
                ->toArray();
    
            return view('Front.store', compact('products', 'total_product'));
        }
    }
    public function details(Request $request,$slug){
        if($slug){
            $product = Products::where('slug', $slug)->first();
            if($product){
                return view('Front.storeDetails',compact('product'));
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
}
