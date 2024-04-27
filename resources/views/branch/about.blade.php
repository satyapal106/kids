@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
</style>
@stop
@section('body') 
@include('include.flash-msg')
<div class="content-body">
    <div class="container-fluid">
      <div class="page-titles">
         <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tools</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)"> About </a></li>
         </ol>
      </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="py-4 border-bottom">
                    <div class="float-left"><a href="{{url('branch/branch-dashboard')}}" class="badge bg-white back-arrow">Dashboard</a></div>
                    <div class="form-title text-center">
                        <h3>About</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch create-workform">                    
                    <div class="card-body p-5">
                    <form method="post" action="{!! url('branch/about-us') !!}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" id="title" name="input[title]" placeholder="Title"  required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>About Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control ckeditor" name="input[description]"></textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
        $(".new-class").on("click", function(){
            $("#new_class_modal form").trigger("reset");
            $("#new_class_modal input[name='where[id]']");
            $(".modal-title").text("New Class");
            $("#new_class_modal").modal("show");
        });

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
                            $.get("{!! url('branch/get-single-details') !!}", {'where[id]' : id, 'tab': "subject"}, function (html){
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
        $(document).on("click", ".confirm-active", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this subject.";
                type = 'green';
            }else{
                msg = "Are you sure do you want non-active this subject.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "subject", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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

    $(document).on("change", "#subject", function(){
        var $title = $(this).val().toLowerCase();
        var res = $title.replace(/ /g, "-");
        $("#subject_url").val(res);
    });
    </script>
    
@stop