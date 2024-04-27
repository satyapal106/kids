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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Upload Books</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Upload New Book</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch create-workform">                    
                    <div class="card-body p-5">
                    <form method="post" action="{!! url('branch/update-book') !!}" enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <input type="hidden" name="where[id]" value="{!! $book->id !!}">
                            <!-- <input type="hidden" name="input[branch_id]" value=""> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School</label>
                                        <select name="input[school_id]" class="form-control" id="">
                                            <option value="">Select School</option>
                                            @if(count($school)!="")
                                                @foreach($school as $row)
                                                <option value="{{$row->id}}" {{$book->school_id== $row->id ? "Selected" : "" }}>{{$row->name}}</option>
                                                @endforeach
                                            @endif    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class</label>
                                        <select name="input[class_id]" class="form-control" id="">
                                            <option value="" disabled="">Select Class</option>
                                            @if(count($class)!="")
                                                @foreach($class as $row)
                                                   <option value="{{$row->id}}" {{$book->class_id== $row->id ? "Selected" : "" }}>{{$row->class}}</option>
                                                @endforeach
                                            @endif    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Title</label>
                                        <input type="text" class="form-control" id="title" name="input[title]" value="{!! $book->title !!}" placeholder="Title" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Title Url</label>
                                        <input type="text" class="form-control" id="title_url" name="input[title_url]" value="{!! $book->title_url !!}" placeholder="Url" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Subject</label>
                                        <select name="input[subject_id]" class="form-control" id="">
                                            <option value="" disabled="">Select Subject</option>
                                            @if(count($subject)!="")
                                                @foreach($subject as $row)
                                                   <option value="{{$row->id}}" {{$book->subject_id== $row->id ? "Selected" : "" }}>{{$row->subject}}</option>
                                                @endforeach
                                            @endif    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Head Image</label>
                                        <input type="file" class="form-control" id="image" name="head_image"  value="{!! $book->head_image !!}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Media Type</label>
                                        <select name="input[media_type]" id="type" class="form-control">
                                            <option value="video" {!! $book->media_type == "video" ? "Selected" : "" !!}>upload video</option>
                                            <option value="book"  {!! $book->media_type == "book" ? "Selected" : "" !!}>upload book</option>
                                            <option value="youtube" {!! $book->media_type == "youtube" ? "Selected" : "" !!}>Url youtube</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group" id="upload-div" style="display:{!! ($book->media_type == 'video'  ||  $book->media_type == 'book' ? 'block' : 'none')     !!}">
                                        <label>Upload (video/Pdf) <span style="color:red">*</span></label>
                                        <input type="file" class="form-control" id="image"  name="upload" value="{!! $book->upload !!}">
                                    </div>
                                   
                                    <div class="form-group" id="upload-url" style="display:{!! ($book->media_type == 'youtube'  ? 'block' : 'none')     !!};">
                                        <label>Media Url <span style="color:red">*</span></label>
                                        <input type="text" class="form-control"  name="input[media_url]" value="{!! $book->media_url !!}"/>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Media Size</label>
                                        <input type="text" class="form-control"  name="input[media_size]"  value="{!! $book->media_size !!}">
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule-end-date">Short Description</label>
                                        <textarea class="form-control ckeditor" name="input[short_description]">{!! $book->short_description  !!}</textarea>
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
    $(document).on("change", "#title", function(){
        var $title = $(this).val().toLowerCase();
        var res = $title.replace(/ /g, "-");
        $("#title_url").val(res);
    });
    $(document).on("change", "select[name='input[media_type]']", function(){
        var mediaType = $(this).val();
        if(mediaType == "youtube"){
            $("#upload-div").css("display", "none");
            $("#upload-url").css("display", "block");
        }else if(mediaType == "video" || mediaType == "book"){
            $("#upload-div").css("display", "block");
            $("#upload-url").css("display", "none");
        }
        
        
    });
    // if(window.location.href.indexof("2")){
    //     ($('select option[ value="youtube"]').attr("selected","true")){
    //     $("#upload-div").css("display", "none");
    //      $("#upload-url").css("display", "block");

    // }}

</script>
@stop