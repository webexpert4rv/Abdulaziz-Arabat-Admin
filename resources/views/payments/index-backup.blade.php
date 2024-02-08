    @extends('adminlte::page')

    @section('title', 'Payment')

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
                                <h3>{{ __('adminlte::adminlte.payment_transactions') }}</h3>

                                <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>


                            </div> 
                            <form action="{{route('export-payment')}}" method="get" id="filterForm">
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
                                        <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                                            <thead>
                                                <tr>
                                                    <th >Sr.No.</th>
                                                    <!--  <th>{{ __('adminlte::adminlte.booking_id') }}</th> -->
                                                    <th>{{ __('adminlte::adminlte.job_id') }}</th>
    <!--   <th>{{ __('adminlte::adminlte.user_name') }}</th>
        <th>{{ __('adminlte::adminlte.driver_name') }}</th> -->
        <th>{{ __('adminlte::adminlte.transaction_id') }}</th>
        <th>{{ __('adminlte::adminlte.amount') }}</th>

        <!--     <th>{{ __('adminlte::adminlte.bank_account_id') }}</th> -->
    <!--    <th>{{ __('adminlte::adminlte.bank_name') }}</th>
    <th>{{ __('adminlte::adminlte.account_info') }}</th>
    <th>{{ __('adminlte::adminlte.remitter_name') }}</th>
    <th>{{ __('adminlte::adminlte.bank_rceipt') }}</th> -->


    <th>{{ __('adminlte::adminlte.created_at') }}</th>
    <th>{{ __('adminlte::adminlte.actions') }}</th>
</tr>
</thead>
<tbody id="tbody">
    @foreach($transactions as $key=>$transaction)
    @if(isset($transaction->job))
    <tr>
        <td>{{$key+1}}</td>
        <!--    <td>{{$transaction->booking->book_id}}</td> -->
        <td>
            {{$transaction->job->job_ID}}



        </td>
    <!--  <td>{{@$transaction->user->name}}</td>
        <td>{{$transaction->driver->name}}</td> -->
        <td>{{$transaction->transaction_id}}</td>                      
        <td>{{$transaction->amount}}</td>
        <!--   <td>{{$transaction->bank_account_id}}</td> -->
    <!-- <td>{{$transaction->bank_name}}</td>
    <td>{{$transaction->account_info}}</td>
    <td>{{$transaction->remitter_name}}</td>
    <td>


    @if($transaction->bank_rceipt)
    <a href="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" target="_blank">
    <img src="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" alt="Dew drop" style="width: 300px">
    </a>
    @endif -->





</td>
<td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
<td>
    @can('view_payment')
    <a class="action-button" title="Job Details" href="javascript.void();"  data-toggle="modal" data-target="#exampleModal-{{$transaction->id}}"><i class="text-info fa fa-eye"></i></a> 
     <a class="action-button" title="Job Details" href="{{route('jobs.show',$transaction->job->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a> 
    @endcan
    <!--  <a class="action-button" title="View" href="{{route('payments.show',$transaction->id)}}"><i class="text-info fa fa-eye"></i></a>  -->
    @if($transaction->bank_rceipt)
    <a href="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" target="_blank"  class="action-button btn btn-danger"  download>
    Rrceipt Download </a>  
    @endif



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
</div>
</section>

@foreach($transactions as $key=>$transaction) 
<div class="modal fade" id="exampleModal-{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row"> 
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Job Id</label>
                            <input class="form-control" value="{{@$transaction->job->job_ID}}" readonly="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>User Name</label>
                            <input class="form-control" value="{{@$transaction->user->name}}" readonly=""> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Driver Name  </label>
                            <input class="form-control" value="{{@$transaction->driver->name}}" readonly="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Transaction Id</label>
                            <input class="form-control" value="{{@$transaction->transaction_id}}" readonly=""> 
                        </div>
                    </div>  
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <input class="form-control" value="{{@$transaction->amount}}" readonly="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Bank Account</label>
                            <input class="form-control" value="{{@$transaction->bank_account_id}}" readonly=""> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Bank Name</label>
                            <input class="form-control" value="{{@$transaction->bank_name}}" readonly="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Account Information  </label>
                            <input class="form-control" value="{{@$transaction->account_info}}" readonly=""> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Remitter Name </label>
                            <input class="form-control" value="{{@$transaction->remitter_name}}" readonly=""> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Bank Rrceipt </label>
                            @if($transaction->bank_rceipt)
                        <a href="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" target="_blank">
                          <img src="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" class="img-thumbnail" alt="Dew drop" style="width: 356px; height: 315px;">
                        </a>
                        @endif

                        @if($transaction->bank_rceipt)
                    <a href="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" target="_blank"  class="action-button btn btn-danger"  download>
                    Rrceipt Download </a> 
                      @endif
                        </div>
                    </div>

                </div>

              

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>  
@endforeach












<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>






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
        if(date_range.length==1)
            return false;
        $.ajax({
            url: "{{route('filetr.payment')}}",
            method: 'post',
            data: {
                date_range: date_range,
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

        var date_range = $('input[name="date_range"]').val().split('-');   
        if(date_range.length==1){
            return false;
        }

        $('input[name="date_range"]').val('');
        $('.advance_options_btn').hide();

        $.ajax({
            url: "{{route('reset.payment')}}",
            method: 'post',
            data: {
                date_range: date_range,
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
    });


    $('.xlsbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('export-payment')}}");
    });
    $('.csvbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('csv-payment')}}");
    });
    $('.pdfbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('pdf-payment')}}");
    });
</script>
<!-- filters  -->

@stop
