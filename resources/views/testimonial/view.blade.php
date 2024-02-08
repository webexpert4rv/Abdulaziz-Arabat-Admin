@extends('adminlte::page')

@section('title', 'Testimonial Information')

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
              <h3>{{ __('adminlte::adminlte.testimonial_detail') }}</h3>
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
                      <label>{{ __('adminlte::adminlte.testimonial_english_name') }}</label>
                      <input class="form-control" placeholder="{{$testimonial->name}}" value="" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.testimonial_arabic_name') }}</label>
                      <input class="form-control" placeholder="{{$testimonial->arabic_name}}" value="" readonly>
                    </div>
                  </div>
                  
                
                
                  <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.created_date') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime($testimonial->created_at))}}" value=""  readonly>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime($testimonial->updated_at))}}" value="" readonly>
                    </div>
                  </div> -->
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group position-relative">
                      <label>{{ __('adminlte::adminlte.testimonial_english_description') }}</label>
                      <textarea rows="6" class="form-control description" readonly>{{$testimonial->description}}</textarea> 
                      <div id="charNum"></div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group position-relative">
                      <label>{{ __('adminlte::adminlte.testimonial_arabic__description') }}</label>
                      <textarea rows="6" class="form-control description" readonly>{{$testimonial->arabic_description}}</textarea> 
                      <div id="charNum"></div>
                    </div>
                  </div>
                  @if(Optional($testimonial->image))
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.image') }}</label>
                      <img width="50%"  src="{{env('STORAGE_PATH')}}/{{$testimonial->image}}">
                    </div>
                  </div>
                  @endif
                  
                  
                  
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
