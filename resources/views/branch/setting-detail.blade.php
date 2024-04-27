@extends('layout.branch_master')

@section('body') 
<div class="content-body">
    <div class="container-fluid container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card card-block card-stretch card-height">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Setting</h4>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                {{-- <img src="{{asset($setting->logo)}}" alt=""> --}}
                            </div>
                            <div class="col-md-4">
                                <p class="mb-0 font-size-16 line-height mb-3 d-flex">Branch: {{$setting->branch}}</p>
                                <p class="mb-0 font-size-16 line-height mb-3 d-flex">Title name: {{$setting->title_name}}</p>
                                <p class="mb-0 font-size-16 line-height mb-3 d-flex">Office No: {{$setting->office_no}}</p>
                            </div> 
                            <div class="col-md-4">
                                <p class="mb-0 font-size-16 line-height mb-3 d-flex"><i class="fas fa-map-marker-alt mr-3 font-size-20"></i>@php echo($setting->address) @endphp</p>
                                <p class="mb-0 font-size-16 line-height mb-3 d-flex"><i class="fas fa-phone-volume mr-3 font-size-20"></i>{{$setting->email}}</p>
                                <p class="mb-0 font-size-16 line-height mb-3 d-flex"><i class="fa fa-envelope"></i>{{$setting->contact_number}}</p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop