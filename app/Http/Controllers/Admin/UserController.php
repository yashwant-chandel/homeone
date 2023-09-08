<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmployeApproved;
use Illuminate\Support\Facades\Mail;
use Hash;

class UserController extends Controller
{
   public function index(Request $request){
    // $requests = User::where([['is_admin',0],['is_approved',0]])->get();
    // return view('Admin.Employes.employerequests',compact('requests'));
    $user = User::where([['id',$request->id],['is_admin',0],['is_approved',1]])->first();
    
    return view('Admin.Employes.registeremploye',compact('user'));
   }
   public function list(){
    $employees = User::where([['is_admin',0],['is_approved',1]])->get();
    return view('Admin.Employes.employeslist',compact('employees'));
   }
//    public function employestatus(Request $request){
//     if($request->action == 'approve'){
//         $user = User::find($request->userid);
//         $user->is_approved = 1;
//         $user->update();
//         $response = 'user approved';
//         $mailData = [
//             'userdeatail' => $user,
//             'action' => $request->action,
//         ];
//         $mail = $mail = Mail::to($user->email)->send(new EmployeApproved($mailData));
//     }elseif($request->action == 'deapprove'){
//         $user = User::find($request->userid)->delete();
//         $response = 'user deleted successfully';
//     }else{
//         return response()->json('error');
//     }  
   
   
//     return response()->json(['success'=>$response]);
//    }

public function registerProcc(Request $request){
    if($request->id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'phone' => 'required',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->update();
        if($request->password){
        $mailData = [
            'link' => url('/userloginprocc?email='.$request->email.'&password='.$request->password),
            'action' => $request->action,
            'email' => $request->email,
            'password' => $request->password,
        ];
     
        $mail = Mail::to($request->email)->send(new EmployeApproved($mailData));
        }
        return redirect()->back()->with(['success'=>'New Employe is created successfully and login link will be sent to employe email']);    
    }else{
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users',
        'phone' => 'required',
        'password' => 'required',
    ]);
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->is_approved = 1;
    $user->save();
    $mailData = [
                    'link' => url('/loginprocc?email='.$request->email.'&password='.$request->password),
                    'action' => $request->action,
                    'email' => $request->email,
                    'password' => $request->password,
                ];
    $mail = Mail::to($request->email)->send(new EmployeApproved($mailData));
    return redirect()->back()->with(['success'=>'New Employe is created successfully and login link will be sent to employe email']);    
            }
}
public function delete($id){
    $user = User::find($id);
    $user->delete();
    return redirect()->back()->with(['success'=>'Employe deleted successfully']);
}
}
