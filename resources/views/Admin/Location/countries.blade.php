@extends('admin_layout/index')
@section('content')
<div class="card card-bordered card-preview d-none" id="addnewcard">
    <div class="card-inner">
        <div class="preview-block">
            <div class="d-flex justify-content-between">
                <span class="preview-title-lg overline-title">Add Country</span>
                <span class="close"><i class="fas fa-times"></i></span>
            </div>
            <div class="row gy-4">
                <div class="col-sm-6">
                    <form action=""  id="form-data">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label class="form-label" for="country_name">Country Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="country_name" id="country_name"
                                    placeholder="Country name">
                            </div>
                        </div>
                       <div class="form-group">
                             <label class="form-label" for="country_code">Country Code</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="country_code" id="country_code"
                                    placeholder="Country code">
                            </div>
                        </div> 

                        <div class="form-group">
                            <button type="button" class="btn btn-primary add" id="add"><span id="button_value">Add</span></button>
                            <button type="button" class="btn btn-primary  add-new d-none" id="add_new"><span >Add New</span></button>                                        
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="nk-block nk-block-lg my-4">
    <div class="nk-block-head">
        <div class="nk-block-head-content d-flex justify-content-between">
            <h4 class="nk-block-title">Categories</h4>
            <button class="btn btn-primary" id="addnew">Add New</button>
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <table class="table table-tranx" id="table">
            <thead>
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class="">#</span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Category Name</span>
                        </span>
                    </th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Category Slug</span>
                        </span>
                    </th>
                    <th class="tb-tnx-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>     <?php $a = 1; ?>
    @foreach($countries as $country)
        <tr class="tb-tnx-item">
            <td class="tb-tnx-id">
                <a href="#"><span>{{ $a++ ?? ''}}</span></a>
            </td>
            <td class="tb-tnx-info">
                <div class="tb-tnx-desc">
                    <input type="text" data-id="{{ $country->id ?? '' }}" class="titleName name{{ $country->id ?? '' }}" value="{{ $country->country_name ?? ''}}"  disabled style="border: none; background: transparent;" />
                </div>
            </td>
            <td class="tb-tnx-info">
                <div class="tb-tnx-desc">
                    <input type="text" data-id="{{ $country->country_code ?? '' }}" class="titleName name{{ $country->country_code ?? '' }}" value="{{ $country->country_code ?? ''}}"  disabled style="border: none; background: transparent;" />
                </div>
            </td>
          
            <td class="tb-tnx-action">
                <div class="dropdown drop>
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em
                            class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                        <ul class="link-list-plain">
                            <li><a href="#" data-id ="{{$country->id ?? ''  }}" data-country_name="{{ $country->country_name ?? '' }}" data-country_code="{{ $country->country_code ?? '' }}" class="edit-category" >Edit</a></li>
                            <li><a href="#" data-id ="{{$country->id ?? ''  }}"  class="remove-country" >Remove</a></li>
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

<!-- Script Area -->
<script>
$(document).ready(function(){
    $("body").delegate(".add", "click", function(e) {
        var country_name = $('#country_name').val();
        var country_code = $('#country_code').val();
        var id = $('#id').val();
        // return false;
        if (country_name === '' || country_code === '') {
            NioApp.Toast('Fields cannot be null', 'info', {position: 'top-right'});
            return false;
        }
        $.ajax({
            method: 'POST',
            url: '{{ url('addCountry') }}',
            dataType: 'json',
            data: {
                country_name : country_name,
                country_code : country_code,
                    id : id,
                    _token: '{{csrf_token()}}',
                },
            success: function(response) {
                console.log(response);
                    $('#id').val('');
                    $('#country_name').val('');
                    $('#country_code').val('');
                    $('.add-new').addClass('d-none');
                    $('#button_value').html('Add');
                NioApp.Toast(response, 'info', {position: 'top-right'});
                $("#table").load(location.href + " #table");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var errors = jqXHR.responseJSON.errors;
                for (var fieldName in errors) {
                    if (errors.hasOwnProperty(fieldName)) {
                        var errorMessages = errors[fieldName];

                        errorMessages.forEach(function(errorMessage) {
                            // console.log(errorMessage);
                            NioApp.Toast(errorMessage, 'error', {
                                position: 'top-right'
                            });
                        });
                    }
                }
            }
        });
   
    });


    $("body").delegate(".edit-category", "click", function (e) {
        $('#addnewcard').removeClass('d-none');
        $('#addnew').hide();
            id = $(this).attr('data-id');
            country_name = $(this).attr('data-country_name');
            country_code = $(this).attr('data-country_code');
            $('#id').val(id);
            $('#country_name').val(country_name);
            $('#country_code').val(country_code);
          $('#button_value').html('update');
          $('#add_new').removeClass('d-none');
          window.scrollTo(0, 0);
            
    });

    $("body").delegate(".add-new", "click", function (e) {
            $('#id').val('');
            $('#country_name').val('');
            $('#country_code').val('');
            $(this).addClass('d-none');
            $('#button_value').html('Add');    
    });

    $("body").delegate(".remove-country", "click", function (e) {
            id = $(this).attr('data-id');
            $.ajax({
            method: 'POST',
            url: '{{ url('country-delete') }}',
            dataType: 'json',
            data: {
                    id : id,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    console.log(response);
                    NioApp.Toast(response, 'info', {position: 'top-right'});
                    $("#table").load(location.href + " #table");
                }


        });
    });

});    
</script>
<script>
    $('#addnew').click(function(){
        $('#addnewcard').removeClass('d-none');
        $(this).hide();
       
    });
     $('.close').click(function(){
            $('#addnewcard').addClass('d-none');
            $('#addnew').show();
        });
</script>
@endsection