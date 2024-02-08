@extends('adminlte::page')

@section('title', 'Booking Information')

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
                            <h3>{{ __('adminlte::adminlte.booking_detail') }}</h3>
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
                                            <label>{{ __('adminlte::adminlte.booking_id') }}</label>
                                            <input class="form-control" placeholder="{{@$booking->book_id}}" readonly>
                                        </div>
                                    </div>
                                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.job_id') }}</label>
                                            <input class="form-control" placeholder="{{@$booking->job->job_ID}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.driver_name') }}</label>
                                            <input class="form-control" placeholder="{{@$booking->driver->name}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.transporter_name') }}</label>
                                            <input class="form-control" placeholder="{{@$booking->driver->transporter->name}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.user_name') }}</label>
                                            <input class="form-control" placeholder="{{@$booking->user->name}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.booked_on') }}</label>
                                            <input class="form-control" placeholder="{{date('d/m/Y H:i:s',strtotime(@$booking->booked_on))}}" readonly>
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.date_of_service') }}</label>
                                            <input class="form-control" placeholder="{{date('d/m/Y',strtotime($booking->date_of_service))}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.time_of_service') }}</label>
                                            <input class="form-control" placeholder="{{date('h:i A',strtotime($booking->time_of_service))}}" readonly>
                                        </div>
                                    </div>
                                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.booking_fee') }}</label>
                                            <input class="form-control" placeholder="{{$booking->booking_fee}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.vehicle_name') }}</label>
                                            <input class="form-control" placeholder="{{$booking->vehicle_name}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.license_plate') }}</label>
                                            <input class="form-control" placeholder="{{$booking->license_plate}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.mobile_number') }}</label>
                                            <input class="form-control" placeholder="{{$booking->mobile_number}}" readonly>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.payment_status') }}</label>
                                            <input class="form-control" placeholder="{{$booking->payment_status}}" readonly>
                                        </div>
                                    </div>

                                    <div class=" col-6">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.pick_up') }}</label>
                                            <input class="form-control" placeholder=" {{@$booking->pickupSubRegion->name}} ,{{@$booking->pickupRegion->name}}" rows="4" readonly>
                                        </div>
                                    </div>
                                    @foreach ($booking->job->JobReceivers as $key => $value)

                                     <div class=" col-12">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.drop_up') }} {{$key+1}}</label>
                                            <input class="form-control" placeholder="  {{@$value->DestinationRegion->name}} ,{{@$value->DestinationSubRegion->name}}" rows="4" readonly>
                                        </div>
                                    </div>                                        
                                    @endforeach                                   
                                   

                                     <div class=" col-6">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.transaction_id') }}</label>
                                            <input class="form-control" placeholder=" {{@$booking->transaction->transaction_id}}" rows="4" readonly>
                                        </div>
                                    </div> 
                                    <div class=" col-6">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.customer_id') }}</label>
                                            <input class="form-control" placeholder=" {{@$booking->transaction->customer}}" rows="4" readonly>
                                        </div>
                                    </div>
                                      <div class=" col-6">
                                        <div class="form-group">
                                            <label>{{ __('adminlte::adminlte.transaction_amount') }}</label>
                                            <input class="form-control" placeholder=" {{@$booking->transaction->amount}}" rows="4" readonly>
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
