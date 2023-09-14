@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Exterior Meta</h4>
                                            </div>
                                        </div>
                                    <form action="{{ url('admin-dashboard/sitemeta/exteriorsubmit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $exterior->id ?? '' }}">
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
                                                        @if(isset($exterior->background_image))
                                                        <div class="col-sm-6">
                                                            <img src="{{ asset('siteIMG/'.$exterior->background_image) }}" alt="">
                                                        </div>
                                                        @endif
                                                    </div>
                                                        <hr class="preview-hr">
                                                        <span class="preview-title-lg overline-title">First Section</span>
                                                        <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="editor1">Text</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" id="editor1" name="first_section_text" id="default-textarea">{{ $exterior->first_section_text ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        <!-- </div> -->
                                                        
                                                        <!-- <div class="col-sm-6"> -->
                                                            <div class="form-group">
                                                                <label class="form-label" for="first_section_image">Image</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" id="first_section_image" name="first_section_image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(isset($exterior->first_section_image))
                                                        <div class="col-sm-6">
                                                            <img src="{{ asset('/siteIMG/'.$exterior->first_section_image) }}" alt="">
                                                        </div>
                                                        @endif
                                                        </div>
                                                        <hr class="preview-hr">
                                                        <span class="preview-title-lg overline-title">Second Section</span>
                                                        <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="editor2">Text</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" id="editor2" name="second_section_text" id="default-textarea">{{ $exterior->second_section_text ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        <!-- </div> -->
                                                        <!-- <div class="col-sm-6"> -->
                                                            <div class="form-group">
                                                                <label class="form-label" for="second_section_images">Images</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" id="second_section_images" name="second_section_images[]" multiple>
                                                                </div>
                                                            </div>
                                                        <!-- </div> -->

                                                        <!-- <div class="col-sm-6"> -->
                                                            <div class="form-group">
                                                                <label class="form-label" for="buttontext">Button Text</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="buttontext" name="buttontext" value="{{ $exterior->second_section_buttontext ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(isset($exterior->second_section_images))
                                                        <?php $secondimages = json_decode($exterior->second_section_images); ?>
                                                        <div class="col-sm-6">
                                                            @foreach($secondimages as $images)
                                                            <img src="{{ asset('siteIMG/'.$images) }}" alt="" width="40%">
                                                            @endforeach
                                                        </div>
                                                        @endif
                                                        </div>
                                                        <hr class="preview-hr">
                                                        <span class="preview-title-lg overline-title">Last Section</span>
                                                        @if(isset($exterior->last_section_titles))
                                                        <?php  $titles = (array) json_decode($exterior->last_section_titles);
                                                        
                                                    
                                                        ?>
                                                        @endif
                                                        <?php  $count = 0; ?>
                                                        <div class="col-sm-6">
                                                         <div class="form-group">
                                                                <label class="form-label" for="last_title">Last Section Title</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="last_title" name="last_title" value="{{ $exterior->last_title ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(isset($exterior->images))
                                                        @foreach($exterior->images as $image)
                                                        <?php $count++; ?>
                                                        <hr class="preview-hr">
                                                        <div class="d-flex justify-content-between">
                                                        <span class="preview-title-lg overline-title">Section {{ $count }}</span>
                                                        <a href="{{ url('admin-dashboard/sitemeta/image/remove?id='.$image->id) }}">close</a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="last_section_texts">Text</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="last_section_texts" name="last_section_texts[]" value="{{ $titles[$image['id']] ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="last_section_images">Image</label>
                                                                <div class="form-control-wrap">
                                                                    <!-- <input type="file" class="form-control" id="last_section_images" name="last_section_images[]"> -->
                                                                    <img src="{{ asset('/siteIMG/'.$image->image_name) }}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        <div class="last_section">

                                                        </div>
                                                        <div class="mt-3">
                                                            <button class="btn btn-md btn-primary">Update</button>
                                                            <button type="button" class="btn btn-md btn-primary addmore">Add More</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <script>
                                    let i = '{{ $count }}';
                                        $('.addmore').click(function(){
                                            i++;
                                            html = '<hr class="preview-hr"><span class="preview-title-lg overline-title">Section '+i+'</span><div class="col-sm-6"> <div class="form-group"><label class="form-label" for="last_section_texts">Text</label><div class="form-control-wrap"><input type="text" class="form-control" id="last_section_texts" name="last_section_texts[]"></div></div></div><div class="col-sm-6"><div class="form-group"><label class="form-label" for="last_section_images">Image</label><div class="form-control-wrap"><input type="file" class="form-control" id="last_section_images" name="last_section_images[]"></div></div></div>';
                                            console.log(html);
                                            $('.last_section').append(html);
                                        })
                                        ClassicEditor.create( document.querySelector( '#editor1' ) );
                                        ClassicEditor.create( document.querySelector( '#editor2' ) );
                                    </script>

@endsection