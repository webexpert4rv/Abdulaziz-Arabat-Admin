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
              <h3>{{ __('adminlte::adminlte.add_sub_region') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="editPricingForm" method="post", action="{{ route('sub-region.store') }}">
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-12">
                    <div class="form-group">
                      <label for="length_unit">{{ __('adminlte::adminlte.region') }}<span class="text-danger"> </span></label>
                      <select name="region_id" class="form-control" id="region">
                        <option value="">Select {{ __('adminlte::adminlte.region') }}</option>
                        @if($regions)
                        @foreach($regions as $key=>$region)
                        <option value="{{@$region->id}}">{{@$region->name}}</option>
                        
                        @endforeach 
                        @endif

                      </select>

                      <div id ="unit_error" class="error"></div>
                      @if($errors->has('region'))
                      <div class="error">{{ $errors->last('region') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.subregion') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Name" name="name" class="form-control" id="name" maxlength="100" >
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>  
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.arabic_name') }}<span class="text-danger"> *</span></label>
                      <input type="text"   placeholder="Arabic Name" name="arabic_name" class="form-control" id="arabic_name" maxlength="100" >
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div> 
                  <div class="col-6">
                  <div class="form-group">
                    <label for="name">{{ __('adminlte::adminlte.lat') }}<span class="text-danger"> *</span></label>
                    <input type="text"  name="lat" class="form-control"   id="lat" maxlength="100" >
                    @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                </div>

                 <div class="col-6">
                  <div class="form-group">
                    <label for="name">{{ __('adminlte::adminlte.long') }}<span class="text-danger"> *</span></label>
                    <input type="text" placeholder="" name="long" class="form-control"   id="long" maxlength="100" >
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
        region_id: {
          required: true
        },
        name: {
          required: true
        }, 
        arabic_name: {
          required: true
        },
         lat: {
          required: true
        },
         long: {
          required: true
        },



      },
      messages: {
        region_id: {
          required: "The Region Name is required",
        },
         name: {
          required: "The Sub Name is required",
        }, 
        arabic_name: {
          required: "The Arabic name is required",
        },
         lat: {
          required: "The Latitude is required",
        },
        long: {
          required: "The Longitude is required",
        },


      }
    });
  });

</script>
@stop
