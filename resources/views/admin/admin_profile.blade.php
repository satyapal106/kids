@extends('layout.admin-master')

@section('style')
<style>
    .border {border: 1px solid #4fc973 !important;color: #58b758;}
    .font-w600 {font-weight: 300;}
    .wspace-no {white-space: nowrap;position: absolute;right: 10px;}
</style>
@stop
@section('body')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Admin Profile</a></li>
                </ol>
            </div>
            <div class="d-md-flex d-block mb-3 align-items-center">
                <div class="widget-timeline-icon py-3 py-md-2 px-1 overflow-auto"></div>
                <div class="dropdown d-inline-block ml-auto mr-2"></div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-xxl-8">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{url('admin/update-admin-profile',$data->id)}}" class="btn btn-primary btn-rounded wspace-no btn-sm"><i class="las scale5 la-pencil-alt mr-2"></i> Edit</a>
                            <div class="media d-sm-flex d-block text-center text-sm-left pb-4 mb-4 border-bottom">
                                <img alt="image" class="rounded mr-sm-4 mr-0" width="130" src="{{asset($data->image)}}">
                                <div class="media-body align-items-center">
                                    <div class="d-sm-flex d-block justify-content-between my-3 my-sm-0">
                                        <div>
                                            <h4 class="fs-22 text-black font-w600 mb-3">
                                                <b>Admin Name:</b> {{$data->name}}</h4>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark font-w600 mb-4">
                                                        <i class="fa fa-phone p-3 border border-primary-light rounded-circle mr-3" aria-hidden="true"></i> +00 123 456 7680</p>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark font-w600 mb-0">
                                                        <i class="fa fa-envelope p-3 border border-primary-light rounded-circle mr-3" aria-hidden="true"></i> {{$data->email}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@stop