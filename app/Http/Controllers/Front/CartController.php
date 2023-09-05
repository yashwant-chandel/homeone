<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Auth;
class CartController extends Controller
{
    //
    public function addToCart(Request $request){
        $product = Products::find($request->product_id);
    
        if (!$product) {
            return response()->json(['error' => 'Failed to find product']);
        }
    
        $user = Auth::user();
    
        $cart = new Cart;
        $cart->product_id = $product->id;        
        $cart->product_quantity = $request->quantity;   
        $cart->product_price = $product->sale_price;
        $cart->user_id = $user->id;
        $cart->save();
    
        return response()->json(['success' => 'Product has been added to the cart']);
    }
    
}
