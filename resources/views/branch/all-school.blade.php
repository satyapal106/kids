@extends('layout.branch_master')
@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .ml-auto, .mx-auto {margin-left: auto !important;position: relative;right: 20px;top: 50px;
        z-index: 2;text-align: end !important;}
</style>
@stop
@section('body')
    @php
        $model = new \App\Models\BranchModel();
    @endphp
<!--**********************************
    Content body start
***********************************-->
        <div class="content-body">
          @include('include.flash-msg')
            <!-- row -->
			<div class="container-fluid">
				<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">School</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">All School</a></li>
					</ol>
                </div>
				<div class="row">
                    @if(count($data)!="")
                       @foreach($data as $row)
                            @php
                                $user=$model->getData('tbl_user_login', array('is_active'=>'1','branch_id'=>$row->branch_id, 'school_id'=>$row->school_id),'get');
                            @endphp

                        <div class="col-xl-12 col-xxl-12 col-lg-12">
                            <div class="dropdown ml-auto">
                                <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item"><a href="{{url('branch/update-school',$row->school_id)}}"><i class="fa fa-edit text-primary mr-2"></i>Edit</a></li>
                                    @if($row->is_active == '1')
                                    <li class="dropdown-item"><a href="javascript:void(0)" class="confirm-active" data-id="{!! $row->id !!}" data-status="2"><i class="fa fa-close text-primary mr-2"></i> Non Active</a></li>
                                    @else
                                    <li class="dropdown-item"><a href="javascript:void(0)" class="confirm-active"  data-id="{!! $row->id !!}" data-status="1"><i class="fa fa-check text-primary mr-2"></i> Active</a></li>
                                    @endif
                                    @if($row->is_delete == '1')
                                    <li class="dropdown-item"><a class="confirm-delete" href="javascript:void(0)"  data-id="{!! $row->id !!}" data-status="2"><i class="fa fa-trash text-primary mr-2"></i>Delete</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="media d-sm-flex d-block text-center text-sm-left pb-4 mb-4 border-bottom">
                                        <div class="media-body align-items-center">
                                        @if($row->is_active == '2')
                                            <a href="javascript:void(0);" class="btn bgl-danger btn-rounded mb-2 text-black">
                                            Non Active
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" class="btn bgl-primary btn-rounded mb-2 text-black">
                                                Active
                                            </a>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong>Branch Name</strong></p>
                                                    <span>{{$row->branch}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong>School Name</strong></p>
                                                    <span>{{$row->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong>Contact Person</strong></p>
                                                    <span>{{$row->contact_person}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong>School Email</strong></p>
                                                    <span>{{$row->school_email}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong>Contact Email</strong></p>
                                                    <span>{{$row->contact_email}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong> Contact Number </strong></p>
                                                    <span>{{$row->contact_number}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark"><strong> Pincode </strong></p>
                                                    <span>{{$row->zip}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark font-w600">City</p>
                                                    <span>{{$row->city}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark font-w600">State</p>
                                                    <span>{{$row->state}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="fs-18 text-dark font-w600">Country</p>
                                                    <span>{{$row->country}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Login Type</th>
                                                    <th>User Id</th>
                                                    <th>Password</th>
                                                    <th></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(count($user)!=0)
                                                    @foreach($user as $row_user)
                                                        <tr>
                                                            <td>{!! ucfirst($row_user->user_type) !!}</td>
                                                            <td>{!! $row_user->user_id !!}</td>
                                                            <td>
                                                                <button type="button" data-password="{!! $row_user->user_password !!}" class="btn btn-info btn-sm show-password">Show</button>
                                                            </td>
                                                            <td>
                                                                @if($row_user->is_active=='1')
                                                                    active
                                                                @elseif($row_user->is_active=='2')
                                                                    Non Active
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
                       @endforeach
                    @endif
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
        $(document).on("click", ".confirm-active", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this School.";
                type = 'green';
            }else{
                msg = "Are you sure do you want non-active this School.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "school", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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

        $(document).on("click", ".confirm-delete", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this School.";
                type = 'green';
            }else{
                msg = "Are you sure do you want delete this School.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "school", 'input[is_delete]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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
        $(document).on("click", ".show-password", function (){
            var password=$(this).data("password");
            $.alert(password);
        });
    </script>
@stop