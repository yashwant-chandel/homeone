@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Order List</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-orders">
                                                <thead class="tb-odr-head ">
                                                    <tr class="tb-odr-item ">
                                                        <th class="tb-odr-info d-flex justify-content-between pr-5">
                                                            <span class="tb-odr-id text-center">Order ID</span>
                                                            <span class="tb-odr-date d-none d-md-inline-block text-center">Date</span>
                                                        </th>
                                                        <th class="tb-odr-amount">
                                                            <span class="tb-odr-total">Amount</span>
                                                            <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                                        </th>
                                                        <th class="tb-odr-action">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tb-odr-body">
                                                    @foreach($orders as $order)
                                                    <tr class="tb-odr-item">
                                                        <td class="tb-odr-info">
                                                            <span class="tb-odr-id"><a href="#">#{{ $order['order_num'] ?? '' }}</a></span>
                                                            <span class="tb-odr-date">{{ $order['created_at'] ?? '' }}</span>
                                                        </td>
                                                        <td class="tb-odr-amount">
                                                            <span class="tb-odr-total">
                                                                <span class="amount">${{ $order['total_amount'] ?? '' }}</span>
                                                            </span>
                                                            <span class="tb-odr-status">
                                                                <span class="badge badge-dot bg-success">@if($order['status'] == 1) confirmed @elseif($order['status'] == 2) Shipped @elseif($order['status'] == 3) Delivered @endif</span>
                                                            </span>
                                                        </td>
                                                        <td class="tb-odr-action">
                                                            <div class="tb-odr-btns d-none d-md-inline">
                                                                <a href="{{ url('admin-dashboard/orderview/'.$order['order_num']) }}" class="btn btn-sm btn-primary">View</a>
                                                            </div>
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="#" class="text-primary">Edit</a></li>
                                                                        <li><a href="#" class="text-primary">View</a></li>
                                                                        <li><a href="#" class="text-danger">Remove</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
                                        </div><!-- .card-preview -->
                                    </div>
@endsection