@extends('adminlte::page')

@section('title', 'Edit Price')

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
                <h3>{{ __('adminlte::adminlte.edit_pricing') }}</h3>
                <!-- <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
              </div>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form id="editPricingForm" method="post", action="{{ route('pricing.index') }}">
                  @csrf
                  <div class="card-body">                
                    <div class="row">

                    <!--  <div class="col-6">
                        <div class="form-group">
                          <label for="type">{{ __('adminlte::adminlte.type') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Type" name="type" class="form-control" id="type" value="" maxlength="100" readonly>
                          @if($errors->has('type'))
                            <div class="error">{{ $errors->first('type') }}</div>
                          @endif
                        </div>
                      </div> -->

                    <div class="col-6">
                      <div class="form-group">
                        <label for="commission">{{ __('adminlte::adminlte.commision') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="commission" class="form-control" id="commission" placeholder="Commission on Transporter" value="{{@$pricing->commission}}" maxlength="100">
                      
                      
                          <div class="error"> @if($errors->has('commission')){{ $errors->last('commission') }} @endif</div>
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="base_fee">{{ __('adminlte::adminlte.online_payment_discount') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="online_payment_discount" class="form-control" value="{{@$pricing->online_payment_discount}}" id="online_payment_discount" placeholder="Commission on User" maxlength="100">
                      
                      
                          <div class="error">  @if($errors->has('online_payment_discount')){{ $errors->last('online_payment_discount') }}  @endif</div>
                      
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="tax">{{ __('adminlte::adminlte.tax') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="tax" class="form-control" id="tax" value="{{@$pricing->tax}}" placeholder="Tax Rate" maxlength="100">
                      
                          <div class="error">@if($errors->has('tax')){{ $errors->last('tax') }}  @endif</div>
                      
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="tax">{{ __('adminlte::adminlte.penality') }}(%)<span class="text-danger"> *</span></label>
                        <input type="text" name="penality" class="form-control" id="penality" value="{{@$pricing->penality}}" placeholder="Penality" maxlength="100">
                      
                          <div class="error">@if($errors->has('penality')){{ $errors->last('penality') }}  @endif</div>
                      
                      </div>
                    </div>
                    
                    <div class="col-6">
                      <div class="form-group">
                        <label for="base_fee">{{ __('adminlte::adminlte.base_fee') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="base_fee" class="form-control" value="{{@$pricing->base_fee}}" id="base_fee" placeholder="Base Fee" maxlength="100">
                      
                      
                          <div class="error">  @if($errors->has('base_fee')){{ $errors->last('base_fee') }}  @endif</div>
                      
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
  <script>
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
          commission: {
            required: true,
            percentage:true
          },
          tax: {
            required: true,
            percentage:true,
          },
          penality:{
            required: true,
            percentage:true,
          },
          base_fee: {
            required: true,
            
          },
         
       
        },
        messages: {
          commission: {
            required: "Commision is required",
          },
          tax: {
            required: "Tax is required",
            
          },
          penality: {
            required: "Penality is required",
            
          },
          base_fee: {
            required: "Base Fee is required",
            
          },
          
          
        }
      });
    });

  </script>
@stop
