<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
class AdminDiscountController extends Controller
{
    public function index(){
        $discount =  Discount::all();
        return view('Admin.Discount.index',compact('discount'));
    }
    public function add(){
      
        return view('Admin.Discount.adddiscount');
    }
    public function update($id){
        if($id){
            $discount = Discount::find($id);
        }else{
            abort(404);
        }  
        return view('Admin.Discount.update',compact('discount'));
    }
    public function addProcc(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';

        $request->validate([
            'discount_name' => 'required',
            'amount' => 'required',
            'expire_on' => 'required'
        ]);

        if($request->discount_type == 'default_option'){
            return redirect()->back()->with(['error'=>'Please select discount type first']);
        }
        if($request->discount_use == 'default_option'){
            return redirect()->back()->with(['error'=>'Please select discount use first']);
        }
        if($request->id){
            $request->validate([
                'discount_code' => 'required|unique:discounts,discount_code,'.$request->id,
            ]);
            $discount = Discount::find($request->id);
            $discount->discount_name = $request->discount_name;
            $discount->discount_code = $request->discount_code;
            $discount->discount_type = $request->discount_type;
            $discount->amount = $request->amount;
            $discount->discount_use = $request->discount_use;
            $discount->expire_on = $request->expire_on;
            $discount->update();
        }else{
            $request->validate([
                'discount_code' => 'required|unique:discounts,discount_code',
            ]);
            $discount = new Discount;
            $discount->discount_name = $request->discount_name;
            $discount->discount_code = $request->discount_code;
            $discount->discount_type = $request->discount_type;
            $discount->amount = $request->amount;
            $discount->discount_use = $request->discount_use;
            $discount->expire_on = $request->expire_on;
            $discount->save();
        }
        return redirect()->back()->with(['success'=>'successfully saved data']);
    }
    public function delete($id){
        $discount = Discount::find($id);
        if($discount){
        $discount->delete();
            return redirect()->back()->with(['error'=>'successfully deleted discount coupon']);
        }else{
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
    }
    public function updatestatus(Request $request){
        $discount = Discount::find($request->id);
        $discount->status = $request->status;
        $discount->update();
        return response()->json(['success'=>'Successfully updated status']);
    }

    public function checkDiscount(Request $request){
        if ($request->discount_code && $request->amount) {
            $discount = Discount::where('discount_code', $request->discount_code)
                ->where('expire_on', '>', now())
                ->where('status', 1)
                ->first();
        
            if ($discount) {
                $amount = $request->amount;
        
                if ($discount->discount_type === 'fixed') {
                    $amount -= $discount->amount;
                } elseif ($discount->discount_type === 'percentage') {
                    $percentage = $discount->amount;
                    $amount *= (1 - ($percentage / 100));
                }
                if($amount < 0){
                    $amount = 0;
                }
                $amount = number_format((float)$amount, 2, '.', '');
                return response()->json(['success' => $amount]);
            }
        
            return response()->json(['error' => 'Invalid discount code or expired']);
        }
        
        return response()->json(['error' => 'Invalid request']);
        
    }
}
