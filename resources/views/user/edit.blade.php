@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
@stop

@section('content')
<link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="order_details">
                    <div class="card">
                        <div class="card-header alert d-flex justify-content-between align-items-center">
                            <h3>{{ __('adminlte::adminlte.edit_user') }}</h3>
                            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form id="addAdminForm" method="post", action="{{ route('users.update',$user->id) }}"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">  
                                <div class="row">
                                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
                                          <div class="form-group">
                                            <img id="blah" style="width: 40%;" src="{{config('services.storage_image_path.web_path')}}/{{$user->profile_image}}">
                                            <label>Profile Image</label>  
                                            <input onchange="readURL(this);" type="file" placeholder="" name="profile_image" class="form-control" id="profile_image" maxlength="100">      
                                        </div>
                                    </div>
                                </div>              
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="unique_ID">User ID</label>
                                                <input class="form-control" placeholder="{{$user->unique_ID}}" readonly> 
                                                

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="full_name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                                                <input type="text" placeholder="Name" value="{{$user->name}}" name="name" class="form-control" id="name" maxlength="100">
                                                @if($errors->has('full_name'))
                                                <div class="error">{{ $errors->first('full_name') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Ex: emaple@arabat.com" maxlength="100">
                                                <div id ="email_error" class="error"></div>
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->last('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="phone_number">{{ __('adminlte::adminlte.mobile') }}<span class="text-danger"> *</span></label>
                                                <input type="text" name="phone_number" value="{{$user->country_code}}{{strip_tags($user->phone_number)}}" id="phone_number" placeholder="Phone Number" maxlength="14" style="padding-left:226px !important;" data-phone="{{$user->phone_number}}">
                                                <div id ="phone_number_error" class="error"></div>
                                                @if($errors->has('phone_number'))
                                                <div class="error">{{ $errors->last('phone_number') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="city">{{ __('adminlte::adminlte.city') }}</label>
                                                <input type="text" name="city" value="{{$user->city}}" class="form-control" id="city" placeholder="City (optional)" maxlength="100">
                                                <div id ="city_error" class="error"></div>
                                                @if($errors->has('city'))
                                                <div class="error">{{ $errors->last('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="address">{{ __('adminlte::adminlte.address') }}</label>
                                                <input type="text" name="address" value="{{$user->address}}" class="form-control" id="address" placeholder="Address (optional)" maxlength="100">
                                                <div id ="address_error" class="error"></div>
                                                @if($errors->has('address'))
                                                <div class="error">{{ $errors->last('address') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="zip_code">{{ __('adminlte::adminlte.zip_code') }}</label>
                                                <input type="text" placeholder="Zip Code (optional)" value="{{$user->zip_code}}" name="zip_code" class="form-control" id="zip_code" maxlength="100">
                                                @if($errors->has('zip_code'))
                                                <div class="error">{{ $errors->last('zip_code') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <input type="hidden" name="account_type" value="0">

                                        <!-- <div class="col-6">
                                            <div class="form-group">
                                                <label for="account_type">{{ __('adminlte::adminlte.account_type') }}<span class="text-danger"> *</span></label>
                                                <select name="account_type"  class="form-control" id="account_type">
                                                    <option value="" hidden>{{ __('adminlte::adminlte.select_account_type') }}</option>
                                                    <option value="0" {{$user->account_type==0?'selected':''}}>Personal</option>
                                                    <option value="1" {{$user->account_type==1?'selected':''}}>Bussiness</option>

                                                </select>
                                                @if($errors->has('account_type'))
                                                <div class="error">{{ $errors->last('account_type') }}</div>
                                                @endif
                                            </div>
                                        </div> -->

                                        <div class="col-6 company_div">
                                            <div class="form-group">
                                                <label for="company">{{ __('adminlte::adminlte.company') }}<span class="text-danger"> *</span></label>
                                                <input type="text" value="{{$user->company_name}}" placeholder="Company Name" name="company_name" class="form-control" id="company" maxlength="100">
                                                @if($errors->has('company'))
                                                <div class="error">{{ $errors->last('company') }}</div>
                                                @endif
                                            </div>
                                        </div>    
                                        
                                        
                                        <div class="col-6 company_div">
                                            <div class="form-group">
                                                <label for="company">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> *</span></label>
                                                <input type="password" value="" placeholder="Password" name="password" class="form-control" id="password" maxlength="100">
                                                @if($errors->has('password'))
                                                <div class="error">{{ $errors->last('password') }}</div>
                                                @endif
                                            </div>
                                        </div> 

                                        <div class="col-6 company_div">
                                            <div class="form-group">
                                                <label for="company">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                                                <input type="password" value="" placeholder="Confirm password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                                                @if($errors->has('confirm_password'))
                                                <div class="error">{{ $errors->last('confirm_password') }}</div>
                                                @endif
                                            </div>
                                        </div> 




                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label for="is_push_notifications">Push Notifications</label>
                                                <select name="is_push_notifications"  class="form-control" id="is_push_notifications">
                                                    <option value="" hidden>{{ __('adminlte::adminlte.select_account_type') }}</option>
                                                    <option value="0" {{$user->is_push_notifications==0?'selected':''}}>OFF</option>
                                                    <option value="1" {{$user->is_push_notifications==1?'selected':''}}>ON</option>

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
                                                    <option value="" hidden>{{ __('adminlte::adminlte.select_account_type') }}</option>
                                                    <option value="0" {{$user->is_email_notifications==0?'selected':''}}>OFF</option>
                                                    <option value="1" {{$user->is_email_notifications==1?'selected':''}}>ON</option>

                                                </select>
                                                @if($errors->has('is_email_notifications'))
                                                <div class="error">{{ $errors->last('is_email_notifications') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-6">
                                            <div class="form-group">
                                                <label for="commission">Commission for User</label>
                                                <input type="text" placeholder="Commission for User" value="{{$user->commission}}" name="commission" class="form-control" id="commission" maxlength="100">
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
</div>
</section>
@endsection

@section('css')
@stop

@section('js')

<script src="{{asset('build/js/intlTelInput.js')}}"></script>
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
    var input = document.querySelector("#phone_number");

    window.intlTelInput(input, {
        separateDialCode: true,


        nationalMode: true,
        formatOnDisplay: false, 


        hiddenInput: "full",
        utilsScript: "{{asset('build/js/utils.js')}}",
    });


</script>
<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#blah').attr('src', e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
      }
  }
  $(document).ready(function() {

    $('#addAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
            name: {
                required:true,
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
                // remote: {
                //     url: "{{route('user.email.check')}}",
                //     type: "post",
                //     data: {
                //         email:$("email").val(),
                //         id   : {{$user->id}},
                //         _token:"{{ csrf_token() }}"
                //     },
                //     dataFilter: function (data) {
                //         if(data){
                //             var response=JSON.parse(data);
                //             if (response.status == 400) {
                //                 return "\"" + "Email already exists" + "\""

                //             }else{
                //                 return 'true';
                //             } 
                //         }else{
                //             return 'true';
                //         } 

                //     }
                // }
            },
            phone_number: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                },
                minlength: 7,
                maxlength: 14,

                remote: {
                    url: "{{route('user.phone.check')}}",
                    type: "post",
                    data: {
                        phone_number:$("phone_number").val(),
                        id   : {{$user->id}},
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
            address: {
                // required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            city: {
                // required: true,
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
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                },
                minlength: 8
            },
            confirm_password: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                },
                minlength: 8,
                equalTo : "#password"
            },
            zip_code: {
                // required: true,
                normalizer: function(value) {
                    return $.trim(value);
                },
                minlength: 5,
                maxlength: 9,
                number:true
            },
            account_type: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }

            },

            company_name: {
                required:function(element) {
                    return $("#account_type").val()==1;
                }, 
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            password: {

                minlength: 8
            },
            confirm_password: {

                minlength: 8,
                equalTo : "#password"
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
                required: "Name  is required"
            },
            email: {
                required: "Email  is required",
                email: "Please enter a valid Email"
            },
            phone_number: {
                required: "Phone number  is required"
            },
            address: {
                required: "Address is required",

            },
            city: {
                required: "City  is required"
            },
            role_id: {
                required: "Role  is required"
            },
            password: {
                required: "Password  is required",
                minlength: "Minimum length should be 8"
            },
            confirm_password: {
                required: "Confirm Password  is required",
                minlength: "Minimum length should be 8",
                equalTo : "Confirm Password must be equal to Password"
            },
            zip_code: {
                required: "Zip Code is required",

            },
            account_type: {
                required: "Account Type is required",

            },

            company_name:{
                required: "Company Name is required",
            },
            password: {

                minlength: "Minimum length should be 8"
            },
            confirm_password: {

                minlength: "Minimum length should be 8",
                equalTo : "The Confirm Password must be equal to Password"
            },
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var account_type  =  $("#account_type").val();
        if(account_type==0){
            $('.company_div').hide();
        }else{
            $('.company_div').show();
        }
    });
    $(document).on("change","#account_type",function(){
        var account_type  =  $("#account_type").val();
        if(account_type==0){
            $('.company_div').hide();
        }else{
            $('.company_div').show();
        }
    });
</script>
@stop
