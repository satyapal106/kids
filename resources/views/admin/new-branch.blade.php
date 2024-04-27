@extends('layout.admin-master')
@section('body') 
@include('include.flash-msg')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Branch</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{!! isset($id) ? "Update" : "New" !!} Branch</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{!! isset($id) ? "Update" : "New" !!} Branch</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('admin/new-branch') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="where[id]" value="{!! isset($id) ? $id : '' !!}"/>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Branch Name <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="Branch Name" value="{!! isset($id) ? $details->branch : '' !!}" type="text" name="input[branch]" id="branch_name" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Branch Url <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="Branch Url" type="text" value="{!! isset($id) ? $details->branch_url : '' !!}" name="input[branch_url]" id="branch_url" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="schedule-end-date">Short Url</label>
                                        <input class="form-control" placeholder="Short Url" type="text" value="{!! isset($id) ? $details->short_url : '' !!}" name="input[short_url]" id="short_url" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="schedule-end-date">logo</label>
                                        <input type="file" id="imgInp" class="form-control" name="logo"  value="{!! isset($id) ? $details->logo : '' !!}"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="schedule-end-date">Contact Number</label>
                                        <input class="form-control" placeholder="Contact Number" type="text" value="{!! isset($id) ? $details->contact_number : '' !!}" name="input[contact_number]" required />
                                    </div>
                                    @if(!isset($id))
                                       <div class="form-group col-md-6">
                                            <label class="form-label" for="schedule-end-date">Login Email <b style="color:red;">*</b></label>
                                            <input class="form-control" placeholder="Email" type="email" id="validate" name="branch_login[0][email]" required />
                                            <span id="validEmail"></span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="schedule-end-date">Login Password <b style="color:red;">*</b></label>
                                            <input class="form-control" placeholder="password" type="text"  name="branch_login[0][password]" required />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="schedule-end-date">Confirm Password <b style="color:red;">*</b></label>
                                            <input class="form-control" placeholder="Confirm password" type="text"  name="branch_login[0][salt_password]" required />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="schedule-end-date">User Name <b style="color:red;">*</b></label>
                                            <input class="form-control" placeholder="User Name" type="text" name="branch_login[0][name]" required />
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label class="form-label" for="schedule-end-date">Short Description</label>
                                        <textarea class="form-control ckeditor" name="input[short_description]">{!! isset($id) ? $details->short_description : '' !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label class="form-label" for="schedule-end-date">Long Description</label>
                                        <textarea class="form-control ckeditor" name="input[long_description]">{!! isset($id) ? $details->long_description : '' !!}</textarea>
                                        </div>
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
   $(document).on("change", "#branch_name", function(){
        var $title = $(this).val().toLowerCase();
        var res = $title.replace(/ /g, "-");
        $("#branch_url").val(res);
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

$(document).ready(function() {
$("#validate").keyup(function(){

    var email = $("#validate").val();

    if(email != 0)
    {
        if(isValidEmailAddress(email))
        {
            $("#validEmail").css({
                "background-image": "url('validYes.png')"
            });
        } else {
            $("#validEmail").css({
                "background-image": "url('validNo.png')"
            });
        }
    } else {
        $("#validEmail").css({
            "background-image": "none"
        });         
    }

});

});
</script>
@stop