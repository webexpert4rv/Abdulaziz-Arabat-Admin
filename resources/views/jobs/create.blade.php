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

form#job-create select#user_id, form#job-create select#transporter_id {
    padding: 0 0 0 50px !important;
    background-image: url(../../images/receiver.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 23px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create select#number_of_vehicle, form#job-create select#total_goods_weight, form#job-create select#product_id, form#job-create select#pick_up_region_id, form#job-create select#destination_region_id {
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
form#job-create select#same_receiver{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/receiver.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 23px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create input#receiver_name{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/receiver.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 23px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create select#pick_up_sub_region_id,form#job-create select#destination_sub_region_id{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/city-choose.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 23px, 20px !important;
    background-repeat: no-repeat !important;
}
form#job-create select#pick_up_region_id,form#job-create select#destination_region_id{
    padding: 0 0 0 50px !important;
    background-image: url(../../images/region.svg), url("../../images/arrowdown.png")!important;
    background-position: 15px 19px,  center right !important;
    background-size: 23px, 20px !important;
    background-repeat: no-repeat !important;
}

</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_job') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="job-create" method="post",  action="{{route('job.store')}}"  enctype="multipart/form-data">
                                @csrf
                                 
                                <div class="card-body">  
                                             
                                    <div class="row">
                                      <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Select User</label>
                                                <select data-placeholder="Select User" name="user_id" id="user_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
                                                  <option value="" selected="">Select User</option>
                                                @foreach($getUsers as $getUser)
                                                <option value="{{$getUser->id}}">{{$getUser->name}}</option> 
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
                                                <option value="{{$getTransporter->id}}">{{$getTransporter->name}}</option> 
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
                                                <label for="email">Select Vehcle Type</label>
                                                <select data-placeholder="Select Vehcle Type" name="vehicle_type_id[]"  multiple class="chosen-select selectpicker input-vehicle" data-live-search="true" data-container="body"> 
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
                                         <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="email">Select Number of Vehcle</label>
                                            <select name="number_of_vehicle" style="border-radius: 9px;width: 100%;height: 59px;" id="number_of_vehicle" class="number_of_vehicle selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                              <option value="" selected="">Select Number Of Vehicle Required</option>
                                              @for ($i=1; $i <=10 ; $i++)
                                              <option value="{{$i}}" >{{$i}}</option>                      
                                              @endfor                        
                                               
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Schedule Date</label>
                                            <input autocomplete="off" type="text" class="form-control input-vehicle input-dash-log" id="schedule_date_datepicker" onautocomplete="off" readonly name="schedule_date" placeholder="Select Schedule Date">
                                            <span class="error insurance_expiry_date_error">@if($errors->has('schedule_date')){{ $errors->first('schedule_date') }}@endif</span>
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100 time__input">
                                            <label for="email">Select Schedule Time</label>
                                            <input autocomplete="off" type="text" class="form-control input-vehicle input-dash-log " id="schedule_time" name="schedule_time" placeholder="Select Schedule Time">
                                            <span class="error insurance_expiry_date_error">
                                              @if($errors->has('schedule_time')){{ $errors->first('schedule_time') }}@endif
                                            </span>
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Total Weight in Ton per Each Vehicle</label>
                                            <select name="total_goods_weight" style="border-radius: 9px;width: 100%;height: 59px;" id="total_goods_weight" class="selectpicker  input-vehicle" data-live-search="true" data-container="body">                     
                                              <option value="" selected="">Select Total Weight in Ton per Each Vehicle</option>
                                              @for ($i=1; $i <=45 ; $i++)
                                              <option value="{{$i}}" >{{$i}}</option>                      
                                              @endfor 
                                            </select>
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Number of Items</label>
                                            <input autocomplete="off" type="tel" class="form-control input-dash-log" id="number_of_items" name="number_of_items" placeholder="Select Number of Items" autocomplete="off">
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Product Type</label> 
                                            <select name="product_id" style="border-radius: 9px;width: 100%;height: 59px;" id="product_id" class="selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                              <option value="" selected="">Select Product Type</option>
                                              @foreach($getProduct as $productType)
                                              <option value="{{$productType->id}}">
                                                {{\Session::get('language')=='ar'?$productType->arabic_name:$productType->name}}
                                              </option> 
                                              @endforeach
                                            </select>
                                          </div>                    
                                        </div>  
                                        <div class="col-md-6" style="display:none;" id="other">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Other Product Type</label> 
                                            <input autocomplete="off"  id="others" type="text" class="form-control input-dash-log"  name="other" placeholder="Select Other Product Type" autocomplete="off">
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Select Same Receiver?</label> 
                                            <select name="same_receiver" style="border-radius: 9px;width: 100%;height: 59px;" id="same_receiver" class="selectpicker  input-vehicle same_receiver" data-live-search="true" data-container="body">
                                              <option value="" selected>Same Receiver?</option>
                                              <option value="yes" >Yes</option>
                                              <option value="no" >No</option> 
                                            </select>
                                          </div>                    
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Name of Receiver of Goods</label> 
                                            <input autocomplete="off" type="text" class="form-control input-dash-log" id="receiver_name" name="receiver_name" placeholder="Name of Receiver of Goods">
                                          </div>                      
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Receiver's Mobile Number</label> 
                                            <input autocomplete="off" type="number" class="form-control input-dash-log" id="receiver_number" name="receiver_number" placeholder="Receiver's Mobile Number">
                                          </div>                    
                                        </div>
                                        <div class="col-md-12"  >
                                          <div class="form-group form-group-width w-100">
                                            <label for="email">Brief Description of Goods</label> 
                                            <textarea class="form-control input-dash-log" onkeyup="countChar(this)" id="description_of_goods" name="description_of_goods" placeholder="Brief Description of Goods"></textarea>
                                            <div class="position-relative" style="float:right !important;margin-top:-20px !important;margin-right: 10px !important;"><label id="charNum" class="description_count">500</label></div>


                                          </div>                    
                                        </div> 
                                        
                                         
                                    </div>
                                <div class="address_box">
                                  <h3>Enter Pickup Address</h3>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group form-group-width w-100">
                                        <label for="email">Select Your Region</label> 
                                        <select name="pick_up_region_id" style="border-radius: 9px;width: 100%;height: 59px;" id="pick_up_region_id" class="selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                          <option value="" selected="">Select Your Region</option>
                                          @foreach($getRegion as $region)
                                          <option value="{{$region->id}}">
                                            {{\Session::get('language')=='ar'?$region->arabic_name:$region->name}}
                                          </option> 
                                          @endforeach
                                        </select>
                                      </div>                      
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group form-group-width w-100">
                                        <label for="email">Select Your City</label>
                                        <select name="pick_up_sub_region_id" style="border-radius: 9px;width: 100%;height: 59px;" id="pick_up_sub_region_id" class="sub_region selectpicker input-vehicle" data-live-search="true" data-container="body">
                                          <option value="" selected="">Select Your City</option>
                                        </select>
                                      </div>                      
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group form-group-width w-100">
                                        <label for="email">Enter Pickup Address</label>
                                        <input autocomplete="off" type="hidden" id="pick_up_lat"   name="pick_up_lat" >
                                        <input autocomplete="off" type="hidden" id="pick_up_long"  name="pick_up_long" >
                                        <input autocomplete="off"  readonly type="text" name="pick_up_address"  class="form-control input-dash-log" value="{{old('pick_up_address')}}" onclick="pickUpLocation()" id="pickup_address" placeholder="Enter Pickup Address">
                                      </div> 
                                    </div>
                                  </div>
                                </div>
                                <div class="address_box">
                                  <h3>Select Drop Address</h3>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group form-group-width w-100">
                                        <label for="email">Select Your Region</label> 
                                        <select name="destination_region_id" style="border-radius: 9px;width: 100%;height: 59px;" id="destination_region_id" class="selectpicker  input-vehicle" data-live-search="true" data-container="body">
                                          <option value="" selected="">Select Drop Address</option>
                                          @foreach($getRegion as $region)
                                          <option value="{{$region->id}}">
                                            {{\Session::get('language')=='ar'?$region->arabic_name:$region->name}}
                                          </option> 
                                          @endforeach
                                        </select>
                                      </div>                      
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group form-group-width w-100">
                                        <label for="email">Select Your City</label>
                                        <select name="destination_sub_region_id" style="border-radius: 9px;width: 100%;height: 59px;" id="destination_sub_region_id" class="drop_sub_region selectpicker input-vehicle" data-live-search="true" data-container="body">
                                          <option value="" selected="">Select Your City</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group form-group-width w-100">
                                        <label for="email">Enter Drop Address</label>
                                        <input autocomplete="off" type="hidden" id="destination_lat" name="destination_lat">
                                        <input autocomplete="off" type="hidden" id="destination_long" name="destination_long">
                                        <input autocomplete="off" type="text" readonly name="destination_address"  class="form-control input-dash-log" value="{{old('destination_address')}}" onclick="destination()" id="destination_address" placeholder="Enter Pickup Location(Optional)">
                                      </div>                      
                                    </div>
                                    <!-- <div class="col-12">
                                      <div class="form-group form-group-width w-100">                    
                                        <textarea class="form-control input-dash-log" id="requirements" name="requirements" placeholder="{{__('web.helps_with_requirements_such_as_winch_wire_cover_etc')}}" onkeyup="countChars(this)"></textarea>

                                        <div class="position-relative"><label id="charNums" class="description_count">500</label></div>

                                      </div>                      
                                    </div> -->
                                  </div>
                                </div>  
                                <div class="address_box receiver_address_box">
                                  <div class="receiver_wrap receiverwrapDiv">                 

                                  </div>

                                </div>
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
                            <div class="card-footer">
                                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                            </div>
                        </form>
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




