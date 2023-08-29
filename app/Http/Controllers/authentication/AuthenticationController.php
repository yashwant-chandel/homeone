<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AuthenticationController extends Controller
{
    public function index(){
     return view('Authentication.login');
    }
    public function register(){

    }
    public function loginProcc(Request $req){
            $req->validate([
                'email' => 'required',
                'password' => 'required',
                'g-recaptcha-response' => 'required'
            ]);
            $recaptcha = $_POST['g-recaptcha-response'];
                    $secret_key = '6LfWkd0mAAAAAGzO6cmejBLvPy4WMBSZUP-CUoR2';
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
                    $response_json = file_get_contents($url);
                    $response = (array)json_decode($response_json);
            if($response['success'] == 1){
                
            }else{
                return redirect()->back()->with(['error'=>'Google recaptcha is not valid']);
            }
            if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'is_approved'=>1])){
                if(Auth::user()->is_admin == 1){
                return redirect('/admin-dashboard')->with(['success'=>'welcome to admin Dashboard']);
                }else{
                    return redirect('/')->with(['success' => 'successfully loggedin']);
                }
            }else{
                return redirect()->back()->with(['error'=>'your credentials are wrong failed to login']);
            }
    }
    public function registerProcc(Request $request){
         
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/')->with('success',"You have logged out succesfully");
    }

}
