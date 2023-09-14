<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterMeta;
use App\Models\LawnMeta;
use App\Models\ExteriorMeta;
use App\Models\Media;
use App\Models\HomeMeta;
use App\Models\PrivacyMeta;

class SiteMetaController extends Controller
{
    public function index(){
       $footer_meta = FooterMeta::first();
       
     return view('Admin.sitemeta.footer',compact('footer_meta'));
    }
    public function footersubmit(Request $request){
        // print_r($request->all());
        if($request->id){
            $footer_meta = FooterMeta::find($request->id);
            $footer_meta->left_text = $request->footer_text;
            $footer_meta->facebook_link = $request->facebook;
            $footer_meta->instagram_link = $request->instagram;
            $footer_meta->Phone = $request->phone;
            $footer_meta->Email = $request->email;
            $footer_meta->Address1 = $request->address1;
            $footer_meta->Address2 = $request->address2;
            $footer_meta->update();
        }else{
        $footer_meta = new FooterMeta();
        $footer_meta->left_text = $request->footer_text;
        $footer_meta->facebook_link = $request->facebook;
        $footer_meta->instagram_link = $request->instagram;
        $footer_meta->Phone = $request->phone;
        $footer_meta->Email = $request->email;
        $footer_meta->Address1 = $request->address1;
        $footer_meta->Address2 = $request->address2;
        $footer_meta->save();
        }
        return redirect()->back()->with(['success','succcessfully updated']);
    }
    public function exterior(){
        $exterior = ExteriorMeta::with('images')->first();
        return view('Admin.sitemeta.exterior',compact('exterior'));
    }
    public function exteriorsubmit(Request $request){
        
        if($request->id){
            $exterior = ExteriorMeta::find($request->id);
            $exterior->first_section_text = $request->first_section_text;
            $exterior->second_section_text = $request->second_section_text;
            $exterior->second_section_buttontext = $request->buttontext;
            $exterior->last_title = $request->last_title;
        if($request->hasFile('background_image')) {
            $backgroundimage = $request->file('background_image');
            $extension = $backgroundimage->getClientOriginalExtension();
            $backgroundimageName = 'exterior_'.rand(0,1000).time().'.'.$extension;
            $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
        } else{
            $backgroundimageName = $exterior->background_image;
        }
        if($request->hasFile('first_section_image')) {
            $firstsectionimage = $request->file('first_section_image');
            $extension = $firstsectionimage->getClientOriginalExtension();
            $first_section_image = 'exterior_'.rand(0,1000).time().'.'.$extension;
            $firstsectionimage->move(public_path().'/siteIMG/',$first_section_image);
        } else{
            $first_section_image = $exterior->first_section_image;
        }
        $second_section_images = json_decode($exterior->second_section_images);
        if($request->hasFile('second_section_images')){
            foreach ($request->file('second_section_images') as $file) {
                $extension2 = $file->getClientOriginalExtension();
                $secondsectionimagename = 'exterior_'.rand(0,1000).time().'.'.$extension2;
                $file->move(public_path().'/siteIMG/',$secondsectionimagename);
                $second_section_images = json_encode($secondsectionimagename);
            }
        }
             $exterior->background_image = $backgroundimageName;
            $exterior->first_section_image = $first_section_image;
            $exterior->second_section_images = json_encode($second_section_images);
            $exterior->update();
        
        }else{
           
            $exterior = new ExteriorMeta;
            $exterior->first_section_text = $request->first_section_text;
            $exterior->second_section_text = $request->second_section_text;
            $exterior->second_section_buttontext = $request->buttontext;
            $exterior->last_title = $request->last_title;
            if($request->hasFile('background_image')) {
                $backgroundimage = $request->file('background_image');
                $extension = $backgroundimage->getClientOriginalExtension();
                $backgroundimageName = 'exterior_'.rand(0,1000).time().'.'.$extension;
                $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
                } else{
                    $backgroundimageName = null;
                }
            if($request->hasFile('first_section_image')) {
                $firstsectionimage = $request->file('first_section_image');
                $extension1 = $firstsectionimage->getClientOriginalExtension();
                $first_section_image = 'exterior_'.rand(0,1000).time().'.'.$extension1;
                $firstsectionimage->move(public_path().'/siteIMG/',$first_section_image);
                } else{
                    $first_section_image = null;
                }
                $secondimages = [];
            if($request->hasFile('second_section_images')){
                foreach ($request->file('second_section_images') as $file) {
                    $extension2 = $file->getClientOriginalExtension();
                    $secondsectionimagename = 'exterior_'.rand(0,1000).time().'.'.$extension2;
                    $file->move(public_path().'/siteIMG/',$secondsectionimagename);
                    array_push($secondimages,$secondsectionimagename);
                }
            }

            $exterior->background_image = $backgroundimageName;
            $exterior->first_section_image = $first_section_image;
            $exterior->second_section_images = json_encode($secondimages);
            $exterior->save();
        }
        $imageNames = $this->uploadImages($request, $exterior->id);
        return redirect()->back()->with('success','successfully updated');
        
    }
    public function lawn(){
        $lawn = LawnMeta::first();
        // dd($lawn);
        return view('Admin.sitemeta.lawn',compact('lawn'));
    }
    public function lawnsubmit(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        if($request->id){
            $lawn = LawnMeta::find($request->id);
            if ($request->hasFile('Background_image')) {
                $backgroundimage = $request->file('Background_image');
                $extension = $backgroundimage->getClientOriginalExtension();
                $backgroundimageName = 'lawn_'.rand(0,1000).time().'.'.$extension;
                $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
                } else{
                    $backgroundimageName = $lawn->background_image;
                }
                $lawn->background_image = $backgroundimageName;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageextension = $image->getClientOriginalExtension();
                    $imageName = 'lawn_'.rand(0,1000).time().'.'.$imageextension;
                    $image->move(public_path().'/siteIMG/',$imageName);
                 }else{
                    $imageName = $lawn->image;
                 } 
                 $lawn->image = $imageName;
                 $lawn->heading = $request->heading;
                 $lawn->sub_heading = $request->subheading;
                 $lawn->text = $request->text;
                 $lawn->update();

        }else{
            $lawn = new LawnMeta;
           if ($request->hasFile('Background_image')) {
            $backgroundimage = $request->file('Background_image');
            $extension = $backgroundimage->getClientOriginalExtension();
            $backgroundimageName = 'lawn_'.rand(0,1000).time().'.'.$extension;
            $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
            } else{
                $backgroundimageName = null;
            }
            $lawn->background_image = $backgroundimageName;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageextension = $image->getClientOriginalExtension();
                $imageName = 'lawn_'.rand(0,1000).time().'.'.$imageextension;
                $image->move(public_path().'/siteIMG/',$imageName);
             }else{
                $imageName = null;
             } 
             $lawn->image = $imageName;
             $lawn->heading = $request->heading;
             $lawn->sub_heading = $request->subheading;
             $lawn->text = $request->text;
             $lawn->save();
        }
        return redirect()->back()->with('success','successfully updated');
        
        
    }


    protected function uploadImages(Request $request, $exteriorid)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '<pre>';
        // die();
        $exterior = ExteriorMeta::find($exteriorid);
        if($exterior->last_section_titles){
            $data = json_decode($exterior->last_section_titles);
            $data1 =  (array)$data;
        }else{
            $data1 = [];
        }
        if ($request->hasFile('last_section_images') && $exteriorid) {
            foreach ($request->file('last_section_images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $name = 'gallery_' . rand(0, 1000) . '_' . time() . '.' . $extension;
                $file->move(public_path('siteIMG'), $name);
    
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = 'siteIMG/' . $name;
                $media->exterior_id = $exteriorid;
                $media->save();
            }
        }
        $medias= Media::where('exterior_id',$exteriorid)->get();
        $count = 0;
        foreach($medias as $m){
            $data1[$m->id] = $request->last_section_texts[$count];
            $count++;
        }
        $exterior->last_section_titles = json_encode($data1);
        $exterior->update();
        return true;
    
        // return true;
    }
    public function home(){
        $homemeta = HomeMeta::first();
        return view('Admin.sitemeta.home',compact('homemeta'));

    }
    public function homeSubmit(Request $request){


        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die();
        if($request->id){
            $homemeta = HomeMeta::find($request->id);
            $homemeta->title = $request->title;
            $homemeta->about_us_text = $request->about_us;
            $homemeta->about_us_title = $request->about_us_title;
            $homemeta->about_us_subtitle = $request->about_us_subtitle;
            $homemeta->middle_section_text = $request->middle_section_text;
            $homemeta->middle_button_text = $request->middle_button_text;
            $homemeta->last_section_text = $request->last_text;
            $homemeta->last_section_button_text = $request->last_button_text;
        if ($request->hasFile('background_image')) {
            $backgroundimage = $request->file('background_image');
            $extension = $backgroundimage->getClientOriginalExtension();
            $backgroundimageName = 'home_'.rand(0,1000).time().'.'.$extension;
            $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
            } else{
                $backgroundimageName = $homemeta->background_image;
            }
        if ($request->hasFile('about_image')) {
                $about_image = $request->file('about_image');
                $extension = $about_image->getClientOriginalExtension();
                $aboutimageName = 'home_'.rand(0,1000).time().'.'.$extension;
                $about_image->move(public_path().'/siteIMG/',$aboutimageName);
                } else{
                    $aboutimageName = $homemeta->about_us_image;
                }
        
        if ($request->hasFile('middle_section_image')) {
            foreach($request->file('middle_section_image') as $file){
                $extension1 = $file->getClientOriginalExtension();
                $imageName = 'home_'.rand(0,1000).time().'.'.$extension1;
                $file->move(public_path().'/siteIMG/',$imageName);
                $imageNames[] = $imageName;
                
        }
                } else{
                    $imageNames = json_decode($homemeta->middle_section_image);
                }
            $homemeta->background_image = $backgroundimageName;
            $homemeta->about_us_image = $aboutimageName;
            $homemeta->middle_section_image = json_encode($imageNames);
            $homemeta->update();

            }else{
                
                $homemeta = new HomeMeta;
                $homemeta->title = $request->title;
                $homemeta->about_us_text = $request->about_us;
                $homemeta->about_us_title = $request->about_us_title;
                $homemeta->about_us_subtitle = $request->about_us_subtitle;
                $homemeta->middle_section_text = $request->middle_section_text;
                $homemeta->middle_button_text = $request->middle_button_text;
                $homemeta->last_section_text = $request->last_text;
                $homemeta->last_section_button_text = $request->last_button_text;
                if ($request->hasFile('background_image')) {
                    $backgroundimage = $request->file('background_image');
                    $extension = $backgroundimage->getClientOriginalExtension();
                    $backgroundimageName = 'home_'.rand(0,1000).time().'.'.$extension;
                    $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
                    } else{
                        $backgroundimageName = null;
            }
            if ($request->hasFile('about_image')) {
                $about_image = $request->file('about_image');
                $extension = $about_image->getClientOriginalExtension();
                $aboutimageName = 'home_'.rand(0,1000).time().'.'.$extension;
                $about_image->move(public_path().'/siteIMG/',$aboutimageName);
                } else{
                    $aboutimageName = null;
                }
            if ($request->hasFile('middle_section_image')) {
                foreach($request->file('middle_section_image') as $file){
                    $extension1 = $file->getClientOriginalExtension();
                    $imageName = 'home_'.rand(0,1000).time().'.'.$extension1;
                    $file->move(public_path().'/siteIMG/',$imageName);
                    $imageNames[] = $imageName;
                    
            }
                    } else{
                        $imageNames = json_decode($homemeta->background_image);
                    }
                $homemeta->background_image = $backgroundimageName;
                $homemeta->about_us_image = $aboutimageName;
                $homemeta->middle_section_image = json_encode($imageNames);
                $homemeta->save();
            }
            return redirect()->back()->with('success','successfully updated home page');
    }
    public function delete(Request $request){
        $media = Media::find($request->id);
        if($media){
            $media->delete();
            return redirect()->back()->with('success','successfully deleted image');
        }else{
            return redirect()->back()->with('error','something went wrong image not find image');
        }

    }

    public function privacypolicy(){
        $privacymeta = PrivacyMeta::first();
        return view('Admin.sitemeta.privacy_policy',compact('privacymeta'));
    }
    public function privacySubmit(Request $request){
      
        if($request->id){
            $privacymeta = PrivacyMeta::find($request->id);
            if ($request->hasFile('background_image')) {
                $backgroundimage = $request->file('background_image');
                $extension = $backgroundimage->getClientOriginalExtension();
                $backgroundimageName = 'home_'.rand(0,1000).time().'.'.$extension;
                $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
                } else{
                    $backgroundimageName = $privacymeta->background_image;
            }
            $privacymeta->background_image = $backgroundimageName;
            $privacymeta->Description = $request->text;
            $privacymeta->save();

        }else{
            $privacymeta = new PrivacyMeta;
            
            if ($request->hasFile('background_image')) {
                $backgroundimage = $request->file('background_image');
                $extension = $backgroundimage->getClientOriginalExtension();
                $backgroundimageName = 'home_'.rand(0,1000).time().'.'.$extension;
                $backgroundimage->move(public_path().'/siteIMG/',$backgroundimageName);
                } else{
                    $backgroundimageName = null;
            }
            $privacymeta->background_image = $backgroundimageName;
            $privacymeta->Description = $request->text;
            $privacymeta->save();
        }
        return redirect()->back()->with('success','Successfully updated');

    }


}