<div class="modal fade" id="destinationReceiver_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress1" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers1"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress2" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers2"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress3" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers3"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress4" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers4"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress5" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers5"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress6" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers6"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress7" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers7"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress8" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers8"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress9" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers9"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_10" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress10" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers10"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
<div class="modal fade" id="destinationReceiver_11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content content_modal">
      <input id="searchmapsdestinationaddress11" class="search-location" type="text" placeholder="Entar a Location">
      <div class="modal-header header_modal"> 
        <div style="width: 800px; height: 400px;" id="mapsdestinationReceivers11"></div>
      </div>
      <button type="button" class="btn close_btn"  data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
  </div>
</div>
@endsection

@section('css')
@stop

@section('js')
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script>
  $(".chosen-select").chosen();
</script> 

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
  function appendHtml(number_vehicle,same_receiver){

    $('.receiverwrapDiv').html('');   
    if (same_receiver=='no') { 

      $.ajax({
        url: "{{ route('job.receiver_wrap') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          number_vehicle: number_vehicle
        },

        success: function(response) { 

          console.log(response);

          $('.receiverwrapDiv').html(response);                            
        }
      }); 
    }


  }


$(document).on("change", "select[name*=same_receiver]", function() {

      var same_receiver = this.value; 

      var number_vehicle = $('#number_of_vehicle').val(); 


      $(".receiver_address_box").hide();

      if(same_receiver=='no'){
        $(".receiver_address_box").show();
      }
       

      appendHtml(number_vehicle,same_receiver);



    });


