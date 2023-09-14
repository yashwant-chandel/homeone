<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class GalleryController extends Controller
{
    //
    public function index(){
        $gallery = Gallery::with('images')->where('status',1)->get();
        // echo '<pre>';
        // print_r($gallery);
        // die();
        return view('Admin.Gallery.index',compact('gallery'));
    }

    public function addGalleryView(Request $request){
        return view('Admin.Gallery.addGallery');
    }
    public function addGallery(Request $request){
        $request->validate([
            'gallery_title' => 'required',
            'slug' => 'required|unique:galleries',
            'images' => 'required',
            'featured_image' => 'required',
            'smart_lighting' => 'required',
        ]);
        try{
                $gallery = new Gallery;
                $gallery->gallery_title = $request->gallery_title;
                $gallery->slug = $request->slug;
                    if ($request->hasFile('featured_image')) {
                        $featuredImage = $request->file('featured_image');
                        $extension = $featuredImage->getClientOriginalExtension();
                        $featuredImageName = 'gallery_'.rand(0,1000).time().'.'.$extension;
                        $featuredImage->move(public_path().'/galleryIMG/',$featuredImageName);
                        
                        $gallery->featured_image = $featuredImageName;    
                    }
                    if ($request->hasFile('smart_lighting')) {
                        $smart_lighting = $request->file('smart_lighting');
                        $extension = $smart_lighting->getClientOriginalExtension();
                        $smart_lightingName = 'gallery_'.rand(0,1000).time().'.'.$extension;
                        $smart_lighting->move(public_path().'/galleryIMG/',$smart_lightingName);
                        
                        $gallery->smart_lighting = $smart_lightingName;    
                    }
               
                $gallery->save();
                
                 $imageNames = $this->uploadImages($request, $gallery->id);
                return redirect()->back()->with('success', 'Gallery has been uploaded');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }

    }

    public function editGallery(Request $request,$slug){
        if($slug){
            $gallery = Gallery::with('images')->where('slug',$slug)->first();
                if (!$gallery) {
                    return redirect()->back()->with('error', 'Gallery not found.');
                }

            return view('Admin.Gallery.update',compact('gallery','slug'));
        }
        return abort(404);
    }

    public function galleryUpdate(Request $request){       
            if ($request->has('existing_images') || $request->hasFile('images')) {

            if ($request->id) {
                $request->validate([
                    'gallery_title' => 'required',
                    'slug' => 'required|unique:products,slug,' . $request->id,
                ]);
                $gallery = Gallery::find($request->id);
                if($gallery){
                    $gallery->gallery_title = $request->gallery_title;
                    $gallery->slug = $request->slug;
                    
                    //  remove images : 
                    $oldImg = $request->oldImg;
                    $existingImg = $request->existing_images;

                    if (!is_null($existingImg)) {
                        $removedImages = array_merge(array_diff($oldImg, $existingImg), array_diff($existingImg, $oldImg));
                    } else {
                        $removedImages = $oldImg;
                    }
                    if($removedImages){
                        foreach ($removedImages as $remove) {
                            $deleteImg = Media::where('id', $remove)->first();
                            
                            if ($deleteImg) {
                                $image_path = public_path('galleryIMG/' . $deleteImg->image_name);
                                
                                if (File::exists($image_path)) {
                                    File::delete($image_path);
                                    $deleteImg->delete();
                                }
                            }
                        }
                    }
                    // end remove Images
                    if ($request->hasFile('featured_image')) {
                        $featuredImage = $request->file('featured_image');
                        $extension = $featuredImage->getClientOriginalExtension();
                        $featuredImageName = 'gallery_'.rand(0,1000).time().'.'.$extension;
                        $featuredImage->move(public_path().'/galleryIMG/',$featuredImageName);
                        
                        $gallery->featured_image = $featuredImageName;    
                    }
                    if ($request->hasFile('smart_lighting')) {
                        $smart_lighting = $request->file('smart_lighting');
                        $extension = $smart_lighting->getClientOriginalExtension();
                        $smart_lightingName = 'gallery_'.rand(0,1000).time().'.'.$extension;
                        $smart_lighting->move(public_path().'/galleryIMG/',$smart_lightingName);
                        
                        $gallery->smart_lighting = $smart_lightingName;    
                    }
                    $imageNames = $this->uploadImages($request, $gallery->id);
                    $gallery->save();

                    return redirect('admin-dashboard/gallery-edit/' . $request->slug)->with('success','Gallery has been updated');
                
                }else{
                    return redirect()->back()->with('error','Failed to update gallery not found !');
                }
             
        }
                
        }else{
            return redirect()->back()->with('error','Gallery Images Not Found !');
        }
        
    }

    protected function uploadImages(Request $request, $galleryId)
    {
        if ($request->hasFile('images') && $galleryId) {
            foreach ($request->file('images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $name = 'gallery_' . rand(0, 1000) . '_' . time() . '.' . $extension;
                $file->move(public_path('galleryIMG'), $name);
    
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = 'galleryIMG/' . $name;
                $media->gallery_id = $galleryId;
                $media->save();
            }
        }
    
        return true;
    }


    public function removeGallery(Request $request, $slug)
    {
        if ($slug) {
            $gallery = Gallery::where('slug', $slug)->first();
    
            if ($gallery) {
                $deleteImg = Media::where('gallery_id', $gallery->id)->get();
    
                foreach ($deleteImg as $remove) {
                    $image_path = public_path('galleryIMG/' . $remove->image_name);
    
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
    
                    $remove->delete(); 
                }
    
                $gallery->delete();
                
                return redirect()->back()->with('success', 'Gallery and related images have been removed');
            } else {
                return redirect()->back()->with('error', 'Invalid Request.');
            }
        }
    }
    
}
