@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Footer Meta</h4>
        </div>
    </div>
    <form action="{{ url('admin-dashboard/sitemeta/lawnsubmit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $lawn->id ?? '' }}">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Background_image">Background Image</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="Background_image" name="Background_image">
                            </div>
                            @if(isset($lawn->background_image))
                            <div class="mt-3">
                                <img src="{{ asset('/siteIMG/'.$lawn->background_image) }}" alt="">
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr class="preview-hr">
                    <span class="preview-title-lg overline-title">First Section</span>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="heading">heading</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="heading" name="heading"
                                    value="{{ $lawn->heading ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="subheading">Sub Heading</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="subheading" name="subheading"
                                    value="{{ $lawn->sub_heading ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="text">Text</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="text" name="text"
                                    value="">{{ $lawn->text ?? '' }} </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="image">Image</label>
                            <div class="form-control-wrap">

                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            @if(isset($lawn->image))
                            <div class="mt-3">
                                <img src="{{ asset('/siteIMG/'.$lawn->image) }}" alt="">
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-md btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#text'))
        .then(editor => { console.log(editor); })
        .catch(error => { console.error(error); });
</script>
@endsection