@extends('adminlte::page')

@section('title', 'Transporter Information')

@section('content_header')
@stop

@section('content')  

<style>
  /*.swal2-confirm{
    margin-bottom: 133px !important;
  }
  .swal2-cancel{
    margin-bottom: 133px !important;
  }*/
  .swal2-show {
    width: 30% !important;
    height: 80% !important;
    font-size: 15px !important;
}
  #exampleTable tr th{
    text-align:center
  }
  #exampleModal {
    overflow-y:scroll;
  }
  .modal-title{
    font-size: 20px;
    font-weight: 600;
  }

  .btn-success {
    background-image: -webkit-linear-gradient(top,#ed1c24 0,#ed1c24 100%); */
    background-image: -o-linear-gradient(top,#ed1c24 0,#ed1c24 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(#ed1c24),to(#ed1c24)); */
    background-image: linear-gradient(to bottom #ed1c24 0,#ed1c24 100%); */

  }

select.form-control {
    padding: 19px 22px !important;
    border-color: #dddddd !important;
    border-radius: 10px !important;
    min-height: 55px !important;
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 0%), 0 0 8px rgb(102 175 233 / 0%) !important;
}
</style>

<style type="text/css">
  .loader_css{
    position: absolute;
    left: 35%;
  }
  .approve_css{
    padding: 15px 10px !important;
    position: relative;
  }

  .swal2-show{
    width: 26%;
    height: 54%;
    font-size: 13px;
  }
</style>
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

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<ul class="nav nav-tabs" id="myTab"> 
  <li class="active"><a data-toggle="tab" href="#sectionA">Transporter Details</a></li> 
  <li><a data-toggle="tab" href="#sectionB">Drivers</a></li>
  <li> <a data-toggle="tab" href="#jobs">Jobs</a> </li> 
  <li> <a data-toggle="tab" href="#payments">Payments</a> </li> 
  <li> <a data-toggle="tab" href="#notifications">Notifications</a> </li> 
  <li> <a data-toggle="tab" href="#receive_quations">Receive Quations</a> </li> 
</ul>

<div class="tab-content"> 
  <div id="sectionA" class="tab-pane fade in active"> 
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="order_details">
              <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                  <h3>{{ __('adminlte::adminlte.transporter_detail') }}</h3> 
                  <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                </div>
                <div class="card-body"> @if (session('status'))
                  <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif
                  <form class="form_wrap">
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group">
                          <label>Profile Image</label>                                         
                          <img  style="width: 25%;" src="{{config('services.storage_image_path.web_path')}}/{{$transporter->profile_image}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <div class="form-group">
                            <label>Transporter ID</label>
                            <input class="form-control" placeholder="{{$transporter->unique_ID}}" readonly> 
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <label>{{ __('adminlte::adminlte.name') }}</label>
                          <input class="form-control" placeholder="" value="{{$transporter->name}}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <label>{{ __('adminlte::adminlte.email') }}</label>
                          <input class="form-control" placeholder="" value="{{$transporter->email}}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <label>{{ __('adminlte::adminlte.mobile') }}</label>
                          <input class="form-control" placeholder="" value="{{$transporter->country_code}} {{$transporter->phone_number}}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <label>Push Notifications</label>
                          <input class="form-control" placeholder="" value="{{$transporter->is_push_notifications==0?'OFF':'ON'}}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <label>Email Notifications</label>
                          <input class="form-control" placeholder="" value="{{$transporter->is_email_notifications==0?'OFF':'ON'}}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group form-wrapper">
                          <label>Referrer code</label>
                          <input class="form-control" placeholder="" value="{{$transporter->referrer_code}}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>Commission for Transporter</label>
                          <input class="form-control" placeholder="{{@$transporter->commission}}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @if(Optional($transporter->transporterDetails)->public_transport_authority_license)
                      <div class="col-sm-6">
                        <div class="form-group form-wrapper">
                          <label class="d-block w-100">{{ __('adminlte::adminlte.public_transport_authority_license') }}</label>
                          <a target="_blank" href="{{ route('download.image', ['path' => $transporter->transporterDetails->public_transport_authority_license]) }}">Download</a>
                          <img class="pop" width="50%" data-type="image"   src="{{config('services.storage_image_path.web_path')}}/{{Optional($transporter->transporterDetails)->public_transport_authority_license}}">
                        </div>
                      </div>
                      @endif
                      @if(Optional($transporter->transporterDetails)->commercial_registration)
                      <div class="col-sm-6">
                        <div class="form-group form-wrapper">
                          <label>{{ __('adminlte::adminlte.commercial_registration') }}</label>
                          <a target="_blank" href="{{ route('download.image', ['path' => $transporter->transporterDetails->commercial_registration]) }}">Download</a>
                          <img class="pop" width="50%" data-type="image"   src="{{config('services.storage_image_path.web_path')}}/{{Optional($transporter->transporterDetails)->commercial_registration}}">
                        </div>
                      </div>
                      @endif
                      @if(Optional($transporter->transporterDetails)->vat_registration)
                      <div class="col-sm-6">
                        <div class="form-group form-wrapper">
                          <label>{{ __('adminlte::adminlte.vat_registration') }}</label>
                          <a target="_blank" href="{{ route('download.image', ['path' => $transporter->transporterDetails->vat_registration]) }}">Download</a>
                          <img class="pop" width="50%" data-type="image"   src="{{config('services.storage_image_path.web_path')}}/{{Optional($transporter->transporterDetails)->vat_registration}}">
                        </div>
                      </div>
                      @endif
                      @if(Optional($transporter->transporterDetails)->iban_details)
                      <div class="col-sm-6">
                        <div class="form-group form-wrapper">
                          <label>{{ __('adminlte::adminlte.iban_details') }}</label>
                          <a target="_blank" href="{{ route('download.image', ['path' => $transporter->transporterDetails->iban_details]) }}">Download</a>
                          <img class="pop" width="50%" data-type="image"   src="{{config('services.storage_image_path.web_path')}}/{{Optional($transporter->transporterDetails)->iban_details}}">
                        </div>
                      </div>
                      @endif

                      @if(count($more_documents)>0)
                      @foreach($more_documents as $more_document)
                      <div class="col-sm-6">
                        <div class="form-group form-wrapper">
                        <a target="_blank" href="{{ route('download.image', ['path' => $more_document->document]) }}">Download</a>
                          <img class="pop" width="50%" data-type="image"   src="{{config('services.storage_image_path.web_path')}}/{{$more_document->document}}">
                        </div>
                      </div>
                      @endforeach
                      @endif


                      <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered">
                          <div class="modal-content">              
                            <div class="modal-body open_img_modal">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <img src=""  class="imagepreview" style="width:100%;">
                            </div>
                          </div>
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


  <div id="sectionB" class="tab-pane fade"> 
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="order_details">
              <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                  <h3>{{ __('adminlte::adminlte.drivers') }}</h3> 
                  <a class="btn btn-sm btn-success" title="Add New Driver" href="javascript:void(0); " style="margin-right:20px;"  onclick="AddNewDriver();" >Add New Driver</a>
                  <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                </div>
                <div class="table-responsive card-body">
                  <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                    <thead>
                      <tr>
                        <th>Sr.No.</th>
                        <th>{{ __('adminlte::adminlte.driver_name') }}</th>
                        <th>{{ __('adminlte::adminlte.phone_number') }}</th>
                       <!--  <th>{{ __('adminlte::adminlte.email') }}</th> -->
                        <!-- <th>{{ __('adminlte::adminlte.address') }}</th> -->
                        <th>{{ __('adminlte::adminlte.quotation_count') }}</th>
                        <th>{{ __('adminlte::adminlte.status') }}</th>
                        <th>{{ __('adminlte::adminlte.actions') }}</th>
                      </tr>
                    </thead>
                    <tbody id="tbody"> 
                      @foreach($driver as $key=>$row)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->country_code}} {{$row->phone_number}}</td>
                        <!-- <td>{{$row->email}}</td> -->
                       
                        <!--   <td>{{$row->address?? 'NA'}}</td> -->
                        <td> 
                          @php 
                          $quotationcount=App\Models\ReceiveQuotes::where('driver_id',$row->id)->count();
                          @endphp
                          <a class="action-button btn btn-info" target="_blank" title="View" href="{{route('jobs.index',['id'=>$row->id])}}">{{$quotationcount}}</a>
                        </td>
                         <td>
                          <?php 
                          $checked = $row->status==1?'checked':'';
                           $status = $row->status==1?'0':'1';
                          ?>
                          <label class="switch">
                          <input type="checkbox"  {{$checked}}  id="demo{{$row->id}}" onchange="updateStatus({{$row->id}},{{$status}})" /  >
                          <span class="slider round"></span>
                        </label></td>
                        <td>
                          <a class="action-button" onclick="driverDetailModalOpen({{$row->id}});" title="View" href="javascript:void(0); "><i class="text-info fa fa-eye"></i></a>
                          <a class="action-button" onclick="driverUpdateDetailModalOpen({{$row->id}});" title="View" href="javascript:void(0); "><i class="text-warning fa fa-edit"></i></a>
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="driverDelete({{$row->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
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

  <div id="notifications" class="tab-pane fade"> 
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="order_details">
              <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                  <h3>Notifications</h3>                   
                </div> 
                <div class="table-responsive card-body">
                  <table style="width:100%" id="exampleTable1" class="table table-bordered table-hover datatable"> 
                    <tbody id="tbody">
                      @foreach($getnotification as $key=>$value)
                      <tr>
                        <td>{{$key+1}}</td>                                                        
                        <td>{{$value->title}} <br>
                         {{$value->description}} <br>
                         {{{date('d/m/Y H:i',strtotime($value->created_at))}}}</td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                   <div style="float: right;">                     
                     {{$getnotification->links("pagination::bootstrap-4")}}
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>
   </div>
   <div id="receive_quations" class="tab-pane fade">
    <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="order_details">
            <div class="card">
              <div class="card-header alert d-flex justify-content-between align-items-center">
                <h3>Receive Quations</h3>                   
              </div>

              <div class="table-responsive card-body">
                <table style="width:100%" id="tablejob" class="table table-bordered table-hover datatable">

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
                   
                  @foreach($receive_quations as $key=>$receive_quation) 
                  <tr class="job_remove{{$receive_quation->id}}">
                   <td>{{@$i++}}</td>
                   <td>{{@$receive_quation->job_ID}}</td>
                   <td>{{$receive_quation->title}}</td>
                   <td>{{date('d/m/Y',strtotime($receive_quation->schedule_date))}}</td>
                   <td>{{date('h:i A',strtotime($receive_quation->schedule_time))}}</td>
                   <td>{{@$receive_quation->PickupRegion->name}} {{@$receive_quation->PickupSubRegion->name}}</td>
                   <td>{{@$receive_quation->JobReceiver->DestinationRegion->name}} {{@$receive_quation->JobReceiver->DestinationSubRegion->name}}</td>

                   <td>{{$receive_quation->number_of_vehicle}}</td>
                   <td>{{ucfirst($receive_quation->status)}}</td>
                   <td>
                    @can('view_jobs')
                    <a class="action-button" title="View" href="{{route('jobs.show',$receive_quation->id)}}"><i class="text-info fa fa-eye"></i></a>
                    @endcan
                    
                    <br><a class="nav-link  " href="javascript:void(0)" onclick="openForwardModal({{@$receive_quation->requestQuotes->id}})" style="background-color: #000000;color: #fff;padding: 10px 10px 0px 10px;"><p>Forward Quote</p></a>
                      
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

   <div id="payments" class="tab-pane fade"> 
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="order_details">
              <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                  <h3>Payments</h3>                   
                </div>  

                <div class="row">
                  <div class="col-sm-3">
                    <div class="small-box teacher">
                      <div class="inner">
                        <div class="right text-left">
                          <p>Total Amount</p>
                          <h3>{{ $totalEarning}} SAR</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="small-box student">
                      <div class="inner">
                        <div class="right text-left">
                          <p>Received Amount</p>
                          <h3>{{ $totalReceivedAmount}} SAR</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="small-box school">
                      <div class="inner">
                        <div class="right text-left">
                          <p>Admin Commission</p>
                          <h3>{{$commission}} SAR</h3>
                        </div>
                      </div>
                    </div>
                  </div> 
                  <div class="col-sm-3">
                   <div class="small-box school">
                    <div class="inner">
                      <div class="right text-left">
                        <p>Total Paid Amount</p>
                        <h3>{{$paid_amount}} SAR</h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="small-box admin">
                    <div class="inner">
                      <div class="right text-left">
                        <p>Total Pending Amount</p>
                        <h3>{{$remaining_amount}} SAR</h3>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card-header alert d-flex justify-content-between align-items-center">
                <h3>Drivers</h3>                   
              </div>


              <div class="table-responsive card-body">
                <table style="width:100%" id="exampleTablepay" class="table table-bordered table-hover datatable">
                  <thead>
                    <tr>
                      <th>Sr.No.</th>
                      <th>Full Name</th>
                      <th>Amount</th>
                      <th>Admin Commission</th>
                      <th>Remaining Amount</th>
                      <th>Paid Amount</th>  
                    </tr>
                  </thead>
                  <tbody id="tbody"> 
                    @foreach( $getDriver as $key=>$transporter) 
                    @php 

                    $drivers_ids = App\Models\User::where('parent_id',$transporter->id)->pluck('id'); 

                    $quote_amount = App\Models\Booking::where('driver_id',$transporter->id)->where('status','service_completed')->sum('quote_amount'); 

                    $paid_amount_total = App\Models\DriverWallet::where('driver_id',$transporter->id)->sum('amount'); 

                    $pricing                =   App\Models\Pricing::first();

                    $remaining_amount = ($quote_amount-($pricing->commission* $quote_amount)/100)- $paid_amount_total;


                    $commission_per = App\Models\DriverWallet::where('driver_id',$transporter->id)-> sum('transporter_commission'); 
                    $panelty_amount = App\Models\DriverWallet::where('driver_id',$transporter->id)->sum('penalty_amount');

                    //$paid_amount= $paid_amount_total-$commission_per-$panelty_amount;
                    //$remaining_amount = $quote_amount-$panelty_amount-($paid_amount+$commission_per); 
                    $tax =$pricing->tax;
                    $transporteCommission =$pricing->commission;

                    $commission=($quote_amount*$transporteCommission/100)*(1+$tax/100);

                    $totalAmount=$quote_amount-$commission;

                    $remaining_amount  =    $totalAmount-($paid_amount_total);                                     

                    @endphp
                    <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$transporter->name}}</td>
                     <td class="request_btn"> {{$totalAmount}}</td>
                     <td class="request_btn"> {{$commission}}</td>
                     <!--   <td class="request_btn"> {{$panelty_amount}} </td> -->
                     <td class="request_btn"> {{$remaining_amount}} </td>
                     <td class="request_btn"> {{$paid_amount_total}}</td>

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
<div id="jobs" class="tab-pane fade"> 
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="order_details">
            <div class="card">
              <div class="card-header alert d-flex justify-content-between align-items-center">
                <h3>Jobs</h3>                   
              </div>

              <div class="table-responsive card-body">
                <table style="width:100%" id="tablejob" class="table table-bordered table-hover datatable">

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
                      <!--  <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="deleteJob({{$job->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a> -->
                     
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
                   <!--  @can('delete_jobs')
                    <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="deleteJob({{$job->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a> -->
                    
                    @endcan
                  </td>   
                </tr>
                @endif
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


