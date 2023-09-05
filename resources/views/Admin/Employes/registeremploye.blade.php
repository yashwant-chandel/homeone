@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Register New Employe</h4>
                                            </div>
                                            <div>
                                            {{ Breadcrumbs::render('Employe-add') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <form action="{{ url('registerProcc') }}" method="post">
                                                @csrf
                                                @if(isset($_GET['id']))
                                                <input type="hidden" name="id" value="{{ $_GET['id'] }}">
                                                @endif
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="name">Full Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? '' }}">
                                                                </div>
                                                                @if ($errors->has('name'))
                                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email">Email</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}">
                                                                </div>
                                                                @if ($errors->has('email'))
                                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>  
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="phone">Phone</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="phone"name="phone" value="{{ $user->phone ?? '' }}">
                                                                </div>
                                                                @if ($errors->has('phone'))
                                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>  
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="password">password</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="password" class="form-control" id="password" name="password" >
                                                                </div>
                                                                @if ($errors->has('password'))
                                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                                @endif
                                                            </div>
                                                        </div> 
                                                        <div class="col-sm-6 mt-3">
                                                            <div class="form-group">
                                                               <button class="btn btn-primary">Register</button>
                                                            </div>                                                    
                                                        </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>

@endsection