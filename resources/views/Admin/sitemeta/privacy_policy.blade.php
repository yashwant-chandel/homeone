@extends('admin_layout/index')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Privacy Policy</h4>
                                            </div>
                                        </div>
                                        <form action="{{ url('admin-dashboard/sitemeta/privacysubmit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $privacymeta->id ?? '' }}">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="row">
                                                <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Image</label>
                                                    <div class="form-control-wrap">
                                                        <input type="file" class="form-control" name="background_image" id="default-01" />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <img src="{{ asset('siteIMG/') }}/{{ $privacymeta->background_image ?? '' }}" alt="">
                                                </div>
                                                <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Text</label>
                                                    <div class="form-control-wrap">
                                                        <textarea  class="form-control" id="editor1" name="text" >{{ $privacymeta->Description ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <button class="btn btn-primary btn-md mt-2">Update</button>
                                            </div>
                                        </div><!-- .card-preview -->
                                      
                                    </div>
        <script>
            ClassicEditor.create( document.querySelector( '#editor1' ) );
        </script>

@endsection