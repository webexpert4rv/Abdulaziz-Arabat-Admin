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
  
</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Expired Pending Quotes</h3> 
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
             

            
            <form id="job-create" method="post" action="{{route('job.expiredJobSent')}}" enctype="multipart/form-data">
                                @csrf
                                 
                                <div class="card-body">  
                                             
                                    <div class="row">
                                      <div class="col-6">
                                            <div class="form-group">
                                                <label for="email">Select Job</label>
                                                <select data-placeholder="Select Job" required name="job_id" id="job_id" style="border-radius: 9px;width: 100%;height: 59px;" class="  selectpicker input-vehicle" data-live-search="true" data-container="body"> 
                                                  <option value="" selected="">Select Job</option>
                                                @foreach($expiredJobs as $expiredJob)
                                                <option value="{{$expiredJob->id}}">{{$expiredJob->job_ID}}</option> 
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
                                                <select data-placeholder="Select Transporter" multiple required name="transporter_id[]" id="transporter_id" style="border-radius: 9px;width: 100%;height: 59px;" class="chosen-select selectpicker input-vehicle" data-live-search="true" data-container="body"> 
                                                   
                                                  

                                              </select>
                                                <div id ="email_error" class="error"></div>
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->last('email') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                         
                                          
                                    </div>
                                    
                                    <div class="card-footer">
                                    <button type="submit" id="createJob" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                                    </div>
                                    <br><br>
                                  
                                
                                    
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
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script>
  $(".chosen-select").chosen();
</script> 
<script> 

$(document).on("change", "select[name*=job_id]", function() {
  var job_id=this.value;
  $.ajax({
        url: "{{ route('get-transporter-list') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          job_id: job_id
        },

        success: function(response) { 
          console.log(response);

          $('#transporter_id').html(response);
          $("#transporter_id").trigger("chosen:updated");
          // console.log(response.phone_number);                         
        }
      });

});
// var validate=$('#job-create').validate({
// //ignore: [],
//     ignore: '',

//     debug: false,
//     rules: {
//       job_id: "required", 
//       transporter_id:"required",
    

//     },
//     messages: {

//       job_id: { 
//         "required":'Please Select Job',         
//       },
//       transporter_id:{
//         "required":'Please Select Transporter',
//       },
      
 

//     },
//     submitHandler: function(form) {
 
//       $.ajax({
//             type: "POST",
//             url: "{{ route('job.expiredJobSent') }}",
//             data: new FormData(form),
//             contentType: false,
//             processData: false,
//             success: function(response) {
//               // window.location.href = "create-job3?job_id="+response+""
              
//             }
//         });
//         }


//   });


 
</script>
 
@stop