<!-- Driver Detail Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <ul class="nav nav-tabs pl-2" id="myTab"> 
          <li class="active"><a data-toggle="tab" href="#section1">Driver Details</a></li> 
          <li><a data-toggle="tab" href="#section2">Vehicle Detail</a></li> 
        </ul> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body driver_details_data">

      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<!-- Start Image Preview Modal -->
<div class="modal fade" id="imagemodal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">              
      <div class="modal-body open_img_modal">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src=""  class="imagepreview1" style="width:100%;">
      </div>
    </div>
  </div>
</div>
<!-- End Image Preview Modal -->


<!-- Modal farword -->
 <div class="modal fade" id="farwardQuoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content content_modal">
        <div class="modal-header header_modal">
          <h5 class="modal-title title_modal" id="exampleModalLabel">Forward Quote</h5>
          <!-- <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">X</button> -->
        </div>
        <div class="modal-body body_modal">
          
          <div class="row">
            <div class="col-12">
              <input type="hidden" value="" id="quote_id">
            <p class="mb-0">Drivers:</p>
               <select name="driver_id" id="driver_id"  class="form-control">
                 
              @foreach($getOnlineDriver as $key=>$row)

              <option value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
               <?php if(count($getOnlineDriver)<1){ ?>
              <option value="">All Drivers are Offline</option>
              <?php } ?>
              </select>
               
            </div>
          </div>
          <p class="mb-0">Additional Comments:</p>
          <textarea class="textarea_modal mt-2 mb-4" rows="5" cols="30" id="msg" name="msg" placeholder="Write your message" style="width:100%"></textarea>
        </div>
        <div class="modal-footer footer_modal">
          <button type="button"  class="btn btn-secondary secondary_btn" data-bs-dismiss="modal">Cancel</button>
          <button type="button" onclick="forwardQuote()" class="btn btn-primary primary_btn">Submit</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal forward -->
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> 

