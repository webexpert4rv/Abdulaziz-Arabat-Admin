@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
@stop

@section('content')

  <link rel="stylesheet" href="https://arabat-web.rvtechnologies.in/css/style.css"> 
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
   
  <link rel="stylesheet" href="https://arabat-web.rvtechnologies.in/css/style.css">
<style type="text/css">
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
    background-image: url(../../images/address.svg)!important;
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
form#job-create .form-group.time__input i.gj-icon.clock {
    width: 100%;
    height: 100%;
    cursor: pointer;
    opacity: 0;
}
form#job-create input#schedule_date_datepicker{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/schedule_date.svg)!important;
    background-position: 15px 19px,  center right !important;
    background-size: 21px, 20px !important;
    background-repeat: no-repeat !important;
}
input.search-location {
    top: 10px !important;
    height: 40px;
    padding: 0 10px 0;
    font-size: 16px;
    border: none;
    box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
}
form#job-create .form-group input#schedule_time {
    background-image: url(../../images/schedule_time.svg);

    background-position: 16px 19px;
    background-size: 20px;
    background-repeat: no-repeat;
    padding: 0 0 0 47px !important;
}
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
                                 <input type="hidden" name="job_id" value="{{$getJobData[0]['id']}}" >
                                 <input type="hidden" name="booking_id" value="{{$getBookingData[0]['id']}}" >
                                 <input type="hidden" name="job_receiver_id" value="{{$getJobReceiverData[0]['id']}}" >
                                <div class="card-body">  
                                             
                                    <div class="row">
                                      <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Select User</label>
                                                <select data-placeholder="Select User" name="user_id" id="user_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
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
                                                <select data-placeholder="Select Transporter" name="transporter_id" id="transporter_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
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
                                                <select data-placeholder="Select Vehcle Type" style="border-radius: 9px;width: 100%;background-color: white;" name="vehicle_type_id" id="vehicle_type_id" class=" input-vehicle" data-live-search="true" data-container="body"> 
                                                  <option value='' selected disabled>Select</option>
                                                 @foreach($getVehiclesTypes as $getVehiclesType)
                                                <option value="{{$getVehiclesType->id}}" <?php if($getJobData[0]['vehicle_type_id']==$getVehiclesType->id){echo 'selected';} ?>>{{$getVehiclesType->name}}</option> 
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
                                              <input autocomplete="off" type="text" readonly name="destination_address"  class="form-control input-dash-log" value="{{$getJobReceiverData[0]['destination_address']}}" onclick="destination()" id="destination_address" placeholder="Enter Pickup Location(Optional)">
                                            </div>                      
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Select Vehcle/Registration Number</label>
                                              <select name="license_plate" style="border-radius: 9px;width: 100%;height: 59px;" id="number_of_vehicle" class="number_of_vehicle selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                                <option value="" selected="">Select</option>
                                                @foreach($getVehiclesNumbers as $getVehiclesNumber)
                                                <option value="{{$getVehiclesNumber->license_plate}}" <?php if($getBookingData[0]['license_plate']==$getVehiclesNumber->license_plate){echo 'selected';} ?>>{{$getVehiclesNumber->license_plate}}</option> 
                                                @endforeach                     
                                                 
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
                                              <select name="driver_id" style="border-radius: 9px;width: 100%;height: 59px;" id="driver_id" class="  selectpicker input-vehicle" data-live-search="true" data-container="body">
                                                <option value="{{$getdrivers[0]->id}}">{{$getdrivers[0]->name}}</option>
                                                                        
                                                 
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100 time__input">
                                            <label for="email">Select Schedule Time</label>
                                            <input autocomplete="off" type="text" class="form-control input-vehicle input-dash-log " value="{{$getJobData[0]['schedule_time']}}" id="schedule_time" name="schedule_time" placeholder="Select Schedule Time">
                                            <span class="error insurance_expiry_date_error">
                                              @if($errors->has('schedule_time')){{ $errors->first('schedule_time') }}@endif
                                            </span>
                                          </div>                    
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Driver Contact Number</label>
                                              <input autocomplete="off" readonly type="number" value="{{$getdrivers[0]->phone_number}}" class="form-control" id="driver_contact_number" name="driver_contact_number" placeholder="Enter Driver Contact Number" autocomplete="off">
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
                                            <select name="product_id" style="border-radius: 9px;width: 100%;height: 59px;" id="product_id" class="selectpicker  input-vehicle" data-live-search="true" data-container="body">
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
                                              <input autocomplete="off" type="text" value="{{$getJobReceiverData[0]['receivers_name']}}" class="form-control" id="receivers_name" name="receivers_name" placeholder="Enter Reciever Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Reciever Contact Number</label>
                                              <input autocomplete="off" type="number" value="{{$getJobReceiverData[0]['receiver_number']}}" class="form-control" id="receiver_number" name="receiver_number" placeholder="Enter Reciever Contact Number" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"  >
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Brief Description of Goods</label> 
                                            <textarea  class="form-control input-dash-log" onkeyup="countChar(this)" id="description_of_goods" name="description_of_goods" placeholder="Brief Description of Goods">{{$getJobData[0]->description_of_goods}}</textarea>
                                            <?php  $countLength=strlen($getJobData[0]->description_of_goods);$totoalLemgth=500-$countLength; ?>
                                            <div class="position-relative"><label id="charNum" class="description_count"><?php echo $totoalLemgth; ?></label></div>


                                          </div>                    
                                        </div> 
                                    <div class="card-footer">
                                    <button type="text" id="createJob" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                                    </div>
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
                         <div class="row">
                                  <h4>Payment Details</h4>
                              
                                <div class="col-md-6">
                                  <form method="post" action="{{ route('download-user-invoice',['type'=>'user']) }}" enctype="multipart/form-data">
                                    <input autocomplete="off" type="hidden" id="job_id" value="{{$getJobData[0]['id']}}"  name="job_id" >
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Base Price</label> 
                                      <input autocomplete="off" value="{{$getBookingData[0]['user_base_price']}}" type="number" required class="form-control input-dash-log" id="user_base_price" name="user_base_price" placeholder="Base Price">
                                    </div>  
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Tax Calculate</label> 
                                      <input autocomplete="off" value="{{$getBookingData[0]['user_tax']}}" type="text" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="user_tax" name="user_tax" placeholder="Tax Calculate">
                                    </div> 
                                     <div class="form-group form-group-width w-100">
                                      <label for="email">Commission</label> 
                                      <input autocomplete="off" value="{{$getBookingData[0]['user_commission']}}" type="text" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="user_commission" name="user_commission" placeholder="Commission">
                                    </div> 
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Select Language</label> 
                                      <select name="language_code" class="form-control input-dash-log">
                                        <option value="en">English</option>
                                        <option value="ar">Arabic</option>
                                      </select>
                                    </div>
                                    <div class="form-group form-group-width w-100">
                                      <button type="submit" id="download_user_invoice" class="btn btn-primary">Download Invoice</button>
                                    </div> 
                                    </form>                   
                                  </div>
                                
                                  

                                
                                  <div class="col-md-6">
                                    <form method="post" action="{{ route('download-user-invoice',['type'=>'transporter']) }}" enctype="multipart/form-data">
                                      <input autocomplete="off" type="hidden" id="job_id" value="{{$getJobData[0]['id']}}"  name="job_id" >
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Base Price for User</label> 
                                      <input autocomplete="off" value="{{$getBookingData[0]['transporter_base_price']}}" type="number" required class="form-control input-dash-log" id="transpoeter_base_price" name="transpoeter_base_price" placeholder="Base Price">
                                    </div>
                                     <div class="form-group form-group-width w-100">
                                      <label for="email">Tax Calculate</label> 
                                      <input autocomplete="off" value="{{$getBookingData[0]['transporter_tax']}}" type="text" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="transpoeter_tax" name="transpoeter_tax" placeholder="Tax Calculate">
                                    </div> 
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Commission for Transporter</label> 
                                      <input autocomplete="off" value="{{$getBookingData[0]['transporter_commission']}}" type="text" minlength="1" maxlength="2" onkeypress="return isNumberKey(event)" required class="form-control input-dash-log" id="transpoeter_commission" name="transpoeter_commission" placeholder="Commission">
                                    </div>
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Select Language</label> 
                                      <select name="language_code" class="form-control input-dash-log">
                                        <option value="en">English</option>
                                        <option value="ar">Arabic</option>
                                      </select>
                                    </div>
                                     <div class="form-group form-group-width w-100"> 
                                      <button type="submit" id="download_transporter_invoice" class="btn btn-primary">Download Invoice</button>
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
      <button type="button" style="margin-left:900px;margin-bottom:-15px;" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
      <div class="modal-header header_modal"> 
        <input id="searchmapspickUpLocation" style="width: 50%;" class="search-location" type="text" placeholder="Enter a Location"> 
        <div style="width: 916px; height: 400px;" id="mapspickUpLocation"></div>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="destinaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content content_modal">
      <button type="button"  style="margin-left:900px;margin-bottom:-15px;" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
      <input id="searchmapsdestinationaddress" style="width: 50%;" class="search-location" type="text" placeholder="Entar a Location"> 

      <div class="modal-header header_modal">
        <div style="width: 916px; height: 400px;" id="mapsdestinationaddress"></div>
      </div>

      
    </div>


  </div>
