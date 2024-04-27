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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Subject</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All Subject</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn-sm btn btn-danger mb-2 float-right new_subject" data-toggle="modal" data-target="#basicModal">+ Add New Subject</button>
                <!-- Modal -->
                <div class="modal fade" id="new_subject_modal">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{!! url('branch/new-subject') !!}" enctype="multipart/form-data">
                            <div class="modal-body">
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
                                    <div class="form-group col-md-6">
                                        <label>Subject Image</label>
                                        <input type="file" class="form-control" id="image" name="image"  value="{!! isset($id) ? $details->image : '' !!}">
                                    </div>
                                    <!-- <div class="form-group col-md-4">
                                        <label>Subject Icon</label>
                                        <input type="file" class="form-control" id="subject_url" name="subject_icon" value="{!! isset($id) ? $details->subject_icon : '' !!}">
                                    </div> -->
                                    <div class="form-group col-md-6">
                                    <label>Background Color</label>
                                        <input type="color" class="form-control"  name="input[background_color]" value="{!! isset($id) ? $details->background_color : '' !!}"  required/>
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
                                <th>Subject Image</th>
                                <th>Subject Name</th>
                                <th>Subject Url</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data)!="")
                            @foreach($data as $key=>$row)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td><img class="mr-3 img-fluid rounded" width="50" src="{{asset($row->image)}}" alt="DexignZone"></td>
                                <td>{!! $row->subject !!}</td>
                                <td>{!! $row->subject_url !!}</td>
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
      $(".new_subject").on("click", function(){
            $("#new_subject_modal form").trigger("reset");
            $("#new_subject_modal input[name='where[id]']").val("");
            $(".modal-title").text("New Subject");
            $("#new_subject_modal").modal("show");
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
                                    $("#new_subject_modal input[name='where[id]']").val(obj.data['id']);
                                    $("#new_subject_modal input[name='input[subject]']").val(obj.data['subject']);
                                    $("#new_subject_modal input[name='input[subject_url]']").val(obj.data['subject_url']);
                                    $(".modal-title").text("Update Subject");
                                    $("#new_subject_modal").modal("show");
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
                msg = "Are you sure do you want active this Subject.";
                type = 'green';
            }else{
                msg = "Are you sure do you want non-active this Subject.";
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