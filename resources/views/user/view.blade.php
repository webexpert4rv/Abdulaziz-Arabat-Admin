@extends('adminlte::page')

@section('title', 'User Information')

@section('content_header')
@stop

@section('content')

<ul class="nav nav-tabs" id="myTab"> 
  <li class="active">
    <a data-toggle="tab" href="#sectionD">User Details</a>
  </li> 
  <li>
    <a data-toggle="tab" href="#sectionE">Jobs</a>
  </li>
  <li>
    <a data-toggle="tab" href="#paymentcard">Payment Cards</a>
  </li> 

  <li><a data-toggle="tab" href="#sectionF">Transactions</a></li>
  <li>
    <a data-toggle="tab" href="#notifications">Notifications</a>
  </li> 
</ul> 
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="tab-content"> 

           <div id="paymentcard" class="tab-pane fade"> 
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="card">


                    <!-- @foreach ($getsaveCard as $key => $value)

                    <div class="selecotr-item div_hide_{{$value->id}}">

                     <label for="radio_{{$value->id}}" class="selector-item_label d-flex align-item-center justify-content-between">
                      <div class="d-flex align-items-center">
                        <img src="{{asset($value->image)}}" width="100" />
                        <div class="card_detail_ad ms-4">
                          <h5 class="mb-0">**** **** **** {{substr($value->card_number,-4)}}</h5>
                          <p class="mb-0">{{__('web.expires')}} {{$value->month}}/{{$value->year}}</p>
                        </div>
                      </div>
                     
                      </label>
                    </div>
                    @endforeach   -->
                    <div class="table-responsive card-body">
                      <table style="width:100%" id="exampleTable1" class="table table-bordered table-hover datatable">                       
                        <tbody id="tbody">
                          @foreach($getsaveCard as $key=>$value)
                          <tr>
                            <td>{{$key+1}}</td>                                                        
                            <td> <img src="{{env('STORAGE_PATH')}}/{{$value->image}}"  onerror="this.src='{{env('STORAGE_PATH')}}/storage/Card_Images/Visa_logo.png'" width="100" /> 
                            </td>                                                        
                            <td>
                              <h5 class="mb-0">**** **** **** {{substr($value->card_number,-4)}}</h5>                            
                              <p class="mb-0">Expires {{$value->month}}/{{$value->year}}</p></td>

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


            <div id="notifications" class="tab-pane fade"> 
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <div class="card">
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


             <div id="sectionD" class="tab-pane fade in active"> 
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-12 p-0">
                    <div class="card">
                            <!-- <div class="card-header alert d-flex justify-content-between align-items-center">
                              <h3>{{ __('adminlte::adminlte.user_detail') }}</h3> <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> 
                            </div> -->
                            <div class="card-body"> @if (session('status'))
                              <div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif
                              <form class="form_wrap">
                                <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                  <div class="form-group">
                                    <label>Profile Image</label>                                         
                                    <!-- <img  style="width: 25%;" src="{{env('STORAGE_PATH')}}/{{$user->profile_image}}"> -->
                                    <img  style="width: 25%;" src="{{config('services.storage_image_path.web_path')}}/{{$user->profile_image}}">
                                  </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                  <div class="form-group">
                                    <label>User ID</label>
                                    <input class="form-control" placeholder="{{@$user->unique_ID}}" readonly> </div>
                                  </div>
                                  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                    <div class="form-group">
                                      <label>{{ __('adminlte::adminlte.name') }}</label>
                                      <input class="form-control" placeholder="{{@$user->name}}" readonly> </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.email') }}</label>
                                        <input class="form-control" placeholder="{{@$user->email}}" readonly> 
                                      </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.mobile') }}</label>
                                        <input class="form-control" placeholder="{{@$user->country_code}} {{@$user->phone_number}}" readonly>
                                      </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.city') }}</label>
                                        <input class="form-control" placeholder="{{@$user->city??'N/A'}}" readonly> 
                                      </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.address') }}</label>
                                        <input class="form-control" placeholder="{{@$user->address??'N/A'}}" readonly>
                                      </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.zip_code') }}</label>
                                        <input class="form-control" placeholder="{{@$user->zip_code??'N/A'}}" readonly>
                                      </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.account_type') }}</label>
                                        <input class="form-control" placeholder="@if($user->account_type==0)Personal  @endif @if($user->account_type==1) Business @endif" readonly>
                                      </div>
                                    </div> @if($user->company_name)
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.company_name') }}</label>
                                        <input class="form-control" placeholder="{{@$user->company_name}}" readonly> 
                                      </div>
                                    </div> @endif

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group form-wrapper">
                                        <label>Push Notifications</label>
                                        <input class="form-control" placeholder="" value="{{$user->is_push_notifications==0?'OFF':'ON'}}" readonly>
                                      </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group form-wrapper">
                                        <label>Email Notifications</label>
                                        <input class="form-control" placeholder="" value="{{$user->is_email_notifications==0?'OFF':'ON'}}" readonly>
                                      </div>
                                    </div> 
                                    

                                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group form-wrapper">
                                        <label>Referrer code</label>
                                        <input class="form-control" placeholder="" value="{{$user->referrer_code}}" readonly>
                                      </div>
                                    </div>


                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>Commission for User</label>
                                        <input class="form-control" placeholder="{{@$user->commission}}" readonly>
                                      </div>
                                    </div>




                                    {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                      <div class="form-group">
                                        <label>{{ __('adminlte::adminlte.created_date') }}</label>
                                        <input class="form-control" placeholder="{{date('Y-m-d',strtotime($user->created_at))}}" readonly> </div>
                                      </div>
                                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                        <div class="form-group">
                                          <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                                          <input class="form-control" placeholder="{{date('Y-m-d',strtotime($user->updated_at))}}" readonly> </div>
                                        </div> --}}
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                        <div id="sectionE" class="tab-pane fade"> 
                          <div class="container">
                            <div class="row justify-content-center">

                              <div class="col-md-12 p-0"> 
                                <div class="card">
                                  <div class="row">

                                    <div class="col-sm-3">
                                      <div class="small-box teacher">
                                        <div class="inner">

                                          <div class="right text-left">
                                            <p>Total Jobs</p>
                                            <h3>{{$total_jobs->total_jobs_count}}</h3>
                                          </div>
                                        </div>

                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="small-box student">
                                        <div class="inner">

                                          <div class="right text-left">
                                            <p>Current Jobs</p>
                                            <h3>{{$current_jobs->current_jobs_count}}</h3>
                                          </div>
                                        </div>

                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="small-box school">
                                        <div class="inner">

                                          <div class="right text-left">
                                            <p>Upcoming jobs</p>
                                            <h3>{{$upcomming_jobs->upcoming_jobs_count}}</h3>
                                          </div>
                                        </div>

                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="small-box admin">
                                        <div class="inner">

                                          <div class="right text-left">
                                            <p>Completed Jobs</p>
                                            <h3>{{$completed_jobs->completed_jobs_count}}</h3>
                                          </div>
                                        </div>

                                      </div>
                                    </div>

                                  </div>
                                  <div class="table-responsive card-body">
                                    <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                                      <thead>
                                        <tr>
                                          <th>Sr.No.</th>
                                          <th>{{ __('adminlte::adminlte.job_id') }}</th>
                                          <th>{{ __('adminlte::adminlte.job_name') }}</th>
                                          <th>{{ __('adminlte::adminlte.pickup_address') }}</th>
                                          <th>{{ __('adminlte::adminlte.destination_address') }}</th>
                                          <th>{{ __('adminlte::adminlte.user_name') }}</th>
                                          <th>{{ __('adminlte::adminlte.status') }}</th>
                                          <th>Created at</th>
                                          <th>{{ __('adminlte::adminlte.actions') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody id="tbody"> 
                                        <?php $i=1;?>
                                        @foreach($total_jobs->totalJobs as $key=>$upcoming_job)
                                        @if(@$upcoming_job->status=='in-progress')
                                        <tr>
                                          <td>{{@$i++}}</td>
                                          <td>{{@$upcoming_job->job_ID}}</td>
                                          <td>{{@$upcoming_job->title}}</td>
                                          <td>@if(@$upcoming_job->PickupRegion->name){{@$upcoming_job->PickupRegion->name}}, {{@$upcoming_job->PickupSubRegion->name}} @endif
                                          </td>
                                          <td>@if(@$upcoming_job->JobReceiver->DestinationRegion->name){{@$upcoming_job->JobReceiver->DestinationRegion->name}}, {{@$upcoming_job->JobReceiver->DestinationSubRegion->name}} @endif</td>
                                          <td>{{@$upcomming_jobs->name}}</td>
                                          <td>
                                            <a class="action-button btn"  href="javascript:void(0)"><span >
                                             {{str_replace('-', " ", @$upcoming_job->status)}}</span></a>

                                           </td>
                                           <td>{{date('d/m/Y',strtotime(@$upcoming_job->created_at))}}</td>
                                           <td>
                                             <a class="action-button" title="View" href="{{route('jobs.show',$upcoming_job->id)}}"><i class="text-info fa fa-eye"></i></a> 
                                             <a class="action-button delete-button" onclick="jobDelete({{$upcoming_job->id}})" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a> </td>
                                           </tr> 
                                           @endif
                                           @endforeach 
                                           @foreach($total_jobs->totalJobs as $key=>$upcoming_job)
                                           @if(@$upcoming_job->status!='in-progress')
                                           <tr>
                                            <td>{{@$i++}}</td>
                                            <td>{{@$upcoming_job->job_ID}}</td>
                                            <td>{{@$upcoming_job->title}}</td>
                                            <td>@if(@$upcoming_job->PickupRegion->name){{@$upcoming_job->PickupRegion->name}}, {{@$upcoming_job->PickupSubRegion->name}} @endif
                                            </td>
                                            <td>@if(@$upcoming_job->JobReceiver->DestinationRegion->name){{@$upcoming_job->JobReceiver->DestinationRegion->name}}, {{@$upcoming_job->JobReceiver->DestinationSubRegion->name}} @endif</td>
                                            <td>{{@$upcomming_jobs->name}}</td>
                                            <td>{{@$upcoming_job->status}}</td>
                                            <td>{{date('d/m/Y',strtotime(@$upcoming_job->created_at))}}</td>
                                            <td> <a class="action-button" title="View" href="{{route('jobs.show',$upcoming_job->id)}}"><i class="text-info fa fa-eye"></i></a> <a class="action-button delete-button" onclick="jobDelete({{$upcoming_job->id}})" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a> </td>
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


                          <div id="sectionF" class="tab-pane fade"> 
                            <div class="container">
                              <div class="row justify-content-center">
                                <div class="col-md-12">
                                  <div class="card">
                                  <!--   <div class="table-responsive card-body">
                                      <table style="width:100%" id="exampleTabletas" class="table table-bordered table-hover datatable"> -->

                                     <table style="width:100%" id="exampleTabletas" class="table table-bordered table-hover datatable">
                                       <thead>
                                        <tr>
                                          <th >Sr.No.</th>
                                          <th>{{ __('adminlte::adminlte.booking_id') }}</th>
                                          <th>{{ __('adminlte::adminlte.job_id') }}</th>
                                          <th>{{ __('adminlte::adminlte.driver_name') }}</th>
                                          <th>{{ __('adminlte::adminlte.transaction_id') }}</th>
                                          <th>{{ __('adminlte::adminlte.amount') }}</th>
                                          <th>{{ __('adminlte::adminlte.created_at') }}</th>
                                          <th>{{ __('adminlte::adminlte.actions') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody id="tbody">
                                        @php $counter = 0; @endphp
                                        @foreach($transactions as $key=>$transaction)
                                        @if(!empty($transaction->job->job_ID))
                                        <tr>
                                          <td>{{$counter+1}}</td>                                                        
                                          <td>{{@$transaction->booking->book_id}}</td>
                                          <td>{{@$transaction->job->job_ID}}</td>
                                          <td>{{@$transaction->driver->name}}</td>
                                          <td>{{@$transaction->transaction_id}}</td>                      
                                          <td>{{@$transaction->amount}}</td>
                                          <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                                          <td>
                                           <a class="action-button" title="Job Details" href="{{route('jobs.show',@$transaction->job->id)}}"><i class="text-info fa fa-eye"></i></a>
                                           <!-- <a class="action-button" title="View" href="{{route('payments.show',$transaction->id)}}"><i class="text-info fa fa-eye"></i></a> -->
                                         </td> 
                                       </tr>
                                         @php $counter++; @endphp
                                       @endif
                                       @endforeach
                                     </tbody>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div> 
                       </div> 
                     </div>
                   </div>
                 </div>
               </div>
             </section>

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
    $('#exampleTable').DataTable();
    $('#exampleTabletas').DataTable();
    $('#exampleTable1').DataTable();
  });


  function jobDelete(id){

    swal({
      title: "Are you sure?",
      text: "Are you sure you want to delete the job?",
      type: "warning",
      showCancelButton: true,
    }, function(willDelete) {
      if (willDelete) {
        var url = "{{ route('job.delete', ":id") }}";
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
            if(response.success == 1) {
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
</script>


@stop
