@extends('adminlte::page')

@section('title', 'Pending Payments')

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
                            <h3>Pending Payments</h3>
                            <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                        </div>
                        <form action="{{route('export-booking')}}" method="get" id="filterForm">
                            @csrf
                             
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
                                                <th>{{ __('adminlte::adminlte.booking_fee') }}(SAR)</th>
                                                <th>{{ __('adminlte::adminlte.job_id') }}</th>
                                                <th>{{ __('adminlte::adminlte.user_name')}}</th>
                                                <th>{{ __('adminlte::adminlte.driver_name')}}</th> 
                                                <th>{{ __('adminlte::adminlte.payment_status')}}</th> 
                                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pendingPayments as $key=>$pendingPayment)
                                            <tr id="remove{{$pendingPayment->id}}">
                                                <td>{{$key+1}}</td> 
                                                <td>{{$pendingPayment->quote_amount}}</td>
                                                <td>{{$pendingPayment->job_ID}}</td>
                                                <td>{{$pendingPayment->userName}}</td>
                                                <td>{{$pendingPayment->driverName}}</td> 
                                                <td>{{$pendingPayment->status}}</td>
                                                <td><a class="nav-link" href="javascript:void(0)" onclick="approvePayment({{$pendingPayment->id}})" style="background-color: #000000;color: #fff;padding: 6px 10px 8px 7px;">Approve</a></td>
                                            </tr>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function approvePayment(id){

    Swal.fire({
    title: "Are you sure",
    text: "You want to approve this payment",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: "Yes approve it",
  }).then((result) => {
    if (result.isConfirmed) {
    
      $.ajax({
        type:'POST',
        url:"{{route('pending.payment.approve')}}",
        data:{
          "_token"      : "{{ csrf_token() }}", 
          "quote_id"    : id,
        },
        success:function(response){

            if(response==1){
                $('#remove'+id).hide();
                Swal.fire({ 
                  text: "Payment approved successfully",
                  icon: "success", 
                });
            }else{
                Swal.fire({ 
                  text: "Something went wrong.",
                  icon: "error", 
                });
            }
        }
      });
  
    }
  });


    }
</script>
@stop