</div>
 
@endsection

@section('css')
@stop

@section('js')
 

<script>

  $(document).ready(function(){
    $('body.arabic_language.after-login span[role="am"]').html('أكون');
    $('body.arabic_language.after-login span[role="pm"]').html('مساءً');
    //$('body.arabic_language.after-login div[role="footer"]').html('<button class="gj-button-md">نعم</button><button class="gj-button-md">Ok</button>');     
        
     


});


  function getmap(map,input){

    var autocomplete = new google.maps.places.Autocomplete(input);
     
    autocomplete.bindTo('bounds', map);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();

    var marker = new google.maps.Marker({
      map: map,      
    });

    
    autocomplete.addListener("place_changed", function(event) {
      infowindow.close();



      var place = autocomplete.getPlace();

      if (!place.geometry || !place.geometry.location) {
        return;
      }
      console.log('location lat logn =>'+place.geometry.location);

      
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);
      }

      /*marker.setPlace({
        placeId: place.place_id,
        location: place.geometry.location,
      });*/

      /*console.log('counr=>'+markers.length);
      console.log('lat =>'+place.geometry.location.lat());
      console.log('lng =>'+place.geometry.location.lng());
      console.log('address =>'+ place.formatted_address);


      $("#pick_up_lat").val(place.geometry.location.lat())
      $("#pick_up_long").val(place.geometry.location.lng())      
      $("#pickup_address").val(place.formatted_address)*/

    });
  }
  

