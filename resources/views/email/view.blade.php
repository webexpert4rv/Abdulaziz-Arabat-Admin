@extends('adminlte::page')

@section('title', 'Email Template Information')

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
              <h3>{{ __('adminlte::adminlte.email_template_detail') }}</h3>
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
                      <label>{{ __('adminlte::adminlte.from_email') }}</label>
                      <input class="form-control" placeholder=" {{$email_template->from_email}}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.subject') }}</label>
                      <input class="form-control" placeholder="{{ $email_template->subject}}" readonly>
                    </div>
                  </div>
                
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.users') }}</label>
                      <textarea class="form-control" placeholder="" rows="4" readonly>@foreach($users as $key=>$user) {{$user->name }} @endforeach</textarea> 
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group position-relative">
                      <label>{{ __('adminlte::adminlte.description') }}</label>
                      <textarea class="form-control description" rows="6" placeholder=" " readonly>{{$email_template->description}}</textarea>
                      <div id="charNum"></div>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

<script>
  
  $(document).ready(function(){
                var len = $(".description").val().length;
                  if (len >= 500) {
                    val.value = val.value.substring(0, 501);
                  } else {
                    $('#charNum').text(len+' character description');
                  }
              });
</script>
@stop
