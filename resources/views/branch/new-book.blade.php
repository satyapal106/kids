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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Books</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">New Book</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card"> 
                    <div class="card-header">
                        <h4 class="card-title">{!! isset($id) ? "Update" : "New" !!} Book</h4>
                    </div>                  
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{!! url('branch/new-book') !!}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="where[id]" value="{!! isset($id) ? $id : '' !!}"/>
                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Subject</label>
                                            <select name="input[subject_id]" class="form-control" id="">
                                                <option value="">Subject Class</option>
                                                @if(count($subject)!="")
                                                    @foreach($subject as $row)
                                                    <option value="{{$row->id}}" {!! isset($id) ? ($details->subject_id == $row->id ? "Selected" : "") : "" !!}>{{$row->subject}}</option>
                                                    @endforeach
                                                @endif    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Book Image</label>
                                            <input type="file" class="form-control" id="image" name="book_pic">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Book Name</label>
                                            <input type="text" class="form-control" id="book" name="input[title]" value="{!! isset($id) ? $details->title : '' !!}" placeholder="Book Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Book Url</label>
                                            <input type="text" class="form-control" id="book_url" name="input[book_url]" value="{!! isset($id) ? $details->book_url : '' !!}" placeholder="Book Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Author Name</label>
                                            <input type="text" class="form-control" id="title" name="input[author]" value="{!! isset($id) ? $details->author : '' !!}" placeholder="Author" required/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="schedule-end-date">Short Description</label>
                                            <textarea class="form-control ckeditor" name="input[short_description]">{!! isset($id) ? $details->short_description : '' !!}</textarea>
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
    $(document).on("change", "#book", function(){
        var $title = $(this).val().toLowerCase();
        var res = $title.replace(/ /g, "-");
        $("#book_url").val(res);
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

    </script>
@stop