@extends('adminlte::page')

@section('title', 'User Information')

@section('content_header')
@stop

@section('content')
<style>
  #exampleTable3 tr th, #exampleTable2 tr th{
    text-align: center;
  }
  #quotationModal {
    overflow-y:scroll;
  }
  .modal-title{
    font-size: 20px;
    font-weight: 600;
  }
  #QuotationTab .active a {
    background-color: #ffcd00 !important;
    /* clip-path: polygon(0% 0%, 100% 0%, 100% 75%, 62% 75%, 49% 100%, 34% 76%, 0% 75%); */
    padding: 10px 20px 10px !important;
    margin: 0px;
    border-radius: 0px !important;
    color: #000;
  }
  .tab a, #QuotationTab li a {
    padding: 10px 20px 10px !important;
    border-radius: 0px !important;
    margin: 0px;
    font-size: 14px !important;
    font-weight: 500;
    background: #fff !important;
    border: 1px solid #ffcd00 !important;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
    color: #000;
  }

  div#charNum1 {
    position: absolute;
    bottom: 2px;
    right: 20px;
    font-size: 14px;
    color: #999;
    width: calc(100% - 21px);
    text-align: right;
  }
  div#charNum2 {
    position: absolute;
    bottom: 2px;
    right: 20px;
    font-size: 14px;
    color: #999;
    width: calc(100% - 21px);
    text-align: right;
  }

