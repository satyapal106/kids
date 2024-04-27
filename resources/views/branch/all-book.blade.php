@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.ml-auto, .mx-auto {
    margin-left: auto !important;
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 9999;
}
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Books</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All Book</a></li>
            </ol>
        </div>
        <div class="row">
        @if(count($data)!="") 
            @foreach($data as $row)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown ml-auto">
                            <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item"><a href="{{url('branch/update-book?id='.$row->id)}}"><i class="fa fa-edit text-primary mr-2"></i>Edit</a></li>
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
                        <div class="row">
                            <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="first">
                                        <img class="img-fluid" src="{{asset($row->book_pic)}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <!--Tab slider End-->
                            <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                <div class="product-detail-content">
                                    <!--Product details-->
                                    <div class="new-arrival-content pr">
                                        <h4 class="text-black">Book Name: {{$row->title}}</h4>
                                        <p>Class: <span class="item">{{$row->class}}</span></p>
                                        <p>Subject: <span class="item">{{$row->subject}}</span></p>
                                        <p>Author Name: <span class="item">{{$row->author}}</span></p>
                                        <!-- Quanatity End -->

                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-md-12">

                                <p class="mt-4">@php echo($row->short_description); @endphp</p>
                            </div>
                            <div class="shopping-cart mt-3">
                                @if($row->is_active == '2')
                                    <a class="btn btn-danger btn-sm" href="#"> Non Active</a>
                                @else
                                    <a class="btn btn-primary btn-sm" href="#">Active</a>
                                @endif
                                <a class="btn btn-secondary btn-sm" href="{{url('branch/all-book',$row->book_url)}}"> All Chapter</a>
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "book", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "book", 'input[is_delete]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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