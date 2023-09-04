<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Gallery;
class FrontController extends Controller
{
    public function index(){
        return view('Front.index');
    }
    public function contact(){
        return view('Front.contact');
    }
    public function lawn(){
        return view('Front.lawn');
    }
    public function exteriors(){
        return view('Front.exteriors');
    }
    public function shop(){
        $products = Products::all();
        return view('Front.shop',compact('products'));
    }
    public function gallery(){
        $gallery = Gallery::with('images')->get();
      
        return view('Front.gallery',compact('gallery'));
    }
}
