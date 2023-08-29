<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){

    }

    public function category(){
        $category = Category::where('status',1)->get();
        return view('Admin.Products.category',compact('category'));
    }
    public function addCategory(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return response()->json('successfully add category');
    }
}
