
@extends('layout.branch_master')

@section('style') 
<style></style>
@stop
@section('body') 
<!--**********************************
 Content body start
***********************************-->
        <div class="content-body">
        @include('include.flash-msg')
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Tools</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">About</a></li>
					</ol>
                </div>
                  <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                       <div class="tab-content">
                                          <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                             <img src="{{asset($about->image)}}" width="100%" alt="" class="img-fluid">
                                             <a class="post-title" href="javascript:void()">
                                                <h4>{{$about->title}}</h4>
                                             </a>
                                             <p>@php echo ($about->description) @endphp</p>
                                             
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
@stop