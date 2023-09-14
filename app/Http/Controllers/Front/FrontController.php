<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Gallery;
use App\Models\LawnMeta;
use App\Models\ExteriorMeta;
use App\Models\HomeMeta;
class FrontController extends Controller
{
    public function index(){
        $galleries = Gallery::where('smart_lighting', '!=', '')->where('featured_image', '!=', '')->get();
        $homemeta = HomeMeta::first();
        // echo '<pre>';
        // print_r($homemeta);
        // die();
        return view('Front.index',compact('homemeta','galleries'));
    }
    public function contact(){
        return view('Front.contact');
    }
    public function lawn(){
        $lawn = LawnMeta::first();
        return view('Front.lawn',compact('lawn'));
    }
    public function exteriors(){
        $galleries = Gallery::where('smart_lighting', '!=', '')->where('featured_image', '!=', '')->get();
        $exterior = ExteriorMeta::with('images')->first();
        // $galleries = Gallery::all();
        // echo '<pre>';
        // print_r($gallery);
        // die();
        return view('Front.exteriors',compact('galleries','exterior'));
    }
  
    public function gallery(){
        $gallery = Gallery::with('images')->get();
      
        return view('Front.gallery',compact('gallery'));
    }
}
