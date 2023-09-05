@extends('admin_layout/index')
@section('content')
{{ Breadcrumbs::render('product-add') }}
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Upload Products</h4>   
        </div>
    </div>
    <div class="card card-bordered">
        <div class="card-inner">
            <form action="{{ url('productsAdd') ?? '' }}" class="form-validate" novalidate="novalidate" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="product_name">Product Name</label>
                            <sup>@error('product_name')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                     />
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
                                <input type="text" class="form-control" id="slug" name="slug"  />
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
                                <textarea class="form-control form-control-sm" id="short_note" name="short_note"
                                    placeholder="Write your message" ></textarea>
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
                                <select class="form-select js-select2" id="cat_id" name="cat_id" data-placeholder="Select a option" required>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id ?? '' }} ">{{ $cat->name ?? ''}}</option>
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
                                <input type="number" class="form-control" id="Quantity" name="Quantity"  />
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
                                <input type="number" class="form-control" id="price" name="price"  />
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
                                <input type="number" class="form-control" id="sale_price" name="sale_price"  />
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <sup>@error('description')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror</sup>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm" id="editor-text-section" name="description"
                                    placeholder="Write your description" ></textarea>
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
                                <textarea class="form-control form-control-sm" id="details" name="details"
                                    placeholder="Write your Details" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Save Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
      const editorId = 'editor-text-section';
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
        let slug = name.replace(/\s+/g, "-"); // Replace consecutive spaces with a single dash
        $('#slug').val(slug);
    });
});

    
</script>
@endsection