@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('admin-assets')}}/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Clockpicker -->
<link href="{{asset('admin-assets')}}/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{asset('admin-assets')}}/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{asset('admin-assets')}}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<style>

</style>

@stop
@section('body') 
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
@include('include.flash-msg')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Class</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add New Class</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Class</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('branch/new-class') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" name="where[id]" value="{!! isset($id) ? $id : '' !!}"/>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Class Name</label>
                                        <input type="text" class="form-control" id="class" name="input[class]" placeholder="Class" value="{!! isset($id) ? $details->class : '' !!}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Class Url</label>
                                        <input type="text" class="form-control" id="class_url" name="input[class_url]" placeholder="Class Url" value="{!! isset($id) ? $details->class_url : '' !!}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Class Image</label>
                                        <input type="file" class="form-control" id="class_url" name="class_image" value="{!! isset($id) ? $details->class_image : '' !!}">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 mb-3">
                                        <div class="example">
                                            <p class="mb-1">Class color</p>
                                            <input type="color" class="as_colorpicker form-control" name="input[class_color]" value="{!! isset($id) ? $details->class_color : '' !!}">
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
<!--**********************************
    Content body end
***********************************-->
@stop
@section('script')
<!-- Daterangepicker -->
<script src="{{asset('admin-assets')}}/js/plugins-init/bs-daterange-picker-init.js"></script>
<!-- Pickdate -->
<script src="{{asset('admin-assets')}}/js/plugins-init/pickadate-init.js"></script>
<!-- Clockpicker init -->
<script src="{{asset('admin-assets')}}/js/plugins-init/clock-picker-init.js"></script>
    <!-- asColorPicker init -->
    <script src="{{asset('admin-assets')}}/js/plugins-init/jquery-asColorPicker.init.js"></script>
    <!-- Material color picker init -->
    <script src="{{asset('admin-assets')}}/js/plugins-init/material-date-picker-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
       $(document).on("click", ".edit", function (){
            var id = $(this).data("id");
            $.confirm({
                title: 'What is up?',
                content: 'Are you sure want edit this',
                type: 'green',
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function(){
                            $.get("{!! url('branch/get-single-details') !!}", {'where[id]' : id, 'tab': "class"}, function (html){
                                var obj = $.parseJSON(html);
                                if(obj.code == 200){
                                    $("#new_class_modal input[name='where[id]']").val(obj.data['id']);
                                    $("#new_class_modal input[name='input[class]']").val(obj.data['class']);
                                    $("#new_class_modal input[name='input[class_url]']").val(obj.data['class_url']);
                                    $(".modal-title").text("Update Class");
                                    $("#new_class_modal").modal("show");
                                }else{
                                    $.alert(obj.msg);
                                    location.reload();
                                }

                            });
                        }
                    },
                    cancel: function(){
                        console.log('the user clicked cancel');
                    }
                }
            });
        });
        $(document).on("click", ".changeStatus", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this Class.";
                type = 'green';
            }else{
                msg = "Are you sure do you want non-active this Class.";
                type = 'red';
            }
            $.confirm({
                title: 'What is up?',
                content: msg,
                type: type,
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function(){
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "class", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
                                var obj = $.parseJSON(html);
                                if(obj.code == 200){
                                    $.alert(obj.msg);
                                }else{
                                    $.alert(obj.msg);
                                }
                                setInterval(function(){ location.reload(); }, 3000);

                            });
                        }
                    },
                    cancel: function(){
                        console.log('the user clicked cancel');
                    }
                }
            });
        });

    $(document).on("change", "#class", function(){
        var $title = $(this).val().toLowerCase();
        var res = $title.replace(/ /g, "-");
        $("#class_url").val(res);
    });
    </script>
    
@stop