$(document).on("change", "select[name*=destination_region_id]", function() {

      var region_id = this.value;

      $.ajax({
        url: "{{ route('job.sub-regions') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          region_id: region_id
        },

        success: function(response) { 

          $('.drop_sub_region').html(response);                         
        }
      });
    }); 

$(document).on("change", "select[name*=pick_up_region_id]", function() {

      var dataId =$(this).attr("id"); 

      var region_id = this.value;

      $.ajax({
        url: "{{ route('job.sub-regions') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          region_id: region_id
        },

        success: function(response) { 
          $('.sub_region').html(response);                         

        }
      });
    });

$(document).on("change", "select[name*=destinations_region_id]", function() {

      var region_id = this.value;

      var dataId =$(this).data("id"); 



      $.ajax({
        url: "{{ route('job.sub-regions') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          region_id: region_id
        },

        success: function(response) { 

          $('.receiver_sub_regio'+dataId).html(response);                             
        }
      });
    });

$(document).on("change", "select[name*=number_of_vehicle]", function() {

      var number_vehicle = this.value;

      if (number_vehicle==1) { 

        var option ='<option value="yes">Yes</option>';
        document.getElementById('same_receiver').disabled = true;

        
      }else{
        var option = '<option value="" selected>Same Receiver?</option><option value="yes" >Yes</option><option value="no" >No </option>';
        document.getElementById('same_receiver').disabled = false;
      }
      $('.same_receiver').html(option);


      var same_receiver = $('#same_receiver').val(); 

      appendHtml(number_vehicle,same_receiver);


    });
 
 $(document).on("change", "select[name*=product_id]", function() {

      var product_id = this.value; 

      $("#other").hide();

      $("#others").removeAttr('name');

      if (product_id==12) {
        $("#other").show();        
        $('#others').attr('name', 'other');
      }
    });
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

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo env('GOOGLE_MAP_KEY'); ?>&callback=initMap" async defer></script>
 
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


    receiver1 = new google.maps.Map(document.getElementById('mapsdestinationReceivers1'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput1 = document.getElementById('searchmapsdestinationaddress1');
    getmap(receiver1,receiverInput1);

    receiver1.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver1(event.latLng);       

    });
    receiver2 = new google.maps.Map(document.getElementById('mapsdestinationReceivers2'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput2 = document.getElementById('searchmapsdestinationaddress2');
    getmap(receiver2,receiverInput2);
    receiver2.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver2(event.latLng);       

    });
    receiver3 = new google.maps.Map(document.getElementById('mapsdestinationReceivers3'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput3 = document.getElementById('searchmapsdestinationaddress3');
    getmap(receiver3,receiverInput3);
    receiver3.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver3(event.latLng);       

    });
    receiver4 = new google.maps.Map(document.getElementById('mapsdestinationReceivers4'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput4 = document.getElementById('searchmapsdestinationaddress4');
    getmap(receiver4,receiverInput4);

    receiver4.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver4(event.latLng);       

    });
    receiver5 = new google.maps.Map(document.getElementById('mapsdestinationReceivers5'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput5 = document.getElementById('searchmapsdestinationaddress5');
    getmap(receiver5,receiverInput5);
    receiver5.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver5(event.latLng);       

    });
    receiver6 = new google.maps.Map(document.getElementById('mapsdestinationReceivers6'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput6 = document.getElementById('searchmapsdestinationaddress6');
    getmap(receiver6,receiverInput6);
    receiver6.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver6(event.latLng);       

    });
    receiver7 = new google.maps.Map(document.getElementById('mapsdestinationReceivers7'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput7 = document.getElementById('searchmapsdestinationaddress7');
    getmap(receiver7,receiverInput7);
    receiver7.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver7(event.latLng);       

    });
    receiver8 = new google.maps.Map(document.getElementById('mapsdestinationReceivers8'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput8 = document.getElementById('searchmapsdestinationaddress8');
    getmap(receiver8,receiverInput8);
    receiver8.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver8(event.latLng);       

    });


    receiver9 = new google.maps.Map(document.getElementById('mapsdestinationReceivers9'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    }); 

    var receiverInput9 = document.getElementById('searchmapsdestinationaddress9');
    getmap(receiver9,receiverInput9);
    receiver9.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver9(event.latLng);       

    });
    receiver10 = new google.maps.Map(document.getElementById('mapsdestinationReceivers10'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    var receiverInput10 = document.getElementById('searchmapsdestinationaddress10');
    getmap(receiver10,receiverInput10);

    receiver10.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver10(event.latLng);      

    });
    receiver11 = new google.maps.Map(document.getElementById('mapsdestinationReceivers11'), {
      zoom: 5,                        
      center: haightAshbury,
      mapTypeId: 'terrain'
    });

    receiver11.addListener('click', function(event) {
      if (markers.length >= 1) {
        deleteMarkers();
      }
      addMarkerrReceiver11(event.latLng);      

    });
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


  function addMarkerrReceiver1(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver1
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_1").val(marker.getPosition().lat())
        $("#receiver_long_1").val(marker.getPosition().lng())      
        $("#receiver_address_1").val(address)
      }
    });
  }
  function addMarkerrReceiver2(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver2
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_2").val(marker.getPosition().lat())
        $("#receiver_long_2").val(marker.getPosition().lng())      
        $("#receiver_address_2").val(address)
      }
    });
  }
  function addMarkerrReceiver3(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver3
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_3").val(marker.getPosition().lat())
        $("#receiver_long_3").val(marker.getPosition().lng())      
        $("#receiver_address_3").val(address)
      }
    });
  }
  function addMarkerrReceiver4(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver4
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_4").val(marker.getPosition().lat())
        $("#receiver_long_4").val(marker.getPosition().lng())      
        $("#receiver_address_4").val(address)
      }
    });
  }
  function addMarkerrReceiver5(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver5
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_5").val(marker.getPosition().lat())
        $("#receiver_long_5").val(marker.getPosition().lng())      
        $("#receiver_address_5").val(address)
      }
    });
  }
  function addMarkerrReceiver6(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver6
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_6").val(marker.getPosition().lat())
        $("#receiver_long_6").val(marker.getPosition().lng())      
        $("#receiver_address_6").val(address)
      }
    });
  }
  function addMarkerrReceiver7(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver7
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_7").val(marker.getPosition().lat())
        $("#receiver_long_7").val(marker.getPosition().lng())      
        $("#receiver_address_7").val(address)
      }
    });
  }
  function addMarkerrReceiver8(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver8
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_8").val(marker.getPosition().lat())
        $("#receiver_long_8").val(marker.getPosition().lng())      
        $("#receiver_address_8").val(address)
      }
    });
  }
  function addMarkerrReceiver9(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver9
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_9").val(marker.getPosition().lat())
        $("#receiver_long_9").val(marker.getPosition().lng())      
        $("#receiver_address_9").val(address)
      }
    });
  }
  function addMarkerrReceiver10(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver10
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_10").val(marker.getPosition().lat())
        $("#receiver_long_10").val(marker.getPosition().lng())       
        $("#receiver_address_10").val(address)
      }
    });
  }
  function addMarkerrReceiver11(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: receiver11
    });
    markers.push(marker);
    var latlng = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{

      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results);
        var address = (results[0].formatted_address); 

        $("#receiver_lat_11").val(marker.getPosition().lat())
        $("#receiver_long_11").val(marker.getPosition().lng())       
        $("#receiver_address_11").val(address)
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

