@extends('admin_layout/index')
@section('content')

<!-- <div class="nk-content "> -->
                    <!-- <div class="container-fluid"> -->
                        <!-- <div class="nk-content-inner"> -->
                            <!-- <div class="nk-content-body"> -->
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3 d-flex justify-content-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Orders</h3>
                                           
                                        </div>
                                        <div>
                                        {{ Breadcrumbs::render('orders') }}
                                        </div>
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title">All Orders</h5>
                                                    </div>
                                                    
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <div class="search-content">
                                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0" id="table">
                                                <div class="nk-tb-list nk-tb-tnx">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span>Orderid</span></div>
                                                        <!-- <div class="nk-tb-col tb-col-xxl"><span></span></div> -->
                                                        <div class="nk-tb-col tb-col-lg"><span>Payment Intent</span></div>
                                                        <div class="nk-tb-col text-end"><span>Employe Detail</span></div>
                                                        <div class="nk-tb-col text-end tb-col-sm"><span>Amount</span></div>
                                                        <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></div>
                                                        <div class="nk-tb-col nk-tb-col-tools"></div>
                                                    </div><!-- .nk-tb-item -->
                                                    @foreach($payments as $payment)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="nk-tnx-type">
                                                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                    <em class="icon ni ni-arrow-up-right"></em>
                                                                </div>
                                                                <div class="nk-tnx-type-text">
                                                                    <span class="tb-lead">#{{ $payment->order_num ?? '' }}</span>
                                                                    <span class="tb-date">{{ $payment->created_at ?? '' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="nk-tb-col tb-col-xxl">
                                                            <span class="tb-lead-sub">Using PayPal Account</span>
                                                            <span class="tb-sub">mypay*****com</span>
                                                        </div> -->
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-lead-sub">#{{ $payment->payment_intent ?? '' }}</span>
                                                            <span class="badge badge-dot bg-success">Deposit</span>
                                                        </div>
                                                        <div class="nk-tb-col text-end">
                                                            <span class="tb-amount">{{ $payment->orders[0]->user['name'] ?? '' }}</span>
                                                            <span class="tb-amount-sm"><a href="{{ url('admin-dashboard/employeregister/?id=') }}{{ $payment->orders[0]->user['id'] ?? '' }}">{{ $payment->orders[0]->user['email'] ?? '' }}</a></span>
                                                        </div>
                                                        <div class="nk-tb-col text-end tb-col-sm">
                                                            <span class="tb-amount"><span>$</span>{{ number_format($payment->payment_ammount,2) ?? '' }}</span>
                                                            <!-- <span class="tb-amount-sm">101290.49 USD</span> -->
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-status">
                                                            <div class="dot dot-success d-md-none"></div>
                                                            <span class="badge badge-sm badge-dim bg-outline-success  d-md-inline-flex">@if($payment->orders[0]->status == 1) Confirmed @elseif($payment->orders[0]->status == 2) Shipped @elseif($payment->orders[0]->status == 3) Delivered @endif</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-2">
                                                                <li class="nk-tb-action-hidden">
                                                                    <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon change-status" order-num="{{ $payment->order_num ?? '' }}" status ={{ $payment->orders[0]->status ?? '' }} data-bs-toggle="tooltip" data-bs-placement="top" title="@if($payment->orders[0]->status == 1) Shipped @elseif($payment->orders[0]->status == 2) Delivered @elseif($payment->orders[0]->status == 3) Confirmed @endif"><em class="icon ni ni-done"></em></a>
                                                                </li>
                                                                <li class="nk-tb-action-hidden">
                                                                    <a href="#tranxDetails{{ $payment->id ?? '' }}" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                                </li>
                                                                <!-- <li>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt">
                                                                                <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                                <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                                <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                                <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li> -->
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                   @endforeach
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                                <!-- <ul class="pagination justify-content-center justify-content-md-start">
                                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                </ul> -->
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            <!-- </div> -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
        @foreach($payments as $p)
        <div class="modal fade" tabindex="-1" id="tranxDetails{{ $p->id ?? '' }}">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <div class="nk-modal-head mb-3 mb-sm-5">
                        <h4 class="nk-modal-title title">Order Id : <small class="text-primary">#{{ $p->order_num ?? '' }}</small></h4>
                    </div>
                    <div class="nk-tnx-details">
                       
                        <div class="nk-modal-head mt-sm-5 mt-4 mb-4">
                            <h5 class="title">Address</h5>
                        </div>
                        <!-- <div class="row gy-3"> -->
                            <div class="col-lg-6 d-flex">
                                <span class="caption-text text-primary"><em class="icon ni ni-map-pin-fill"></em></span>
                                <span class="caption-text"> {{ $p->address->street ?? '' }} ,{{ $p->address->city ?? '' }},{{ $p->address->state ?? '' }}<br>{{ $p->address->country ?? '' }}, {{ $p->address->postal_code ?? '' }}</span>
                            </div>
                            <div class="col-lg-6 d-flex">
                                <span class="caption-text text-primary"><em class="icon ni ni-call-fill"></em></span>
                                <span class="caption-text text-break">{{ $p->mobile ?? '' }}</span>
                            </div>
                            <div class="col-lg-6 d-flex">
                                <span class="sub-text text-primary"><em class="icon ni ni-mail-fill"></em></span>
                                <span class="caption-text">{{ $p->mobile ?? '' }}</span>
                            </div>
                        <div class="nk-modal-head mt-sm-5 mt-4 mb-4">
                            <h5 class="title">Payment Detail</h5>
                        </div>
                        <div class="col-lg-12 d-flex">
                                <span class="caption-text text-primary">Payment Intent : </span>
                                <span class="caption-text"> #{{ $p->payment_intent ?? '' }}</span>
                        </div>
                        <div class="col-lg-12 d-flex">
                                <span class="caption-text text-primary">Payment status : </span>
                               @if($p->status == 1)  <span class="caption-text badge bg-success ms-2 text-white"> success </span>@else <span class="caption-text badge bg-danger ms-2 text-white"> failed </span> @endif
                        </div>
                        <div class="nk-modal-head mt-sm-5 mt-4 mb-4">
                            </a><h5 class="title">Products</h5>
                        </div>
                        <div class="invoice-bills">
                                                <div class="table-responsive">
                                                   
                                                    <table class="table table-striped" >
                                                        <thead>
                                                            <tr>
                                                                <th class="w-150px"></th>
                                                                <th class="w-60">Product name</th>
                                                                <th>Price</th>
                                                                <th>Qty</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($p->orders as $order)
                                                            <tr>
                                                                <td><img src="{{ asset('productIMG') }}/{{ $order->product['featured_image'] ?? '' }}" alt=""></td>
                                                                <td><a href="{{ url('admin-dashboard/product-edit/'.$order->product['slug']) }}">{{ $order->product['product_name'] ?? '' }}</a></td>
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
                                                    
                                                </div>
                                            </div>
                    </div><!-- .nk-tnx-details -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    @endforeach
    <script>
        $('.change-status').click(function(e){
            e.preventDefault();
            status = $(this).attr('status');
            ordernum = $(this).attr('order-num');
            $.ajax({
                method:'post',
                url: '{{ route('order-update') }}',
                data: { status:status,order_num:ordernum,_token:"{{ csrf_token() }}"},
                success: function(response){
                //    location.reload();
                NioApp.Toast(response.success, 'info', {position: 'top-right'});
                setTimeout(function() {
                    location.reload();
                }, 1000);
                }
            })
        })
    </script>
@endsection