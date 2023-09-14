@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head d-flex justify-content-between">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Update Product</h4>   
        </div>
        <div>
        {{ Breadcrumbs::render('product-edit',$slug) }}
        </div>
    </div>
    <div class="card card-bordered">
        <div class="card-inner">
            <form action="{{ url('productsUpdate') ?? '' }}" class="form-validate" novalidate="novalidate" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $product->id ?? '' }}" name="id" />
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="product_name">Product Name</label>
                            <sup>@error('product_name')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name ?? '' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="slug">Product Slug</label>
                            <sup>@error('slug')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="slug" name="slug"  value="{{ $product->slug ?? '' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="short_note">Short Note</label>
                            <sup>@error('slug')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm" id="short_note" name="short_note" value="{{ $product->short_note ?? '' }}"
                                    placeholder="Write your message" ><?php print_r($product->short_note); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="cat_id">Category</label>
                            <sup>@error('cat_id')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap ">
                                <select class="form-select js-select2" id="cat_id" name="cat_id" data-placeholder="Select a option" value="{{ $product->cat_id ?? '' }}">
                                    @foreach ($category as $cat)
                                        @if ($cat->id == $product->cat_id)
                                        <option value="{{ $cat->id ?? '' }} " selected>{{ $cat->name ?? ''}}</option>
                                        @else
                                        <option value="{{ $cat->id ?? '' }} ">{{ $cat->name ?? ''}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Quantity">Product Quantity</label>
                            <sup>@error('Quantity')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" id="Quantity" name="Quantity" value="{{ $product->Quantity ?? ''}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="price">Regular Price</label>
                            <sup>@error('price')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price ?? ''}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="sale_price">Sale Price</label>
                            <sup>@error('sale_price')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" id="sale_price" name="sale_price"  value="{{ $product->sale_price ?? ''}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="featured_image">Featured Image Upload</label>
                            <sup>@error('featured_image')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="featured_image" name="featured_image">
                                    <label class="form-file-label" for="featured_image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="images">Upload Images</label>
                            <sup>@error('images')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror</sup>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" multiple class="form-file-input" id="images" name="images[]">
                                    <label class="form-file-label" for="images">Choose files</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                            <input type="hidden" name="oldImg" value="{{ $product->images ?? '' }}">
                            <?php $images = json_decode($product->images); ?>
                            
                            <div class="image-row" style="display: flex; flex-wrap: wrap;gap: 1rem;">
                                @foreach ($images as $image)
                                    <?php $img = \App\Models\Media::find($image); ?>
                                    <div class="image-container" style="position: relative;margin-right: 1rem;">
                                        <i data-id="{{ $img->id ?? '' }}" class="fas fa-trash-alt text-danger remove-image" style="position: absolute; cursor: pointer;"></i>
                                        <img class="image-fluid" style="max-width: 5rem" src="{{ asset('productIMG') ?? ''  }}/{{ $img->image_name ?? '' }}" alt="">
                                        <input type="hidden" name="existing_images[]" value="{{ $img->id }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <sup>@error('description')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm" id="description" name="description" value="<?php print_r($product->description); ?>"
                                    placeholder="Write your description" ><?php print_r($product->description); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="details">Details</label>
                            <sup>@error('details')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm" id="details" name="details" value="<?php print_r($product->details); ?>"
                                    placeholder="Write your Details" ><?php print_r($product->details); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Update Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
      const editorId = 'description';
             const editor =  ClassicEditor
            .create(document.querySelector(`#${editorId}`))
            .then(editor => {
               
                // console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#details'))
        .then(editor => { console.log(editor); })
        .catch(error => { console.error(error); });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#short_note'))
        .then(editor => { console.log(editor); })
        .catch(error => { console.error(error); });
</script>
<script>
$(document).ready(function(){
    $('#product_name').on('keyup',function(){
        let name = $(this).val().toLowerCase();
        let slug = name.replace(/\s+/g, "-"); 
        $('#slug').val(slug);
    });


    $('.remove-image').on('click', function (){
        $(this).parent().remove();
    })
});

    
</script>
@endsection 