@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head d-flex justify-content-between">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Update Gallery</h4>   
        </div>
        <div>
        {{ Breadcrumbs::render('gallery-edit',$slug) }}
        </div>
    </div>
    <div class="card card-bordered">
        <div class="card-inner">
            <form action="{{ url('galleryUpdate') ?? '' }}" class="form-validate" novalidate="novalidate" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-gs">
                    <input type="hidden" name="id" value="{{ $gallery->id ?? '' }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="gallery_title">Gallery Tilte</label>
                            <sup>@error('gallery_title')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="gallery_title" name="gallery_title"  value="{{ $gallery->gallery_title ?? '' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="slug">Gallery Slug</label>
                            <sup>@error('slug')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $gallery->slug ?? '' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="images">Update Featured Image</label>
                            <sup>@error('featured_image')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror</sup>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="featured_image" name="featured_image">
                                    <label class="form-file-label" for="featured_image">Update Featured Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="smart_lighting">Update lighting Image</label>
                            <sup>@error('smart_lighting')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror</sup>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="smart_lighting" name="smart_lighting">
                                    <label class="form-file-label" for="smart_lighting">Update Featured Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row my-3"> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="images">Update Gallery Images</label>
                            <sup>@error('images')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror</sup>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" multiple class="form-file-input" id="images" name="images[]">
                                    <label class="form-file-label" for="images">Add new gallery images</label>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-6 ">
                       
                            <div class="image-row" style="display: flex; flex-wrap: wrap;gap: 1rem;">
                                @foreach ($gallery->images as $image)
                                <input type="hidden" name="oldImg[]" value="{{ $image->id ?? '' }}">
                                    <div class="image-container" style="position: relative;margin-right: 1rem;">
                                        <i data-id="{{ $img->id ?? '' }}" class="fas fa-trash-alt text-danger remove-image" style="position: absolute; cursor: pointer;"></i>
                                        <img class="image-fluid" style="max-width: 5rem" src="{{ asset('galleryIMG/'.$image->image_name) }}" alt="">
                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 my-4"> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Update Gallery</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#gallery_title').on('keyup',function(){
        let name = $(this).val().toLowerCase();
        let slug = name.replace(/\s+/g, "-"); // Replace consecutive spaces with a single dash
        $('#slug').val(slug);
    });

    $('.remove-image').on('click', function (){
        $(this).parent().remove();
    })
});

    
</script>
@endsection