@extends('layout.branch_master')
@section('body') 
<div class="content-body">
@include('include.flash-msg')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">School</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Update School</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update School</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('branch/update-school') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="where[id]" value="{!! $details->id !!}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="School Name" value="{!! $details->name !!}" type="text" name="input[name]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Contact Person <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="Contact Person" type="text" value="{!! $details->contact_person  !!}" name="input[contact_person]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>School Email</label>
                                        <input class="form-control" placeholder="School Email" type="text" value="{!! $details->school_email  !!}" name="input[school_email]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Contact Email</label>
                                        <input class="form-control" placeholder="Contact Email" type="text" value="{!! $details->contact_email !!}" name="input[contact_email]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Contact Number</label>
                                        <input class="form-control" placeholder="Contact Number" type="text" value="{!! $details->contact_number  !!}" name="input[contact_number]" required />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="zip">Pin Code</label>
                                        <input type="text" class="form-control" name="input[zip]" id="zip" value="{!! $details->zip !!}"  placeholder="Pin Code" required>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="state">City</label>
                                        <input type="text" class="form-control" name="input[city]" id="city" value="{!! $details->city !!}"  placeholder="Enter your city name." required>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="state">State</label>
                                        <input type="address" class="form-control" name="input[state]" id="state" value="{!! $details->state  !!}"  placeholder="Enter your state name." required>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="Country">Country</label>
                                        <input type="text" class="form-control" name="input[country]" value="{!! $details->country !!}" id="country" placeholder="Country" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label class="form-label" for="schedule-end-date">Note</label>
                                        <textarea class="form-control ckeditor" name="input[note]">{!! $details->note  !!}</textarea>
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

$(document).on("change", "#zip", function(){

var val = $(this).val();
if(val !=""){
    $.post("{!! url('admin/get-address') !!}", {'_token' : '{!! csrf_token() !!}', 'pincode' : val }, function(html){
        var obj = $.parseJSON(html);

        //$("#shipping_city").val(obj['region']);
        $("#city").val(obj['region']);
        $("#state").val(obj['state']);
        $("#country").val(obj['country']);
        return false;
    });
}
});

$(document).on("change", "#add-address-modal input[name=zip]", function(){
var val = $(this).val();
if(val !=""){
    $.post("{!! url('admin/get-address') !!}", {'_token' : '{!! csrf_token() !!}', 'pincode' : val }, function(html){
        console.log(html);
        var obj = $.parseJSON(html);

        //$("#shipping_city").val(obj['region']);
        $("#add-address-modal input[name=city]").val(obj['region']);
        $("#add-address-modal input[name=state]").val(obj['state']);
        $("#add-address-modal input[name=country]").val(obj['country']);
        return false;
    });
}
});
</script>
@stop