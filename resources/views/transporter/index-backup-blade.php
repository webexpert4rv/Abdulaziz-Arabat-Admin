@extends('adminlte::page')

@section('title', 'Transporter')

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
                <h3>{{ __('adminlte::adminlte.transporter') }}</h3>
                <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
              
              
              </div> 
              <form action="{{route('export-user',['type'=>'transporter'])}}" method="get" id="filterForm">
                 
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
                      <th>{{ __('adminlte::adminlte.transporterId') }}</th>
                      <th>{{ __('adminlte::adminlte.email') }}</th>
                      <th>{{ __('adminlte::adminlte.name') }}</th>                   
                      <th>Status</th>
                      <th>Approvel Status</th>
                      <th>{{ __('adminlte::adminlte.actions') }}</th>
                    </tr>
                  </thead>
                    <tbody id="tbody">
                  @foreach($transporters as $key=>$transporter)
                      <tr class="row_{{$transporter->id}}">
                          <td >{{$key+1}}</td>
                          <td>{{$transporter->unique_ID}}</td>
                          <td>{{$transporter->email}}</td>
                          <td>{{$transporter->name}}</td> 
                          <td> 
                            @can('edit_transporter') 
                            <label class="switch">
                              <input type="checkbox" onchange="updateStatus({{$transporter->id}})" type="checkbox" id="demo{{$transporter->id}}" {{$transporter->status==1?'checked':''}}>
                              <span class="slider round"></span>
                            </label>
                            @endcan
                          </td>
                          <td class="approve_css approve_status{{$transporter->id}}">
                            <div class="loader_css
                            forgot_loader_img{{$transporter->id}}">
                        
                            </div>
                            @can('edit_transporter') 
                            @if($transporter->is_approve==0)
                            <a class="action-button btn btn-danger" onclick="transporterApproveStatus({{$transporter->id}},1)" href="javascript:void(0)">Pending</a>
                            @else
                            <a class="action-button btn btn-success"  onclick="transporterUnApproveStatus({{$transporter->id}},0)"  href="javascript:void(0)">Approved</a>
                            @endif
                           @endcan
                          </td>
                          <td>
                          @can('view_transporter') 
                            <a class="action-button" title="View" href="{{route('transporters.show',$transporter->id)}}"><i class="text-info fa fa-eye"></i></a>
                          @endcan
                          @can('edit_transporter') 
                            <a class="action-button" title="Edit" href="{{route('transporters.edit',$transporter->id)}}"><i class="text-warning fa fa-edit"></i></a>
                          @endcan
                          @can('delete_transporter') 
                            <a class="action-button delete-button" onclick="transporterDelete({{$transporter->id}})"title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                          @endcan
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
  </div>
</section>
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
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
 
 function transporterDelete(id){

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete the transporter?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
          $.ajax({
            url: "transporters/"+id,
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
                $('.row_'+id).remove();
               // window.location.reload();
               
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                alert("Something went wrong! Please try again.");
                }, 500);
                // swal("Error!", "Something went wrong! Please try again.", "error");
                // swal("Something went wrong! Please try again.");
              }
            }
          });
        } 
      });
  }
    function transporterUnApproveStatus(id,status){
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to unapprove the transporter?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
          $.ajax({
            url: "{{route('transport.unapprove.status')}}",
            type: 'post',
            data: {
               "id"      :   id,
               "status"  :   status,
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            
            success: function(response) {
             
              $(".approve_status"+id).html('<div class="loader_css forgot_loader_img'+id+'"></div><a class="action-button btn btn-danger" onclick="transporterApproveStatus('+id+',1)" href="javascript:void(0)">Pending</a>');
              
            }
          });
        } 
      });
    }
    function transporterApproveStatus(id,status){

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to approve the transporter?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
          $.ajax({
            url: "{{route('transport.approve.status')}}",
            type: 'post',
            data: {
               "id"      :   id,
               "status"  :   status,
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
              $(".forgot_loader_img"+id).append('<img src="{{asset('images/loader_transparent.gif')}}" class="mx-auto d-block w-25">');
               
             },
            success: function(response) {
             
              $(".approve_status"+id).html(' <div class="loader_css forgot_loader_img'+id+'"></div><a class="action-button btn btn-success" onclick="transporterUnApproveStatus('+id+',0)" href="javascript:void(0)">Approved</a>');
              $(".forgot_loader_img"+id).css("display","none");
              
            }
          });
        } 
      });
    }

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


      console.log('transporters');
      var date_range = $('input[name="date_range"]').val().split('-');  
      var current = $('.current').text();  
      var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 
      var type= "transporter";
      if(date_range.length==1)
        return false;
      $.ajax({
           url: "{{route('transporters.filter')}}",
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
    });

    $('body').on('click','.reset-button',function(){
      
     
      var date_range = $('input[name="date_range"]').val().split('-');   
      if(date_range.length==1){
        return false;
      }
      var current = $('.current').text();  
      var limit = $('select[name="exampleTable_length"]').find(":selected").text(); 
      var type= "transporter";
      $('input[name="date_range"]').val('');
      $('.advance_options_btn').hide();
      
      $.ajax({
           url: "{{route('transporter.reset')}}",
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
    });


    $('.xlsbtn').click(function(){
       
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('export-user',['type'=>'transporter'])}}");
    });
    $('.csvbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('csv-user',['type'=>'transporter'])}}");
    });
    $('.pdfbtn').click(function(){
        $('input').attr('name', 'search');
        $('.date_range').attr('name', 'date_range');
        $("#filterForm").attr("action", "{{route('pdf-user',['type'=>'transporter'])}}");
    });
  </script>
  <!-- filters  -->
@stop
