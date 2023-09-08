<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
class AdminDiscountController extends Controller
{
    public function index(){

        return view('Admin.Discount.index');
    }
    public function add(){

        return view('Admin.Discount.adddiscount');
    }
    public function addProcc(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';

        $request->validate([
            'discount_name' => 'required',
            'discount_code' => 'required',
            'amount' => 'required',
            'expire_on' => 'required'
        ]);

        if($request->discount_type == 'default_option'){
            return redirect()->back()->with(['error'=>'Please select discount type first']);
        }
        if($request->discount_use == 'default_option'){
            return redirect()->back()->with(['error'=>'Please select discount use first']);
        }

        $discount = new Discount;
        $discount->discount_name = $request->discount_name;
        $discount->discount_code = $request->discount_code;
        $discount->discount_type = $request->discount_type;
        $discount->amount = $request->amount;
        $discount->discount_use = $request->discount_use;
        $discount->expire_on = $request->expire_on;
        $discount->save();
        return redirect()->back()->with(['success'=>'successfully saved data']);
    }
}
