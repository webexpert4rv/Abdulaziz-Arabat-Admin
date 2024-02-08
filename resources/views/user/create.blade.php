@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
@stop

@section('content')
<link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_user') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addAdminForm" method="post",  action="{{ route('add_user') }}"  enctype="multipart/form-data">
                                @csrf
                                 
                                <div class="card-body">  
                                             
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('adminlte::adminlte.email') }}</label>
                                                <input type="text" name="email"  class="form-control" id="email" placeholder="Ex: emaple@arabat.com" maxlength="100">
                                                <div id ="email_error" class="error"></div>
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->last('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="full_name">{{ __('adminlte::adminlte.name') }}</label>
                                                <input type="text" placeholder="Name"   name="name" class="form-control" id="name" maxlength="100">
                                                @if($errors->has('full_name'))
                                                <div class="error">{{ $errors->first('full_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-6 company_div">
                                            <div class="form-group">
                                                <label for="company">{{ __('adminlte::adminlte.company') }}</label>
                                                <input type="text"   placeholder="Company Name" name="company_name" class="form-control" id="company" maxlength="100">
                                                @if($errors->has('company'))
                                                <div class="error">{{ $errors->last('company') }}</div>
                                                @endif
                                            </div>
                                        </div>    
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="phone_number">{{ __('adminlte::adminlte.mobile') }}</label>
                                                <input type="text" name="phone_number"   id="phone_number" placeholder="Phone Number" maxlength="14" style="padding-left:226px !important;">
                                                <div id ="phone_number_error" class="error"></div>
                                                @if($errors->has('phone_number'))
                                                <div class="error">{{ $errors->last('phone_number') }}</div>
                                                @endif
                                            </div>
                                        </div>  
                                        
                                        

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="city">{{ __('adminlte::adminlte.city') }}</label>
                                                <input type="text" name="city"   class="form-control" id="city" placeholder="City" maxlength="100">
                                                <div id ="city_error" class="error"></div>
                                                @if($errors->has('city'))
                                                <div class="error">{{ $errors->last('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                          
                                          <div class="col-6">
                                            <div class="form-group">
                                                <label for="city">{{ __('adminlte::adminlte.password') }}</label>
                                                <input type="password" name="password"   class="form-control" id="password" placeholder="Password" maxlength="100">
                                                <div id ="city_error" class="error"></div>
                                                @if($errors->has('city'))
                                                <div class="error">{{ $errors->last('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="city">Refferal Code</label>
                                                <input type="text" class="form-control" name="referrer_code" id="referrer_code" placeholder="Referral Code" autocomplete="off">
                                                <div id ="city_error" class="error"></div>
                                                @if($errors->has('city'))
                                                <div class="error">{{ $errors->last('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="commission">Commission for User</label>
                                                <input type="text" placeholder="Commission for User" autocomplete="off" onkeypress="return isNumberKey(event)" name="commission" class="form-control" id="commission" maxlength="2">
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
    $(document).ready(function() {
      $("#email").blur(function() {
        email=$(this).val();
        console.log(email);
        if(email!=''){
            $.ajax({
              type:"POST",
              url:"{{route('user.email.check')}}",
              data: {
                email: $(this).val(),
                table_name: 'users'
              },
              success: function(result) {
                if(result) {
                  $("#email_error").html("This email is already registered.");
                }
                else {
                  $("#email_error").html("");
                }
              }
            });
        }
      });
      $("#phone_number").blur(function() {
        phone_number= $(this).val();
        if(phone_number!=''){
            $.ajax({
              type:"POST",
              url:"{{route('user.phone.check')}}",
              data: {
                phone_number: $(this).val(),
                table_name: 'users'
              },
              success: function(result) {
                if(result) {
                  $("#phone_number_error").html("This Mobile Number is already registered.");
                }
                else {
                  $("#phone_number_error").html("");
                }
              }
            });
        }

      });
      $('#addAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          phone_number: {
            required: true
          },
          city: {
            // required: true
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
           zip_code: {
            required: true
          },
           account_type: {
            required: true
          },
       	location: {
                required: function(){
                    return $("#account_type").val() == "business";
              }
         },
        company: {
                required: function(){
                    return $("#account_type").val() == "business";
              }
         }, 
             commission: {
                required: false,
                normalizer: function(value) {
                    return $.trim(value);
                },
                minlength: 1,
                maxlength: 9,
                number:true
            },
        },
        messages: {
          name: {
            required: "The Name  is required"
          },
          email: {
            required: "The Email  is required",
            email: "Please enter a valid Email"
          },
           phone_number: {
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
          zip_code: {
            required: "The Zip Code is required",
           
          },
          account_type: {
            required: "The Account Type is required",
           
          },
          location: {
            required: "The Location is required",
           
          },
          company: {
            required: "The Company Name is required",
           
          },
          
        }
      });
    });



    $(document).on("change","#account_type",function(){
    	
    	 var account_type=$("#account_type").val();
    	 if(account_type=='business'){
    	 	$('.company_div').css("display","block");
    	 	$('.location_div').css("display","block");
    	 }else{
			$('.company_div').css("display","none");
    	 	$('.location_div').css("display","none");
    	 }
    });
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode;
     // console.log(charCode);
        if (charCode != 46 && charCode != 45 && charCode > 31
        && (charCode < 48 || charCode > 57))
         return false;

      return true;
    }
  </script>
@stop
