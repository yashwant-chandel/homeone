@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head d-flex justify-content-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Gallery</h4>
        </div>
        <div>
        {{ Breadcrumbs::render('gallery') }}
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input " id="checkAll">
                                <label class="custom-control-label checkAll" for="checkAll"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Slug</span></th>
                       
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gallery as $g )
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input checkbox" data-id="{{ $g->id ?? '' }}" id="{{ $g->slug ?? '' }}">
                                <label class="custom-control-label checkboxLabel" for="{{ $g->slug ?? '' }}"></label>
                            </div>
                        </td>
                        <td class="nk-tb-col">
                            <div class="user-card">
                           
                                <div class="user-info">
                                    <span class="tb-lead">{{ $g->gallery_title ?? '' }}</span>
                                   
                                </div>
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-mb" >
                            <span class="tb-amount">{{ $g->slug ?? '' }}</span>
                        </td>
                        
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                            data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ url('admin-dashboard/gallery-edit') ?? '' }}/{{ $g->slug ?? ''}}"><i class="icon fas fa-edit"></i><span>Edit</span></a></li>
                                                <li><a href="{{ url('gallery-remove') ?? '' }}/{{ $g->slug ?? ''}}"><i class="icon fas fa-trash-alt"></i><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection