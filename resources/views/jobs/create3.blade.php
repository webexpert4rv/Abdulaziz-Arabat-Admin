@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
@stop

@section('content')

  <link rel="stylesheet" href="{{env('STORAGE_PATH')}}/css/style.css"> 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom CSS -->

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
   * { font-family: DejaVu Sans, sans-serif; }
  #map {
    height: 100%;
  }
  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  div.pac-container {
    z-index: 99999999999 !important;
  }
  .request_for_quotations .form-group .custom_check {
    margin: 0 5px 0 0;
    display: flex;
    align-items: center;
    position: relative;
}
.request_for_quotations .form-group .custom_check span {
    height: 18px;
    width: 18px;
    display: block;
    border: 1px solid #000200;
    border-radius: 4px;
    margin: 0 5px 0 0;
    position: relative;
}
form#job-create select#number_of_vehicle,form#job-create select#vehicle_type_id, form#job-create select#total_goods_weight, form#job-create select#product_id, form#job-create select#pick_up_region_id, form#job-create select#destination_region_id {
    padding: 0 0 0 50px !important;
    background-image: url(../../images/vehiclenumber.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 26px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create select#product_id{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/type.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 26px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create select#same_receiver,form#job-create select#user_id,form#job-create select#transporter_id,form#job-create select#driver_id{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/receiver.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 16px, 16px !important;
    background-repeat: no-repeat !important;
}
form#job-create input#receivers_name{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/receiver.svg)!important;
    background-position: 15px 19px,  center right !important;
    background-size: 16px, 16px !important;
    background-repeat: no-repeat !important;
}
form#job-create select#pick_up_sub_region_id,form#job-create select#destination_sub_region_id{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/city-choose.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 26px, 20px !important;
    background-repeat: no-repeat !important;
}
 
