@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Footer Meta</h4>
        </div>
    </div>
    <form action="{{ url('admin-dashboard/sitemeta/footersubmit') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $footer_meta->id ?? '' }}">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="facebook">Facebook Link</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                        value="{{ $footer_meta->facebook_link ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="instagram">Instagram Link</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                        value="{{ $footer_meta->instagram_link ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="footer_text">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $footer_meta->Phone ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="footer_text">Email</label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $footer_meta->Email ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="address1">Address 1</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="address1" name="address1"
                                        value="{{ $footer_meta->Address1 ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="address2">Address 2</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="address2" name="address2"
                                        value="{{ $footer_meta->Address2 ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="footer_text">Footer Text</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" id="footer_text" name="footer_text"
                                        value=""><?php echo isset($footer_meta->left_text); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-md btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#footer_text'))
        .then(editor => { console.log(editor); })
        .catch(error => { console.error(error); });
</script>
@endsection