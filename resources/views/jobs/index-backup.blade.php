@extends('adminlte::page')

@section('title', 'User')

@section('content_header')

@stop

@section('content')

<section class="content">
  <style>

    .drp-calendar.left{
      background-color: white;
    }
  </style>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            

            <div class="card-header alert d-flex justify-content-between align-items-center">
              <h3>{{ __('adminlte::adminlte.jobs') }}</h3>
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
                            
                            <select class="form-control ml-3" name="job_status" id="job_status">
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
                  <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
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
                    <tbody id="tbody">
                      <?php $i=1;?>
                      @foreach($jobs as $key=>$job)
                      @if(@$job->status=='in-progress')
                      <tr class="job_remove{{$job->id}}">
                       <td>{{@$i++}}</td>
                       <td>{{@$job->job_ID}}</td>
                       <td>{{$job->title}}</td>
                       <td>{{date('d/m/Y',strtotime($job->schedule_date))}}</td>
                       <td>{{date('h:i A',strtotime($job->schedule_time))}}</td>
                       <td>{{@$job->PickupRegion->name}} {{@$job->PickupSubRegion->name}}</td>
                       <td>{{@$job->JobReceiver->DestinationRegion->name}} {{@$job->JobReceiver->DestinationSubRegion->name}}</td>
                       
                       <td>{{$job->number_of_vehicle}}</td>
                       <td>{{ucfirst($job->status)}}</td>
                       <td>
                        <a class="action-button" title="View" href="{{route('jobs.show',$job->id)}}"><i class="text-info fa fa-eye"></i></a>
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="deleteJob({{$job->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                      </td> 
                    </tr>
                    @endif
                    @endforeach
                    @foreach($jobs as $key=>$job)
                    @if(@$job->status!='in-progress')
                    <tr class="job_remove{{$job->id}}">
                     <td>{{@$i++}}</td>
                     <td>{{@$job->job_ID}}</td>
                     <td>{{$job->title}}</td>
                     <td>{{date('d/m/Y',strtotime($job->schedule_date))}}</td>
                     <td>{{date('h:i A',strtotime($job->schedule_time))}}</td>
                     <td>{{@$job->PickupRegion->name}} {{@$job->PickupSubRegion->name}}</td>
                     <td>{{@$job->JobReceiver->DestinationRegion->name}} {{@$job->JobReceiver->DestinationSubRegion->name}}</td>
                     
                     <td>{{$job->number_of_vehicle}}</td>
                     <td>{{ucfirst($job->status)}}</td>
                     <td>
                      @can('view_jobs')
                      <a class="action-button" title="View" href="{{route('jobs.show',$job->id)}}"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                      @can('delete_jobs')
                      <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="deleteJob({{$job->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                      @endcan
                    </td> 
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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
        $(".job_remove"+id).remove();
              // if(response.success == 1) {
              //   window.location.reload();
              //   /* console.log("response", response);
              //   obj.parent().parent().remove(); */
              // }
              // else {
              //   console.log("FALSE");
              //   setTimeout(() => {
              //   alert("Something went wrong! Please try again.");
              //   }, 500);
              //   // swal("Error!", "Something went wrong! Please try again.", "error");
              //   // swal("Something went wrong! Please try again.");
              // }
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
   </script>
   <!-- date filter -->

   <!-- filters  -->
   <script type="text/javascript">
    $('body').on('click','.apply-filter',function(){
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-'); 
      var job_status = $('#job_status').val();  
      
      // if(date_range.length==1)
      //   return false;
      $.ajax({
       url: "{{route('filetr.job')}}",
       method: 'post',
       data: {
         date_range: date_range,
         job_status:job_status,
       },
       dataType: "JSON",
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       success: function (response) {
        
         console.log('response');
         console.log(response);
         if(response.status) {
           $('#tbody').html(response.html);    
         }
       }
     });
    });

    $('body').on('click','.reset-button',function(){
     
      $('input[name="date_range"]').val('');
      $('.advance_options_btn').hide();
      var current = $('.current').text();  
      var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 
      $.ajax({
       url: "{{route('reset.job')}}",
       method: 'post',
       data: {
        current:current,
        limit:limit,
        reset : true
      },
      dataType: "JSON",
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     success: function (response) {
      $('#job_status').val('');
      console.log('response');
      console.log(response);
      if(response.status) {
       $('#tbody').html(response.html);    
     }
   }
 });
    });


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
  </script>
  
  <!-- filters  -->
  @stop
