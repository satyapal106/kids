@extends('layout.branch_master')

@section('style') 
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
</style>
@stop
@section('body') 
@include('include.flash-msg')
<div class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="py-4 border-bottom">
                    <div class="float-left"><a href="{{url('branch/branch-dashboard')}}" class="badge bg-white back-arrow">Dashboard</a></div>
                    <div class="form-title text-center">
                        <h3>Update Contact Us Detail </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch create-workform">                    
                    <div class="card-body p-5">
                    <form method="post" action="{!! url('branch/update-contact') !!}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <input type="hidden" name="where[id]" value="{!! $contact->id !!}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" id="title" name="input[title]" value="{!! $contact->title !!}" placeholder="Title"  required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="title" name="input[email]" value="{!! $contact->email !!}" placeholder="Email"  required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" class="form-control" id="title" name="input[contact_number]" value="{!! $contact->contact_number !!}" placeholder="Contact Number"  required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="title" name="input[address]" placeholder="Address" value="{!! $contact->address !!}"  required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Image</label>
                                        <input type="file" class="form-control" id="image" name="image" value="{!! $contact->image !!}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control ckeditor" name="input[description]">{!! $contact->description !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12  mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
 @stop