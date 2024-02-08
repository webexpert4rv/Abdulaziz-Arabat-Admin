@extends('adminlte::page')

@section('title', 'Banner Information')

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
              <h3>{{ __('adminlte::adminlte.banner_detail') }}</h3>
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
                      <label>{{ __('adminlte::adminlte.english_title') }}</label>
                      <input class="form-control" placeholder="{{$banner->title}}" value="" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.arabic_title') }}</label>
                      <input class="form-control" placeholder="{{$banner->arabic_title}}" value="" readonly>
                    </div>
                  </div>
                  
                
                
                  <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.created_date') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime($banner->created_at))}}" value=""  readonly>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                      <input class="form-control" placeholder="{{date('d/m/Y',strtotime($banner->updated_at))}}" value="" readonly>
                    </div>
                     
                  </div> -->
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.english_description') }}</label>
                      <textarea class="form-control" readonly>{{$banner->description}}</textarea> 
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.arabic_description') }}</label>
                      <textarea class="form-control" readonly>{{$banner->arabic_description}}</textarea> 
                    </div>
                  </div>
                  @if(Optional($banner->image))
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.image') }}</label>
                      <img width="50%"  src="{{env('STORAGE_PATH')}}/{{$banner->image}}">
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
@stop
