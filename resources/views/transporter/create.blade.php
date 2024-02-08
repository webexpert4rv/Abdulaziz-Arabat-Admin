@extends('adminlte::page')

@section('title', 'Add Transporter')

@section('content_header')
@stop

@section('content')
<link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_transporter') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addTransporterForm" method="post" ,  action="{{ route('add_transporter') }}" enctype="multipart/form-data" >
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-6">
                    <div class="form-group">
                      <label for="full_name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Name" name="full_name" class="form-control" id="full_name" maxlength="100">
                      @if($errors->has('full_name'))
                        <div class="error">{{ $errors->first('full_name') }}</div>
                      @endif
                    </div>
                  </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Ex: emaple@arabat.com" maxlength="100">
                    <div id ="email_error" class="error"></div>
                    @if($errors->has('email'))
                      <div class="error">{{ $errors->last('email') }}</div>
                    @endif
                  </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="phone_number">{{ __('adminlte::adminlte.mobile') }}<span class="text-danger"> *</span></label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="Mobile" maxlength="14" style="padding-left:226px !important;">
                    <div id ="mobile_error" class="error"></div>
                    @if($errors->has('mobile'))
                    <div class="error">{{ $errors->last('mobile') }}</div>
                    @endif
                </div>
            </div>  
                 <div class="col-6">
                  <div class="form-group">
                    <label for="city">TGA Licence Number</label>
                    <input type="text" name="pta_license_number" class="form-control"  placeholder="TGA Licence Number" maxlength="100">
                    <div id ="city_error" class="error"></div>
                    @if($errors->has('email'))
                      <div class="error">{{ $errors->last('city') }}</div>
                    @endif
                  </div>
                </div>

               

              <!--   <div class="col-6">
                  <div class="form-group">
                    <label for="password">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> *</span></label>
                    <input type="password" placeholder="Password" name="password" class="form-control" id="password" maxlength="100">
                    @if($errors->has('password'))
                      <div class="error">{{ $errors->last('password') }}</div>
                    @endif
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                    @if($errors->has('confirm_password'))
                      <div class="error">{{ $errors->last('confirm_password') }}</div>
                    @endif
                  </div>
                </div> -->

 				<!-- <div class="col-6">
                  <div class="form-group">
                    <label for="zip_code">{{ __('adminlte::adminlte.zip_code') }}<span class="text-danger"> *</span></label>
                    <input type="text" placeholder="Zip Code" name="zip_code" class="form-control" id="zip_code" maxlength="100">
                    @if($errors->has('zip_code'))
                      <div class="error">{{ $errors->last('zip_code') }}</div>
                    @endif
                  </div>
                </div> -->
                <div class="col-6">
                  <div class="form-group">
                    <label for="public_transportation_athority_licence">Transport General Authority Licence<span class="text-danger"> *</span></label>
                    <input type="file" placeholder="" name="public_transport_authority_license" class="form-control" id="public_transport_authority_license" maxlength="100">
                    @if($errors->has('public_transportation_athority_licence'))
                      <div class="error">{{ $errors->last('public_transportation_athority_licence') }}</div>
                    @endif
                  </div>
                </div>
 				       <div class="col-6">
                  <div class="form-group">
                    <label for="commercial_registration">Commercial Registration<span class="text-danger"> *</span></label>
                    <input type="file" placeholder="" name="commercial_registration" class="form-control" id="commercial_registration" maxlength="100">
                    @if($errors->has('commercial_registration'))
                      <div class="error">{{ $errors->last('commercial_registration') }}</div>
                    @endif
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="vat_registration">{{ __('adminlte::adminlte.vat_registration') }}<span class="text-danger"> *</span></label>
                    <input type="file" placeholder="" name="vat_registration" class="form-control" id="vat_registration" maxlength="100">
                    @if($errors->has('vat_registration'))
                      <div class="error">{{ $errors->last('vat_registration') }}</div>
                    @endif
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="iban_details">IBAN Details<span class="text-danger"> *</span></label>
                    <input type="file" placeholder="" name="iban_details" class="form-control" id="iban_details" maxlength="100">
                    @if($errors->has('iban_details'))
                      <div class="error">{{ $errors->last('iban_details') }}</div>
                    @endif
                  </div>
                </div>

                 <div class="col-6">
                  <div class="form-group">
                    <label for="city">Name of Fleet Supervisor<span class="text-danger"> *</span></label>
                   <input type="text" name="transporter_supervisor_name" class="form-control" value="" id="transporter_supervisor_name" placeholder="Name of Fleet Supervisor">
                    <div id ="city_error" class="error"></div>
                    @if($errors->has('email'))
                      <div class="error">{{ $errors->last('city') }}</div>
                    @endif
                  </div>
                </div>

                 <div class="col-6">
                <div class="form-group">
                    <label for="phone_number">Supervisor Mobile Number<span class="text-danger"> *</span></label>
                    <input type="text" name="mobile"   id="mobile" placeholder="Supervisor Mobile Number" maxlength="14" style="padding-left:226px !important;">
                    <div id ="phone_number_error" class="error"></div>
                    @if($errors->has('phone_number'))
                    <div class="error">{{ $errors->last('phone_number') }}</div>
                    @endif
                </div>
            </div>  

                 <div class="col-6">
                  <div class="form-group">
                    <label for="city">Referral Code</label>
                    <input type="text" class="form-control" id="referrer_code" value="" name="referrer_code" placeholder="Referral Code" autocomplete="off">
                    <div id ="city_error" class="error"></div>
                    @if($errors->has('email'))
                      <div class="error">{{ $errors->last('city') }}</div>
                    @endif
                  </div>
                </div>

				        <div class="col-6">
                  <div class="form-group">
                      <label for="commission">Commission for Transporter</label>
                      <input type="text" placeholder="Commission for Transporter"  name="commission" class="form-control" id="commission" maxlength="100">
                      @if($errors->has('commission'))
                      <div class="error">{{ $errors->last('commission') }}</div>
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
@endsection

