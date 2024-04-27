@extends('layout.branch_master') 

@section('style') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Slider</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">All Slider</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                   <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-intro-title mb-4">Slider</h4>
                                <div class="bootstrap-carousel">
                                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                        @if(count($data)!="") 
                                           @foreach($data as $key=>$row)
                                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                               <img class="d-block w-100" src="{{asset($row->slider)}}" alt="First slide">
                                            </div>
                                           @endforeach
                                        @endif
                                        </div><a class="carousel-control-prev" href="#carouselExampleIndicators2" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span
                                                class="sr-only">Previous</span> </a><a class="carousel-control-next" href="#carouselExampleIndicators2" data-slide="next"><span
                                                class="carousel-control-next-icon"></span>
                                            <span class="sr-only">Next</span></a>
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
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
       $(document).on("click", ".confirm-active", function (){
            var id = $(this).data("id"), status= $(this).data("status"), msg ='', type = '';
            if(status == 1){
                msg = "Are you sure do you want active this book.";
                type = 'green';
            }else{
                msg = "Are you sure do you want delete this slider.";
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
                            $.post("{!! url('branch/update-status') !!}", {'where[id]' : id, 'tab': "slider", 'input[is_active]':status, '_token': "{!! csrf_token() !!}" }, function (html){
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
    </script>
@stop