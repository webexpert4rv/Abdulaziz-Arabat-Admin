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

              <form class="form_wrap">
                <div class="row">

                <div class="col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.blog_title') }}</label>
                      <input class="form-control" placeholder="{{$data->blog_title}}" value="" readonly>
                    </div>
                  </div>                   
                    <div class="col-12">
                    <div class="form-group">
                        <label for="name">{{ __('adminlte::adminlte.description') }}</label> 
                     <?php echo $data->description ?>
                    </div>
                  </div>
               
             
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.image') }}</label>
                      <img width="50%"  src="{{env('STORAGE_PATH')}}/{{$data->blog_image}}">
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
