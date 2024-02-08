@extends('adminlte::page')

@section('title', 'Payment Information')

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
              <h3>{{ __('adminlte::adminlte.payment_detail') }}</h3>
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
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.transaction_id') }}</label>
                      <input class="form-control" placeholder="{{@$transaction->transaction_id}}" readonly>
                    </div>
                  </div>
                
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.user_name') }}</label>
                      <input class="form-control" placeholder="{{@$transaction->user->name}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.driver_name') }}</label>
                      <input class="form-control" placeholder="{{@$transaction->driver->name}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.booked_on') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime(@$transaction->booked_on))}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.amount') }}</label>
                      <input class="form-control" placeholder="{{@$transaction->amount}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.status') }}</label>
                      <input class="form-control" placeholder="{{@$transaction->status}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.created_at') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime(@$transaction->created_at))}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.updated_at') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime(@$transaction->updated_at))}}" readonly>
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
