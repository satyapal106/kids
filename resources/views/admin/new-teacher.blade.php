@extends('layout.admin-master')
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Teacher</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{!! isset($id) ? "Update" : "New" !!} Teacher</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{!! isset($id) ? "Update" : "New" !!} Teacher</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('admin/new-teacher') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="where[id]" value="{!! isset($id) ? $id : '' !!}"/>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Branch Name</label>
                                        <select name="input[branch_id]" id="branch_id" class="form-control select2">
                                            @if(count($branch)!="")
                                               @foreach($branch as $row)
                                                <option value="{{$row->id}}">{{$row->branch}}</option>
                                               @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>School Name</label>
                                        <select name="input[school_id]" id="school_id" class="form-control select2">
                                            <option value="0">Please Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Name <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="Teacher Name" value="{!! isset($id) ? $details->name : '' !!}" type="text" name="input[name]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Image <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="image" value="{!! isset($id) ? $details->image : '' !!}" type="file" name="image">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input class="form-control" placeholder="Email" type="text" value="{!! isset($id) ? $details->email : '' !!}" name="input[email]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Contact Number</label>
                                        <input class="form-control" placeholder="Contact Number" type="text" value="{!! isset($id) ? $details->contact_number : '' !!}" name="input[contact_number]" required />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="zip">Pin Code</label>
                                        <input type="text" class="form-control" name="input[zip]" id="zip" placeholder="Pin Code" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="state">City</label>
                                        <input type="text" class="form-control" name="input[city]" id="city" placeholder="Enter your city name." required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="state">State</label>
                                        <input type="address" class="form-control" name="input[state]" id="state" placeholder="Enter your state name." required>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label for="Country">Country</label>
                                        <input type="text" class="form-control" name="input[country]" id="country" placeholder="Country" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Employee Number <b style="color:red;">*</b></label>
                                        <input class="form-control" placeholder="Employee Number" type="text" value="{!! isset($id) ? $details->employee_number : '' !!}" name="input[employee_number]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password</label>
                                        <input class="form-control" placeholder="Password" type="text" value="{!! isset($id) ? $details->password : '' !!}" name="input[password]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Confirm Password</label>
                                        <input class="form-control" placeholder="Confirm Password" type="text" value="{!! isset($id) ? $details->confirm_password : '' !!}" name="input[confirm_password]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Added By</label>
                                        <input class="form-control" placeholder="Added By" type="text" value="{!! isset($id) ? $details->added_by : '' !!}" name="input[added_by]" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="checkbox" name="input[i_agree]" value="I Agree" required>
                                        <label for="vehicle1"> I Agree</label><br>
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
    $(document).on("change", "#branch_id", function () {
        $.post('{!! url('admin/branch-By-school')  !!}', {'branch_id' : $(this).val(), '_token' : "{!! csrf_token() !!}"}, function(html){
            var obj= $.parseJSON(html);
            $("#school_id").html(obj.data);
            $('select').select2();
    });
});
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