@stop

@section('js') 
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<script type="text/javascript">
  $(document).ready(function () {

    $('#exampleTablepay').DataTable( );
    $('#tablejob').DataTable( );
  });

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
<script>
  function updateStatus(id){ 

    if($('#demo'+id).is(":checked")){
      var status=1;
    }else{
      var status=0;
    }

   
    $.ajax({
      type: 'POST',
     url: "{{route('update.user.status')}}",
      data: {
        "_token"      : "{{ csrf_token() }}",
        "status"      : status,
        "id"          : id,
      },
      success: function(data) {


      }

    });
  }

  function driverDelete(id){
    swal({
      title: "Are you sure?",
      text: "Are you sure you want to delete the Driver?",
      type: "warning",
      showCancelButton: true,
    }, function(willDelete) {
      if (willDelete) {
        var url = "{{route('driver.delete',":id")}}";
        url = url.replace(':id', id);
        $.ajax({
          url: url,
          type: 'post',
          data: {
            "id"      :   id,

          },
          dataType: "JSON",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            console.log("Response", response);
            if(response == 1) {
              window.location.reload();
              /* console.log("response", response);
              obj.parent().parent().remove(); */
            }
            else {
              console.log("FALSE");
              setTimeout(() => {
                swal("Error!", "Something went wrong! Please try again.", "error");
              }, 500);
              // swal("Error!", "Something went wrong! Please try again.", "error");
              // swal("Something went wrong! Please try again.");
            }
          }
        });
      } 
    });
  }
  function driverDetailModalOpen(id){
    var url= "{{route('driver.show',':id')}}";
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
 
        
        var vehicle_type =response.data.vehicle_details.vehicle_type.name+'('+response.data.vehicle_details.vehicle_type.max_load +' '+response.data.vehicle_details.vehicle_type.max_load_unit +' , '+response.data.vehicle_details.vehicle_type.length +' '+response.data.vehicle_details.vehicle_type.unit +')';
 
        var mydate = new Date(response.data.vehicle_details.insurance_expiry_date);

        var expiry_date = mydate.getDate() + '/' + (mydate.getMonth()+ 1)  + '/' + mydate.getFullYear();
   
       
      
        var html=`  
        <div class="tab-content">  

 
        <div id="section1" class="tab-pane fade in active"> 
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.name') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.name==null?'':response.data.name}" readonly>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.mobile') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.phone_number==null?'':response.data.phone_number}" readonly>
        </div>
        </div>
        {{--   <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.email') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.email==null?'':response.data.email}" readonly>
        </div>
        </div> --}}

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.city') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.city==null?'':response.data.city}"  readonly>
        </div>
        </div>

        {{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.address') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.address==null?'':response.data.address}" readonly>
        </div>
        </div> --}}

        {{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.zip_code') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.zip_code==null?'':response.data.zip_code}"  readonly>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group form-wrapper position-relative">
        <label for="message-text" class="col-form-label">{{ __('adminlte::adminlte.description') }}<span class="text-danger">*</span></label>
        <textarea class="form-control description" rows="6" id="message-text" readonly>${response.data.driver_details.description==null?'':response.data.driver_details.description}</textarea>
        <div id="charNum"></div>
        </div>
        </div> --}}
        <div class="col-sm-12"></div>
        <div class="col-sm-6 ">
        <div class="form-group form-wrapper">
        <label >{{ __('adminlte::adminlte.driver_licence') }}<span class="text-danger">*</span></label> 

        <a target="_blank" href="/admin/download-image/${response.data.driver_details.driver_licence}">Download</a>         

        <img width="50%"  class="pop1" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.driver_details.driver_licence}"   data-url="${response.data.driver_details.driver_licence}">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.verification_id') }}<span class="text-danger">*</span></label> 
        <a target="_blank" href="/admin/download-image/${response.data.driver_details.verification_id}">Download</a> 
        <img  class="pop1" width="50%" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.driver_details.verification_id}" data-url="${response.data.driver_details.verification_id}">
        </div>

        </div> 
        <div class="col-sm-12">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.moreimage') }}  <span class="text-danger">*</span></label>

        </div>

        </div> 

        ${response.moreimage}







        </div>
        </div>
        <div id="section2" class="tab-pane fade">
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_type') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${vehicle_type} " readonly>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.type_of_insurance') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.vehicle_details.insurance_type.name}" readonly>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.insurance_expiry_date') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${expiry_date}" readonly>
        </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_number') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.vehicle_details.license_plate}"  readonly>
        </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.registration_year') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.vehicle_details.vehicle_registration_year}" readonly>
        </div>
        </div>


        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 ">
        <div class="form-group form-wrapper">
        <label >{{ __('adminlte::adminlte.vehicle_insurance') }}<span class="text-danger">*</span></label>
        <a target="_blank" href="/admin/download-image/${response.data.vehicle_details.insurance}">Download</a>  
        <img width="50%"  class="pop1" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.vehicle_details.insurance}">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_registration') }}<span class="text-danger">*</span></label>
        <a target="_blank" href="/admin/download-image/${response.data.vehicle_details.vehicle_registration}">Download</a>  
        <img  class="pop1" width="50%" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.vehicle_details.vehicle_registration}">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.pta_licence') }}<span class="text-danger">*</span></label>
        <a target="_blank" href="/admin/download-image/${response.data.vehicle_details.Vehicle_PTA_License}">Download</a>  
        <img  class="pop1" width="50%" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.vehicle_details.Vehicle_PTA_License}">
        </div>
        </div>
        </div>
        </div>

        </div>`;
        $(".driver_details_data").html(html);
        $('#exampleModal').modal('show');
        $(".pop1").click(function(){
          var data=  $(this).attr('data-type'); 
          var image_name=  $(this).attr('data-url'); 
 
          var download = '<a target="_blank" href="/admin/download-image/' + image_name + '">Download</a>';

          

          console.log("Download URL:", download);

          if(data=="image"){
            $('.imagepreview1').attr('src', $(this).attr('src'));
            $('.imagepreview1').show();
          }
          $('#imagemodal1').modal('show');
        });

        $(document).ready(function(){
          var len = $(".description").val().length;
          if (len >= 500) {
            val.value = val.value.substring(0, 501);
          } else {
            $('#charNum').text(500 - len+' character description');
          }
        });
// $(".close").on("click",function(){
//   $('#imagemodal1').modal('hide');  
// });

      }
    });

}


