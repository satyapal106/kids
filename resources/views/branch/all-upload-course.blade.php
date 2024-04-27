@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
.video-wrapper {
    position: relative;
}

.video-wrapper > video {
    width: 100%;
    vertical-align: middle;
}

.video-wrapper > video.has-media-controls-hidden::-webkit-media-controls {
    display: none;
}

.video-overlay-play-button {
    box-sizing: border-box;
    width: 100%;
    height: 100%;
    padding: 10px calc(50% - 50px);
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    opacity: 0.95;
    cursor: pointer;
    background-image: linear-gradient(transparent, #000);
    transition: opacity 150ms;
}

.video-overlay-play-button:hover {
    opacity: 1;
}

.video-overlay-play-button.is-hidden {
    display: none;
}
.view {cursor: pointer;position: absolute;top: -30px;right: 250px;}
.download {cursor: pointer;position: absolute;top: -30px;right: 100px;}
.card-block{height: 620px;}
</style>
@stop
@section('body')
    @include('include.flash-msg')
<!--**********************************
            Content body start
***********************************-->
    <div class="content-body">
        <!-- row -->

        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Book</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">All Book Details</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Book</h4>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <div class="default-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#details"><i class="la la-home mr-2"></i> Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#chapter"><i class="la la-building mr-2"></i> Chapter</a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" href="#subject"><i class="la la-book mr-2"></i> Subject</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" href="#message"><i class="la la-envelope mr-2"></i> Message</a>--}}
{{--                                    </li>--}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="details" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Title</th>
                                                    <th>Author Name</th>
                                                    <th>Short Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($data)!="")
                                                    @foreach($data as $key=>$row)
                                                        <tr>
                                                            <td>{{$key + 1}}</td>
                                                            <td>{{$row->class}}</td>
                                                            <td>{{$row->subject}}</td>
                                                            <td>{{$row->title}}</td>
                                                            <td>{{$row->author}}</td>
                                                            <td>@php echo ($row->short_description); @endphp</td>
                                                            <td>
                                                                    <span class="badge {!! $row->is_active == '1' ? 'btn-primary' : 'btn-danger' !!}">
                                                                        {!! $row->is_active == '1' ? "Active" : "Non Active" !!}
                                                                    </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm btn-success edit" href="{{url('branch/update-upload-course?id='.$row->course_id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                @if($row->is_active == '1')
                                                                    <a href="#" class="confirm-active btn-sm btn btn-danger" data-id="{!! $row->course_id !!}" data-status="2">
                                                                        <i class="fa fa-close"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="confirm-active btn-sm btn btn-warning" data-id="{!! $row->course_id !!}" data-status="1">
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
                                    <div class="tab-pane fade" id="chapter">
                                           <h4 class="card-title mt-4">All Chapter</h4>
                                           <a  href="{{url('branch/upload-course')}}" type="button" class="btn-sm btn btn-danger mb-2 float-right">+ Add New</a>
                                        <div class="table-responsive">
                                            <table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Upload</th>
                                                    <th>Media Type</th>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($data)!="")
                                                    @foreach($data as $key=>$row)
                                                        <tr>
                                                            <td>{!! $key+1 !!}</td>
                                                            <td>
                                                            @if($row->media_type=="video" || $row->media_type=="youtube")
                                                                @if($row->media_type=="video")
                                                                    <div class="video-wrapper">
                                                                        <video src="{{asset($row->upload)}}" poster="{{asset($row->image)}}" style="width:100px;height:100px;"></video>
                                                                    </div>
                                                                @else
                                                                    <iframe width="100px" height="100px" src="{{$row->media_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                @endif

                                                            @else
                                                                <a href="#">
                                                                    <img src="{{asset($row->upload)}}" width="60px;" height="60px;"  class="rounded-circle" alt="">
                                                                </a>

                                                            @endif
                                                            </td>
{{--                                                            <td><img class="mr-3 img-fluid rounded" width="50" src="{{asset($row->upload)}}" alt="DexignZone"></td>--}}
                                                            <td>{!! $row->media_type !!}</td>
                                                            <td>{!! $row->class !!}</td>
                                                            <td>{!! $row->subject !!}</td>
                                                            <td>
                                                                <span class="badge {!! $row->is_active == '1' ? 'btn-primary' : 'btn-danger' !!}">
                                                                    {!! $row->is_active == '1' ? "Active" : "Non Active" !!}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm btn-success " href="{{url('branch/update-upload-course?id='.$row->course_id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                @if($row->is_active == '1')
                                                                    <a href="#" class="confirm-active btn-sm btn btn-danger" data-id="{!! $row->course_id !!}" data-status="2">
                                                                        <i class="fa fa-close"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="confirm-active btn-sm btn btn-warning" data-id="{!! $row->course_id !!}" data-status="1">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
{{--<div class="container-fluid">--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12">                --}}
{{--            <div class="event-content">--}}
{{--                <div id="event1" class="tab-pane fade active show">--}}
{{--                    <div class="row">--}}
{{--                        @if(count($data)!="") --}}
{{--                            @foreach($data as $row)                               --}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="card card-block mb-3">--}}
{{--                                        <div class="card-header d-flex justify-content-between">--}}
{{--                                            <div class="iq-header-title">--}}
{{--                                                <h4 class="card-title mb-0">{{$row->course_title}}</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="card-header-toolbar mt-1">--}}
{{--                                                <div class="dropdown">--}}
{{--                                                    <span class="dropdown-toggle" id="dropdownMenuButton02" data-toggle="dropdown">--}}
{{--                                                        <i class="ri-more-2-fill"></i>--}}
{{--                                                    </span>--}}
{{--                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton02">--}}
{{--                                                        <a class="dropdown-item " href="{{url('branch/update-upload-course?id='.$row->course_id)}}"><i class="fa fa-edit text-primary mr-2"></i>Edit</a>--}}
{{--                                                        @if($row->is_active == '1')--}}
{{--                                                            <a class="dropdown-item confirm-active" href="javascript:void(0)"  data-id="{!! $row->course_id !!}" data-status="2"><i class="fa fa-close text-primary mr-2"></i>Non Active</a>--}}
{{--                                                        @else  --}}
{{--                                                            <a class="dropdown-item confirm-active" href="javascript:void(0)"  data-id="{!! $row->course_id !!}" data-status="1"><i class="fa fa-check text-primary mr-2"></i>Active</a>--}}
{{--                                                        @endif --}}

{{--                                                        @if($row->is_delete == '1')--}}
{{--                                                            <a class="dropdown-item confirm-delete" href="javascript:void(0)"  data-id="{!! $row->course_id !!}" data-status="2"><i class="fa fa-trash text-primary mr-2"></i>Delete</a>--}}
{{--                                                        @endif    --}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            @if($row->media_type=="video" || $row->media_type=="youtube")--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-lg-12">--}}
{{--                                                    @if($row->media_type=="video")--}}
{{--                                                        <div class="video-wrapper">--}}
{{--                                                            <video src="{{asset($row->upload)}}" poster="{{asset($row->image)}}" style="width:100%;height:200px;"></video>--}}
{{--                                                        </div>--}}
{{--                                                    @else--}}
{{--                                                    --}}
{{--                                                    <iframe width="100%" height="200" src="{{$row->media_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
{{--                                                @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                             @else--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-lg-12">--}}
{{--                                                   <a href="#">--}}
{{--                                                        <img src="{{asset($row->image)}}" width="100%;" height="200px;" alt="">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            --}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-lg-4"></div>--}}
{{--                                                <div class="col-lg-8">--}}
{{--                                                    <a href="{{asset($row->upload)}}" class="btn btn-success view">View</a>--}}
{{--                                                    <a href="{{asset($row->upload)}}" class="btn btn-primary download" download="{{asset($row->upload)}}">Download</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @endif--}}
{{--                                            <hr>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-lg-6">--}}
{{--                                                   <p>{{$row->class}}</p>--}}
{{--                                                   <p>Media Type :{{$row->media_type}}</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-6">--}}
{{--                                                    <p>{{$row->subject}}</p>--}}
{{--                                                    <p>{{$row->name}}</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-lg-12">--}}
{{--                                                    <p>@php echo($row->short_description); @endphp</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif    --}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
       $(document).on("click", ".confirm-active", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this book.";
                type = 'green';
            }else{
                msg = "Are you sure do you want non-active this book.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "book_course", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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
                msg = "Are you sure do you want active this book.";
                type = 'green';
            }else{
                msg = "Are you sure do you want delete this book.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[course_id]' : id, 'tab': "book_course", 'input[is_delete]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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
    <script>
    var videoPlayButton,
	videoWrapper = document.getElementsByClassName('video-wrapper')[0],
    video = document.getElementsByTagName('video')[0],
    videoMethods = {
        renderVideoPlayButton: function() {
            if (videoWrapper.contains(video)) {
				this.formatVideoPlayButton()
                video.classList.add('has-media-controls-hidden')
                videoPlayButton = document.getElementsByClassName('video-overlay-play-button')[0]
                videoPlayButton.addEventListener('click', this.hideVideoPlayButton)
            }
        },

        formatVideoPlayButton: function() {
            videoWrapper.insertAdjacentHTML('beforeend', '\
                <svg class="video-overlay-play-button" viewBox="0 0 200 200" alt="Play video">\
                    <circle cx="100" cy="100" r="90" fill="none" stroke-width="15" stroke="#fff"/>\
                    <polygon points="70, 55 70, 145 145, 100" fill="#fff"/>\
                </svg>\
            ')
        },

        hideVideoPlayButton: function() {
            video.play()
            videoPlayButton.classList.add('is-hidden')
            video.classList.remove('has-media-controls-hidden')
            video.setAttribute('controls', 'controls')
        }
	}

videoMethods.renderVideoPlayButton()
</script>
<script>
     $("#playvideo").click(function(){
      $("#video1")[0].src += "?autoplay=1";
     });
    </script>
@stop