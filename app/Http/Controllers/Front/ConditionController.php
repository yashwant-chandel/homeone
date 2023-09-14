<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Gallery;
use App\Models\LawnMeta;
use App\Models\PrivacyMeta;
class ConditionController extends Controller
{
    public function privacyPolicy(){
        $privacy = PrivacyMeta::first();

        return view('Front.Conditions.PrivacyAndTerms',compact('privacy'));
    }
    
}
