@extends('adminlte::page')

@section('title', 'Driver Information')

@section('content_header')
@stop

@section('content')

 <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.driver_detail') }}</h3> <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> </div>
          <div class="card-body"> @if (session('status'))
            <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif
            <form class="form_wrap">
            <div class="row">

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.name') }}</label>
                  <input class="form-control" placeholder="" value="{{$driver->name}}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email') }}</label>
                  <input class="form-control" placeholder="" value="{{$driver->email}}" readonly>
                </div>
              </div>
             
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.mobile') }}</label>
                  <input class="form-control" placeholder="" value="{{$driver->phone_number}}" readonly>
                </div>
              </div>
               <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.city') }}</label>
                  <input class="form-control" placeholder="" value="{{$driver->city}}"  readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.address') }}</label>
                  <input class="form-control" placeholder="" value="{{$driver->address ?? 'NA'}}" readonly>
                </div>
              </div>
               <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.zip_code') }}</label>
                  <input class="form-control" placeholder="" value="{{$driver->zip_code}}"  readonly>
                </div>
              </div>
             
              {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="" value="{{date('d/m/Y',strtotime($driver->created_at))}}"  readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                  <input class="form-control" placeholder="" value="{{date('d/m/Y',strtotime($driver->updated_at))}}" readonly>
                </div>
              </div> --}}
              <div class="col-sm-12 ">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.description') }}</label>
                  <textarea class="form-control" readonly>{{$driver->driverDetails->description}}</textarea> 
                </div>
              </div>
             
             
             @if(@$driver->driverDetails->driver_licence)
                <div class="col-sm-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.driver_licence') }}</label>
                  <img width="50%" id="driver_licence" class="pop" data-type="image" src="{{env('STORAGE_PATH')}}/{{($driver->driverDetails->driver_licence)}}">
                </div>
              </div>
              @endif
              @if(@$driver->driverDetails->verification_id)
                <div class="col-sm-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.verification_id') }}</label>
                  <img id="verification_id" class="pop" width="50%" data-type="image" src="{{env('STORAGE_PATH')}}/{{($driver->driverDetails->verification_id)}}">
                </div>
              </div>
              @endif
             
            <!-- Start Image Preview Modal -->
              <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">              
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <img src=""  class="imagepreview" style="width:100%;">
                    </div>
                  </div>
                </div>
              </div>
            <!-- End Image Preview Modal -->

                    
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
   $(".pop").click(function(){
       var data=  $(this).attr('data-type');
       
      if(data=="image"){
        $('.imagepreview').attr('src', $(this).attr('src'));
        $('.imagepreview').show();
      }
     $('#imagemodal').modal('show');
 });

 $(".close").on("click",function(){
  $('#imagemodal').modal('hide');  
 });
</script>
@stop
