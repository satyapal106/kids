@extends('layout.branch_master')

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
.btn {padding: 0.6rem 0.6rem;border-radius: 0.75rem;font-weight: 500;font-size: 1rem;}
</style>
@stop
@section('body') 
<div class="content-body">
@include('include.flash-msg')
    <div class="container-fluid">
       <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">School Book</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">New School Book</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card"> 
                    <div class="card-header">
                        <h4 class="card-title">{!! isset($id) ? "Update" : "New" !!} School Book</h4>
                        <a  href="{{url('branch/new-book')}}" target="_blank" class="btn btn-primary sm">+ Add Book</a>
                        <!-- Modal -->
                        <!-- <div class="modal fade" id="basicModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Modal body text goes here.</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>                  
                    <div class="card-body">
                       <div class="basic-form">
                            <form method="post" action="{!! url('branch/new-school-book') !!}" enctype="multipart/form-data">
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
                                                <option value="">Subject Class</option>
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
                                            <label>School</label>
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