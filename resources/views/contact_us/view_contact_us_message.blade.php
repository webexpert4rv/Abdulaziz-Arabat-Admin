@extends('adminlte::page')

@section('title', 'Contact Us Details')

@section('content_header')
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                <h3>Contact Us Details</h3>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                
                <form class="form_wrap">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="{{ $contactUsMessage->first_name }} {{$contactUsMessage->last_name}}" readonly>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" placeholder="{{ $contactUsMessage->email }}" readonly>
                      </div>
                    </div>

                  </div>

                
                

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Message</label>
                        <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $contactUsMessage->description !!}<div>
                      </div>
                    </div>
                  </div>
                  

                  <div class="row">

                    <div class="col-6">
                      <div class="form-group">
                        <label>Status</label>
                        <input class="form-control" placeholder="{{ ucfirst($contactUsMessage->status) }}" readonly>
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