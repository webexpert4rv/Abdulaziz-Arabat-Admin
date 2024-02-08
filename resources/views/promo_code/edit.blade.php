@extends('adminlte::page')

@section('title', 'Edit Promo Code')

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
                <h3>{{ __('adminlte::adminlte.edit_promo_code') }}</h3>
                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              </div>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form id="editPricingForm" method="post", action="{{ route('promocodes.update',$promocode->id) }}">
                  @method('PUT')
                  @csrf
                  <div class="card-body">                
                    <div class="row">
                    <div class="col-12">
                  <div class="form-group">
                    <label for="to_email">{{ __('adminlte::adminlte.to_email') }}<span class="text-danger"> *</span></label>

                   <select   name="user_id" class="form-control user_name ml-2 js-example_user"  id="js-example_user">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}" {{$user->id==$promocode->user_id?'selected':''}}>{{$user->name}}({{$user->booking_count}})</option>
                    @endforeach
                  </select>                    
                  <div class="error user_id_error">  @if($errors->has('name')){{ $errors->last('name') }} @endif</div>
                </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="promo_code">{{ __('adminlte::adminlte.promo_code') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Promo Code" name="promo_code" class="form-control" value=" {{$promocode->promo_code}}" id="promo_code" maxlength="10" >
                          @if($errors->has('promo_code'))
                            <div class="error">{{ $errors->first('promo_code') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="type">{{ __('adminlte::adminlte.type') }}<span class="text-danger"> *</span></label>
                          <select name="type" id="type_value" class="form-control">
                            <option value="0" {{ $promocode->type==0?'selected':''}}>Percentage</option>
                            <option value="1" {{ $promocode->type==1?'selected':''}}>Amount</option>
                          </select>
                          
                          @if($errors->has('type'))
                            <div class="error">{{ $errors->first('type') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="value">{{ __('adminlte::adminlte.value') }}<span class="text-danger"> *</span></label>
                          <span class="value_field"> @if($promocode->type==0)
                          <input type="text" placeholder="Value" name="percentage" class="form-control" value="{{$promocode->value}}" id="percentage" maxlength="100" autocomplete="off">
                          @else
                          <input type="text" placeholder="Value" name="fixed" class="form-control" value="{{$promocode->value}}" id="fixed" maxlength="100" >
                          @endif</span>
                          @if($errors->has('value'))
                            <div class="error">{{ $errors->first('value') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="expiry_date">{{ __('adminlte::adminlte.expiry_date') }}<span class="text-danger"> *</span></label>
                          <input type="text" value="{{date('d/m/Y',strtotime($promocode->expiry_date))}}" placeholder="" name="expiry_date" class="form-control" id="expiry_date" maxlength="100" >
                          @if($errors->has('expiry_date'))
                            <div class="error">{{ $errors->first('expiry_date') }}</div>
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
</section>
@endsection

@section('css')
@stop

@section('js')
 	
			<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
			<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
			</script>
			


  <script>
  	var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
	$('#expiry_date').datepicker({
		calendarWeeks: true,
		todayHighlight: true,
     minDate: today,
    format: "dd/mm/yyyy",
	});
    $(document).ready(function() {
    	
    	jQuery.validator.addMethod("percentage", function (value, element) {
        	
	        if (/^100(\.0{0,2})? *%?$|^\d{1,2}(\.\d{1,2})? *%?$/.test(value)) {
	            return true;
	        } else {
	            return false;
	        }
		    

    }, "Please enter a valid value");
      
     
      $('#editPricingForm').validate({
        ignore: [],
        debug: false,
        rules: {
          promo_code: {
            required: true
          },
          type: {
            required: true
          },
          fixed:{
			required: true,
			digits:true
          },
          percentage: {
            required: true,
            percentage:function(){
 			    return  $("#type_value").val()==0?true:'' ;
            }
          },
          expiry_date: {
            required: true
          },
          
         
       
        },
        messages: {
          promo_code: {
            required: "Promo Code is required",
          },
          type: {
            required: "Type is required",
          },
          fixed:{
			required: "Value is required",
          },
          percentage: {
            required: "Value is required",
          },
          expiry_date: {
            required: "Expiry Date is required",
          },
          
          
        }
      });
    });

$("#type_value").on("change",function(){
	var value=$("#type_value").val();

	if(value==1){
		$("#percentage").remove();
		$(".value_field").html('<input value="{{$promocode->value}}"  type="text" placeholder="Value" name="fixed" class="form-control" id="fixed" maxlength="100" autocomplete="off">');
	}else{
		$("#fixed").remove();
		$(".value_field").html('<input type="text" placeholder="Value" name="percentage" class="form-control" value="{{$promocode->value}}" id="percentage" maxlength="100" autocomplete="off">');
	}
});
  </script>
@stop
