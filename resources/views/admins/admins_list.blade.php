@extends('adminlte::page')

@section('title', 'Admins')

@section('content_header')
@stop

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <!--  <div class="card-header alert d-flex justify-content-between align-items-center">
                <h3></h3>
                <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
              </div> -->


            <!--  <div class="card-body">
                    <div class="text-right">
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
                                            <i class="fas fa-calendar-alt mr-2"></i><input type="text" name="date_range" class="form-control" autocomplete="off">
                                          </div>
                                        <button class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                                        <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                                      </div>
                                  </div>
                                </div>
                                <div class="advance_options_btn" style="display: none;">  
                                  <button class="btn btn-primary export-bulk-invoices"><i class="fas fa-download mr-2"></i>Download bulk invoices</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div> -->
            <div class="card-header alert d-flex justify-content-between align-items-center">
              <h3>{{ __('adminlte::adminlte.admins') }}</h3>
              @can('add_admins')
              <a class="btn btn-sm btn-success" href="add">Add Admin</a>
              @endcan
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
                    <th class="">Sr.No.</th>
                    <th>{{ __('adminlte::adminlte.email') }}</th>
                    <th>{{ __('adminlte::adminlte.name') }}</th>
                    <th>{{ __('adminlte::adminlte.role') }}</th>
                    
                    <th>Created at</th>
                    <th>Last updated at</th>
                    <th>Status</th>
                  
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                    
                  </tr>
                </thead>
                <tbody id="tbody">
                  @foreach($adminsList as $key=>$admin)
                    <tr class="row_{{$admin->id}}">
                      <td class="">{{$key+1}}</td>
                      <td>{{ @$admin->email }}</td>
                      <td>{{ @$admin->full_name }}</td>
                      <td>{{ @$admin->role->name }}</td>
                      @if(@$admin->created_at)
                      <td>{{@$admin->created_at->timezone(session('timezone')??'UTC')->format('d/m/Y')}}</td>
                      <td>{{@$admin->updated_at->timezone(session('timezone')??'UTC')->format('d/m/Y')}}</td>
                      @else
                       <td> </td>
                       <td> </td>
                      @endif

                      <td>
                      @can('edit_admins')
                      @if($admin_user->id!=$admin->id)
                        <label class="switch">
                          <input type="checkbox" onchange="updateStatus({{$admin->id}},{!! $admin->status == 1 ? '0' : '1' !!})" type="checkbox" id="demo{{$admin->id}}" {{$admin->status==1?'checked':''}}>
                          <span class="slider round"></span>
                        </label>
                        @endif
                      @endcan
                      </td>
                      <td>
                        
                        @can('view_admins')
                          <a class="action-button" title="View" href="view/{{$admin->id}}"><i class="text-info fa fa-eye"></i></a>
                        @endcan 
                        @can('edit_admins')
                          <a class="action-button" title="Edit" href="edit/{{$admin->id}}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_admins')
                          @if($admin_user->id!=$admin->id)
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $admin->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                          @endif
                        @endcan
                      </td>
                      
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>{{ __('adminlte::adminlte.name') }}</th>
                    <th>{{ __('adminlte::adminlte.email') }}</th>
                    <th>{{ __('adminlte::adminlte.role') }}</th>
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  </tr>
                </tfoot>
              </table>
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

  <!-- date filter -->
  <script type="text/javascript">
    $(document).ready(function() {
       var today = new Date();
       var dd = String(today.getDate()).padStart(2, '0');
       var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
       var yyyy = today.getFullYear();
   
       today = mm + '/' + dd + '/' + yyyy;
   
     $('input[name="date_range"]').daterangepicker({
       "startDate": today,
       "endDate": today,
       "autoApply": true,
       autoUpdateInput: false,
       locale: {
           cancelLabel: 'Clear'
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

  <script>    
    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      Swal.fire({
   title: "Are you sure?",
        text: "Are you sure you want to delete this Admin?",
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Recycle Bin',
        denyButtonText: `Delete Forever`,
        cancelButtonText:'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    var link = "{{ route('delete_admin') }}";
    deleteFunctionalityCommonMethod(id,link);
    
  } else if (result.isDenied) {
    var link = "{{ route('delete_admin_permanantly') }}";
    deleteFunctionalityCommonMethod(id,link);
  }else{
    console.log('canceled');
  }
});
    });
  </script>



  <script type="text/javascript">
    $('body').on('click','.apply-filter',function(){
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-');   
      if(date_range.length==1)
        return false;
      $.ajax({
           url: '{{ route('admins.filter') }}',
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
      console.log('filter now');
      var date_range = $('input[name="date_range"]').val().split('-');   
      if(date_range.length==1){
        return false;
      }

      $('input[name="date_range"]').val('');
      $('.advance_options_btn').hide();
      
      $.ajax({
           url: '{{ route('admins.filter') }}',
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
  </script>

<script>
 function updateStatus(id,status){ 
      $.ajax({
            type: 'POST',
            url: "{{route('update.admin.status')}}",
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

@stop
