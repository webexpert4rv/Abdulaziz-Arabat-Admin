@extends('adminlte::page')

@section('title', 'Transporter')

@section('content_header')
@stop

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 

<link rel="stylesheet" href="https://arabat-web.rvtechnologies.in/css/style.css">  
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">

            <div class="card-header alert d-flex justify-content-between align-items-center">
              <h3>{{ __('adminlte::adminlte.jobs') }}</h3>
              <a href="manually-job" style="margin-right:20px;">Manually Job List</a>
              <a href="create-job2" style="margin-right:20px;">Create New Job</a>
              <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
              
            </div> 
            <form action="{{route('export-job')}}" method="get" id="filterForm">
              @csrf
              <div class="text-right mb-3">
                <div class="advance-options" style="display: none;">
                  <div class="title">
                    <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                  </div>
                  <div class="left_option">
                    <div class="left_inner">
                      <h6>Select Date Range(Created)</h6>
                      <div class="date-picker-new">
                        <div class="apply_reset_btn">
                          <div class="button_input_wrap">
                            <i class="fas fa-calendar-alt mr-2"></i><input type="text" name="date_range" class="form-control date_range" autocomplete="off">
                            
                            <select class="form-control ml-3 job_status" name="job_status" id="job_status">
                              <option value="">Select status</option>
                              <option value="in-progress">In Progress</option>
                              <option value="pending">Pending</option>
                              <option value="completed">Completed</option>
                              <option value="cancelled">cancelled</option>
                              
                            </select>
                            
                            
                          </div>
                          <button type="button" class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                          <button type="button" class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                        </div>
                      </div>
                    </div>
                    <div class="button_input_wrap">  
                      <button type="submit" class="btn btn-primary float-left xlsbtn" href=""><i class="fas fa-download mr-2"></i>XLSX</button>
                      <button type="submit" class="btn btn-primary float-left ml-2 csvbtn" href=""><i class="fas fa-download mr-2"></i>CSV</button> 
                      <button type="submit" class="btn btn-primary float-left ml-2 pdfbtn" href=""><i class="fas fa-download mr-2"></i>PDF</button> 
                    </div> 
                    
                  </div>
                </div>
              </div> 
            </form>
            <div class="card-body">
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
              @endif
              <div class="table-responsive">

               <table style="width:100%"  class="table table-bordered table-hover datatable">
                 <thead>
                  <tr >
                    <th >Sr.No.</th>
                    <th>{{ __('adminlte::adminlte.job_id') }}</th>
                    <th>{{ __('adminlte::adminlte.product_type') }}</th>
                    <th>{{ __('adminlte::adminlte.schedule_date') }}</th>
                    <th>{{ __('adminlte::adminlte.schedule_time') }}</th>
                    <th>{{__('adminlte::adminlte.pick_up_address') }}</th>
                    <th>{{__('adminlte::adminlte.destination_address') }}</th>
                    <th>{{__('adminlte::adminlte.number_of_vehicle') }}</th>
                    <th>{{__('adminlte::adminlte.status') }}</th> 
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>

              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top:25%;">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="job-create" method="post" action="{{route('job.expiredJobSent')}}" enctype="multipart/form-data">
        <input type="hidden" name="job_id" id="job_id">
      <div class="modal-body mx-3">
        <div class="md-form mb-5"> 
          <select data-placeholder="Select Transporter" multiple required name="transporter_id[]" id="transporter_id" style="border-radius: 9px;width: 100%;height: 59px;" class="chosen-select selectpicker input-vehicle" data-live-search="true" data-container="body"> 
            <option value="" selected="">Select Transporter</option>
        </select>
        </div>

        

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="createJob" class="btn btn-primary saveForm">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
  .loader_css{
    position: absolute;
    left: 35%;
  }
  .approve_css{
    padding: 15px 10px !important;
    position: relative;
  }
