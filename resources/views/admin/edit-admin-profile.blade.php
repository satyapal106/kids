@extends('layout.admin-master')
@section('body')
    <div class="content-body">
        @include('include.flash-msg')
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Admin </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Admin Profile</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Admin Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{!! url('admin/update-profile') !!}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                    <input type="hidden" name="where[id]" value="{!! $data->id !!}"/>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Admin Name </label>
                                            <input class="form-control" placeholder="Admin Name" value="{!!$data->name  !!}" type="text" name="input[name]" required />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input class="form-control" placeholder="Email" type="text" value="{!! $data->email !!}" name="input[email]" required />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Contact Number </label>
                                            <input class="form-control" placeholder="Contact Person" type="text" value="{!!  $data->contact_number !!}" name="input[contact_number]" required />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Image </label>
                                            <input class="form-control" placeholder="Contact Person" type="file" value="{!!  $data->image !!}" name="image" required />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Update Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{!! url('admin/update-password') !!}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Old password</label>
                                            <input class="form-control" placeholder="Old Password" type="text" value="" name="old_password" required />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>password</label>
                                            <input class="form-control" placeholder="New Password" type="text" value="" name="new_password" required />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Confirm Password</label>
                                            <input class="form-control" placeholder="Confirm Password" type="text" value="" name="confirm_password" required />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>

    </script>

@stop