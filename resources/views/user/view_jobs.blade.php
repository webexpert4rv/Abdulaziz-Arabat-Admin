@extends('adminlte::page')

@section('title', 'User Information')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.job_details') }}</h3>
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
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.title') }}</label>
                    <input class="form-control"  placeholder="{{$jobs->title}}" readonly>
                  </div>
                </div>
                
               
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.total_goods_weight') }}</label>
                    <input class="form-control" placeholder="{{$jobs->total_goods_weight}}" readonly>
                  </div>
                </div>
                <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.quantity') }}</label>
                    <input class="form-control" placeholder="" readonly>
                    
                  </div>
                </div> -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.vehicle_type') }}</label>
                    <input class="form-control" placeholder="@foreach($vehicle_Type as $key=>$row) {{$row->name}} @if($key!=(count($vehicle_Type)-1)), @endif @endforeach" readonly>
                    
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.number_of_vehicle') }}</label>
                    <input class="form-control" placeholder="{{@$jobs->number_of_vehicle}}" readonly>
                    
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.pick_up_address') }}</label>
                    <input class="form-control" placeholder="@if(@$jobs->PickupRegion->name) {{@$jobs->PickupRegion->name}}, {{@$jobs->PickupSubRegion->name}} @endif" readonly>
                  </div>
                </div>
                 <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.destination_address') }}</label>
                    <input class="form-control" placeholder="@if(@$jobs->JobReceiver->DestinationRegion->name) {{@$jobs->JobReceiver->DestinationRegion->name}}, {{@$jobs->JobReceiver->DestinationSubRegion->name}} @endif" readonly>
                  </div>
                </div>
                 <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.schedule_date') }}</label>
                    <input class="form-control" placeholder="{{date('d/m/Y',strtotime(@$jobs->schedule_date))}}" readonly>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.schedule_time') }}</label>
                    <input class="form-control" placeholder="{{date('H:i A',strtotime(@$jobs->schedule_time))}}" readonly>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.job_status') }}</label>
                    <input class="form-control" placeholder="@if(@$jobs->is_active==1) Active @else Closed @endif" readonly>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.description_of_goods') }}</label>
                    <textarea class="form-control" placeholder="" readonly>{{@$jobs->description_of_goods}}</textarea>
                  </div>
                </div>
               
                 <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.address') }}</label>
                    <input class="form-control" placeholder="" readonly>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.created_date') }}</label>
                    <input class="form-control" placeholder="" readonly>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                    <input class="form-control" placeholder="" readonly>
                  </div>
                </div> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('css')

@stop
@section('js')

@stop