function driverUpdateDetailModalOpen(id){
    var url= "{{route('driver.show',':id')}}";
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
        console.log(response.driverPassword);
       // console.log(response.moreimage);
        var vehicle_type =response.data.vehicle_details.vehicle_type.name+'('+response.data.vehicle_details.vehicle_type.max_load +' '+response.data.vehicle_details.vehicle_type.max_load_unit +' , '+response.data.vehicle_details.vehicle_type.length +' '+response.data.vehicle_details.vehicle_type.unit +')';

        console.log('vehicle_type =>' +vehicle_type);


        var mydate = new Date(response.data.vehicle_details.insurance_expiry_date);

        var expiry_date = mydate.getDate() + '/' + (mydate.getMonth()+ 1)  + '/' + mydate.getFullYear();

        var html=`
        <form id="editDriverForm" method="post" action="{{ route('driver.update') }}" enctype="multipart/form-data">
        <input type="hidden" name="id" value="${id}">
        <div class="tab-content">  

        
        <div id="section1" class="tab-pane fade in active"> 
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.name') }}<span class="text-danger">*</span></label>
        <input class="form-control"   name="name" placeholder="" value="${response.data.name==null?'':response.data.name}">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.mobile') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" name="phone_number" id="phone_number" value="${response.data.phone_number==null?'':response.data.phone_number}" >
        </div>
        </div>
        {{--   <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.email') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder=""   value="${response.data.email==null?'':response.data.email}" readonly>
        </div>
        </div> --}}

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.city') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.city==null?'':response.data.city}"  readonly>
        </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>Password<span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" placeholder="" value="${response.driverPassword==null?'':response.driverPassword}" >
        </div>
        </div>

        {{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.address') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.address==null?'':response.data.address}" readonly>
        </div>
        </div> --}}

        {{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.zip_code') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" value="${response.data.zip_code==null?'':response.data.zip_code}"  readonly>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group form-wrapper position-relative">
        <label for="message-text" class="col-form-label">{{ __('adminlte::adminlte.description') }}<span class="text-danger">*</span></label>
        <textarea class="form-control description" rows="6" id="message-text" readonly>${response.data.driver_details.description==null?'':response.data.driver_details.description}</textarea>
        <div id="charNum"></div>
        </div>
        </div> --}}
        <div class="col-sm-12"></div>
        <div class="col-sm-6 ">
        <div class="form-group form-wrapper">
        <label >{{ __('adminlte::adminlte.driver_licence') }}<span class="text-danger">*</span></label>
        <img width="50%"  class="pop1" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.driver_details.driver_licence}">
        <input type="file" class="form-control" id="driver_licence" name="driver_licence">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.verification_id') }}<span class="text-danger">*</span></label>
        <img  class="pop1" width="50%" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.driver_details.verification_id}">
        <input type="file" class="form-control" name="verification_id">
        </div>

        </div> 
        <div class="col-sm-12">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.moreimage') }}  <span class="text-danger">*</span></label>

        </div>

        </div> 

        ${response.moreimage}

        </div>
        </div>
        <div id="section2" class="tab-pane fade">
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_type') }}<span class="text-danger">*</span></label>
        <select class="form-control" name="vehicle_type_id"  >
        ${response.vehicleTypes}
        </select>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.type_of_insurance') }}<span class="text-danger">*</span></label> 
        <select class="form-control" name="insurance_type_id"  >
        ${response.insuranceTypeList}
        </select>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.insurance_expiry_date') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" name="insurance_expiry_date" value="${expiry_date}" >
        </div>
        </div>
         

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_number') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" name="vehicle_number"  value="${response.data.vehicle_details.license_plate}" >
        </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.registration_year') }}<span class="text-danger">*</span></label> 
        <select class="form-control" name="vehicle_registration_year"  >
        ${response.vehicleRegistrationYearList}
        </select>
        </div>
        </div>


        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 ">
        <div class="form-group form-wrapper">
        <label >{{ __('adminlte::adminlte.vehicle_insurance') }}<span class="text-danger">*</span></label>
        <img width="50%"  class="pop1" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.vehicle_details.insurance}">
        <input type="file" class="form-control" name="insurance">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_registration') }}<span class="text-danger">*</span></label>
        <img  class="pop1" width="50%" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.vehicle_details.vehicle_registration}">
        <input type="file" class="form-control" name="vehicle_registration">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.pta_licence') }}<span class="text-danger">*</span></label>
        <img  class="pop1" width="50%" data-type="image" src="{{config('services.storage_image_path.web_path')}}/${response.data.vehicle_details.Vehicle_PTA_License}">
        <input type="file" class="form-control" name="Vehicle_PTA_License">
        </div>
        </div>
        </div>
         
        <button type="text"   class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
         
        </div>
        
        </div>
        </form>`;
        $(".driver_details_data").html(html);
        $('#exampleModal').modal('show');
        $(".pop1").click(function(){
          var data=  $(this).attr('data-type'); 
          if(data=="image"){
            $('.imagepreview1').attr('src', $(this).attr('src'));
            $('.imagepreview1').show();
          }
          $('#imagemodal1').modal('show');
        });

        $(document).ready(function(){
          var len = $(".description").val().length;
          if (len >= 500) {
            val.value = val.value.substring(0, 501);
          } else {
            $('#charNum').text(500 - len+' character description');
          }
        });
// $(".close").on("click",function(){
//   $('#imagemodal1').modal('hide');  
// });

      }
    });

}


 function AddNewDriver(){
    var url= "{{route('driver.add.details')}}";
     
    $.ajax({
      url: url,
      type: 'get',
       
      dataType: "JSON",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        console.log(response);
        
        var html=`
        <form id="addDriverForm" method="post" action="{{ route('driver.add') }}" enctype="multipart/form-data">
         <input type="hidden" name="transport_id" value="<?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo substr($actual_link, strrpos($actual_link, '/') + 1); ?>" > 
        <div class="tab-content">  

        
        <div id="section1" class="tab-pane fade in active"> 
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.name') }}<span class="text-danger">*</span></label>
        <input class="form-control" required  name="name" placeholder="Driver Name">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.mobile') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="Mobile NUmber" name="phone_number" id="phone_number" >
        </div>
        </div>
        {{--   <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.email') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" readonly>
        </div>
        </div> --}}

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.city') }}<span class="text-danger">*</span></label>
        <input type="text" name="city" class="form-control" placeholder="City Optional" >
        </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>Password<span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" placeholder="Password" >
        </div>
        </div>

        {{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.address') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder=""  readonly>
        </div>
        </div> --}}

        {{--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.zip_code') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" readonly>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group form-wrapper position-relative">
        <label for="message-text" class="col-form-label">{{ __('adminlte::adminlte.description') }}<span class="text-danger">*</span></label>
        <textarea class="form-control description" rows="6" id="message-text" readonly></textarea>
        <div id="charNum"></div>
        </div>
        </div> --}}
        <div class="col-sm-12"></div>
        <div class="col-sm-6 ">
        <div class="form-group form-wrapper">
        <label >{{ __('adminlte::adminlte.driver_licence') }}<span class="text-danger">*</span></label>
        <input type="file" class="form-control" id="driver_licence" name="driver_licence">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.verification_id') }}<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="verification_id">
        </div>

        </div> 
          

        </div>
        </div>
        <div id="section2" class="tab-pane fade">
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_type') }}<span class="text-danger">*</span></label>
        <select class="form-control" name="vehicle_type_id"  >
        ${response.vehicleTypes}
        </select>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.type_of_insurance') }}<span class="text-danger">*</span></label> 
        <select class="form-control" name="insurance_type_id"  >
        ${response.insuranceTypeList}
        </select>
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.insurance_expiry_date') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" name="insurance_expiry_date" >
        </div>
        </div>
         

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_number') }}<span class="text-danger">*</span></label>
        <input class="form-control" placeholder="" name="license_plate"  >
        </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.registration_year') }}<span class="text-danger">*</span></label> 
        <select class="form-control" name="vehicle_registration_year"  >
        ${response.vehicleRegistrationYearList}
        </select>
        </div>
        </div>


        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 ">
        <div class="form-group form-wrapper">
        <label >{{ __('adminlte::adminlte.vehicle_insurance') }}<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="insurance">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.vehicle_registration') }}<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="vehicle_registration">
        </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">
        <div class="form-group form-wrapper">
        <label>{{ __('adminlte::adminlte.pta_licence') }}<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="Vehicle_PTA_License">
        </div>
        </div>
        </div>
         
        <button type="text"   class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
         
        </div>
        
        </div>
        </form>`;
        $(".driver_details_data").html(html);
        $('#exampleModal').modal('show');
        $(".pop1").click(function(){
          var data=  $(this).attr('data-type'); 
          if(data=="image"){
            $('.imagepreview1').attr('src', $(this).attr('src'));
            $('.imagepreview1').show();
          }
          $('#imagemodal1').modal('show');
        });

        $(document).ready(function(){
          var len = $(".description").val().length;
          if (len >= 500) {
            val.value = val.value.substring(0, 501);
          } else {
            $('#charNum').text(500 - len+' character description');
          }
        });
// $(".close").on("click",function(){
//   $('#imagemodal1').modal('hide');  
// });

      }
    });

}
</script>
<script>
  $(".pop").click(function(){

    var data=  $(this).attr('data-type');

    if(data=="image"){
      $('.imagepreview').attr('src', $(this).attr('src'));
      $('.imagepreview').show();
    }
    $('#imagemodal').modal('show');
  });

  $(".close").on("click",function(){
    $('#imagemodal').modal('hide');  
  });

