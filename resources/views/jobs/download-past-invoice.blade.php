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

</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Download Past Invoice</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
                <div class="row">
                                   
                              
                                <div class="col-md-6">
                                  <form method="post" action="{{ route('download-user-past-invoice') }}" enctype="multipart/form-data"> 
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Select Job Id</label> 
                                      <select required name="job_id" class="form-control input-dash-log">
                                        <option value="" selected disabled>select</option>
                                        @foreach($getJobsManually as $getJobsManuallys)
                                    <option value="{{$getJobsManuallys->id}}" >{{$getJobsManuallys->job_ID}}</option> 
                                        @endforeach
                                      </select>
                                    </div>  
                                    <div class="form-group form-group-width w-100">
                                      <label for="email">Select Type</label> 
                                      <select name="type" class="form-control input-dash-log">
                                        <option value="user">User</option>
                                        <option value="transporter">Transporter</option>
                                      </select>
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
