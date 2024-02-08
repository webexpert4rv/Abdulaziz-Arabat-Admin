@if($number_vehicle)


@for ($i = 1; $i <= $number_vehicle; $i++)
<h3>Receiver No  {{$i}}</h3><br>
<div class="row">

	<div class="col-md-6">
		<div class="form-group form-group-width w-100">
			<label for="email">Name of Receiver of Goods</label>
			<input type="text" class="form-control input-dash-log dash_log_name" id="receivers_name{{$i-1}}" name="receivers_name[]" placeholder="Name of Receiver of Goods">
		</div>											
	</div>	 								 
	<div class="col-md-6">
		<div class="form-group form-group-width w-100">
			<label for="email">Receiver's Contact Number</label>
			<input type="number" class="form-control input-dash-log dash_log_reciever" id="receivers_number{{$i-1}}" name="receivers_number[]" placeholder="Receiver's Contact Number">
		</div>												
	</div>
	<div class="col-md-6">
		<div class="form-group form-group-width w-100">
			<select name="destinations_region_id[]" style="border-radius: 9px;width: 100%;height: 59px;" id="destinations_region_id{{$i-1}}" data-id='{{$i}}'  class="selectpicker selectpicker-region input-vehicle" data-live-search="true" data-container="body">
				<option value="" selected="">Select Destination Region</option>
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
			<select name="destinations_sub_region_id[]" style="border-radius: 9px;width: 100%;height: 59px;" id="destinations_sub_region_id{{$i-1}}" class="receiver_sub_regio{{$i}} selectpicker selectpicker-destination input-vehicle" data-live-search="true" data-container="body">
				<option value="" selected="">Select Destination City</option>
			</select>
		</div>													
	</div>
	<div class="col-md-12">
		<div class="form-group form-group-width w-100">
			<label for="email">Receiver Address</label>
			<input type="hidden" id="receiver_lat_{{$i}}" name="receiver_lat[]" value="">
			<input type="hidden" id="receiver_long_{{$i}}" name="receiver_long[]" value="">
			<input type="text" readonly onclick="destinationReceiver({{$i}})" name="receiver_address[]"   class="form-control input-dash-log dash_log_address" value="{{old('receiver_address')}}" id="receiver_address_{{$i}}" placeholder="Receiver Address">
		</div>												
	</div>
</div>


 



@endfor

 


@endif
