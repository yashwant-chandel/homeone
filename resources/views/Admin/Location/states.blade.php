@extends('admin_layout/index')
@section('content')
<div class="card card-bordered card-preview d-none" id="addnewcard">
    <div class="card-inner">
        <div class="preview-block">
            <div class="d-flex justify-content-between">
                <span class="preview-title-lg overline-title">Add States</span>
                <span class="close"><i class="fas fa-times"></i></span>
            </div>
            <div class="row gy-4">
                <div class="col-sm-6">
                    <form action=""  id="form-data">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label class="form-label" for="state_name">State Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="state_name" id="state_name"
                                    placeholder="State name">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <div class="form-control-wrap ">
                                <select class="form-select js-select22 " id="country_id" name="country_id" data-placeholder="Select a Country" required>
                                    @foreach ($countries as $country)
                                        <option class="form-control country_{{ $country->id ?? '' }}" value="{{ $country->id ?? '' }} ">{{ $country->country_name ?? ''}}</option>
                                    @endforeach
                                </select>
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
            <h4 class="nk-block-title">States</h4>
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
                            <span>State Name</span>
                        </span>
                    </th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Country</span>
                        </span>
                    </th>
                    <th class="tb-tnx-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>     <?php $a = 1; ?>
    @foreach($states as $state)
        <tr class="tb-tnx-item">
            <td class="tb-tnx-id">
                <a href="#"><span>{{ $a++ ?? ''}}</span></a>
            </td>
            <td class="tb-tnx-info">
                <div class="tb-tnx-desc">
                    <input type="text" data-id="{{ $state->id ?? '' }}" class="titleName name{{ $state->id ?? '' }}" value="{{ $state->state_name ?? ''}}"  disabled style="border: none; background: transparent;" />
                </div>
            </td>
            <td class="tb-tnx-info">
                <div class="tb-tnx-desc">
                    <input type="text" data-id="{{ $state->country_id ?? '' }}" class="titleName name{{ $state->country_id ?? '' }}" value="{{ $state->country->country_name ?? ''}}"  disabled style="border: none; background: transparent;" />
                </div>
            </td>
          
            <td class="tb-tnx-action">
                <div class="dropdown drop>
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em
                            class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                        <ul class="link-list-plain">
                            <li><a href="#" data-id ="{{$state->id ?? ''  }}" data-state_name="{{ $state->state_name ?? '' }}" data-country_id="{{ $state->country_id ?? '' }}" class="edit-state" >Edit</a></li>
                            <li><a href="#" data-id ="{{$state->id ?? ''  }}"  class="remove-state" >Remove</a></li>
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
        var state_name = $('#state_name').val();
        var country_id = $('#country_id').val();
        var id = $('#id').val();
        // return false;
        if (state_name === '' || country_id === '') {
            NioApp.Toast('Fields cannot be null', 'info', {position: 'top-right'});
            return false;
        }

        $.ajax({
            method: 'POST',
            url: '{{ url('addState') }}',
            dataType: 'json',
            data: {
                state_name : state_name,
                country_id : country_id,
                    id : id,
                    _token: '{{csrf_token()}}',
                },
            success: function(response) {
                console.log(response);
                    $('#id').val('');
                    $('#state_name').val('');
                    // $('#country_id').val('');
                    // $('.add-new').addClass('d-none');
                    // $('#button_value').html('Add');
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


    $("body").delegate(".edit-state", "click", function (e) {
        $('#addnewcard').removeClass('d-none');
        $('#addnew').hide();
            id = $(this).attr('data-id');
            state_name = $(this).attr('data-state_name');
            country_id = $(this).attr('data-country_id');
            $('#id').val(id);
            $('#state_name').val(state_name);
            $('.country_' + country_id).prop('selected', true);

           

          $('#button_value').html('update');
          $('#add_new').removeClass('d-none');
          window.scrollTo(0, 0);
            
    });

    $("body").delegate(".add-new", "click", function (e) {
            $('#id').val('');
            $('#state_name').val('');
            // $('#country_id').val('');
            $(this).addClass('d-none');
            $('#button_value').html('Add');    
    });

    $("body").delegate(".remove-state", "click", function (e) {
            id = $(this).attr('data-id');
            $.ajax({
            method: 'POST',
            url: '{{ url('state-delete') }}',
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