<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Countries,States,Products,Cart,Order,Payment,Address};
use Illuminate\Support\Str;

use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

use Auth;
use Session;

use Stripe\{ Stripe,SetupIntent,Customer,PaymentIntent,Charge};

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = Cart::with('product')->where('status', 0)->where('user_id', Auth::user()->id)->get();

        $total_amount = Cart::where('status', 0)->where('user_id', Auth::user()->id)->sum('subtotal');

        if ($cart->isEmpty()) {
            return redirect()->back()->with('error','Cart Is empty nothing to checkout '); 
        }

        $setupIntent = SetupIntent::create();
        $client_secret = $setupIntent->client_secret;
        $locations = Countries::with('states')->get();
        // echo '<pre>';
        // print_r($locations);
        // die();
        return view('Front.Checkout.index', compact('client_secret', 'total_amount', 'cart','locations'));
    }


    public function checkout(Request $request)
    {
        echo '<pre>';
        print_r($request->all());
        die();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'street' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'amount' => 'required',
        ]);
// print_r($request->all());
// die();

        $amount = $request->$amount;
        if($request->discount_code != ''){
            $amount = $request->discount_amount;
        }
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // Create customer and payment method
        try {
                $customer = $stripe->customers->create([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'payment_method' => $request->token,
                    'address' => [
                        'line1' => $request->street,
                        'postal_code' => $request->postal_code,
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                    ],
                ]);

                // print_r($customer);
                // die();
                // Attach payment method
                $paymentMethodAttachStatus = $stripe->paymentMethods->attach(
                    $request->token,
                    ['customer' => $customer->id]
                );

                // Create a payment intent
                
                $totalAmountCents = (int)($amount * 100);
                $stripePaymentIntent = $stripe->paymentIntents->create([
                    'customer' => $customer->id,
                    'amount' => $totalAmountCents,
                    'currency' => 'inr',
                    'payment_method' => $request->token,
                    'off_session' => true,
                    'confirm' => true,
                    'description' => 'test description',
                ]);

                // Check the payment intent status to determine success or error
                if ($stripePaymentIntent->status === 'succeeded') {

                    $latestOrderId = Order::latest('id')->value('id') ?? 0;
                    $orderNum = $latestOrderId . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);

                    /* create order */
                    foreach (json_decode($request->products) as $qty => $p_id) {
                        $product = Products::where('id', $p_id)->first();
                        $product->Quantity = $product->Quantity - $qty;
                        $product->save();
                    /*Update cart item   status*/
                        $cartstatus = Cart::where('status', 0)
                            ->where('user_id', Auth::user()->id)
                            ->where('product_id', $p_id)
                            ->update(['status' => 1]);

                            $order = new Order;
                            $order->order_num = $orderNum;
                            $order->product_id = $p_id;
                            $order->product_quantity = $qty;
                            $order->user_id = Auth::user()->id;
                            $order->product_price = $product->sale_price;
                            $order->total_price = $request->amount;
                            $order->save();
                    }
                    /* add Address */
                    $address = new Address;
                    $address->order_num = $orderNum;
                    $address->street = $request->street;
                    $address->postal_code = $request->postal_code;
                    $address->city = $request->city;
                    $address->state = $request->state;
                    $address->country = $request->country;
                    $address->save();

                    /* add payment */
                    $payment = new Payment;
                    $payment->order_num = $orderNum;
                    $payment->email = $request->email;
                    $payment->phone = $request->phone;
                    $payment->payment_intent = $stripePaymentIntent->id;
                    $payment->stripe_customer_id = $customer->id;
                    $payment->total_amount = $request->amount;
                    $payment->payment_ammount = $request->amount;
                    $payment->discount = $orderNum;
                    $payment->save();
                    /* Order booked mail : */
                    $mailData = [
                        'order_num' => $orderNum,
                        'name' => $request->first_name . ' ' . $request->last_name,
                    ];
                    $mail = Mail::to($request->email)->send(new OrderMail($mailData));

                    if($request->discount_code != ''){
                        $coupon = $this->couponUpdate($request); 
                    }

                    return redirect('/')->with('success','Payment succeeded, Your order has been booked.');
                } else {
                    return redirect()->back()->with('error',$stripePaymentIntent->last_payment_error->message);
                }
            } catch (\Stripe\Exception\CardException $e) {
                // Handle card errors (e.g., card declined)
                return redirect()->back()->with('error',$e->getMessage());
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                return redirect()->back()->with('error',$e->getMessage());
            } catch (\Stripe\Exception\AuthenticationException $e) {
                return redirect()->back()->with('error',$e->getMessage());
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                return redirect()->back()->with('error',$e->getMessage());
            } catch (\Stripe\Exception\ApiErrorException $e) {
                return redirect()->back()->with('error',$e->getMessage());
            } catch (Exception $e) {
                return redirect()->back()->with('error',$e->getMessage());
            }

    }
    protected function couponUpdate(Request $request){
        // if($request->discount_code && $request->amount){
        //     $discount = Discount::where('discount_code', $request->discount_code)
        //     ->where('expire_on', '>', now())
        //     ->where('status',1)
        //     ->first();

        //     if($discount){
        //         if($discount->discount_type == 'fixed'){
        //             $amount = $request->amount - $discount->amount;
        //             if($discount->discount_use == 'multiple' ){
        //                 $discount->discount_used += 1;
        //                 $discount->save();
        //             }else{
        //                 $discount->status = 0;
        //                 $$discount->save();
        //             }
        //             return true;
        //         }
        //         if($discount->discount_type == 'percentage'){
        //             $percentage = $discount->amount;
        //             $amount = $request->amount;
                    
        //             $amount = ($percentage / 100) * $amount;
                    
        //             if($discount->discount_use == 'multiple' ){
        //                 $discount->discount_used += 1;
        //                 $discount->save();
        //             }else{
        //                 $discount->status = 0;
        //                 $$discount->save();
        //             }
                    
        //             return response()->json($amount);
        //         }
        //     }
        //     return response()->json(['error','Invalid discount Code or Expire']);
        // }
    
    }




