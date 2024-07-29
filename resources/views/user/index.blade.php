@extends('adminlte::page')

@section('title', 'User')

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
                            <h3>{{ __('adminlte::adminlte.users') }}</h3>
                            <a href="create-user" style="margin-right:20px;">Add New User</a>
                            <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                        </div> 
                        <form action="{{route('export-user',['type'=>'user'])}}" method="get" id="filterForm">                   
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
                                          <th >Sr.No.</th> 
                                          <th style="width: 1000%;">{{ __('adminlte::adminlte.userId') }}</th>
                                          <th>{{ __('adminlte::adminlte.email') }}</th>
                                          <th>{{ __('adminlte::adminlte.name') }}</th>
                                          <th>{{ __('adminlte::adminlte.phone_number') }}</th>
                                          <th>{{ __('adminlte::adminlte.account_type') }}</th>
                                          <th>{{ __('adminlte::adminlte.number_of_job') }}</th>    
                                          <th>{{ __('adminlte::adminlte.created_at') }}</th>
                                          <th>Status</th>
                                          <th>{{ __('adminlte::adminlte.actions') }}</th>
                                      </thead>
                                      <tbody>
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
<style>
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

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .drp-calendar.left{
        background-color: white;

    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
  $(function () {
    var myDataTable = $('.datatable').DataTable({        
     serverSide: true,
     ajax: {
      url: "{{ route('users.index') }}",
      data: function (d) {

       d.date_range = $('input[name="date_range"]').val().split('-'); 
   }
},
order:[[0,"DESC"]],
columns: [
    {data: 'id', name: 'id'},
    {data: 'unique_ID', name: 'unique_ID'},
    {data: 'email', name: 'email'},
    {data: 'name', name: 'name'},
    {data: 'phone_number', name: 'phone_number'}, 
    {data: 'account_type', name: 'account_type'},
    {data: 'booking_count', name: 'booking_count'},
   
    {data: 'created_at', name: 'created_at'},
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
    function userDelete(id){

        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete the user?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {

                $.ajax({
                    url: "users/"+id,
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

    function updateStatus(id,status){ 

        if($('#demo'+id).is(":checked")){
            var statuss=1;
        }else{
            var statuss=0;
        }

        $.ajax({
            type: 'POST',
            url: "{{route('update.user.status')}}",
            data: {
                "_token"      : "{{ csrf_token() }}",
                "status"      : statuss,
                "id"          : id,
            },
            success: function(data) {
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
    /* $('body').on('click','.apply-filter',function(){
        console.log('filter now');
        var date_range = $('input[name="date_range"]').val().split('-');   
        var current = $('.current').text();  
        var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 
        var type= "user";
        if(date_range.length==1)
            return false;
        $.ajax({
            url: "{{route('filter.user')}}",
            method: 'post',
            data: {
                date_range: date_range,
                current:current,
                limit:limit,
                type:type,
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
    }); */

    /*$('body').on('click','.reset-button',function(){

        var date_range = $('input[name="date_range"]').val().split('-');   
        var current = $('.current').text();  
        var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 
        var type= "user";
        $('input[name="date_range"]').val('');
        $('.advance_options_btn').hide();

        $.ajax({
            url: "{{route('reset.user')}}",
            method: 'post',
            data: {
                current:current,
                limit:limit,
                type:type,
                reset : true
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
    });*/


    $('.xlsbtn').click(function(){

        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('export-user',['type'=>'user'])}}");
    });
    $('.csvbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('csv-user',['type'=>'user'])}}");
    });
    $('.pdfbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('pdf-user',['type'=>'user'])}}");
    });
</script>
<!-- filters  -->

@stop