form#job-create input#pickup_address,form#job-create input#destination_address{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/address.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 16px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create input#user_contact_number,form#job-create input#driver_contact_number,form#job-create input#receiver_number{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/receiver_number.svg)!important;
    background-position: 15px 19px,  center right !important;
    background-size: 21px, 20px !important;
    background-repeat: no-repeat !important;
}
i.clock.gj-icon {
    left: 0;
    top: 14px;
    font-size: 22px;
    left: 2px;
}
</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>REGISTER ORDER</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <div class="row">
              <div class="col-md-6"  >
                <button type="button" style="margin-left: 30px;" class="btn btn-primary">Users</button>
              </div>
              <div class="col-md-6"  >
                <button type="button" class="btn btn-primary">Transporters</button>
              </div>
            </div>

            
            <form id="job-create" method="post"  enctype="multipart/form-data">
                                @csrf
                                 
                                <div class="card-body">  
                                             
                                    <div class="row">
                                      <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Select User </label>
                                                <select data-placeholder="Select User" disabled name="user_id" id="user_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
                                                  <option value="" selected="">Select User</option>
                                                @foreach($getUsers as $getUser)
                                                <option value="{{$getUser->id}}" <?php if($getJobData[0]['user_id']==$getUser->id){echo 'selected';} ?>>{{$getUser->name}}</option> 
                                                @endforeach
                                              </select>
                                                <div id ="email_error" class="error"></div>
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->last('email') }}</div>
                                                @endif 
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Select Transporter</label>
                                                <select data-placeholder="Select Transporter" disabled name="transporter_id" id="transporter_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
                                                  <option value="" selected="">Select Transporter</option>
                                                @foreach($getTransporters as $getTransporter)
                                                <option value="{{$getTransporter->id}}" <?php if($getJobData[0]['transporter_id']==$getTransporter->id){echo 'selected';} ?>>{{$getTransporter->name}}</option> 
                                                @endforeach
                                              </select>
                                                <div id ="email_error" class="error"></div>
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->last('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Enter Pickup Address</label>
                                            <input autocomplete="off" type="hidden" id="pick_up_lat" value="{{$getJobData[0]['pick_up_lat']}}"  name="pick_up_lat" >
                                            <input autocomplete="off" type="hidden" id="pick_up_long" value="{{$getJobData[0]['pick_up_long']}}" name="pick_up_long" >
                                            <input autocomplete="off"  readonly type="text" name="pick_up_address" value="{{$getJobData[0]['pick_up_address']}}" class="form-control input-dash-log" value="{{old('pick_up_address')}}" onclick="pickUpLocation()" id="pickup_address" placeholder="Enter Pickup Address">
                                            <div id ="email_error" class="error"></div>
                                              @if($errors->has('email'))
                                              <div class="error">{{ $errors->last('email') }}</div>
                                              @endif
                                          </div> 

                                        </div>
                                         <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Select Vehcle Type</label>
                                                <select data-placeholder="Select Vehcle Type" disabled style="border-radius: 9px;width: 100%;background-color: white;" name="vehicle_type_id" id="vehicle_type_id" class=" input-vehicle" data-live-search="true" data-container="body"> 
                                                  
                                                 @foreach($getVehicleType as $vehicletype)
                                                <option value="{{$vehicletype->id}}">
                                                  {{\Session::get('language')=='ar'?$vehicletype->arabic_name:$vehicletype->name}}({{$vehicletype->max_load}} {{$vehicletype->max_load_unit}}, {{$vehicletype->length}} {{$vehicletype->unit}})
                                                </option> 
                                                @endforeach
                                              </select>
                                                <div id ="email_error" class="error"></div>
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->last('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-6">
                                            <div class="form-group form-group-width w-100">
                                              <label for="email">Enter Drop Address</label>
                                              <input autocomplete="off" type="hidden" id="destination_lat" value="{{$getJobReceiverData[0]['destination_lat']}}" name="destination_lat">
                                              <input autocomplete="off" type="hidden" id="destination_long" value="{{$getJobReceiverData[0]['destination_long']}}" name="destination_long">
                                              <input autocomplete="off" type="text" readonly name="destination_address" value="{{$getJobReceiverData[0]['destination_address']}}" class="form-control input-dash-log" value="{{old('destination_address')}}" onclick="destination()" id="destination_address" placeholder="Enter Pickup Location(Optional)">
                                            </div>                      
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Select Vehcle/Registration Number</label>
                                              <select name="license_plate" disabled style="border-radius: 9px;width: 100%;height: 59px;" id="number_of_vehicle" class="number_of_vehicle selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                                <option value="{{$getBookingData[0]['license_plate']}}" selected="">{{$getBookingData[0]['license_plate']}}</option>
                                                                     
                                                 
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">User Contact Number</label>
                                              <input autocomplete="off" type="text" disabled class="form-control" value="{{$getUserData[0]['phone_number']}}" id="user_contact_number" name="user_contact_number" placeholder="Enter User Contact Number" autocomplete="off">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Select Driver</label>
                                              <select name="driver_id" disabled style="border-radius: 9px;width: 100%;height: 59px;" id="driver_id" class="  selectpicker input-vehicle" data-live-search="true" data-container="body">
                                                <option value="{{$getDriverData[0]->id}}" selected="">{{$getDriverData[0]->name}}</option>
                                                                        
                                                 
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100 time__input">
                                            <label for="email">Select Schedule Time</label>
                                            <input autocomplete="off" type="text" disabled value="{{$getJobData[0]['schedule_time']}}" class="form-control input-vehicle input-dash-log " id="schedule_time" name="schedule_time" placeholder="Select Schedule Time">
                                            <span class="error insurance_expiry_date_error">
                                              @if($errors->has('schedule_time')){{ $errors->first('schedule_time') }}@endif
                                            </span>
                                          </div>                    
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Driver Contact Number</label>
                                              <input autocomplete="off" readonly type="number" value="{{$getDriverData[0]->phone_number}}" class="form-control" id="driver_contact_number" name="driver_contact_number" placeholder="Enter Driver Contact Number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Schedule Date</label>
                                            <input autocomplete="off" type="text" value="{{$getJobData[0]['schedule_date']}}" class="form-control input-vehicle input-dash-log" id="schedule_date_datepicker" onautocomplete="off" readonly name="schedule_date" placeholder="Select Schedule Date">
                                            <span class="error insurance_expiry_date_error">@if($errors->has('schedule_date')){{ $errors->first('schedule_date') }}@endif</span>
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Product Type</label> 
                                            <select name="product_id" disabled style="border-radius: 9px;width: 100%;height: 59px;" id="product_id" class="selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                              <option value="" selected="">Select Product Type</option>
                                              @foreach($getProduct as $productType)
                                              <option value="{{$productType->id}}" <?php if($getJobData[0]['product_id']==$productType->id){echo 'selected';} ?>>
                                                {{\Session::get('language')=='ar'?$productType->arabic_name:$productType->name}}
                                              </option> 
                                              @endforeach
                                            </select>
                                          </div>                    
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Reciever Name</label>
                                              <input autocomplete="off" readonly value="{{$getJobReceiverData[0]['receivers_name']}}" type="text" class="form-control" id="receivers_name" name="receivers_name" placeholder="Enter Reciever Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Reciever Contact Number</label>
                                              <input autocomplete="off" readonly value="{{$getJobReceiverData[0]['receiver_number']}}" type="number" class="form-control" id="receiver_number" name="receiver_number" placeholder="Enter Reciever Contact Number" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"  >
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Brief Description of Goods</label> 
                                            <textarea class="form-control input-dash-log" readonly onkeyup="countChar(this)" id="description_of_goods" name="description_of_goods" placeholder="Brief Description of Goods">{{$getJobData[0]['description_of_goods']}}</textarea>
                                            <!-- <div class="position-relative"><label id="charNum" class="description_count">500</label></div> -->


                                          </div>                    
                                        </div> 
                                    <!-- <div class="card-footer">
                                    <button type="text" id="createJob" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                                    </div> -->
                                    <br><br>
                                 
                                 
                               
                                <!-- <div class="request_for_quotations mb-3">
                                  <div class="form-group form-group-width">
                                    <div class="custom_check" style="width:26px !important;border:none !important;">
                                      <input autocomplete="off" type="checkbox" checked name="rfq_status">
                                      <span></span>

                                    </div>  Request for Quotations               
                                  </div>
                                </div> -->  
                                    
                            </div>
                            <!-- /.card-body -->
                            
                        </form>
                        <?php $paymentStatus='none'; if(!empty($_GET['job_id'])){$paymentStatus='flex';}else{$paymentStatus='none';} ?>
                         <div class="row" style="display:<?php echo $paymentStatus; ?>">
                                  <h4>Payment Details</h4> 
  
 
                                <div class="col-md-6">
                                  <form method="post" action="{{ route('download-user-invoice',['type'=>'user']) }}" enctype="multipart/form-data">
                                    <input autocomplete="off" type="hidden" id="job_id" value="{{$getJobData[0]['id']}}"  name="job_id" >
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Base Price</label> 
                                      <input autocomplete="off" value="{{@$jobsPaymentDetails->user_base_price }}" type="number" required class="form-control input-dash-log" id="user_base_price" name="user_base_price" placeholder="Base Price">
                                    </div>  
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Tax Calculate</label> 
                                      <input autocomplete="off" type="text" value="{{@$jobsPaymentDetails->user_tax }}" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="user_tax" name="user_tax" placeholder="Tax Calculate">
                                    </div> 
                                     <div class="form-group form-group-width w-100">
                                      <label for="email">Commission</label> 
                                      <input autocomplete="off" type="text" value="{{@$jobsPaymentDetails->user_commission }}" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="user_commission" name="user_commission" placeholder="Commission">
                                    </div> 
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Select Language</label> 
                                      <select name="language_code" class="form-control input-dash-log">
                                        <option value="en" {{ @$jobsPaymentDetails->user_language_code == "en" ? 'selected' : '' }}>English</option>
                                        <option value="ar" {{ @$jobsPaymentDetails->user_language_code == "ar" ? 'selected' : '' }}>Arabic</option>
                                      </select>
                                    </div>
                                    <div class="form-group form-group-width w-100">
                                      <button type="submit" id="download_user_invoice" class="btn btn-primary">Save And Download Invoice</button>
                                    </div> 
                                    </form>                   
                                  </div>
                                
                                  

                                
                                  <div class="col-md-6">
                                    <form method="post" action="{{ route('download-user-invoice',['type'=>'transporter']) }}" enctype="multipart/form-data">
                                      <input autocomplete="off" type="hidden" id="job_id" value="{{$getJobData[0]['id']}}"  name="job_id" >
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Base Price for User</label> 
                                      <input autocomplete="off" value="{{@$jobsPaymentDetails->transpoeter_base_price }}" type="number" required class="form-control input-dash-log" id="transpoeter_base_price" name="transpoeter_base_price" placeholder="Base Price">
                                    </div>
                                     <div class="form-group form-group-width w-100">
                                      <label for="email">Tax Calculate</label> 
                                      <input autocomplete="off" value="{{@$jobsPaymentDetails->transpoeter_tax }}" type="text" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="transpoeter_tax" name="transpoeter_tax" placeholder="Tax Calculate">
                                    </div> 
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Commission for Transporter</label> 
                                      <input autocomplete="off" value="{{@$jobsPaymentDetails->transpoeter_commission }}" type="text" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="transpoeter_commission" name="transpoeter_commission" placeholder="Commission">
                                    </div>
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Select Language</label> 
                                      <select name="language_code" class="form-control input-dash-log">
                                      <option value="en" {{ @$jobsPaymentDetails->transpoeter_language_code == "en" ? 'selected' : '' }}>English</option>
                                        <option value="ar" {{ @$jobsPaymentDetails->transpoeter_language_code == "ar" ? 'selected' : '' }}>Arabic</option>
                                      </select>
                                    </div>
                                     <div class="form-group form-group-width w-100"> 
                                      <button type="submit" id="download_transporter_invoice" class="btn btn-primary">Save And Download Invoice</button>
                                    </div> 
                                  </form>                     
                                  </div>


                                  </div>
                                    
                       
          </div>
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="pickUpLocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">    
    <div class="modal-content content_modal">
      <div class="modal-header header_modal"> 
        <input id="searchmapspickUpLocation" class="search-location" type="text" placeholder="Enter a Location"> 
        <div style="width: 800px; height: 400px;" id="mapspickUpLocation"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress" class="search-location" type="text" placeholder="Entar a Location"> 
      <div class="modal-header header_modal">
        <div style="width: 800px; height: 400px;" id="mapsdestinationaddress"></div>
      </div>

      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>


  </div>
</div>
 
@endsection

@section('css')
@stop

@section('js')
  <script>
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}
  </script>
 
@stop