function driverUpdateMobile(id){

  var name                      = $('#name').val();
  var phone_number              = $('#phone_number').val();
  var vehicle_type_id           = $('#vehicle_type_id').val();
  var insurance_type_id         = $('#insurance_type_id').val();
  var insurance_expiry_date     = $('#insurance_expiry_date').val();
  var vehicle_number            = $('#vehicle_number').val();
  var vehicle_registration_year = $('#vehicle_registration_year').val(); 

  var file_data = $('#driver_licence').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);

  var url= "{{route('driver.update')}}"; 

    $.ajax({
      url: url,
      type: 'POST',  
      processData: false,
      contentType: false,
      data:$('#editDriverForm').serialize() 
      // {
      //   "id"                        :id,
      //   "name"                      :name,
      //   "phone_number"              :phone_number,
      //   "vehicle_type_id"           :vehicle_type_id,
      //   "insurance_type_id"         :insurance_type_id,
      //   "insurance_expiry_date"     :insurance_expiry_date,
      //   "vehicle_number"            :vehicle_number,
      //   "vehicle_registration_year" :vehicle_registration_year,

      // }
      ,
      dataType: "JSON",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {

        if(response==1){ 
          swal("Success!", "Data updated Successfully", "success");
          setTimeout(() => {
                window.location.reload();
                }, 700);
          ;
        }else{ 
          swal("Error!", "Mobile Number already exist. Please try other Mobile Number", "error");
        }
      }

    });

};

