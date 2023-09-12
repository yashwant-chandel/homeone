<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){

        return view('Front.contact');
    }
    public function submitprocc(Request $request){
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
    }

}
