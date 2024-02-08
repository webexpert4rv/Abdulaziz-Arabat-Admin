@extends('adminlte::page')

@section('title', 'vehicle Type Information')

@section('content_header')
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
              <h3>{{ __('adminlte::adminlte.vehicle_type_detail') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>        
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form class="form_wrap">
                <div class="row">
                <!-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.image') }}</label>
                    <img src="{{env('STORAGE_PATH')}}/{{$vehicletype->image}}">
                    </div>
                  </div>
                  -->
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.name') }}</label>
                      <input class="form-control" placeholder="{{$vehicletype->name}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.max_load') }}</label>
                      <input class="form-control" placeholder="{{$vehicletype->max_load}} {{$vehicletype->max_load_unit}}" readonly>
                    </div>
                  </div>
                
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.length') }}</label>
                      <input class="form-control" placeholder="{{$vehicletype->length}} {{$vehicletype->unit}}" readonly>
                    </div>
                  </div>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('css')
@stop

@section('js')
@stop
