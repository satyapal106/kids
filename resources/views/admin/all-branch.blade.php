@extends('layout.admin-master')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<style>
    .mb-md-4, .my-md-4 {margin-bottom: 1.5rem !important;position: absolute;right: 0px;top: 5px;}
    .qrcode{padding: 10px 173px;}
    p{text-align:justify;}
    .border {border: 1px solid #4fc973 !important;
        color: #58b758;
        position: relative;
        display: block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #fff;
        text-align: center;
        font-size: 20px;
        line-height: 40px;
        transition: .6s;
        box-shadow: 0 5px 4px rgb(0 0 0 / 50%);}
    .font-w600 {font-weight: 300;}
    .wspace-no {white-space: nowrap;position: absolute;right: 10px;}
</style>
@stop
@section('body')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Branch</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All Branch</a></li>
            </ol>
        </div>
        <div class="row">
            @if(count($data)!="")
                @foreach($data as $row)
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                        <div class="d-block d-sm-flex mb-3 mb-md-4">
                            <div class="dropdown ml-auto mr-1 d-inline-block">
                                <button type="button" class="btn btn-primary btn-rounded dropdown-toggle light font-w600  mb-2" data-toggle="dropdown" aria-expanded="false">
                                    <i class="las la-check-circle scale5 mr-3"></i>Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{!! url('admin/update-branch?id='.$row->id) !!}">Edit</a>
                                    @if($row->is_active == '1')
                                    <a class="dropdown-item changeStatus" href="javascript:void(0);"  data-id="{!! $row->id !!}" data-status="2">Non Active</a>
                                    @else
                                    <a class="dropdown-item changeStatus" href="javascript:void(0);" data-id="{!! $row->id !!}" data-status="1">Active</a>
                                    @endif
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <div class="tab-content">
                                        <div id="my-posts" class="tab-pane fade active show">
                                            <div class="my-post-content pt-3">
                                                <div class="profile-uoloaded-post pb-5">
                                                    <img src="images/profile/8.jpg" alt="" class="img-fluid">
                                                    <a class="post-title" href="javascript:void()">
                                                        <h4>{{$row->branch}}</h4>
                                                    </a>
                                                    <p class="text-justify">@php echo ($row->short_description) @endphp</p>
                                                        <p class="qrcode">{!! QrCode::size(80)->format('svg')->generate('https://kids.digitalnawab.com/branch/'.($row->branch_url).'/'.base64_encode($row->id)); !!} </p>
                                                    @if($row->is_active == '2')
                                                    <button class="btn btn-secondary"><span class="mr-2"></span>Non Active</button>
                                                    @else
                                                    <button class="btn  btn-primary"><span class="mr-2"></span>Active</button>
                                                    @endif

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <a href="https://api.whatsapp.com/send?text={{$row->branch}} {{url('admin/all-branch')}}" target="_blank">
                                                            <i class="fa fa-whatsapp border border-primary-light rounded-circle mr-3" aria-hidden="true"></i>

                                                        </a>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <a href="'{{$row->email}}:?subject='.{{$row->branch}}.'&body=check Out this side :'.{{url('admin/all-branch')}}.">
                                                            <i class="fa fa-envelope border border-primary-light rounded-circle mr-3 float-right" aria-hidden="true"></i>

                                                        </a>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="https://api.whatsapp.com/send?text={{$row->branch}} {{url('admin/all-branch')}}">
                                                            <i class="<i class='fa-solid fa-message'></i> border border-primary-light rounded-circle mr-3 float-right" aria-hidden="true"></i>

                                                        </a>
                                                    </div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                            $.post("{!! url('admin/update-status') !!}", {'where[id]': id, 'input[is_active]': status, 'tab': "branch", '_token': "{!! csrf_token() !!}"}, function(html){
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
