@extends('adminlte::page')

@section('title', 'Edit Vehicle Type')

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
                <h3>{{ __('adminlte::adminlte.edit_vehicle_type') }}</h3>
                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              </div>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form id="EditVehicleTypesForm" method="post", action="{{ route('vehicletypes.update',$vehicletype->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="card-body">                
                    <div class="row">
                    <!-- <div class="col-6">
                      <div class="form-group">
                        <label for="max_load_unit">{{ __('adminlte::adminlte.vehicle_category') }}<span class="text-danger"> *</span></label>
                        <select name="max_load_unit" class="form-control" id="max_load_unit">
                          <option value="">Select Vehicle Category</option>
                          @foreach($vehicle_category as $row)
                          <option value="{{$row->id}}" {{$vehicletype->vehicle_type_category==$row->id?'selected':''}}>{{$row->name}}</option>
                          @endforeach
                        </select>
                      
                        <div id ="email_error" class="error"></div>
                        @if($errors->has('max_load_unit'))
                          <div class="error">{{ $errors->last('max_load_unit') }}</div>
                        @endif
                      </div>
                    </div> -->
                      <div class="col-6">
                        <div class="form-group">
                          <label for="full_name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Name" name="name" class="form-control" id="name" value="{{$vehicletype->name}}" maxlength="100">
                          @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                          @endif
                        </div>
                      </div> 
                      <div class="col-6">
                        <div class="form-group">
                          <label for="full_name">{{ __('adminlte::adminlte.arabic_name') }}<span class="text-danger"> *</span></label>
                          <input type="text"placeholder="Arabic Name" name="arabic_name" class="form-control" id="arabic_name" value="{{$vehicletype->arabic_name}}" maxlength="100">
                          @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                          @endif
                        </div>
                      </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label for="max_load">{{ __('adminlte::adminlte.max_load') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="max_load" class="form-control" value="{{$vehicletype->max_load}}" id="max_load" placeholder="Max Load" maxlength="100">
                        <div id ="email_error" class="error"></div>
                        @if($errors->has('max_load'))
                          <div class="error">{{ $errors->last('max_load') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label for="max_load_unit">{{ __('adminlte::adminlte.max_load_unit') }}<span class="text-danger"> *</span></label>
                        <select name="max_load_unit" class="form-control" id="max_load_unit">
                          <option value="">Select Unit</option>
                        
                          <option value="Tons" {{$vehicletype->max_load_unit=='Tons'?'selected':''}}>Tons</option>
                        
                        </select>
                      
                        <div id ="email_error" class="error"></div>
                        @if($errors->has('max_load_unit'))
                          <div class="error">{{ $errors->last('max_load_unit') }}</div>
                        @endif
                      </div>
                    </div>
                    
                  <div class="col-6">
                      <div class="form-group">
                        <label for="length">{{ __('adminlte::adminlte.length') }}<span class="text-danger"> </span></label>
                        <input type="text" placeholder="Length" name="length" class="form-control" value="{{$vehicletype->length}}" id="length" maxlength="100">
                        @if($errors->has('length'))
                          <div class="error">{{ $errors->last('length') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="length_unit">{{ __('adminlte::adminlte.length_unit') }}<span class="text-danger"> </span></label>
                        <select name="unit" class="form-control" id="unit">
                          <option value="">Select Unit</option>
                        
                          <option value="meter"{{$vehicletype->unit=='meter'?'selected':''}}>Meter</option>
                        
                        </select>
                      
                        <div id ="unit_error" class="error"></div>
                        @if($errors->has('unit'))
                          <div class="error">{{ $errors->last('unit') }}</div>
                        @endif
                      </div>
                    </div>
                  <!-- <div class="col-6">
                      <div class="form-group">
                        <label for="image">{{ __('adminlte::adminlte.image') }}<span class="text-danger"> *</span></label>
                        <input type="file" placeholder="" name="image" class="form-control" id="image" maxlength="100" onchange="loadFile(event)">
                        @if($vehicletype->image)
                          <img src="{{env('STORAGE_PATH')}}/{{$vehicletype->image}}" id="output" width="25%"/>
                          @endif
                        @if($errors->has('image'))
                          <div class="error">{{ $errors->last('image') }}</div>
                        @endif
                      </div>
                    </div> -->
                  


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
  var loadFile = function(event) {
 
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    
    output.onload = function() {
       
      URL.revokeObjectURL(output.src) // free memory
    }
  };
   
</script>
  <script>
        $(document).ready(function() {
        jQuery.validator.addMethod("maxLoad", function (value, element) {
          
          if (/^[1-9]\d*(\.\d+)?$/.test(value)) {
              return true;
          } else {
              return false;
          }
        }, "Please enter a valid value");
      $('#EditVehicleTypesForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          arabic_name: {
            required: true
          },
          max_load: {
            required: true,
            maxLoad:true,
          },
          max_load_unit: {
            required: true,
            
          },
          
          // length: {
          //   required: true
          // },
          // unit: {
          //   required: true
          // },

        
        },
        messages: {
          name: {
            required: "Name  is required"
          },
          arabic_name: {
            required: "Arabic Name  is required"
          },
          max_load: {
            required: "Max Load  is required"
           
          },
          max_load_unit: {
            required: "Max Load Unit is required"
           
          },
          

          // length: {
          //   required: "The Length  is required"
          // },
          // unit: {
          //   required: "The Length Unit is required"
          // },
         
         
          
        }
      });
    });
   

  </script>
@stop