</script>
<script>

function countChar(val) {

    var len = val.value.length;
    if (len >= 500) {
      val.value = val.value.substring(0, 501);
    } else {
      $('#charNum').text(500 - len);
    }
  };

  function countChars(val) {

    var len = val.value.length;
    if (len >= 500) {
      val.value = val.value.substring(0, 501);
    } else {
      $('#charNums').text(500 - len);
    }
  };
 
  
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>   


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js">
</script> 

<script type="text/javascript">

  $('#schedule_date_datepicker').datepicker({

    startDate: '-0m',
    format: 'dd/mm/yyyy',


  });



</script> 
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"> </script> -->
<script>

  $('#schedule_time').timepicker({});


var timepickerElement = document.getElementById('schedule_time');
// var timepicker = new UnpkgTimepicker(timepickerElement, {
//   // Specify the language option
//   language: 'fr', // 'fr' for French, replace with your desired language code
//   // Other options...
// });


</script>
<script>
 function pickUpLocation(){
    $("#pickUpLocation").modal("show");
  }
  function destination(){

    $("#destinaddress").modal("show");
  }

  function destinationReceiver(id){
    $("#destinationReceiver_"+id).modal("show");

  }
  </script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCQ7tSwbJ4k3xdWU61tpSLf4-Fjl2cJ7YY&callback=initMap" async defer></script>
 
<script>

  var map;
  var markers = [];

  function initMap() {


    var haightAshbury = {lat: 23.507604696737108, lng: 45.188371411075536};

    map = new google.maps.Map(document.getElementById('mapspickUpLocation'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var input = document.getElementById('searchmapspickUpLocation');

    getmap(map,input);


    map.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerPickUp(event.latLng);       

    });


    mapm = new google.maps.Map(document.getElementById('mapsdestinationaddress'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var input1 = document.getElementById('searchmapsdestinationaddress');
    getmap(mapm,input1);

    mapm.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }

      addMarkerDestination(event.latLng);

    });




