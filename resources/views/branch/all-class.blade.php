@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
.dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_paginate, .dataTables_wrapper .dataTables_processing {
    color: #333;
    display: none !important;
}
i{font-size:15px;}
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All Class</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn-sm btn btn-danger mb-2 float-right new_class" data-toggle="modal" data-target="#basicModal">+ Add New Class</button> 
                <!-- Modal -->
                <div class="modal fade" id="new_class_modal">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{!! url('branch/new-class') !!}" enctype="multipart/form-data">
                            <div class="modal-body">
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Image</th>
                                <th>Class Name</th>
                                <th>Class Url</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data)!="")
                            @foreach($data as $key=>$row)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td><img class="mr-3 img-fluid rounded" width="50" src="{{asset($row->class_image)}}" alt="DexignZone"></td>
                                <td>{!! $row->class !!}</td>
                                <td>{!! $row->class_url !!}</td>
                                <td>
                                    <span class="badge {!! $row->is_active == '1' ? 'btn-primary' : 'btn-danger' !!}">
                                        {!! $row->is_active == '1' ? "Active" : "Non Active" !!}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success edit" data-id="{!! $row->id !!}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-edit"></i> 
                                    </a>
                                    @if($row->is_active == '1')
                                    <a href="#" class="changeStatus btn-sm btn btn-danger" data-id="{!! $row->id !!}" data-status="2">
                                        <i class="fa fa-close"></i>
                                    </a>
                                    @else
                                    <a href="#" class="changeStatus btn-sm btn btn-warning" data-id="{!! $row->id !!}" data-status="1">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
      $(".new_class").on("click", function(){
            $("#new_class_modal form").trigger("reset");
            $("#new_class_modal input[name='where[id]']").val("");
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