<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
            return view('Admin.Orders.index');
    }
    public function orderview($orderid){

            return view('Admin.Orders.orderdetail');
    }
}
