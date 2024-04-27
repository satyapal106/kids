@extends('layout.branch_master')
@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('body') 
<div class="content-body">
@include('include.flash-msg')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Subject</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{!! isset($id) ? "Update" : "New" !!} Subject</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{!! isset($id) ? "Update" : "New" !!} Subject</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('branch/new-subject') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="where[id]" value="{!! isset($id) ? $id : '' !!}"/>
                                <div class="form-row">
                                   <div class="form-group col-md-6">
                                        <label>Subject <b style="color:red;">*</b></label>
                                        <input type="text" class="form-control" id="subject" name="input[subject]" placeholder="Subject" value="{!! isset($id) ? $details->subject : '' !!}" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Subject Url <b style="color:red;">*</b></label>
                                        <input type="text" class="form-control" id="subject_url" name="input[subject_url]" value="{!! isset($id) ? $details->subject : '' !!}" placeholder="Subject Url" required/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Subject Image</label>
                                        <input type="file" class="form-control" id="image" name="image"  value="{!! isset($id) ? $details->image : '' !!}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Subject Icon</label>
                                        <input type="file" class="form-control" id="subject_url" name="subject_icon" value="{!! isset($id) ? $details->subject_icon : '' !!}">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label>Background Color</label>
                                        <input type="color" class="form-control"  name="input[background_color]" value="{!! isset($id) ? $details->background_color : '' !!}"  required/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
$(document).on("change", "#subject", function(){
        var $title = $(this).val().toLowerCase();
        var res = $title.replace(/ /g, "-");
        $("#subject_url").val(res);
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