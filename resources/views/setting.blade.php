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
              <h3>{{ __('adminlte::adminlte.setting') }}</h3>
              <!-- <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="editPricingForm" method="post", action="{{ route('setting') }}">
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-6">
                    <div class="form-group">
                      <label for="radius">{{ __('adminlte::adminlte.radius') }} / KM <span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Radius" name="radius" value="{{@$setting->radius}}" class="form-control" id="radius" maxlength="100" >
                      @if($errors->has('radius'))
                      <div class="error">{{ $errors->first('radius') }}</div>
                      @endif
                    </div>
                  </div>  
                   <!--  <div class="col-3">
                      <div class="form-group">
                        <label for="radius">{{ __('adminlte::adminlte.schedule_day_time') }} <span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Schedule day time" name="schedule_day_time" value="{{@$setting->schedule_day_time}}" class="form-control" id="schedule_day_time" maxlength="10" >
                        @if($errors->has('radius'))
                          <div class="error">{{ $errors->first('radius') }}</div>
                        @endif
                      </div>
                    </div> -->

                    <div class="col-3">
                      <div class="form-group">
                    <label for="radius">{{ __('adminlte::adminlte.schedule_day_time') }} <span class="text-danger"> *</span></label> 
                        <select name="schedule_day_time" class="form-control" id="schedule_day_time">
                          <option value="">Select Schedule day time</option>
                          @for ($i=1; $i <=12 ; $i++)                             
                          <option value="hour_{{$i}}" @if('hour_'.$i==$setting->schedule_day_time) selected @endif  >{{$i}} hour</option>
                          @endfor

                           @for ($d=1; $d <=5 ; $d++)                             
                          <option value="d_{{$d}}"  @if('d_'.$d==$setting->schedule_day_time) selected @endif>{{$d}} Day</option>
                          @endfor

                        </select>

                        <div id ="email_error" class="error"></div>
                        @if($errors->has('schedule_day_time'))
                        <div class="error">{{ $errors->last('schedule_day_time') }}</div>
                        @endif
                      </div>
                    </div>


                 <!--    <div class="col-3">
                      <div class="form-group">
                        <label for="radius">{{ __('adminlte::adminlte.same_day_time') }}<span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Same day time" name="same_day_time" value="{{@$setting->same_day_time}}" class="form-control" id="same_day_time" maxlength="10" >
                        @if($errors->has('radius'))
                        <div class="error">{{ $errors->first('radius') }}</div>
                        @endif
                      </div>
                    </div> -->

                    <div class="col-3">
                      <div class="form-group">
                    <label for="radius">{{ __('adminlte::adminlte.same_day_time') }} <span class="text-danger"> *</span></label> 
                        <select name="same_day_time" class="form-control" id="same_day_time">
                          <option value="">Same day time</option>
                          
                          @for ($m=15; $m <=60 ; $m+= 15)                             
                          <option value="mit_{{$m}}" @if('mit_'.$m==$setting->same_day_time) selected @endif>{{$m}} minute</option>
                          @endfor

                           @for ($h=1; $h <=5 ; $h++)                             
                          <option value="hour_{{$h}}" @if('hour_'.$h==$setting->same_day_time) selected @endif>{{$h}} hour</option>
                          @endfor

                          

                        </select>

                        <div id ="email_error" class="error"></div>
                        @if($errors->has('same_day_time'))
                        <div class="error">{{ $errors->last('same_day_time') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label for="radius">Show Promotion on Website<span class="text-danger"> *</span></label> 
                        <select name="show_promotion" class="form-control" id="show_promotion">
                          <option value="1" <?php if($setting->show_promotion==1) {echo 'selected';} ?>>Yes</option>
                          <option value="2" <?php if(!empty($setting)){ if($setting->show_promotion==2) {echo 'selected';}}else{echo 'selected';} ?>>No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label for="radius">Show Referel on Website<span class="text-danger"> *</span></label> 
                        <select name="show_referel" class="form-control" id="show_referel">
                          <option value="1" <?php if($setting->show_referel==1) {echo 'selected';} ?>>Yes</option>
                          <option value="2" <?php if(!empty($setting)){ if($setting->show_referel==2) {echo 'selected';}}else{echo 'selected';} ?>>No</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label for="radius">Driver invited Limit for RFQ<span class="text-danger"> *</span></label> 
                        <input type="number" name="rfq_limit_for_driver" value="{{@$setting->rfq_limit_for_driver}}" class="form-control" id="rfq_limit_for_driver">
                          
                      </div>
                    </div>

                    <!-- <div class="col-3">
                      <div class="form-group">
                        <label for="radius">User accept limit for RFQ<span class="text-danger"> *</span></label> 
                        <input type="number" name="rfq_limit_for_user" value="{{@$setting->rfq_limit_for_user}}" class="form-control" id="rfq_limit_for_user">
                           
                      </div>
                    </div> -->

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


      $('#editPricingForm').validate({
        ignore: [],
        debug: false,
        rules: {
          radius: {
            required: true,
            number:true,
            max:100,
          }, 
          schedule_day_time: {
            required: true
          }, 
          same_day_time: {
            required: true
          },
          


        },
        messages: {
          radius: {
            required: "The Radius / KM is required",
          }, 
          schedule_day_time: {
            required: "The Schedule day time is required",
          }, 
          same_day_time: {
            required: "The Same day time is required",
          },
          
          
        }
      });
    });

  </script>
  @stop
