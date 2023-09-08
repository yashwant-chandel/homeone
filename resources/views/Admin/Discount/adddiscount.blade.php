@extends('admin_layout/index')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Add Discount Coupon</h4>
                                               
                                            </div>
                                        </div>
                                        <form action="{{ url('admin-dashboard/discounts/addprocc') }}" method="post">
                                            @csrf
                                        <input type="hidden" name="id" value="">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">                                                
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount_name">Discount Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" name="discount_name" class="form-control" id="discount_name" placeholder="Enter Discount Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount_code">Coupon Code</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" name="discount_code" class="form-control" id="discount_code" placeholder="Enter Coupon code">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-06">Discount Type</label>
                                                                <div class="form-control-wrap ">
                                                                    <div class="form-control-select">
                                                                        <select class="form-control" name="discount_type" id="discount_type">
                                                                            <option value="default_option">Please Select</option>
                                                                            <option value="fixed">Fixed</option>
                                                                            <option value="percentage">Percentage</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="amount">Amount</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-text-hint">
                                                                        <span class="overline-title">Usd</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Input placeholder">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount_use">Discount Use</label>
                                                                <div class="form-control-wrap ">
                                                                    <div class="form-control-select">
                                                                        <select class="form-control" name="discount_use" id="discount_use">
                                                                            <option value="default_option">Please Select</option>
                                                                            <option value="single">Single</option>
                                                                            <option value="multiple">Multiple</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="expire-on">Expire On</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="datetime-local" class="form-control" name="expire_git puon" id="expire-on" placeholder="Input placeholder">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        
                                    </div>
    <script>
       
        $("#discount_name").on('change',function(){
        let random_string = randomString(4, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        let name = $(this).val().toUpperCase();
        let half_name = name.substr(0, 4);
        let coupon_code = '#'+half_name+'-'+random_string;
        $("#discount_code").val(coupon_code);
        });
        function randomString(length, chars) {
            var result = '';
            for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
            return result;
        }
    </script>
@endsection