//     public function checkout(Request $request)
//     {

//         $request->validate([
//             'first_name' => 'required',
//             'last_name' => 'required',
//             'email' => 'required',
//             'phone' => 'required',
//             'street' => 'required',
//             'postal_code' => 'required',
//             'city' => 'required',
//             'state' => 'required',
//             'country' => 'required',
//             'amount' => 'required',
//         ]);

//         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

//         // Create customer and payment method
//         try {
//                 $customer = $stripe->customers->create([
//                     'name' => $request->first_name . ' ' . $request->last_name,
//                     'email' => $request->email,
//                     'phone' => $request->phone,
//                     'payment_method' => $request->token,
//                     'address' => [
//                         'line1' => $request->street,
//                         'postal_code' => $request->postal_code,
//                         'city' => $request->city,
//                         'state' => $request->state,
//                         'country' => $request->country,
//                     ],
//                 ]);

//                 // print_r($customer);
//                 // die();
//                 // Attach payment method
//                 $paymentMethodAttachStatus = $stripe->paymentMethods->attach(
//                     $request->token,
//                     ['customer' => $customer->id]
//                 );

//                 // Create a payment intent
//                 $totalAmountCents = (int)($request->amount * 100);
//                 $stripePaymentIntent = $stripe->paymentIntents->create([
//                     'customer' => $customer->id,
//                     'amount' => $totalAmountCents,
//                     'currency' => 'inr',
//                     'payment_method' => $request->token,
//                     'off_session' => true,
//                     'confirm' => true,
//                     'description' => 'test description',
//                 ]);

//                 // Check the payment intent status to determine success or error
//                 if ($stripePaymentIntent->status === 'succeeded') {

//                     $latestOrderId = Order::latest('id')->value('id') ?? 0;
//                     $orderNum = $latestOrderId . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);

//                     /* create order */
//                     foreach (json_decode($request->products) as $qty => $p_id) {
//                         $product = Products::where('id', $p_id)->first();
//                         $product->Quantity = $product->Quantity - $qty;
//                         $product->save();
//                     /*Update cart item   status*/
//                         $cartstatus = Cart::where('status', 0)
//                             ->where('user_id', Auth::user()->id)
//                             ->where('product_id', $p_id)
//                             ->update(['status' => 1]);

//                             $order = new Order;
//                             $order->order_num = $orderNum;
//                             $order->product_id = $p_id;
//                             $order->product_quantity = $qty;
//                             $order->user_id = Auth::user()->id;
//                             $order->product_price = $product->sale_price;
//                             $order->total_price = $request->amount;
//                             $order->save();
//                     }
//                     /* add Address */
//                     $address = new Address;
//                     $address->order_num = $orderNum;
//                     $address->street = $request->street;
//                     $address->postal_code = $request->postal_code;
//                     $address->city = $request->city;
//                     $address->state = $request->state;
//                     $address->country = $request->country;
//                     $address->save();

//                     /* add payment */
//                     $payment = new Payment;
//                     $payment->order_num = $orderNum;
//                     $payment->email = $request->email;
//                     $payment->phone = $request->phone;
//                     $payment->payment_intent = $stripePaymentIntent->id;
//                     $payment->stripe_customer_id = $customer->id;
//                     $payment->total_amount = $request->amount;
//                     $payment->payment_ammount = $request->amount;
//                     $payment->discount = $orderNum;
//                     $payment->save();
//                     /* Order booked mail : */
//                     $mailData = [
//                         'order_num' => $orderNum,
//                         'name' => $request->first_name . ' ' . $request->last_name,
//                     ];
//                     $mail = Mail::to($request->email)->send(new OrderMail($mailData));
//                     return redirect('/')->with('success','Payment succeeded, Your order has been booked.');
//                 } else {
//                     return redirect()->back()->with('error',$stripePaymentIntent->last_payment_error->message);
//                 }
//             } catch (\Stripe\Exception\CardException $e) {
//                 // Handle card errors (e.g., card declined)
//                 return redirect()->back()->with('error',$e->getMessage());
//             } catch (\Stripe\Exception\InvalidRequestException $e) {
//                 return redirect()->back()->with('error',$e->getMessage());
//             } catch (\Stripe\Exception\AuthenticationException $e) {
//                 return redirect()->back()->with('error',$e->getMessage());
//             } catch (\Stripe\Exception\ApiConnectionException $e) {
//                 return redirect()->back()->with('error',$e->getMessage());
//             } catch (\Stripe\Exception\ApiErrorException $e) {
//                 return redirect()->back()->with('error',$e->getMessage());
//             } catch (Exception $e) {
//                 return redirect()->back()->with('error',$e->getMessage());
//             }

//     }


}
