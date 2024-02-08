@extends('adminlte::page')

@section('title', 'Edit Transporter')

@section('content_header')
@stop

@section('content')
<link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">
<style>
  #phone_number{
    padding-left: 92px !important;
  }
</style>
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
              <h3>{{ __('adminlte::adminlte.edit_transporter') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="editTransporterForm" method="post", action="{{ route('transporters.update',$transporter->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">  
               <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                       <img id="blahprofile" style="width: 40%;" src="{{config('services.storage_image_path.web_path')}}/{{$transporter->profile_image}}">
                      <label>Profile Image</label>   
                      <input onchange="readURLblahprofile(this);" type="file" placeholder="" name="profile_image" class="form-control" id="profile_image" maxlength="100">      
                     
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-6">
                    <div class="form-group form-wrapper">
                     <div class="form-group">
                      <label>Transporter ID</label>
                      <input class="form-control" placeholder="{{$transporter->unique_ID}}" readonly> </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="full_name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Name" name="name" value="{{$transporter->name}}" class="form-control" id="name" maxlength="100">
                      
                      <div class="error name_error">@if($errors->has('name')){{ $errors->first('name') }} @endif</div>

                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" value="{{$transporter->email}}"  id="email" placeholder="Ex: emaple@arabat.com" maxlength="100">
                      <div id ="email_error" class="error"></div>

                      <div class="error email_error">   @if($errors->has('email')){{ $errors->last('email') }} @endif</div>

                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="mobile">{{ __('adminlte::adminlte.mobile') }}<span class="text-danger"> *</span></label>
                      <input type="text" value="{{$transporter->country_code}} {{$transporter->phone_number}}" name="phone_number"  class="form-control" id="phone_number" placeholder="Mobile" maxlength="100" >
                      <div id ="mobile_error" class="error"></div>

                      <div class="error mobile_error">  @if($errors->has('mobile')){{ $errors->last('mobile') }} @endif</div>

                    </div>
                  </div>


                  <div class="col-6">
                  <div class="form-group">
                    <label for="password">{{ __('adminlte::adminlte.password') }}</label>
                    <input type="password" placeholder="Password" name="password" class="form-control" id="password" maxlength="100">
                    
                      <div class="password_error error">@if($errors->has('password')) {{ $errors->last('password') }}   @endif</div>
                  
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}</label>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                    
                      <div class="confirm_password_error error">@if($errors->has('confirm_password')) {{ $errors->last('confirm_password') }}   @endif</div>
                  
                  </div>
                </div> 




                  <div class="col-6">
                    <div class="form-group"> 
                      <label for="is_push_notifications">Push Notifications</label>
                      <select name="is_push_notifications"  class="form-control" id="is_push_notifications">

                        <option value="0" {{$transporter->is_push_notifications==0?'selected':''}}>OFF</option>
                        <option value="1" {{$transporter->is_push_notifications==1?'selected':''}}>ON</option>

                      </select>
                      @if($errors->has('is_push_notifications'))
                      <div class="error">{{ $errors->last('is_push_notifications') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="is_email_notifications">Email Notifications</label>
                      <select name="is_email_notifications"  class="form-control" id="is_email_notifications">

                        <option value="0" {{$transporter->is_email_notifications==0?'selected':''}}>OFF</option>
                        <option value="1" {{$transporter->is_email_notifications==1?'selected':''}}>ON</option>

                      </select>
                      @if($errors->has('is_email_notifications'))
                      <div class="error">{{ $errors->last('is_email_notifications') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="commission">Commission for Transporter</label>
                        <input type="text" placeholder="Commission for Transporter" value="{{$transporter->commission}}" name="commission" class="form-control" id="commission" maxlength="100">
                        @if($errors->has('commission'))
                        <div class="error">{{ $errors->last('commission') }}</div>
                        @endif
                    </div>
                </div>
                </div>
               
                <div class="row">


                 <!-- <div class="col-6">
                  <div class="form-group">
                    <label for="city">{{ __('adminlte::adminlte.city') }}<span class="text-danger"> *</span></label>
                    <input type="text" value="{{$transporter->city}}" name="city" class="form-control" id="city" placeholder="City" maxlength="100">
                    <div id ="city_error" class="error"></div>
                   
                      <div class="error city_error"> @if($errors->has('city')){{ $errors->last('city') }} @endif</div>
                   
                  </div>
                </div> -->

            <!--     <div class="col-6">
                  <div class="form-group">
                    <label for="address">{{ __('adminlte::adminlte.address') }}<span class="text-danger"> *</span></label>
                    <input type="text" value="{{$transporter->address}}" name="address" class="form-control" id="address" placeholder="Address" maxlength="100">
                    <div id ="address_error" class="error"></div>
                   
                      <div class="error address_error"> @if($errors->has('address')){{ $errors->last('address') }}@endif</div>
                    
                  </div>
                </div> -->
                <!-- <div class="col-6">
                  <div class="form-group">
                    <label for="zip_code">{{ __('adminlte::adminlte.zip_code') }}<span class="text-danger"> *</span></label>
                    <input type="text" placeholder="Zip Code" value="{{$transporter->zip_code}}" name="zip_code" class="form-control" id="zip_code" maxlength="100">
                   
                      <div class="error zip_code_error"> @if($errors->has('zip_code')){{ $errors->last('zip_code') }} @endif</div>
                   
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="password">{{ __('adminlte::adminlte.password') }}</label>
                    <input type="password" placeholder="Password" name="password" class="form-control" id="password" maxlength="100">
                    
                      <div class="password_error error">@if($errors->has('password')) {{ $errors->last('password') }}   @endif</div>
                  
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}</label>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                    
                      <div class="confirm_password_error error">@if($errors->has('confirm_password')) {{ $errors->last('confirm_password') }}   @endif</div>
                  
                  </div>
                </div> -->




                <div class="col-6">
                  <div class="form-group">
                    <label for="verification_id">{{ __('adminlte::adminlte.public_transport_authority_license') }}<span class="text-danger"> *</span></label>
                    <input onchange="readURL(this);" type="file" placeholder="" name="public_transport_authority_license" class="form-control" id="public_transport_authority_license" maxlength="100">
                    <?php if(!empty(Optional($transporter->transporterDetails)->public_transport_authority_license)){$blah=config('services.storage_image_path.web_path').'/'.Optional($transporter->transporterDetails)->public_transport_authority_license;}else{$blah='';}  ?>
                    <img id="blah" width="50%" src="{{$blah}}">


                    <div class="error public_transport_authority_license_error"> @if($errors->has('public_transport_authority_license')){{ $errors->last('public_transport_authority_license') }}    @endif</div>

                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="commercial_registration">{{ __('adminlte::adminlte.commercial_registration') }}<span class="text-danger"> *</span></label>
                    <input onchange="readURL1(this);" type="file" placeholder="" name="commercial_registration" class="form-control" id="commercial_registration" maxlength="100">
                    <?php if(!empty(Optional($transporter->transporterDetails)->commercial_registration)){$blah1=config('services.storage_image_path.web_path').'/'.Optional($transporter->transporterDetails)->commercial_registration;}else{$blah1='';}  ?>
                    <img id="blah1" width="50%"  src="{{$blah1}}">


                    <div class="error commercial_registration_error"> @if($errors->has('commercial_registration')){{ $errors->last('commercial_registration') }} @endif</div>

                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="vat_registration">{{ __('adminlte::adminlte.vat_registration') }}<span class="text-danger"> *</span></label>
                    <input onchange="readURL2(this);" type="file" placeholder="" name="vat_registration" class="form-control" id="vat_registration" maxlength="100">
                    <?php if(!empty(Optional($transporter->transporterDetails)->vat_registration)){$blah2=config('services.storage_image_path.web_path').'/'.Optional($transporter->transporterDetails)->vat_registration;}else{$blah2='';}  ?>
                    <img id="blah2" width="50%"  src="{{$blah2}}">
                    

                    <div class="error vat_registration_error"> @if($errors->has('vat_registration')){{ $errors->last('vat_registration') }}@endif</div>
                    
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="iban_details">{{ __('adminlte::adminlte.iban_details') }}<span class="text-danger"> *</span></label>
                    <input onchange="readURL3(this);" type="file" placeholder="" name="iban_details" class="form-control" id="iban_detail_image" maxlength="100">
                    <?php if(!empty(Optional($transporter->transporterDetails)->iban_details)){$blah3=config('services.storage_image_path.web_path').'/'.Optional($transporter->transporterDetails)->iban_details;}else{$blah3='';}  ?>
                    <img id="blah3" width="50%"  src="{{$blah3}}">
                    
                    
                    <div class="error iban_details_error">@if($errors->has('iban_details')){{ $errors->last('iban_details') }}  @endif</div>

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

<script src="{{asset('build/js/intlTelInput.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKW4P7mmbMBCf48mhUTBKvpHfLDhPgP1c&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
<!-- <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script> -->
<script type="text/javascript">
  var autocomplete;
  function initAutocomplete() {
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();
      console.log(lat);
      console.log(lng);
      $("#latitude").val(lat);
      $("#longitude").val(lng);
        // document.getElementById("latitude").value = lat;
        // document.getElementById("longitude").value = lng;
    });
  }
</script>
<script>
  var input = document.querySelector("#phone_number");
  
  window.intlTelInput(input, {
    separateDialCode: true,
    hiddenInput: "full",
    utilsScript: "{{asset('build/js/utils.js')}}",
  });


</script>
<script>
  $(document).ready(function() {

    $('#editTransporterForm').validate({
      ignore: [],
      debug: false,
      rules: {
        name: {
          required: true,
          normalizer: function(value) {
            return $.trim(value);
          }
        },
        email: {
          required: true,
          normalizer: function(value) {
            return $.trim(value);
          },
          email: true,
          remote: {
            url: "{{route('user.email.check')}}",
            type: "post",
            data: {
              email:$("email").val(),
              id   : "{{$transporter->id}}",
              _token:"{{ csrf_token() }}"
            },
            dataFilter: function (data) {
              if(data){
                var response=JSON.parse(data);
                if (response.status == 400) {
                 return "\"" + "Email already exists" + "\""

               }else{
                 return 'true';
               } 
             }else{
               return 'true';
             } 

           }
         }
       },
       phone_number: {
        required: true,
        normalizer: function(value) {
          return $.trim(value);
        },
        remote: {
          url: "{{route('user.phone.check')}}",
          type: "post",
          data: {
            phone_number:$("phone_number").val(),
            id   : "{{$transporter->id}}",
            _token:"{{ csrf_token() }}"
          },
          dataFilter: function (data) {

           if(data){
            var response=JSON.parse(data);
            if (response.status == 400) {
             return "\"" + "Phone Number already exists" + "\""  
           }else{
             return 'true';
           } 
         }else{
           return 'true';
         } 

       }
     }
   },
   city: {
    required: true,
    normalizer: function(value) {
      return $.trim(value);
    }
  },
  role_id: {
    required: true,
    normalizer: function(value) {
      return $.trim(value);
    }
  },
  password: {

    normalizer: function(value) {
      return $.trim(value);
    },
    minlength: 8
  },
  confirm_password: {

    normalizer: function(value) {
      return $.trim(value);
    },
    minlength: 8,
    equalTo : "#password"
  },
  zip_code: {
    required: true,
    normalizer: function(value) {
      return $.trim(value);
    }
  },
  transporter_name: {
    required: true,
    normalizer: function(value) {
      return $.trim(value);
    }
  },
  address: {
    required: true,
    normalizer: function(value) {
      return $.trim(value);
    }
  },
          //  verification_id: {
          //   accept: "image/*"
          //   //required: true
          // },
          // company_insurance: {
          //   accept: "image/*"
          //   //required: true
          // },
          // public_transportation_athority_licence: {
          //   accept: "image/*"
          //  // required: true
          // },
          // vat_registration: {
          //   accept: "image/*"
          //   //required: true
          // },

},
messages: {
  name: {
    required: "Name  is required"
  },
  email: {
    required: "Email  is required",
    email: "Please enter a valid Email"
  },
  phone_number: {
    required: "Phone Number  is required"
  },
  city: {
    required: "City  is required"
  },
  role_id: {
    required: "Role  is required"
  },
  password: {

    minlength: "Minimum length should be 8"
  },
  confirm_password: {

    minlength: "Minimum length should be 8",
    equalTo : "Confirm Password must be equal to Password"
  },
  zip_code: {
    required: "Zip Code is required",

  },
  transporter_name: {
    required: "Transporter name is required",

  },
  address: {
    required: "Address is required",

  },
          //  verification_id: {
          //   required: "The Verification id is required",

          // },
          // company_insurance: {
          //   required: "The Company insurance is required",

          // },  
          // public_transportation_athority_licence: {
          //   required: "The PTA Licence is required",
          // },
          // vat_registration: {
          //   required: "The Vat Registration is required",
          // },



},
errorPlacement: function(error, element){
  var text=error[0].innerText;
              //console.log(text);
  var name = element[0].name+'_error';
  $('.'+name).html(text);
            //$(element).removeClass(name+'_error');
},
success: function(label,element) {
  label.parent().removeClass('error');
  label.remove();
}
});
});

</script>
<script>
   function readURLblahprofile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#blahprofile').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  } 

  function readURL1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#blah1').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL2(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#blah2').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL3(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#blah3').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@stop
