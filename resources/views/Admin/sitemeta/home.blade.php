@extends('admin_layout/index')
@section('content')


<div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="title nk-block-title">Exterior Meta</h4>
                                </div>
                            </div>
                            <form action="{{ url('admin-dashboard/sitemeta/homesubmit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $homemeta->id ?? '' }}">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="background_image">Background Image</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" id="background_image" name="background_image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(isset($homemeta->background_image))
                                                        <div class="col-sm-6">
                                                            <img src="{{ asset('siteIMG/'.$homemeta->background_image) }}" alt="">
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="title">Title</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="title" name="title" value="{{ $homemeta->title ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="preview-hr">
                                                        <span class="preview-title-lg overline-title">About Us</span>
                                                        <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="title">Title</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="title" name="about_us_title" value="{{ $homemeta->about_us_title ?? '' }}">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="subtitle">SubTitle</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="subtitle" name="about_us_subtitle" value="{{ $homemeta->about_us_subtitle ?? '' }}">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="editor1">Text</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" id="editor1" name="about_us" >{{ $homemeta->about_us_text ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="about_image">Image</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" id="about_image" name="about_image" >
                                                                </div>
                                                                @if(isset($homemeta->about_us_image))
                                                                <img class="mt-3" src="{{ asset('siteIMG/'.$homemeta->about_us_image) }}" alt="" width="70%">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        </div>
                                                        <hr class="preview-hr">
                                                        <span class="preview-title-lg overline-title">Middle Section</span>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                             <div class="form-group">
                                                                    <label class="form-label" for="middle_section_title">Heading</label>
                                                                    <div class="form-control-wrap">
                                                                        <input class="form-control" id="middle_section_title" name="middle_section_title" value="{{ $homemeta->middle_section_title ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="editor2">Text</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control" id="editor2" name="middle_section_text">{{ $homemeta->middle_section_text ?? '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            <!-- </div> -->
                                                            <!-- <div class="col-sm-6"> -->
                                                                <div class="form-group">
                                                                    <label class="form-label" for="second_section_images">Images</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="file" class="form-control" id="middle_section_image" name="middle_section_image[]" multiple>
                                                                    </div>
                                                                </div>
                                                            <!-- </div> -->

                                                            <!-- <div class="col-sm-6"> -->
                                                                <div class="form-group">
                                                                    <label class="form-label" for="buttontext">Button Text</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="middlebuttontext" name="middle_button_text" value="{{ $homemeta->middle_button_text ?? '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                @if(isset($homemeta->middle_section_image))
                                                                <?php $imagess = json_decode($homemeta->middle_section_image); ?>
                                                                @if(isset($imagess[0]))
                                                                @foreach($imagess as $image)
                                                                     <img src="{{ asset('siteIMG/'.$image) }}" alt="" width="30%">
                                                                @endforeach
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <hr class="preview-hr">
                                                        <span class="preview-title-lg overline-title">Last Section</span>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="last_section_title">Heading</label>
                                                                <div class="form-control-wrap">
                                                                    <input  class="form-control" id="last_section_title" name="last_section_title" value="{{ $homemeta->last_section_title ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="last_text">Text</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea  class="form-control" id="editor3" name="last_text" >{{ $homemeta->last_section_text ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        <!-- </div>
                                                        <div class="col-sm-6"> -->
                                                        <div class="form-group">
                                                                <label class="form-label" for="buttontext">Button Text</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="buttontext" name="last_button_text" value="{{ $homemeta->last_section_button_text ?? '' }}">
                                                                </div>
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
    ClassicEditor.create( document.querySelector( '#editor1' ) );
    ClassicEditor.create( document.querySelector( '#editor2' ) );
    ClassicEditor.create( document.querySelector( '#editor3' ) );
</script>
@endsection