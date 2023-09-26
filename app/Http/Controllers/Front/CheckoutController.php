<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Discount,Countries,States,Products,Cart,Order,Payment,Address};
use Illuminate\Support\Str;

use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

use Auth;
use Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log; // Import Laravel's Log facade

use Stripe\{ Stripe,SetupIntent,Customer,PaymentIntent,Charge};

use App\Services\FedExService;


class CheckoutController extends Controller
{

    // public function calculateShipping()
    // {
    //     // Call the FedEx service to calculate shipping charges
        

    //     // Use $shippingCharges in your checkout process
    // }

        // public function checkout(Request $request)
        // {
        //     // Sample shipment details
        //     $shipmentDetails = [
        //         'weight' => 5, // Weight of the package in pounds
        //         'dimensions' => '12x8x6', // Dimensions of the package in inches (Length x Width x Height)
        //         'origin' => '123 Main St, City, State', // Origin address
        //         'destination' => '456 Destination St, Another City, Another State', // Destination address
        //         'service_type' => 'FEDEX_GROUND', // FedEx service type (e.g., FEDEX_GROUND, FEDEX_2_DAY)
        //     ];
    
        //     // Calculate shipping charges
        //     $shippingCharges = $this->calculateShipping($shipmentDetails);
    
        //     // Use $shippingCharges in your checkout process
        //     echo '<pre>';
        //     print_r($shippingCharges);
        //     die();
        // }
    
        public function sendFedExRequest($payload)
        {
            try {
                $client = new Client();
    
                $headers = [
                    'Content-Type' => 'application/json',
                ];
    
                $url = env('FEDEX_API_URL');
    
                $payload['WebAuthenticationDetail'] = [
                    'UserCredential' => [
                        'Key' => env('FEDEX_API_KEY'),
                        'Password' => env('FEDEX_API_SECRET'),
                    ],
                ];
                $payload['ClientDetail'] = [
                    'AccountNumber' => env('FEDEX_ACCOUNT_NUMBER'),
                ];
    
                $response = $client->post($url, [
                    'headers' => $headers,
                    'json' => $payload,
                ]);
    
                return $responseData;
                $responseData = json_decode($response->getBody(), true);
    
            } catch (\Exception $e) {
                // Handle exceptions (e.g., log the error)
                $error = Log::error('Error sending FedEx API request: ' . $e->getMessage());
    
                // Return an error response if needed
                return  $e->getMessage();
            }
        }
    
        public function checkout()
        {
            $shipmentDetails = [
                'Weight' => 5, 
                'Dimensions' => [
                    'Length' => 12, 
                    'Width' => 8,   
                    'Height' => 6,  
                ],
                'Origin' => [
                    'StreetLines' => '123 Main St',
                    'City' => 'City',
                    'StateOrProvinceCode' => 'ST',
                    'PostalCode' => '12345',
                    'CountryCode' => 'US',
                ],
                'Destination' => [
                    'StreetLines' => '456 Destination St',
                    'City' => 'Another City',
                    'StateOrProvinceCode' => 'AS',
                    'PostalCode' => '67890',
                    'CountryCode' => 'US',
                ],
                'ServiceType' => 'FEDEX_GROUND', 
            ];
    
            $shippingCharges = $this->sendFedExRequest($shipmentDetails);
            
            echo '<pre>';
            print_r($shippingCharges);
            die();
        }
    



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

    // public function checkout(Request $request)
    // {
       
    //     $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'street' => 'required',
    //         'postal_code' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'country' => 'required',
    //         'amount' => 'required',
    //     ]);


    //     $amount = $request->amount;
    //     if($request->discount_code != ''){
    //         $amount = $request->discount_amount;
    //     }
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     // Create customer and payment method
    //     try {
    //             $customer = $stripe->customers->create([
    //                 'name' => $request->first_name . ' ' . $request->last_name,
    //                 'email' => $request->email,
    //                 'phone' => $request->phone,
    //                 'payment_method' => $request->token,
    //                 'address' => [
    //                     'line1' => $request->street,
    //                     'postal_code' => $request->postal_code,
    //                     'city' => $request->city,
    //                     'state' => $request->state,
    //                     'country' => $request->country,
    //                 ],
    //             ]);

    //             // print_r($customer);
    //             // die();
    //             // Attach payment method
    //             $paymentMethodAttachStatus = $stripe->paymentMethods->attach(
    //                 $request->token,
    //                 ['customer' => $customer->id]
    //             );