</style>
<div>
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a data-toggle="tab" href="#section1">Job Details</a></li>
    <li><a data-toggle="tab" href="#section2">Sender Details</a></li>
    <li><a data-toggle="tab" href="#section3">Receivers</a></li>
    <li><a data-toggle="tab" href="#section4">Received Quotations</a></li>
  </ul>
  <div class="tab-content">
    <div id="section1" class="tab-pane fade in active">
      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="order_details">
                <div class="card">
                  <div class="card-header alert d-flex justify-content-between align-items-center">
                    <h3>{{ __('adminlte::adminlte.job_detail') }}</h3> <a class="btn btn-sm btn-success success_btn_back" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> </div>
                    <div class="card-body"> @if (session('status'))
                      <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif

                      <form class="form_wrap">
                        <div class="row">


                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.job_id') }}</label>
                              <div class="custom_input">
                                <p class="mb-0">{{$job->job_ID}}</p>
                              </div>

                            </div>
                          </div> 
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.vehicle_type') }}</label>
                              <div class="custom_input">
                                <p class="mb-0">@foreach($vehicle_Type as $key=>$row) {{$row->name}} @if($key!=(count($vehicle_Type)-1)), @endif @endforeach</p>
                              </div>

                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.number_of_vehicle') }}</label>
                              <input class="form-control" placeholder="{{@$job->number_of_vehicle}}" readonly>

                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.schedule_date') }}</label>
                              <input class="form-control" placeholder="{{@date('d/m/Y',strtotime($job->schedule_date))}}" readonly>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.schedule_time') }}</label>
                              <input class="form-control" placeholder="{{@$job->schedule_time}}" readonly>
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.total_goods_weight') }}</label>
                              <input class="form-control" placeholder="{{$job->total_goods_weight}}" readonly>
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.number_of_item') }}</label>
                              <input class="form-control" placeholder="{{$job->number_of_items}}" readonly>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.product_type') }}</label>
                              <input class="form-control"  placeholder="{{$job->title}}" readonly>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.status') }}</label>
                              <input class="form-control"  placeholder="{{ucfirst($job->status)}}" readonly>
                            </div>
                          </div>
                        <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>{{ __('adminlte::adminlte.pick_up_address') }}</label>
                            <input class="form-control" placeholder="@if(@$job->PickupRegion->name) {{@$job->PickupRegion->name}}, {{@$job->PickupSubRegion->name}} @endif" readonly>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                          <div class="form-group">
                            <label>{{ __('adminlte::adminlte.destination_address') }}</label>
                            <input class="form-control" placeholder="@if(@$job->JobReceiver->DestinationRegion->name) {{@$job->JobReceiver->DestinationRegion->name}}, {{@$job->JobReceiver->DestinationSubRegion->name}} @endif" readonly>
                          </div>
                        </div> -->
                        
                        <!-- <div class="col-sm-12">
                          <div class="form-group">
                            <label>{{ __('adminlte::adminlte.job_status') }}</label>
                            <input class="form-control" placeholder="@if(@$job->is_active==1) Active @else Closed @endif" readonly>
                          </div>
                        </div> -->
                        <div class="col-sm-12">
                          <div class="form-group position-relative">
                            <label>{{ __('adminlte::adminlte.description_of_goods') }}</label>
                            <textarea class="form-control description" rows="6" placeholder="" readonly>{{@$job->description_of_goods}}</textarea>
                            <div id="charNum"></div>
                          </div>
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
    </div>
    <div id="section2" class="tab-pane fade">
      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="order_details">
                <div class="card">
                  <div class="card-header alert d-flex justify-content-between align-items-center">
                    <h3>{{ __('adminlte::adminlte.sender_detail') }}</h3> <a class="btn btn-sm btn-success success_btn_back" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> </div>
                    <div class="card-body"> @if (session('status'))
                      <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif

                      <form class="form_wrap">
                        <div class="row">


                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.user_name') }}</label>
                              <input class="form-control" placeholder="{{@$job->user->name}}" readonly>

                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.email') }}</label>
                              <input class="form-control" placeholder="{{@$job->user->email}}" readonly>

                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.mobile') }}</label>
                              <input class="form-control" placeholder="{{@$job->user->country_code}} {{@$job->user->phone_number}}" readonly>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.city') }}</label>
                              <input class="form-control" placeholder="{{@$job->user->city}}" readonly>
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.address') }}</label>
                              <input class="form-control" placeholder="{{@$job->user->address}}" readonly>
                            </div>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                            <div class="form-group">
                              <label>{{ __('adminlte::adminlte.zip_code') }}</label>
                              <input class="form-control" placeholder="{{@$job->user->zip_code}}" readonly>
                            </div>
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
      </div>
      <div id="section3" class="tab-pane fade">
        <section class="content">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="order_details">
                  <div class="card">
                    <div class="card-header alert d-flex justify-content-between align-items-center">
                      <h3>{{ __('adminlte::adminlte.receivers') }}</h3> <a class="btn btn-sm btn-success success_btn_back" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> </div>
                      <div class="table-responsive card-body">
                        <table style="width:100%" id="exampleTable2" class="table table-bordered table-hover datatable">
                          <thead>
                            <tr>
                              <th>Sr.No.</th>
                              <th>{{ __('adminlte::adminlte.receivers_name') }}</th>
                              <th>{{ __('adminlte::adminlte.receiver_number') }}</th>
                              <th>{{ __('adminlte::adminlte.pickup_address') }}</th>
                              <th>{{ __('adminlte::adminlte.destination_address') }}</th>
                              <th>{{ __('adminlte::adminlte.actions') }}</th>
                          <!-- <th>{{ __('adminlte::adminlte.verification_code') }}</th>
                            <th>Created at</th> -->

                          </tr>
                        </thead>
                        <tbody id="tbody"> 
                          @foreach($job->JobReceivers as $key=>$receiver)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$receiver->receivers_name}}</td>
                            <td>{{$receiver->receiver_number}}</td>
                            <td>{{@$job->PickupSubRegion->name}}, {{@$job->PickupRegion->name}}</td>
                            <td>{{@$receiver->DestinationSubRegion->name}}, {{@$receiver->DestinationRegion->name}}</td>
                            <!-- <td>{{$receiver->verification_code}}</td>
                          
                              <td>{{date('d/m/Y',strtotime($receiver->created_at))}}</td> -->
                              <td>
                                <a class="action-button" title="View" href="javascript:void(0);" onclick="viewReceiverDetail({{$receiver->id}});"><i class="text-info fa fa-eye"></i></a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div id="section4" class="tab-pane fade">
          <section class="content">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="order_details">
                    <div class="card">
                      <div class="card-header alert d-flex justify-content-between align-items-center">
                        <h3>{{ __('adminlte::adminlte.received_quotation') }}</h3> <a class="btn btn-sm btn-success success_btn_back" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> </div>
                        <div class="table-responsive card-body">
                          <table style="width:100%" id="exampleTable3" class="table table-bordered table-hover datatable">
                            <thead>
                              <tr>
                                <th>Sr.No.</th>
                                <th>{{ __('adminlte::adminlte.quote_amount') }}</th>
                                <th>{{ __('adminlte::adminlte.status') }}</th>
                                <th>{{ __('adminlte::adminlte.reason') }}</th>
                                <th>{{ __('adminlte::adminlte.comment') }}</th>
                                <th>{{ __('adminlte::adminlte.is_active_date') }}</th>
                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                              </tr>
                            </thead>
                            <tbody id="tbody"> 
                              @foreach($job->receiveQuotes as $key=>$receivQuote)

                              <tr>
                                <td>{{$key+1}}</td>

                                <td>{{$receivQuote->quote_amount}}</td>
                                <!-- <th>

                                  {{ ucfirst($receivQuote->status) }}


                                </th>
  -->
                                  <th>{{$receivQuote->is_accepted==0?'Declined':''}}

                                    @if($receivQuote->is_accepted==1)

                                    @if($receivQuote->status=='payment-pending' OR $receivQuote->status=='accepted' )

                                    Accepted

 
                                    @endif
                                    @endif


                                  </th>


                                <td>{{$receivQuote->reasons}}</td>
                                <td>{{$receivQuote->comment}}</td>
                                <td>
                                  <div class="EditShow_{{$receivQuote->id}}">

                                    <label class="datetimeShow_{{$receivQuote->id}}"> {{date('d/m/Y H:i' ,strtotime($receivQuote->is_active_date))}}</label>
                                    <button type="button" class="btn btn-primary btn-sm EditActiveDate" onclick="editActiveDate({{$receivQuote->id}})">Edit</button>
                                  </div>


                                  <div style="display: none;" class="UpdateShow_{{$receivQuote->id}}">
                                    <input id="datetimepicker" type="text" class="datetime_{{$receivQuote->id}}" value="{{date('d/m/Y H:i',strtotime($receivQuote->is_active_date))}}" style="width: 110%;">
                                    <button type="button" class="btn btn-primary btn-sm UpdateActiveDate" 
                                    onclick="updateActiveDate({{$receivQuote->id}})" >Update</button>
                                  </div>
                                </td>
                                <td>

                                  <a class="action-button" title="View" href="javascript:void(0);" onclick="viewReceivedQuotationDetail({{$receivQuote->id}});"><i class="text-info fa fa-eye"></i></a> 

                                  <!--   <a class="action-button datetimepicker" title="increasing" href="javascript:void(0);" onclick="increaseTime({{$receivQuote->id}});" >increase time</a> -->







                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>


      <!-- Driver Detail Modal Start -->
      <div class="modal fade" id="receiverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Receiver Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body receiver_details_data">

            </div>

          </div>
        </div>
      </div>
      <!-- Modal End -->

      <!-- Quotation Detail Modal Start -->
      <div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <ul class="nav nav-tabs" id="QuotationTab">
                <li class="active"><a data-toggle="tab" href="#sectionA">Quotation Details</a></li>
                <li><a data-toggle="tab" href="#sectionB">Vehicle Details</a></li>
              </ul>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body quotation_details_data">

            </div>

          </div>
        </div>
      </div>
      <!-- Modal End -->

      <!-- Start Image Preview Modal -->
      <div class="modal fade" id="imagemodal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">              
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
              </button>
              <img src=""  class="imagepreview1" style="width:100%;">
            </div>
          </div>
        </div>
      </div>
      <!-- End Image Preview Modal -->
      @endsection

      @section('css')
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> 

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
      <style type="text/css">
       /* Style the tab */
       .tab {
        overflow: hidden;

        background-color: #f5f5f5;
      }


      .tab a.active {
        background-color: #ffcd00 !important;
      }

      /* Style the tab content */
      .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;

      }
      .tablinks{
        color: #1f1717;
        height: 42px;
      }

      /* Style the close button */
      .topright {
        float: right;
        cursor: pointer;
        font-size: 28px;
      }

      .topright:hover {color: red;}
    </style>
    @stop

    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 


    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
          $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
      });
    </script> 

    <script type="text/javascript">

      $(document).ready(function () {
        $('#exampleTable1').DataTable();
      });
      $(document).ready(function () {
        $('#exampleTable2').DataTable();
      });
      $(document).ready(function () {
        $('#exampleTable3').DataTable();
      });
    </script>




    <script type="text/javascript">
      $(document).ready(function() {
       jQuery.datetimepicker.setDateFormatter({
        parseDate: function(date, format) {
          var d = moment(date, format);
          return d.isValid() ? d.toDate() : false;
        },
        formatDate: function(date, format) {
          return moment(date).format(format);
        }
      });

       $("#datetimepicker").datetimepicker({        

        step: 30,
        minDate: 0,
       // minTime: 0,
        format: 'DD/MM/YYYY H:mm',
        formatTime:'H:mm',
        formatDate:'DD/MM/YYYY'
      });

     });


   </script>

   <script>



    function editActiveDate(id)
    {
     $(".UpdateShow_"+id).show();
     $(".EditShow_"+id).hide();
   } 


   function updateActiveDate(id)
   {

    var datetime = $(".datetime_"+id).val();


    swal({
      title: "Are you sure?",
      text: "Are you sure you want to change active time?",
      type: "warning",
      showCancelButton: true,
    }, function(ActiveDate) {
      if (ActiveDate) {

        $.ajax({
          type: 'POST',
          url: "{{route('jobs.update.ActiveDate')}}",
          data: {
            "_token"      : "{{ csrf_token() }}",
            "datetime"    : datetime,
            "id"          : id,
          },
          success: function(response) {

           $(".UpdateShow_"+id).hide();      
           $(".EditShow_"+id).show();           
           $(".datetimeShow_"+id).html(datetime);           

         }
       });
      } 
    });





  }





  function viewReceiverDetail(id){
    var url= "{{route('view.receiver.detail',':id')}}";
    url = url.replace(':id', id);
    $.ajax({
      url: url,
      type: 'get',
      data: {
        "id"      :   id,
      },
      dataType: "JSON",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {

        var html=`<form class="form_wrap">
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.receivers_name') }}</label>
        <input class="form-control" placeholder="" value="${response.data.receivers_name}" readonly>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.receiver_number') }}</label>
        <input class="form-control" placeholder="" value="${response.data.receiver_number}" readonly>
        </div>
        </div>

        <div class="col-sm-12">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.destination_address') }}</label>
        <input class="form-control" placeholder="" value="${response.data.destination_region.name}, ${response.data.destination_sub_region.name}" readonly>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group form-wrapper position-relative">
        <label>{{ __('adminlte::adminlte.description') }}</label>
        <textarea class="form-control description1" rows="6" placeholder="" value="${response.data.requirements}" readonly></textarea>
        <div id="charNum1"></div>
        </div>
        </div>
        </div>
        </form>`;
        $(".receiver_details_data").html(html);
        $('#receiverModal').modal("show");

        $(document).ready(function(){
          var len1 = $(".description1").val().length;
          $('#charNum1').text(len1+' character description');

        });

      }
    });

  }

  function viewReceivedQuotationDetail(id){
    var url= "{{route('view.received.quotation.detail',':id')}}";
    url = url.replace(':id', id);
    $.ajax({
      url: url,
      type: 'get',
      data: {
        "id"      :   id,
      },
      dataType: "JSON",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        var mydate = new Date(response.data.driver.vehicle_details.insurance_expiry_date);
        var expiry_date = mydate.getDate() + '/' +mydate.getMonth() + '/' + mydate.getFullYear();

        console.log(response.data);
        var html=`<div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
        <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.name') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.name==null?'':response.data.driver.name}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.mobile') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.phone_number==null?'':response.data.driver.phone_number}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.email') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.email==null?'':response.data.driver.email}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.city') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.city==null?'':response.data.driver.city}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.address') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.address==null?'':response.data.driver.address}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.zip_code') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.zip_code==null?'':response.data.driver.zip_code}" readonly> </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group form-wrapper position-relative">
        <label for="message-text" class="col-form-label">{{ __('adminlte::adminlte.description') }}</label>
        <textarea class="form-control description2" rows="6" id="message-text">${response.data.driver.driver_details.description==null?'':response.data.driver.driver_details.description}</textarea>
        <div id="charNum2"></div>
        </div>
        </div>
        <div class="col-sm-6 ">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.driver_licence') }}</label> <img width="50%" class="pop1" data-type="image" src="{{env('STORAGE_PATH')}}/${response.data.driver.driver_details.driver_licence}"> </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.verification_id') }}</label> <img class="pop1" width="50%" data-type="image" src="{{env('STORAGE_PATH')}}/${response.data.driver.driver_details.verification_id}"> </div>
        </div>
        </div>
        </div>

        <div id="sectionB" class="tab-pane fade">
        <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_type') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.vehicle_details.vehicle_type.name}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.type_of_insurance') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.vehicle_details.insurance_type.name}" readonly> </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.insurance_expiry_date') }}</label>
        <input class="form-control" placeholder="" value="${expiry_date}" readonly> </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_number') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.vehicle_details.license_plate}" readonly> </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.registration_year') }}</label>
        <input class="form-control" placeholder="" value="${response.data.driver.vehicle_details.vehicle_registration_year}" readonly> </div>
        </div>
        <div class="col-sm-4 ">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_insurance') }}</label> <img width="50%" class="pop1" data-type="image" src="{{env('STORAGE_PATH')}}/${response.data.driver.vehicle_details.insurance}"> </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_registration') }}</label> <img class="pop1" width="50%" data-type="image" src="{{env('STORAGE_PATH')}}/${response.data.driver.vehicle_details.vehicle_registration}"> </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.pta_licence') }}</label> <img class="pop1" width="50%" data-type="image" src="{{env('STORAGE_PATH')}}/${response.data.driver.vehicle_details.Vehicle_PTA_License}"> </div>
        </div>
        </div>
        </div> 
        </div>`;
        $(".quotation_details_data").html(html);
        $('#quotationModal').modal("show");
        $(".pop1").click(function(){
          var data=  $(this).attr('data-type'); 
          if(data=="image"){
            $('.imagepreview1').attr('src', $(this).attr('src'));
            $('.imagepreview1').show();
          }
          $('#imagemodal1').modal('show');

        });
        $(document).ready(function(){
          var len1 = $(".description2").val().length;
          $('#charNum2').text(len1+' character description');

        });
      }
    });


}

</script>
<script>
 $(document).ready(function(){
  var len = $(".description").val().length;
  $('#charNum').text(len+' character description');

});
</script>

@stop
