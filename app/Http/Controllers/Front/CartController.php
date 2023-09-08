<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Auth;
class CartController extends Controller
{

    public function index(Request $request){
        $userId = Auth::user()->id;
    
        $cart = Cart::with('product')->where('status', 0)->where('user_id', $userId)->get();
    
        $subtotalSum = Cart::where('status', 0)->where('user_id', $userId)->sum('subtotal');
    
        $cartCategoryIds = $cart->pluck('product.cat_id')->unique()->toArray();

        $relatedProducts = [];        
        foreach ($cartCategoryIds as $categoryId) {
            $relatedProductsForCategory = Products::where('cat_id', $categoryId)
                ->where('id', '!=', $cart->pluck('product.id')->toArray())
                ->get();
        
            $relatedProducts = array_merge($relatedProducts, $relatedProductsForCategory->toArray());
        }
        
        // echo '<pre>';
        // print_r($relatedProducts);
        // die();
        
        return view('Front.Cart.index', compact('cart', 'subtotalSum', 'relatedProducts'));
    }
    
    public function addToCart(Request $request){
        $product = Products::find($request->product_id);
        if($product->Quantity < $request->quantity){
            return response()->json(['error' => 'Sorry, the quantity of the product that you have selected is not in stock yet.']);
        }
        if (!$product) {
            return response()->json(['error' => 'Failed to find product']);
        }
        if (Cart::where('status', '=', 0)->where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->exists()) {
            $cart = Cart::where('product_id', $request->product_id)->where('status', 0)->where('user_id',Auth::user()->id)->first();
            if ($cart) {
                $cart->product_quantity += $request->quantity;
                    if($cart->product_quantity > $product->Quantity){
                        return response()->json(['error' => 'Sorry, You have already added product stock limit to your cart..']);
                    }
                $cart->subtotal = $cart->product_quantity * $cart->product_price;
                $cart->save();   
                return response()->json(['success' => 'Product quantity has been updated']);
            } else {
                return response()->json(['error' => 'Cart item not found'], 404);
            }
         }
        $user = Auth::user();
    
        $cart = new Cart;
        $cart->product_id = $product->id;        
        $cart->product_quantity = $request->quantity; 
        $cart->subtotal = $product->sale_price*$request->quantity;
        $cart->product_price = $product->sale_price;
        $cart->user_id = $user->id;
        $cart->save();
    
        return response()->json(['success' => 'Product has been added to the cart']);
        
    }

    public function update(Request $request){
        if($request->cartItems){
            foreach($request->cartItems as $cartData){
                $product = Products::find($cartData['productId']);
                if($product->Quantity < $cartData['quantity']){
                    return response()->json(['error' => 'Sorry, the quantity of the product that you have selected is not in stock yet.']);
                }
                $cart = Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $cartData['productId'])
                    ->where('status', 0)
                    ->first();
    
                if ($cart) {
                    $cart->product_quantity = $cartData['quantity'];
                    $cart->subtotal = $cartData['quantity']*$cart->product_price;
                    $cart->save();
                }
            }
    
            return response()->json(['success' => 'Cart has been updated successfully']);
        } else {
            return response()->json(['error' => 'An error occurred while updating the cart.']);
        }
    }
    public function removeCart(Request $request){
        if ($request->has('removeSingle') && $request->has('product_id')) {
            $deleted = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $request->product_id)
                ->where('status', 0)
                ->delete();
    
            if ($deleted) {
                return response()->json(['success' => 'Cart item has been removed successfully']);
            }
        } 
        if ($request->has('removeAll')) {
            $deleted = Cart::where('user_id', Auth::user()->id)
                ->where('status', 0)
                ->delete();
    
            if ($deleted) {
                return response()->json(['success' => 'All cart items have been removed successfully']);
            }
        }
    
        return response()->json(['error' => 'Cart item not found']);
    }
    
    
    
    
}
