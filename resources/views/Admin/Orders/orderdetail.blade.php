@extends('admin_layout/index')
@section('content')
<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Order Id: <strong class="text-primary small">#{{ $orderid ?? '' }}</strong></h3>
                                            <div class="nk-block-des text-soft">
                                                <ul class="list-inline">
                                                    <li>Created At: <span class="text-base">{{ $payment->created_at ?? '' }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="invoice">
                                        <div class="invoice-wrap">
                                           
                                            <div class="invoice-head">
                                                <div class="invoice-contact">
                                                    <span class="overline-title">Adderss</span>
                                                    <div class="invoice-contact-info">
                                                        <!-- <h4 class="title">Gregory Ander son</h4> -->
                                                        <ul class="list-plain">
                                                            <li><em class="icon ni ni-map-pin-fill"></em><span>
                                                            {{ $address->street ?? '' }} ,{{ $address->city ?? '' }},{{ $address->state ?? '' }}<br>{{ $address->country ?? '' }}, {{ $address->postal_code ?? '' }}</span></li>
                                                            <li><em class="icon ni ni-call-fill"></em><span>{{ $payment->phone ?? '' }}</span></li>
                                                            <li><a href="mailto:{{ $payment->email ?? '' }}"><em class="icon ni ni-mail-fill"></em><span>{{ $payment->email ?? '' }}</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="invoice-desc">
                                                    <h3 class="title">Payment</h3>
                                                    <ul class="list-plain">
                                                        <li class="invoice-id"><span>Payment Intent</span>:<span>{{ $payment->payment_intent ?? '' }}</span></li>
                                                        <li class="invoice-date"><span>Payment status</span>:<span>@if($payment->status == 1) Completed @else Pending @endif</span></li>
                                                    </ul>
                                                </div>
                                            </div><!-- .invoice-head -->
                                            <div class="invoice-bills">
                                                <div class="table-responsive">
                                                   
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-150px">Item ID</th>
                                                                <th class="w-60">Product name</th>
                                                                <th>Price</th>
                                                                <th>Qty</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($orders as $order)
                                                            <tr>
                                                                <td>24108054</td>
                                                                <td>{{ $order->product['product_name'] ?? '' }}</td>
                                                                <td>${{ $order->product['sale_price'] ?? '' }}</td>
                                                                <td>{{ $order->product_quantity ?? '' }}</td>
                                                                <td>${{ $order->product_price*$order->product_quantity}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">Subtotal</td>
                                                                <td>${{ $order->total_price ?? '' }}</td>
                                                            </tr>
                                                            <!-- <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">Processing fee</td>
                                                                <td>$10.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">TAX</td>
                                                                <td>$43.50</td>
                                                            </tr> -->
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="2">Grand Total</td>
                                                                <td>${{ $order->total_price ?? '' }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was created on a computer and is valid without the signature and seal. </div>
                                                </div>
                                            </div><!-- .invoice-bills -->
                                        </div><!-- .invoice-wrap -->
                                    </div><!-- .invoice -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>

@endsection