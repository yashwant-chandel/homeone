@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Discount Coupons</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">Coupon Code</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Coupon name</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Discount Type</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Amount/Percentage</span>
                                                                    <span>Discount Type</span>
                                                                </span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-amount">
                                                            <span class="tb-tnx-total">Used Type</span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Used Time</span>
                                                        </th>
                                                        <th class="tb-tnx-amount">
                                                            <span class="tb-tnx-total">Expire On</span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                                        </th>
                                                      <th>action</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($discount as $d)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <a ><span>{{ $d->discount_code ?? '' }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{ $d->discount_name ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">{{ $d->amount ?? '' }}</span>
                                                                <span class="date">{{ $d->expire_on ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount">
                                                            <div class="tb-tnx-total">
                                                                <span class="amount">{{ $d->discount_type ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-status">
                                                                <span class="badge badge-dot bg-warning">{{ $d->discount_use ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount">
                                                             <div class="tb-tnx-total">
                                                                <span class="amount">{{ $d->discount_used ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-status">
                                                                <span class="">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input statuscheckbox" type="checkbox" data-id="{{ $d->id ?? '' }}" role="switch" id="flexSwitchCheckDefault" @if($d->status == 1) checked @endif>
                                                                    </div>
                                                            </span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-action">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('admin-dashboard/discounts/update/'.$d->id) }}">Edit</a></li>
                                                                        <li><a class="delete" link="{{ url('admin-dashboard/discounts/delete/'.$d->id) }}">Remove</a></li>
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
                                    <script>
                                        $(document).ready(function(){
                                            $('.delete').click(function(){
                                                    link = $(this).attr('link');
                                                    Swal.fire({
                                                            title: 'Do you want to delete this event?',
                                                            showCancelButton: true,
                                                            confirmButtonText: 'yes',
                                                            confirmButtonColor: '#008000',
                                                            cancelButtonText: 'no',
                                                            cancelButtonColor: '#d33',
                                                            }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location.href = link;
                                                            } 
                                                            }); 
                                            });
                                        });
                                        $(document).ready(function(){
                                        $('.statuscheckbox').on('click',function(){
                                            id = $(this).attr('data-id');
                                            if($(this).is(":checked")){
                                                status = 1;
                                            }else{
                                                status = 0;
                                            }
                                            $.ajax({
                                                method: 'POST',
                                                url: '{{ url('admin-dashboard/updatestatus') }}',
                                                dataType: 'json',
                                                data: {
                                                        id : id,
                                                        status: status,
                                                        _token: '{{csrf_token()}}'
                                                    },
                                                    success: function(response) {
                                                            
                                                        NioApp.Toast(response.success, 'info', {position: 'top-right'});
                                                    }


                                                });
                                        });
                                        });
                                    </script>

@endsection