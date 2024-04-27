@extends('layout.admin-master')
@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css"> 
<style>
   
</style>
@stop
@section('body') 
<!--**********************************
        Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">School</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All School</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>School Name</th>
                                <th>Contact Person</th>
                                <th>School Email</th>
                                <th>Contact Email</th>
                                <th>Contact Number</th>
                                <th>Pincode</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data)!="")
                               @foreach($data as $key=>$row)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td>{!! $row->branch !!}</td>
                                <td>{!! $row->name !!}</td>
                                <td>{{$row->contact_person}}</td>
                                <td>{!! $row->school_email !!}</td>
                                <td>{!! $row->contact_email !!}</td>
                                <td>{!! $row->contact_number!!}</td>
                                <td>{!! $row->zip !!}</td>
                                <td>{!! $row->city !!}</td>
                                <td>{!! $row->state !!}</td>
                                <td>{!! $row->country !!}</td>
                                <td>{!! $row->note !!}</td>
                                <td>
                                    <span class="badge {!! $row->is_active == '1' ? 'btn-primary' : 'btn-danger' !!}">
                                        {!! $row->is_active == '1' ? "Active" : "Non Active" !!}
                                    </span>
                                </td>
                                <td>
                                    <a href="{!! url('admin/update-school?id='.$row->id) !!}">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    @if($row->is_active == '1')
                                    <a href="#" class="changeStatus" data-id="{!! $row->id !!}" data-status="2">
                                        <i class="fa fa-times btn-secondary"></i>
                                    </a>
                                    @else
                                    <a href="#" class="changeStatus" data-id="{!! $row->id !!}" data-status="1">
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
    $(document).on("click", ".changeStatus", function(){
            var id= $(this).data("id"), status = $(this).data("status");
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do you want ?',
                buttons: {
                    Confirm: {
                        btnClass: 'btn-blue done',
                        action: function(){
                            $.post("{!! url('admin/update-status') !!}", {'where[id]': id, 'input[is_active]': status, 'tab': "school", '_token': "{!! csrf_token() !!}"}, function(html){
                                var obj = $.parseJSON(html);
                                if(obj.code == 200){
                                    $.alert(obj.msg);
                                    setInterval(function(){ location.reload(); }, 3000);
                                }else{
                                    $.alert(obj.msg);
                                }
                            });

                        }
                    },
                    Cancel: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.alert("You click cancel.");
                        }
                    },
                }
            });
        });
</script>

@stop