@section('css')
@stop

@section('js')
<script src="{{asset('build/js/intlTelInput.js')}}"></script>
<script>
    var input = document.querySelector("#mobile");

    window.intlTelInput(input, {
        separateDialCode: true,
        hiddenInput: "full",
        utilsScript: "{{asset('build/js/utils.js')}}",
    });



</script>
<script>
    var input = document.querySelector("#phone_number");

    window.intlTelInput(input, {
        separateDialCode: true,
        hiddenInput: "full",
        utilsScript: "{{asset('build/js/utils.js')}}",
    });
 


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKW4P7mmbMBCf48mhUTBKvpHfLDhPgP1c&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
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
//     phone_number:{

//   required: function(element) {
//     return $("#type").val()==0;
//  },

//  number:true,
//  maxlength:10,

//  notEqualTo:"#phone_number",
//  normalizer: function(value) {
//     return $.trim(value);
//  },

//  remote: {
//     url: "{{route('user.check.phone_number')}}",
//     type: "post",
//     data: {
//       phone_number:$("phone_number").val(),
//       _token:"{{ csrf_token() }}"
//    },
//    dataFilter: function (data) {

//       var json = JSON.parse(data);
//       console.log(json.msg);
//       if (json.msg == 0) {
//         return 'true';
//      }else{
//         return "\"" + "<?php echo __('web.phone_number_has_already_been_taken');?>" + "\""
//      } 
//   }
// }
// }
    $(document).ready(function() {
      $("#email").blur(function() {
        $.ajax({
          type:"POST",
          url:"{{route('user.email.check')}}",
          data: {
            email: $(this).val(),
            table_name: 'users'
          },
          success: function(result) {
            if(result) {
              $("#email_error").html("This email is already registered");
            }
            else {
              $("#email_error").html("");
            }
          }
        });
      });
      //     $("#phone_number").blur(function() {
      //   $.ajax({
      //     type:"POST",
      //     url:"{{route('user.check.phone_number')}}",
      //     data: {
      //       phone_number: $(this).val(),
      //       table_name: 'users'
      //     },
      //     success: function(result) {
      //       console.log(result.msg);
             
      //       if (result.msg==1) {
      //          $("#mobile_error").html("");
      //       return 'true';
      //      }else{
              
      //         $("#mobile_error").html("This Mobile is already registered");
      //      } 
            
      //     }
      //   });
      // });
      $('#addTransporterForm').validate({
        ignore: [],
        debug: false,
        rules: {
          full_name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          
          phone_number: {     

          /* required: function(element) {
          return $("#type").val()==0;
          },*/

            required: true,
          //validphone:true,
            number:true,
            maxlength:10,
            normalizer: function(value) {
              return $.trim(value);
           },

           remote: {
              url: "{{route('user.check.phone_number')}}",
              type: "post",
              data: {
                phone_number:$("phone_number").val(),
                _token:"{{ csrf_token() }}"
             },
             dataFilter: function (data) {

                var json = JSON.parse(data);
                console.log(json.msg);
                if (json.msg == 0) {
                  
                  return "\"" + "This Mobile is already registered" + "\""
               }else{
                  return 'true';
               } 
            }
          }
          },
          city: {
            required: true
          },
          role_id: {
            required: true
          },
          password: {
            required: true,
            minlength: 8
          },
          confirm_password: {
            required: true,
            minlength: 8,
            equalTo : "#password"
          },
          
       
        },
        messages: {
          full_name: {
            required: "The Name  is required"
          },
          email: {
            required: "The Email  is required",
            email: "Please enter a valid Email"
          },
           mobile: {
            required: "The Mobile  is required"
          },
          city: {
            required: "The City  is required"
          },
          role_id: {
            required: "The Role  is required"
          },
          password: {
            required: "The Password  is required",
            minlength: "Minimum length should be 8"
          },
          confirm_password: {
            required: "The Confirm Password  is required",
            minlength: "Minimum length should be 8",
            equalTo : "The Confirm Password must be equal to Password"
          },
          
          
        }
      });
    });

  </script>
@stop
