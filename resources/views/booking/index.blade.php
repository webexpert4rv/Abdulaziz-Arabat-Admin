@extends('adminlte::page')

@section('title', 'Booking')

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
                            <h3>{{ __('adminlte::adminlte.booking') }}</h3>
                            <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                        </div>
                        <form action="{{route('export-booking')}}" method="get" id="filterForm">
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
                                                        <select   name="status" class="form-control  booking_status ml-2">
                                                            <option value="">Booking status</option>
                                                            <option value="not_started_yet">Not started yet</option>
                                                            <option value="started">Started</option>
                                                            <option value="on_the_way">On the way</option>
                                                            <option value="service_completed">Service completed</option>
                                                            <option value="cancelled">Cancelled</option> 
                                                        </select> 
                                                        <select   name="User_status" class="form-control user_name ml-2 js-example_user" id="js-example_user">
                                                            <option value="">Select User</option>
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                            @endforeach
                                                        </select> 
                                                        <select   name="driver_status" class="form-control driver_name ml-2 js-example">
                                                            <option value="">Select Drivers</option>
                                                            @foreach($drivers as $driver)
                                                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                                                            @endforeach
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
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table style="width:100%"  class="table table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th >Sr.No.</th>
                                                <th>{{ __('adminlte::adminlte.booking_id') }}</th>
                                                <th>{{ __('adminlte::adminlte.job_id') }}</th>
                                                <th>{{ __('adminlte::adminlte.booking_fee') }}(SAR)</th>
                                                <th>{{ __('adminlte::adminlte.user_name')}}</th>
                                                <th>{{ __('adminlte::adminlte.driver_name')}}</th>
                                                <th>{{ __('adminlte::adminlte.transporter_name')}}</th>
                                                <th>{{ __('adminlte::adminlte.payment_status')}}</th>
                                                <th>{{ __('adminlte::adminlte.booking_status')}}</th>
                                                <th>{{ __('adminlte::adminlte.booked_on')}}</th>
                                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">


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
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(function () {
    var myDataTable = $('.datatable').DataTable({        
     serverSide: true,
     ajax: {
      url: "{{ route('booking.index') }}",
      data: function (d) {

       d.date_range = $('input[name="date_range"]').val().split('-');        
       d.booking_status = $('.booking_status').val();
       d.driver_name    = $('.driver_name').val();
       d.user_name     =  $('.user_name').val();
   }

},
order:[[0,"DESC"]],
columns: [
    {data: 'id', name: 'id'},
    {data: 'book_id', name: 'book_id'},
    {data: 'job_ID', name: 'job_ID'},
    {data: 'booking_fee', name: 'booking_fee'}, 
    {data: 'user_name', name: 'user_name'},
    {data: 'driver_name', name: 'driver_name'},
    {data: 'transporter_name', name: 'transporter_name'},
    {data: 'payment_status', name: 'payment_status'},
    {data: 'status', name: 'status'},
    {data: 'booked_on', name: 'booked_on'},
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

<script>
  $(document).ready(function() {
    $('.js-example_user').select2();
    $('.js-example').select2();

});
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
  /*  $('body').on('click','.apply-filter',function(){
        console.log('filter now');
        var date_range = $('input[name="date_range"]').val().split('-');  
        
        booking_status = $('.booking_status').val();
        driver_name    = $('.driver_name').val();
        user_name     =  $('.user_name').val();


       // if(date_range.length==1)
        //    return false;
        $.ajax({
            url: "{{route('filetr.booking')}}",
            method: 'post',
            data: {
                date_range: date_range,
                booking_status: booking_status,
                driver_name:driver_name,
                user_name:user_name,
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
*/

   // filterForm

    $('body').on('click','.reset-button',function(){

       $(".js-example_user").select2({
        placeholder: "Select User",
        initSelection: function(element, callback) {                   
        }
    });

       $(".js-example").select2({
        placeholder: "Select Drivers",
        initSelection: function(element, callback) {                   
        }
    });




       var current = $('.current').text();  
       var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 

       $('input[name="date_range"]').val('');
       $('.booking_status').val('');
       $('.driver_name').val('');
       $('.user_name').val('');
       $('.advance_options_btn').hide();

       $('.booking_status').val('');
            $('.driver_name').val('');
            $('.user_name').val('');

       /*$.ajax({
        url: "{{route('reset.booking')}}",
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
            $('.booking_status').val('');
            $('.driver_name').val('');
            $('.user_name').val('');
            
             //  $('.select2-selection__rendered').text('Select Drivers');
            //   $('.select2-selection__rendered').text('Select User');

            console.log('response');
            console.log(response);
            if(response.status) {
                $('#tbody').html(response.html);    
            }
        }
    });*/
   });


    $('.xlsbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('export-booking')}}");
    });
    $('.csvbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('csv-booking')}}");
    });
    $('.pdfbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('pdf-booking')}}");
    });
</script>
<!-- filters  -->

@stop