    //             // Create a payment intent
                
    //             $totalAmountCents = (int)($amount * 100);
    //             $stripePaymentIntent = $stripe->paymentIntents->create([
    //                 'customer' => $customer->id,
    //                 'amount' => $totalAmountCents,
    //                 'currency' => 'inr',
    //                 'payment_method' => $request->token,
    //                 'off_session' => true,
    //                 'confirm' => true,
    //                 'description' => 'test description',
    //             ]);

    //             // Check the payment intent status to determine success or error
    //             if ($stripePaymentIntent->status === 'succeeded') {

    //                 $latestOrderId = Order::latest('id')->value('id') ?? 0;
    //                 $orderNum = $latestOrderId . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);

    //                 /* create order */
    //                 foreach (json_decode($request->products) as $qty => $p_id) {
    //                     $product = Products::where('id', $p_id)->first();
    //                     $product->Quantity = $product->Quantity - $qty;
    //                     $product->save();
    //                 /*Update cart item   status*/
    //                     $cartstatus = Cart::where('status', 0)
    //                         ->where('user_id', Auth::user()->id)
    //                         ->where('product_id', $p_id)
    //                         ->update(['status' => 1]);

    //                         $order = new Order;
    //                         $order->order_num = $orderNum;
    //                         $order->product_id = $p_id;
    //                         $order->product_quantity = $qty;
    //                         $order->user_id = Auth::user()->id;
    //                         $order->product_price = $product->sale_price;
    //                         $order->total_price = $request->amount;
    //                         $order->discount_amount = $request->discount_amount;
    //                         $order->discount_code = $request->discount_code;
    //                         $order->save();
    //                 }
    //                 /* add Address */
    //                 $address = new Address;
    //                 $address->order_num = $orderNum;
    //                 $address->street = $request->street;
    //                 $address->postal_code = $request->postal_code;
    //                 $address->city = $request->city;
    //                 $address->state = $request->state;
    //                 $address->country = $request->country;
    //                 $address->save();

    //                 /* add payment */
    //                 $payment = new Payment;
    //                 $payment->order_num = $orderNum;
    //                 $payment->email = $request->email;
    //                 $payment->phone = $request->phone;
    //                 $payment->payment_intent = $stripePaymentIntent->id;
    //                 $payment->stripe_customer_id = $customer->id;
    //                 $payment->total_amount = $request->amount;
    //                 $payment->payment_ammount = $amount;
    //                 $payment->discount = $request->discount_amount;
    //                 $payment->save();
    //                 /* Order booked mail : */
    //                 $mailData = [
    //                     'order_num' => $orderNum,
    //                     'name' => $request->first_name . ' ' . $request->last_name,
    //                 ];
    //                 $mail = Mail::to($request->email)->send(new OrderMail($mailData));

    //                 if($request->discount_code != ''){
    //                     $coupon = $this->couponUpdate($request); 
    //                 }

    //                 return redirect('/')->with('success','Payment succeeded, Your order has been booked.');
    //             } else {
    //                 return redirect()->back()->with('error',$stripePaymentIntent->last_payment_error->message);
    //             }
    //         } catch (\Stripe\Exception\CardException $e) {
    //             // Handle card errors (e.g., card declined)
    //             return redirect()->back()->with('error',$e->getMessage());
    //         } catch (\Stripe\Exception\InvalidRequestException $e) {
    //             return redirect()->back()->with('error',$e->getMessage());
    //         } catch (\Stripe\Exception\AuthenticationException $e) {
    //             return redirect()->back()->with('error',$e->getMessage());
    //         } catch (\Stripe\Exception\ApiConnectionException $e) {
    //             return redirect()->back()->with('error',$e->getMessage());
    //         } catch (\Stripe\Exception\ApiErrorException $e) {
    //             return redirect()->back()->with('error',$e->getMessage());
    //         } catch (Exception $e) {
    //             return redirect()->back()->with('error',$e->getMessage());
    //         }

    // }
    protected function couponUpdate(Request $request){
        if($request->discount_code){
            $discount = Discount::where('discount_code', $request->discount_code)
            ->where('expire_on', '>', now())
            ->where('status',1)
            ->first();

            if($discount){
                    if($discount->discount_use == 'multiple' ){
                        $discount->discount_used += 1;
                        $discount->save();
                    }else{
                        $discount->status = 0;
                        $discount->save();
                    }
                    return true;
            }
            return false;
        }
    
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
