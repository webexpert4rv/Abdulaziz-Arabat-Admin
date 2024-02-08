@extends('adminlte::page')

@section('title', 'Edit Price')

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
              <h3>{{ __('adminlte::adminlte.edit_region') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form id="editPricingForm" method="post", action="{{ route('region.update',$region->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">                
                  <div class="row">

                    <div class="col-12">
                      <div class="form-group">
                        <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Name" name="name" class="form-control" value="{{$region->name}}" id="name" maxlength="100" >
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>  

                    <div class="col-12">
                      <div class="form-group">
                        <label for="name">{{ __('adminlte::adminlte.arabic_name') }}<span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Arabic Name" name="arabic_name" class="form-control" value="{{$region->arabic_name}}" id="arabic_name" maxlength="100" >
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>

                  
                  

                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                </div>
              </form>
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
  <script>
    $(document).ready(function() {
      
     
      $('#editPricingForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          
         
       
        },
        messages: {
          name: {
            required: "The Name is required",
          },
          
          
        }
      });
    });

  </script>
@stop
