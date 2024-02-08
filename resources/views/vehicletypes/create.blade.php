@extends('adminlte::page')

@section('title', 'Add Vehicle Type')

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
              <h3>{{ __('adminlte::adminlte.add_vehicle_type') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form id="AddVehicleTypesForm" method="post", action="{{ route('vehicletypes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">                
                  <div class="row">
                <!--  <div class="col-6">
                    <div class="form-group">
                      <label for="vehicle_type_category">{{ __('adminlte::adminlte.vehicle_category') }}<span class="text-danger"> *</span></label>
                      <select name="vehicle_type_category" class="form-control" id="vehicle_type_category">
                        <option value="">Select Vehicle Category</option>
                        @foreach($vehicle_category as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
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
                        <input type="text" placeholder="Name" name="name" class="form-control" id="full_name" maxlength="100">
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="full_name">{{ __('adminlte::adminlte.arabic_name') }}<span class="text-danger"> *</span></label>
                        <input type="text"   name="arabic_name" class="form-control" placeholder="Arabic Name" id="arabic_name" maxlength="100">
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="max_load">{{ __('adminlte::adminlte.max_load') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="max_load" class="form-control" id="max_load" placeholder="Max Load" maxlength="100">
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
                      
                        <option value="Tons">Tons</option>
                      
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
                      <input type="text" placeholder="Length" name="length" class="form-control" id="length" maxlength="100">
                      @if($errors->has('length'))
                        <div class="error">{{ $errors->last('length') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="length_unit">{{ __('adminlte::adminlte.length_unit') }}<span class="text-danger"> </span></label>
                      <select name="unit" class="form-control" id="length_unit">
                        <option value="">Select Unit</option>
                      
                        <option value="meter">Meter</option>
                      
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
                      <input  type="file" placeholder="" name="image" class="form-control" id="image" maxlength="100" onchange="loadFile(event)">
                      <a href="javascript:void(0);" onclick="removeImage();" class="close AClass">
                        <span>&times;</span>
                      </a>
                      <img id="output" width="25%"/>
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
<style type="text/css">
  .AClass{
    right:0px;
    position: absolute;
    margin-right: 386px;
    /* margin-bottom: -3px; */
    margin-top: -7px;
  }
</style>
@stop

@section('js')
<script>
  var loadFile = function(event) {
 $("#output").css("display","block");
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    
    output.onload = function() {
       $(".AClass").css("display","block");
       $("#output").css("display","block");
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  function removeImage(){
      $("#output").css("display","none");
      $(".AClass").css("display","none");
      $("#image").val("");

   }
</script>
  <script>
    $(document).ready(function() {
        $(".AClass").css("display","none");
        $("#output").css("display","none");

        jQuery.validator.addMethod("maxLoad", function (value, element) {
          
          if (/^[1-9]\d*(\.\d+)?$/.test(value)) {
              return true;
          } else {
              return false;
          }
        }, "Please enter a valid value");
      $('#AddVehicleTypesForm').validate({
        ignore: [],
        debug: false,
        rules: {
          // vehicle_type_category:{
          //   required:true,
          // },
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

          image: {
            required: true,
            minlength: 8
          },
          
       
        },
        messages: {
          // vehicle_type_category:{
          //   required:"Vehicle category is required"
          // },
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
          image: {
            required: "The Image  is required",
           
          },
         
          
        }
      });
    });
   

  </script>
@stop
