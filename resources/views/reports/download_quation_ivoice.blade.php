@extends('adminlte::page')

@section('title', 'Download Quations and Invoices')

@section('content_header')
@stop

@section('content')

  <link rel="stylesheet" href="https://server3.rvtechnologies.in/Arabat/web/public/css/style.css"> 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 

<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom CSS --> 
 <style>
 

body {
    padding: 0px 0 0 !important;
}
 </style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Download Quations and Invoices</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
             
                              
                                <div class="card-body">  
                                             
                                    <div class="row">
                                      <div class="col-6">
                                        <form method="post" action="{{ route('download-user-quation',['type'=>'user']) }}" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="email">Select User</label>
                                                <select required data-placeholder="Select User" name="user_id" id="user_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
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
                                            <div>
                                                    <button type="submit" name="action" value="userQuations" style="background-color: #ffcd00;border: 1px solid #ffcd00;" class="btn btn-primary">Download Quations</button>
                                                    <button type="submit" name="action" value="userInvoice" style="background-color: #ffcd00;border: 1px solid #ffcd00;" class="btn btn-primary">Download Invoices</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <form method="post" action="{{ route('download-transporter-quation',['type'=>'transporter']) }}" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="email">Select Transporter</label>
                                                <select required data-placeholder="Select Transporter" name="transporter_id" id="transporter_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
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
                                             <div>
                                                    <button type="submit"  name="action" value="transporterQuations" style="background-color: #ffcd00;border: 1px solid #ffcd00;" class="btn btn-primary">Download Quations</button>
                                                    <button type="submit" name="action" value="transporterInvoice"  style="background-color: #ffcd00;border: 1px solid #ffcd00;" class="btn btn-primary">Download Invoices</button>
                                                </div>
                                            </form>
                                        </div>
                                       
                                        

                                        
                                        
                                         
                                    </div>
                                 
                                    
                            </div>
                             
          </div>
        </div>
      </div>
  </div>
</div>
 
@endsection

@section('css')
@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<script>
$(document).on("click", "#download_user_quation", function() {
    var user_id=$('#user_id :selected').val();
    $(this).attr("target", "_blank");
        if(user_id=='')
        {
        alert('Please select User'); 
        return false;
        }else{
            $.ajax({
                url: "{{ route('download-user-quation') }}",
                type: 'post',
                data: {
                  "_token": "{{ csrf_token() }}",
                  user_id: user_id,
                  type:"user"
                },

                success: function(response) { 

                  console.log(response);                           
                }
              }); 
        }
});
$(document).on("click", "#download_user_invoice", function() {
    var user_id=$('#user_id :selected').val();
        if(user_id=='')
        {
        alert('Please select User');
        return false;
        }
});
$(document).on("click", "#download_transporter_quation", function() {
    var transporter_id=$('#transporter_id :selected').val();
        if(transporter_id=='')
        {
        alert('Please select Transporter');
        return false;
        }else{
           
        }
});
$(document).on("click", "#download_transporter_invoice", function() {
    var transporter_id=$('#transporter_id :selected').val();
        if(transporter_id=='')
        {
        alert('Please select Transporter');
        return false;
        }
});
</script>
 
@stop