$('#job-create').validate({
//ignore: [],
    ignore: '',

    debug: false,
    rules: {
      'vehicle_type_id[]': "required",
      user_id: "required",
      transporter_id:"required",
      number_of_vehicle: "required",
      schedule_date    : "required",
      schedule_time    : "required",
    //   total_goods_weight    : "required",
    //   number_of_items    : "required",
    //   product_id    : "required",
    // //  description_of_goods    : "required",
    //   same_receiver    : "required",
    //   receiver_name    : "required",
    //   receiver_number    :{

    //     required:true,
    //     minlength:9,
    //     maxlength:12,
    //     number: true
    //   },

    //   pick_up_region_id    : "required",
    //   pick_up_sub_region_id    : "required",
    //   pick_up_address    : "required",
    //   destination_region_id    : "required",
    //   destination_sub_region_id    : "required",
    //   requirements    : "required",
    //   other    : "required",

    //   "receivers_name[]": {
    //     receivers_name:true
    //   },
    //   "receivers_number[]": {
    //     receivers_number:true
    //   },
    //   "destinations_region_id[]": {
    //     destinations_region_id:true
    //   },
    //   "destinations_sub_region_id[]": {
    //     destinations_sub_region_id:true
    //   },


    },
    messages: {

      'vehicle_type_id[]': { 
        "required":'Please Select Vehcle Type',         
      },
      user_id: { 
        "required":'Please Select User',         
      },
      transporter_id:{
        "required":'Please Select Transporter',
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
      // total_goods_weight: {
      //   "required":'Please Select Total Weight in Ton per Each Vehicle',           
      // },  
      // number_of_items: {
      //   "required":'Please Select Number of Items',           
      // },
      // product_id: {
      //   "required":'Please Select Product Type',           
      // }, 
      // description_of_goods: {
      //   "required":'Please EnterBrief Description of Goods',           
      // },
      // same_receiver: {
      //   "required":'Please Select Same Receiver?',           
      // },
      // receiver_name: {
      //   "required":'Please Enter Name of Receiver of Goods',           
      // }, 
      // receiver_number: {
      //   "required":'Please Enter Receiver Mobile Number',           
      //   "minlength":'Please Enter Mobile Number Should be in between 10',           
      //   "maxlength":'Please Enter Mobile Number Should be in between 10',           

      // },
      // pick_up_region_id: {
      //   "required":'Please Select Your Region',           
      // },
      // pick_up_sub_region_id: {
      //   "required":'Please Select Your City',           
      // },
      // pick_up_address: {
      //   "required":'Please Select Pickup Address',           
      // }, 
      // destination_region_id: {
      //   "required":'Please Select Drop Address',           
      // }, 
      // destination_sub_region_id: {
      //   "required":'Please Select Your City',           
      // },
      // requirements: {
      //   "required":'<?php echo __('web.please_enter_job_description'); ?>',           
      // }, 

    },


  });
</script>
 
@stop
