@extends('layout.branch_master')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .ml-auto, .mx-auto {margin-left: auto !important;position: absolute;top: 10px;right: 10px;z-index: 9999;}
        .new-arrival-content h4 {font-size: 16px;color: #828690;text-transform: capitalize !important;font-weight: 600;margin-bottom: 10px;}
        svg {overflow: hidden;vertical-align: middle;position: absolute;height: 50px;left: 477px;}
        .fa {font-size: 16px !important;}
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Chapter</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">All Chapter</a></li>
                </ol>
            </div>
{{--            <div class="row">--}}
{{--                @if(count($data)!="")--}}
{{--                    @foreach($data as $row)--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="dropdown ml-auto">--}}
{{--                                        <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>--}}
{{--                                        <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <li class="dropdown-item"><a href="{{url('branch/update-book?id='.$row->id)}}"><i class="fa fa-edit text-primary mr-2"></i>Edit</a></li>--}}
{{--                                            @if($row->is_active == '1')--}}
{{--                                                <li class="dropdown-item"><a href="javascript:void(0)" class="confirm-active" data-id="{!! $row->id !!}" data-status="2"><i class="fa fa-close text-primary mr-2"></i> Non Active</a></li>--}}
{{--                                            @else--}}
{{--                                                <li class="dropdown-item"><a href="javascript:void(0)" class="confirm-active"  data-id="{!! $row->id !!}" data-status="1"><i class="fa fa-check text-primary mr-2"></i> Active</a></li>--}}
{{--                                            @endif--}}
{{--                                            @if($row->is_delete == '1')--}}
{{--                                                <li class="dropdown-item"><a class="confirm-delete" href="javascript:void(0)"  data-id="{!! $row->id !!}" data-status="2"><i class="fa fa-trash text-primary mr-2"></i>Delete</a></li>--}}
{{--                                            @endif--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">--}}
{{--                                            <div class="tab-content">--}}
{{--                                                <div role="tabpanel" class="tab-pane fade show active" id="first">--}}
{{--                                                    <img class="img-fluid" src="{{asset($row->upload)}}" alt="">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--Tab slider End-->--}}
{{--                                        <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">--}}
{{--                                            <div class="product-detail-content">--}}
{{--                                                <!--Product details-->--}}
{{--                                                <div class="new-arrival-content pr">--}}
{{--                                                    <h4 class="text-black">Chapter Name: {{$row->course_title}}</h4>--}}
{{--                                                    <p>Class: <span class="item">{{$row->class}}</span></p>--}}
{{--                                                    <p>Subject: <span class="item">{{$row->subject}}</span></p>--}}
{{--                                                    <p>Book Name: <span class="item">{{$row->title}}</span></p>--}}
{{--                                                    <p>Author Name: <span class="item">{{$row->author}}</span></p>--}}

{{--                                                    <!-- Quanatity End -->--}}
{{--                                                    <div class="shopping-cart mt-3">--}}
{{--                                                        @if($row->is_active == '2')--}}
{{--                                                            <a class="btn btn-danger btn-sm" href="#"> Non Active</a>--}}
{{--                                                        @else--}}
{{--                                                            <a class="btn btn-primary btn-sm" href="#">Active</a>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}
            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-danger mb-2 float-right new_chapter" data-toggle="modal" data-target="#basicModal">+ Add New Chapter</button>
                    <!-- Modal -->
                    <div class="modal fade" id="new_chapter_modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{!! url('branch/new-chapter') !!}" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <input type="hidden" name="input[class_id]" value="{!! $detail->class_id !!}"/>
                                        <input type="hidden" name="input[subject_id]" value="{!! $detail->subject_id !!}"/>
                                        <input type="hidden" name="input[school_id]" value="{!! $detail->school_id !!}"/>
                                        <input type="hidden" name="input[book_id]" value="{!! $detail->book_id !!}"/>
                                        <div class="row">
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Class</label>--}}
{{--                                                    <select name="input[class_id]" class="form-control" id="">--}}
{{--                                                        <option value="">Select Class</option>--}}
{{--                                                        @if(count($class)!="")--}}
{{--                                                            @foreach($class as $row)--}}
{{--                                                                <option value="{{$row->id}}" {!! isset($id) ? ($details->class_id == $book->id ? "Selected" : "") : "" !!}>{{$row->class}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endif--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label> Subject</label>--}}
{{--                                                    <select name="input[subject_id]" class="form-control" id="">--}}
{{--                                                        <option value="">Subject Subject</option>--}}
{{--                                                        @if(count($subject)!="")--}}
{{--                                                            @foreach($subject as $row)--}}
{{--                                                                <option value="{{$row->id}}" {!! isset($id) ? ($details->subject_id == $row->id ? "Selected" : "") : "" !!}>{{$row->subject}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endif--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label> School</label>--}}
{{--                                                    <select name="input[school_id]" class="form-control" id="">--}}
{{--                                                        <option value="">Select School</option>--}}
{{--                                                        @if(count($school)!="")--}}
{{--                                                            @foreach($school as $row)--}}
{{--                                                                <option value="{{$row->id}}" {!! isset($id) ? ($details->school_id == $row->id ? "Selected" : "") : "" !!}>{{$row->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endif--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            {{--                                        <div class="col-md-6">--}}
                                            {{--                                            <div class="form-group">--}}
                                            {{--                                                <label>Book</label>--}}
                                            {{--                                                <select name="input[book_id]" class="form-control" id="">--}}
                                            {{--                                                    <option value="">Select Book</option>--}}
                                            {{--                                                    @if(count($book)!="")--}}
                                            {{--                                                        @foreach($book as $row)--}}
                                            {{--                                                            <option value="{{$row->id}}" {!! isset($id) ? ($details->book_id == $row->id ? "Selected" : "") : "" !!}>{{$row->title}}</option>--}}
                                            {{--                                                        @endforeach--}}
                                            {{--                                                    @endif--}}
                                            {{--                                                </select>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Title</label>
                                                    <input type="text" class="form-control" id="title" name="input[course_title]" value="{!! isset($id) ? $details->course_title : '' !!}"  placeholder="Title" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Media Type</label>
                                                    <select name="input[media_type]" id="type" class="form-control">
                                                        <option value="video" {!! isset($id) ? ($details->media_type =='video' ? "Selected" : "") : "" !!}>upload Video</option>
                                                        <option value="ebook" {!! isset($id) ? ($details->media_type == 'ebook' ? "Selected" : "") : "" !!}>upload Ebook</option>
                                                        <option value="youtube" {!! isset($id) ? ($details->media_type =='youtube' ? "Selected" : "") : "" !!}>Url Youtube</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="upload-div">
                                                    <label>Upload (video/Pdf) <span style="color:red">*</span></label>
                                                    <input type="file" class="form-control" id="image"  name="upload">
                                                </div>
                                                <div class="form-group" id="upload-url" style="display:none">
                                                    <label>Media Url <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control"  name="input[media_url]"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12  mt-3">
                                                <button type="submit" class="btn btn-success">Submit</button>
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
{{--                    <a  href="{{url('branch/new-chapter')}}" type="button" class="btn-sm btn btn-danger mb-2 float-right">+ Add New Chapter</a>--}}
                </div>
                <div class="table-responsive">
                    <table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Upload</th>
                            <th>Media Type</th>
                            <th>Chapter Name</th>
                            <th>Class Name</th>
                            <th>Subject Name</th>
                            <th>Book Name</th>
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
                                                    <video src="{{asset($row->upload)}}" poster="{{asset($row->image)}}" style="width:60px;height:60px;"></video>
                                                </div>
                                            @else
                                                <iframe width="60px" height="60px" src="{{$row->media_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            @endif

                                        @else
                                            <a href="{{asset($row->upload)}}">
                                                <i class="fa fa-download pl-4" style="font-size: 30px;"></i>
{{--                                                <img src="{{asset($row->image)}}" width="60px;" height="60px;"  class="rounded-circle" alt="">--}}
                                            </a>

                                        @endif
                                    </td>
                                    {{--                                                            <td><img class="mr-3 img-fluid rounded" width="50" src="{{asset($row->upload)}}" alt="DexignZone"></td>--}}
                                    <td>{!! $row->media_type !!}</td>
                                    <td>{!! $row->course_title !!}</td>
                                    <td>{!! $row->class !!}</td>
                                    <td>{!! $row->subject !!}</td>
                                    <td>{!! $row->title !!}</td>
                                    <td>
                                                                <span class="badge {!! $row->is_active == '1' ? 'btn-primary' : 'btn-danger' !!}">
                                                                    {!! $row->is_active == '1' ? "Active" : "Non Active" !!}
                                                                </span>
                                    </td>
                                    <td>
                                        <a class="#" href="{{url('branch/update-upload-course?id='.$row->course_id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if($row->is_active == '1')
                                            <a href="javascript:void(0)" class="confirm-active " data-id="{!! $row->course_id !!}" data-status="2">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="confirm-active" data-id="{!! $row->course_id !!}" data-status="1">
                                                <i class="fa fa-check text-primary"></i>
                                            </a>
                                        @endif
                                        @if($row->is_delete == '1')
                                            <a class="confirm-delete" href="javascript:void(0)"  data-id="{!! $row->course_id !!}" data-status="2"><i class="fa fa-trash text-danger mr-2"></i></a>
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
    <!--**********************************
        Content body end
    ***********************************-->
@stop
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".new_chapter").on("click", function(){
            $("#new_chapter_modal form").trigger("reset");
            $("#new_chapter_modal input[name='where[id]']").val("");
            $(".modal-title").text("New Chapter");
            $("#new_chapter_modal").modal("show");
        });
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "book_course", 'input[is_delete]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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
        $(document).on("change", "select[name='input[media_type]']", function(){
            var mediaType = $(this).val();
            if(mediaType == "youtube"){
                $("#upload-div").css("display", "none");
                $("#upload-url").css("display", "block");
            }else if(mediaType == "video" || mediaType == "ebook"){
                $("#upload-div").css("display", "block");
                $("#upload-url").css("display", "none");
            }
        });
    </script>
@stop