</style>
<style>
  body{
    padding:0px !important;
  }
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.swal2-popup.swal2-modal.swal2-show {
    width: 30%;
}
</style>
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
  $(function () {
    var myDataTable = $('.datatable').DataTable({        
     serverSide: true,
     ajax: {
      url: "{{ route('jobs.index') }}",
      data: function (d) {

       d.date_range = $('input[name="date_range"]').val().split('-'); 
       d.job_status =  $('.job_status').val();
     }
   },
   order:[[0,"DESC"]],
   columns: [
    {data: 'id', name: 'id'},
    {data: 'job_ID', name: 'job_ID'},
    {data: 'title', name: 'title'},
    {data: 'schedule_date', name: 'schedule_date'}, 
    {data: 'schedule_time', name: 'schedule_time'}, 
    {data: 'pick_up_address', name: 'pick_up_address'}, 
    {data: 'destination_address', name: 'destination_address'}, 
    {data: 'number_of_vehicle', name: 'number_of_vehicle'}, 
    
    {data: 'status', name: 'status'}, 
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
 });

    $('body').on('click','.apply-filter',function(){

      myDataTable.draw();
    });
    $('body').on('click','.reset-button',function(){
      $('input[name="date_range"]').val('');

      myDataTable.draw();
    });
    
  });

  


</script>


<script type="text/javascript">

 function deleteJob(id){

  swal({
    title: "Are you sure?",
    text: "Are you sure you want to delete the job?",
    type: "warning",
    showCancelButton: true,
  }, function(willDelete) {
    if (willDelete) {

      $.ajax({
        url: "jobs/"+id,
        type: 'DELETE',
        data: {
         "id"      :   id,
         
       },
       dataType: "JSON",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      success: function(response) {
        console.log("Response", response);
        if(response.success == 1) {

         $('.datatable').DataTable().draw();

       }
       else {
        console.log("FALSE");
        setTimeout(() => {
          alert("Something went wrong! Please try again.");
        }, 500);

      }
    }
  });
    } 
  });
}

 function cancelJob(id){

  swal({
    title: "Are you sure?",
    text: "Are you sure you want to cancel the job?",
    type: "warning",
    showCancelButton: true,
  }, function(willDelete) {
    if (willDelete) {

      $.ajax({
        url: "{{route('cancel-job')}}",
        type: 'GET',
        data: {
         "id"      :   id,
         
       },
       dataType: "JSON",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      success: function(response) {
        console.log("Response", response);
        if(response.success == 1) {

         $('.datatable').DataTable().draw();

       }
       else {
        console.log("FALSE");
        setTimeout(() => {
          alert("Something went wrong! Please try again.");
        }, 500);

      }
    }
  });
    } 
  });
}


</script>

<!-- date filter -->
<script type="text/javascript">
  $(document).ready(function() {

   var today = new Date();
   var dd = String(today.getDate()).padStart(2, '0');
       var mm = String(today.getMonth()+1).padStart(2, '0'); //January is 0!
       var yyyy = today.getFullYear();

       today =  mm+ '/' + dd + '/' + yyyy;
       
       $('input[name="date_range"]').daterangepicker({
         "startDate": today,
         "endDate": today,
         "autoApply": true,
         autoUpdateInput: false,
         locale: {
           cancelLabel: 'Clear',
           format: 'MM/DD/YYYY'
         }
       });

       $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
         $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
       });

       $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
         $(this).val('');
       });
       $('body').on('click','.show-advance-options',function(e){
         e.preventDefault();
         $('.advance-options').slideToggle();
       });


     });


  $('body').on('click','.reset-button',function(){
     
      $('input[name="date_range"]').val('');
      $('.job_status').val('');
      $('.advance_options_btn').hide();
      var current = $('.current').text();  
      var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 
       
    });
   </script>
   <!-- date filter -->



   <!-- filters  -->
   <script type="text/javascript">



    $('.xlsbtn').click(function(){
      $('input').attr('name', 'search');
      $('.date_range').attr('name', 'date_range');
      $("#filterForm").attr("action", "{{route('export-job')}}");
    });
    $('.csvbtn').click(function(){
      $('input').attr('name', 'search');
      $('.date_range').attr('name', 'date_range');
      $("#filterForm").attr("action", "{{route('csv-job')}}");
    });
    $('.pdfbtn').click(function(){
      $('input').attr('name', 'search');
      $('.date_range').attr('name', 'date_range');
      $("#filterForm").attr("action", "{{route('pdf-job')}}");
    });

$(document).on('click', '.sendJobTransporterPopup', function() { 
  var job_id= this.value;
  console.log(job_id);


  $.ajax({
        url: "{{ route('get-transporter-list') }}",
        type: 'post',

        data: {
          "_token": "{{ csrf_token() }}",
          job_id: job_id
        },

        success: function(response) { 
          console.log(response);
          $('#job_id').val(job_id);
          $('#transporter_id').html(response); 
          $("#transporter_id").trigger("chosen:updated");
          // console.log(response.phone_number);                         
        }
      });
 
    $('#modalLoginForm').modal('show');



});

$(document).on('click', '.saveForm', function() { 
   var transporter_id = $('#transporter_id').val();
   if(transporter_id==null){
    alert('Please select atleast one Transporter');
    }
});
  </script>
  <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script>
  $(".chosen-select").chosen();
</script> 
  <!-- filters  -->
  @stop
