<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index(){
        $messages = ContactUs::all();
        return view('Admin.ContactUs.index',compact('messages'));
    }

    public function remove(Request $request, $id) {
        if ($id) {
            $contact = ContactUs::find($id);
            if ($contact) {
                $contact->delete();
                return redirect()->back()->with('success','ContactUs message deleted successfully');
            } else {
                return redirect()->back()->with('error','Contact not found');
            }
        } else {
            return redirect()->back()->with('error','Invalid Id');
        }
    }
    

}
