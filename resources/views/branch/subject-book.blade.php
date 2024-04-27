@extends('layout.branch_master')

@section('style') 
<style>
.dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_info 
{color: #333;display:none !important;}
</style>
@stop
@section('body') 
@include('include.flash-msg')
<div class="content-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="navbar-breadcrumb">
                        <h3 class="mb-1">All Book</h3>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">                
            <div class="event-content">
                <div id="event1" class="tab-pane fade active show">
                    <div class="row">
                        @if(count($detail)!="") 
                            @foreach($detail as $row)                               
                                <div class="col-lg-4">
                                    <div class="card card-block mb-3">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title mb-0">{{$row->title}}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if($row->media_type == 'video' || $row->media_type == 'book')
                                                <a href="{{asset($row->upload)}}">
                                                    <img src="{{asset($row->head_image)}}" width="150px;" alt="">
                                                </a>
                                            @else
                                                <a href="{{$row->media_url}}">
                                                    <img src="{{asset($row->head_image)}}" width="150px;" alt="">
                                                </a>
                                            @endif
                                            <br/><br/>
                                            <p>{{$row->class}}</p>
                                            <p>{{$row->subject}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')

@stop