/*----------*/


   
  }

  function addMarkerPickUp(location) {

    var marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#pick_up_lat").val(marker.getPosition().lat())
        $("#pick_up_long").val(marker.getPosition().lng())       
        $("#pickup_address").val(address)
      }
    });
  }



  function addMarkerDestination(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: mapm
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#destination_lat").val(marker.getPosition().lat())
        $("#destination_long").val(marker.getPosition().lng())       
        $("#destination_address").val(address)
      }
    });
  }

 




  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

  function clearMarkers() {
    setMapOnAll(null);
  }

  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

$(document).on("change", "select[name*=user_id]", function() {
  var user_id=this.value;
  $.ajax({
        url: "{{ route('get-user-details') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          id: user_id
        },

        success: function(response) { 

          $('#user_contact_number').val(response.phone_number);
          // console.log(response.phone_number);                         
        }
      });

});

$(document).on("change", "select[name*=transporter_id]", function() {
  var transporter_id=this.value;

  $.ajax({
        url: "{{ route('get-vehicle-details') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          id: transporter_id
        },

        success: function(response) { 
          // console.log(response.vehicleList);
          $('#vehicle_type_id').html(response.vehicleList);
          // $('#driver_id').html(response.driverList);
          $('#number_of_vehicle').html('<option value="" selected disabled>Select</option>');
          $('#driver_id').html('<option value="" selected disabled>Select</option>');
          // console.log(response.phone_number);                         
        }
      });

});

$(document).on("change", "select[name*=vehicle_type_id]", function() {
  var transporter_id=$('#transporter_id').val();
  var vehicle_type_id=this.value;
  // console.log(transporter_id);
  $.ajax({
        url: "{{ route('get-vehicle-number-details') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          vehicle_type_id: vehicle_type_id,transporter_id:transporter_id
        },

        success: function(response) { 
          // console.log(response);
          $('#number_of_vehicle').html(response.vehicleNumberList);
          $('#driver_id').html('<option value="" selected="">Select</option>');
          $('#driver_contact_number').val('');
          // $('#driver_id').html(response.driverList);
          // console.log(response.phone_number);                         
        }
      });

});

$(document).on("change", "select[name*=license_plate]", function() {
  var license_plate=this.value;
  $.ajax({
        url: "{{ route('get-driver-list') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          license_plate: license_plate
        },

        success: function(response) { 
          $('#driver_id').html(response.driver_name);
          $('#driver_contact_number').val(response.driver_phone_number);
          // console.log(response.phone_number);                         
        }
      });

});

var validate=$('#job-create').validate({
//ignore: [],
    ignore: '',

    debug: false,
    rules: {
      vehicle_type_id: "required",
      user_id: "required",
      transporter_id:"required",
      pick_up_address:"required", 
      number_of_vehicle: "required",
      schedule_date    : "required",
      schedule_time    : "required",
      product_id       : "required",
    

    },
    messages: {

      vehicle_type_id: { 
        "required":'Please Select Vehcle Type',         
      },
      user_id: { 
        "required":'Please Select User',         
      },
      transporter_id:{
        "required":'Please Select Transporter',
      },
      pick_up_address:{
        "required":'Please select Pickup Address',
      },
      number_of_vehicle: { 
        "required":'Please Select Number of Vehcle',         
      },
      schedule_date: {
        "required":'Please Select Schedule Date',           
      },  
      schedule_time: {
        "required":'Please Select Schedule Time',           
      },
      product_id: {
        "required":'Please Select Product Type',
      },
 

    },
    submitHandler: function(form) {
 
      $.ajax({
            type: "POST",
            url: "{{ route('job.update.manually') }}",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function(response) {
              // window.location.href = "edit-job?job_id="+response+""
                if (response.status == 'failed') {
                    toastr.error(response.message);
                }

                if (response.status == 'success') {
                    toastr.success(response.message);
                    $('#myModal').modal('hide');

                }
            }
        });
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
