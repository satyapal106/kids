@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
</style>
@stop
@section('body') 
<div class="content-body">
@include('include.flash-msg')
    <div class="container-fluid">
       <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Upload Course</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">New Upload Course</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card"> 
                    <div class="card-header">
                        <h4 class="card-title">{!! isset($id) ? "Update" : "New" !!} Upload Course</h4>
                    </div>                  
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('branch/upload-course') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="where[id]" value="{!! isset($id) ? $id : '' !!}"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Class</label>
                                            <select name="input[class_id]" class="form-control" id="">
                                                <option value="">Select Class</option>
                                                @if(count($class)!="")
                                                    @foreach($class as $row)
                                                    <option value="{{$row->id}}" {!! isset($id) ? ($details->class_id == $row->id ? "Selected" : "") : "" !!}>{{$row->class}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Subject</label>
                                            <select name="input[subject_id]" class="form-control" id="">
                                                <option value="">Subject Subject</option>
                                                @if(count($subject)!="")
                                                    @foreach($subject as $row)
                                                    <option value="{{$row->id}}" {!! isset($id) ? ($details->subject_id == $row->id ? "Selected" : "") : "" !!}>{{$row->subject}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> School</label>
                                            <select name="input[school_id]" class="form-control" id="">
                                                <option value="">Select School</option>
                                                @if(count($school)!="")
                                                    @foreach($school as $row)
                                                    <option value="{{$row->id}}" {!! isset($id) ? ($details->school_id == $row->id ? "Selected" : "") : "" !!}>{{$row->name}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Book</label>
                                            <select name="input[book_id]" class="form-control" id="">
                                                <option value="">Select Book</option>
                                                @if(count($book)!="")
                                                    @foreach($book as $row)
                                                    <option value="{{$row->id}}" {!! isset($id) ? ($details->book_id == $row->id ? "Selected" : "") : "" !!}>{{$row->title}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Title</label>
                                            <input type="text" class="form-control" id="title" name="input[course_title]" value="{!! isset($id) ? $details->course_title : '' !!}"  placeholder="Title" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Media Type</label>
                                            <select name="input[media_type]"  onchange="run()" id="type" class="form-control">
                                                @if(count($media)!="")
                                                    @foreach($media as $row)
                                                <option value="{{$row->id}}" {!! isset($id) ? ($details->media_type =='video' ? "Selected" : "") : "" !!}>{{$row->title}}</option>
                                                    @endforeach
                                                @endif
{{--                                                <option value="ebook" {!! isset($id) ? ($details->media_type == 'ebook' ? "Selected" : "") : "" !!}>upload Ebook</option>--}}
{{--                                                <option value="youtube" {!! isset($id) ? ($details->media_type =='youtube' ? "Selected" : "") : "" !!}>Url Youtube</option>--}}
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
                            </form>
                        </div>
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
        if(mediaType == "4"){
            $("#upload-div").css("display", "none");
            $("#upload-url").css("display", "block");
        }else if(mediaType == '1' || mediaType =='2' ||  mediaType == '3'){
            $("#upload-div").css("display", "block");
            $("#upload-url").css("display", "none");
        }
    });
</script>
@stop