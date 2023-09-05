@extends('admin_layout/index')
@section('content')
                        <div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Employees Request</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx" id="table">
                                                <thead>
                                                    <tr class="tb-tnx-head text-center">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Name</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <!-- <span class="d-md-none">Email</span> -->
                                                                <span class="d-none d-md-block">
                                                                    <span>Eamil</span>
                                                                    <span>Phone</span>
                                                                </span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-amount is-alt">
                                                            <span class="tb-tnx-total">Registered on</span>
                                                        </th>
                                                        <th class="tb-tnx-action">
                                                            <span>&nbsp;</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $count = 1; ?>
                                                    @foreach($requests as $request)
                                                    <tr class="tb-tnx-item text-center">
                                                        <td class="tb-tnx-id">
                                                            <a href="#"><span>#{{ $count++ }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{ $request->email ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">{{ $request->name ?? '' }}</span>
                                                                <span class="date">{{ $request->phone ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount is-alt">
                                                            <div class="tb-tnx-total">
                                                                <span class="amount">{{ $request->created_at ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-action">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="#" user-id = "{{ $request->id ?? '' }}" action="approve" class="approve">Approve</a></li>
                                                                        <li><a href="#" user-id = "{{ $request->id ?? '' }}" action="deapprove" class="approve">Remove</a></li>
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
                                            $("body").delegate(".approve","click",function(e){
                                                e.preventDefault();
                                                userid = $(this).attr('user-id');
                                                action = $(this).attr('action');
                                                $.ajax({
                                                    method: 'post',
                                                    url: '{{ url('employestatus') }}',
                                                    data: { userid:userid,action:action,_token:'{{ csrf_token() }}' },
                                                    dataType: 'json',
                                                    success:function(response){
                                                      if(response == 'error'){
                                                        NioApp.Toast(response['error'], 'info', {position: 'top-right'}); 
                                                        
                                                      }else{
                                                        NioApp.Toast(response['success'], 'info', {position: 'top-right'});
                                                      }
                                                      $("#table").load(location.href + " #table");
                                                    }
                                                })

                                            })
                                        })
                                    </script>
@endsection