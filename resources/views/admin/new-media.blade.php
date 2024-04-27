@extends('layout.admin-master')
@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
.dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_paginate, .dataTables_wrapper .dataTables_processing {
    color: #333;
    display: none !important;
}
.media-insert{height:260px;}
.btn {padding: 6px 10px;border-radius: 0.75rem;font-weight: 500;font-size: 1rem;}
</style>

@stop
@section('body') 
@include('include.flash-msg')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Types Of Media</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">New Media</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Media</h4>
                        </div>
                        <!-- <a href="#" class="btn btn-primary new-class">Add New Class</a> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive data-table">
                            <table class="data-tables table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Media Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data)!="")
                                       @foreach($data as $key=>$row)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$row->title}}</td>
                                                <td><span class="badge {!! $row->is_active == '1' ? 'badge-success' : 'badge-danger' !!}">{!! $row->is_active == '1' ? "Active" : "Non-Active" !!}</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center list-action">
                                                        <a class="badge bg-success-light mr-2" data-id="{!! $row->id !!}" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"
                                                          href="{{url('admin/update-media',$row->id)}}"><i class="fa fa-edit"></i>
                                                        </a>
                                                        @if($row->is_active != '1')
                                                            <a class="badge bg-warning-light mr-2 confirm-active" data-id="{!! $row->id !!}" data-status="1" data-toggle="tooltip" data-placement="top" title="Active" data-original-title="Active"
                                                            href="#"><i class="fa fa-check"></i>
                                                            </a>
                                                        @else
                                                            <a class="badge bg-warning-light mr-2 confirm-active" data-id="{!! $row->id !!}" data-status="2" data-toggle="tooltip" data-placement="top" title="Non Active" data-original-title="Non Active"
                                                            href="#"><i class="fa fa-close"></i>
                                                            </a>
                                                        @endif
                                                    </div>
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
            <div class="col-lg-4">
                <div class="card media-insert">
                    <div class="card-body">
                       <div class="iq-header-title">
                            <h4 class="card-title mb-0">Add New Media</h4>
                        </div>
                        <hr/>
                        <form method="post" action="{!! url('admin/new-media') !!}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Media</label>
                                        <input type="text" class="form-control" id="class" name="input[title]" required/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
        $(document).on("click", ".confirm-active", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this testimonial.";
                type = 'green';
            }else{
                msg = "Are you sure do you want non-active this testimonial.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "media", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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