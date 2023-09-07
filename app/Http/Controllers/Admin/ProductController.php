<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){

    }

    public function category(){
        $category = Category::where('status',1)->get();
        return view('Admin.Products.category',compact('category'));
    }
    public function addCategory(Request $request) {
        if ($request->id != '') {
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:categories,slug,' . $request->id,
            ]);
            
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
    
            return response()->json('Successfully updated category');
        } else {
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:categories',
            ]);
    
            $category = new Category;
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
    
            return response()->json('Successfully added category');
        }
    }
    public function deleteCategory(Request $request) {
        if ($request->has('id')) {
            $category = Category::find($request->id);
            if ($category) {
                $category->delete();
                return response()->json('Category deleted successfully');
            } else {
                return response()->json('Category not found');
            }
        } else {
            return response()->json('Missing category');
        }
    }
    
    public function addProductsView(Request $request){

        $category = Category::all();
        return view('Admin.Products.addProducts',compact('category'));
    }
    //  function for add product 

    public function addProduct(Request $request){
        $request->validate([
            'product_name' => 'required',
            'slug' => 'required|unique:products',
            'short_note' => 'required',
            'cat_id' => 'required',
            'Quantity' => 'required',
            'price' => 'required',
            'images' => 'required',
            'featured_image' => 'required',
            'description' => 'required',
            'details' => 'required',
            'sale_price' => 'required',

        ]);
        try {
            $product = new Products;
            $product->product_name = $request->product_name;
            $product->slug = $request->slug;
            $product->short_note = $request->short_note;
            $product->cat_id = $request->cat_id;
            $product->Quantity = $request->Quantity;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->details = $request->details;
            $product->sale_price = $request->sale_price;
            

            if ($request->hasFile('featured_image')) {
                $featuredImage = $request->file('featured_image');
                $extension = $featuredImage->getClientOriginalExtension();
                $featuredImageName = 'product_'.rand(0,1000).time().'.'.$extension;;
                $featuredImage->move(public_path().'/productIMG/',$featuredImageName);
                
                $product->featured_image = $featuredImageName;    
            }

            $imageNames = $this->uploadImages($request);
            $product->images = json_encode($imageNames);

            $product->save();
            return redirect()->back()->with('success','Product added succefully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the product.');
        }
    }

    public function products(Request $request){
        $products = Products::with('category')->get();
        return view('Admin.Products.index',compact('products'));
    }
    // function for return view of edit page :

    public function editProduct(Request $request, $slug) {
        $category = Category::all();
        $product = Products::where('slug', $slug)->with('category')->first();
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        return view('Admin.Products.update', compact('product','category','slug'));
    }
    // function for Product update :

    public function productsUpdate(Request $request){
        if ($request->id) {
            $request->validate([
                'product_name' => 'required',
                'slug' => 'required|unique:products,slug,' . $request->id,
                'short_note' => 'required',
                'cat_id' => 'required',
                'Quantity' => 'required',
                'price' => 'required',
                'description' => 'required',
                'details' => 'required',
                'sale_price' => 'required',
            ]);
        
            try {
                $product = Products::find($request->id);
                $product->product_name = $request->product_name;
                $product->slug = $request->slug;
                $product->short_note = $request->short_note;
                $product->cat_id = $request->cat_id;
                $product->Quantity = $request->Quantity;
                $product->price = $request->price;
                $product->description = $request->description;
                $product->details = $request->details;
                $product->sale_price = $request->sale_price;
        
                $existingImg = [];
                $oldImg = json_decode($request->oldImg);
                $existingImg = $request->existing_images;

                if (!is_null($existingImg)) {
                    $removedImages = array_merge(array_diff($oldImg, $existingImg), array_diff($existingImg, $oldImg));
                } else {
                    $removedImages = $oldImg;
                }
                
                foreach ($removedImages as $remove) {
                    $deleteImg = Media::where('id', $remove)->first();
                    
                    if ($deleteImg) {
                        $image_path = public_path('productIMG/' . $deleteImg->image_name);
                        
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                            $deleteImg->delete();
                        }
                    }
                }
                
                if ($request->hasFile('featured_image')) {
                    $featuredImage = $request->file('featured_image');
                    $extension = $featuredImage->getClientOriginalExtension();
                    $featuredImageName = 'product_' . rand(0, 1000) . time() . '.' . $extension;
                    $featuredImage->move(public_path('productIMG'), $featuredImageName);
                    $product->featured_image = $featuredImageName;
                }
              
                $imageNames = $this->uploadImages($request); 
                if(empty($existingImg)){
                $updatedImageIds = $imageNames;
                }else{
                $updatedImageIds = array_merge($existingImg, $imageNames);
                }
                $product->images = json_encode($updatedImageIds);


                $product->save();
                return redirect('admin-dashboard/product-edit/' . $request->slug)->with('success', 'Product updated successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred while updating the product.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to update product.');
        }
        
    }

    // Function for upload Multiple images and get there Id's in array : 

    protected function uploadImages(Request $request)
    {
        $imageNames = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $name = 'product_' . rand(0, 1000) . '_' . time() . '.' . $extension;
                $file->move(public_path('productIMG'), $name);
    
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = url('productIMG/' . $name);
                $media->save();
    
                $imageNames[] = $media->id;
            }
        }
    
        return $imageNames;
    }

    // Function for remove product with Image form folder and Database :

    public function removeProduct(Request $request,$slug){
        if($slug){
            $product = Products::where('slug', $slug)->first();
    
            if ($product) {
                $removedImages = json_decode($product->images);
                foreach ($removedImages as $remove) {
                    $deleteImg = Media::where('id', $remove)->first();
                    
                    if ($deleteImg) {
                        $image_path = public_path('productIMG/' . $deleteImg->image_name);
                        
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                            $deleteImg->delete();
                        }
                    }
                }
                $product->delete();
            }else{
                return redirect()->back()->with('error', 'Invalid Request.');
            }

            return redirect()->back()->with('success','Product has been removed');
        }
    }
    
        
    }

