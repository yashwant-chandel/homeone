<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmployeApproved;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
   public function index(){
    $requests = User::where([['is_admin',0],['is_approved',0]])->get();
    return view('Admin.Employes.employerequests',compact('requests'));
   }
   public function list(){
    $employees = User::where([['is_admin',0],['is_approved',1]])->get();
    return view('Admin.Employes.employeslist',compact('employees'));
   }
   public function employestatus(Request $request){
    if($request->action == 'approve'){
        $user = User::find($request->userid);
        $user->is_approved = 1;
        $user->update();
        $response = 'user approved';
        $mailData = [
            'userdeatail' => $user,
            'action' => $request->action,
        ];
        $mail = $mail = Mail::to($user->email)->send(new EmployeApproved($mailData));
    }elseif($request->action == 'deapprove'){
        $user = User::find($request->userid)->delete();
        $response = 'user deleted successfully';
    }else{
        return response()->json('error');
    }  
   
   
    return response()->json(['success'=>$response]);
   }
}