function openForwardModal(id){

  $.ajax({
        type:'POST',
        url:"{{route('check.job.accepted')}}",
        data:{
          "_token"      : "{{ csrf_token() }}",
          "id"   :id, 
        },
        success:function(response){
          console.log(response.data);
          if(response.data==''){
            $("#quote_id").val(id);
            $("#farwardQuoteModal").modal("show"); 
          }else{
            Swal.fire({ 
                  text: "This Job is Already Accepted by this Driver " +"' "+response.data[0].name+" '",
                  icon: "error", 
                });
          }
           
        }
      });

  
}
function forwardQuote(){ 
   if($("#driver_id").val()=='' || $("#driver_id").val()==null){
      Swal.fire({ 
      text: "All Drivers are offine",
      icon: "error", 
    });
      return false;
    }
  $('#farwardQuoteModal').modal('hide');
  Swal.fire({
    title: "Are you sure",
    text: "You want to forward this quotation",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: "Yes forward it",
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
        type:'POST',
        url:"{{route('forward.quotation')}}",
        data:{
          "_token"      : "{{ csrf_token() }}",
          "driver_id"   :$("#driver_id").val(),
          "quote_id"    : $("#quote_id").val(),
        },
        success:function(response){

          Swal.fire(
          //  "{{__('web.accepted')}}",
            "Your job has been forworded Successfully"
          
          )
          Swal.fire({ 
                  text: "Your job has been forworded Successfully",
                  icon: "success", 
                });
          $("#farwardQuoteModal").modal("hide");
        }
      });
  
    }
  });
}
$(".secondary_btn").click(function(){
  $("#farwardQuoteModal").modal("hide");
});

</script>

@stop
