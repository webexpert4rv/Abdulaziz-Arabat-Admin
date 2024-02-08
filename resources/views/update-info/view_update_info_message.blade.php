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
                <h3>Update Information Details</h3>
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
                        <label>Old Mobile Number</label>
                        <input class="form-control" placeholder="{{ $updateInformationMessage->old_mobile_number }} " readonly>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Old Email</label>
                        <input class="form-control" placeholder="{{ $updateInformationMessage->old_email }}" readonly>
                      </div>
                    </div>

                 <div class="col-6">
                      <div class="form-group">
                        <label>New Mobile Number</label>
                        <input class="form-control" placeholder="{{ $updateInformationMessage->mobile_number }}" readonly>
                      </div>
                    </div>
               <div class="col-6">
                      <div class="form-group">
                        <label>New Email</label>
                        <input class="form-control" placeholder="{{ $updateInformationMessage->email }}" readonly>
                      </div>
                    </div>

                  </div>

                
                

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Message</label>
                        <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $updateInformationMessage->description !!}<div>
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