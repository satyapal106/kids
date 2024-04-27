@extends('layout.branch_master')

@section('style') 
<style>
.profile-box {background: #f5f6fa;position: relative;padding-bottom: 0px;border-radius: 0 0 5px 5px;}
</style>
@stop
@section('body') 
@include('include.flash-msg')
<div class="content-page">
   <div class="container-fluid container">
      <div class="row">
         <div class="col-lg-4">
            <div class="card card-block p-card">
               <div class="profile-box">
                  <img src="{{asset($contact->image)}}" alt="profile-bg" class="rounded d-block mx-auto img-fluid mb-3">
               </div>
            </div>
         </div>
         <div class="col-lg-8">
            <div class="card card-block mb-3">
               <div class="card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title mb-0">{{$contact->title}}</h4>
                  </div>
                  <div class="dropdown">
                        <span class="dropdown-toggle" id="dropdownMenuButton02" data-toggle="dropdown">
                           <i class="ri-more-2-fill"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton02">
                           <a class="dropdown-item " href="{{url('branch/contact-detail',$contact->id)}}"><i class="ri-pencil-line mr-3"></i>Edit</a>
                           
                        </div>
                  </div>
               </div>
               <div class="card-body">
                  <p>@php echo ($contact->description) @endphp</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop