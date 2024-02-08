@extends('adminlte::page')

@section('title', 'Deleted Admins')

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
              <h3>{{ __('adminlte::adminlte.deleted_admins') }}</h3>
              <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>         
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <table style="width:100%" id="deleted-jobseekers-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>{{ __('adminlte::adminlte.name') }}</th>
                    <th>{{ __('adminlte::adminlte.email') }}</th>
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  
                    <!-- @can('manage_recycle_bin_users') -->
                      
                    <!-- @endcan -->
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < count(is_countable($admins)?$admins:[]); $i++) { ?>
                  <tr id="user_row_{{ $admins[$i]->id }}">
                    <td class="display-none"></td>
                    <td>{{ $admins[$i]->full_name }}</td>
                    <td>{{ $admins[$i]->email }}</td>
              
                  
                      <td>
                      <a class="action-button restore-button" title="Restore" href="javascript:void(0)" data-id="{{ $admins[$i]->id}}"><i class="text-success fa fa-undo"></i></a>
                      <a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $admins[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>
                      <!-- @can('manage_recycle_bin_users') -->
                      <!-- @can('restore_user') -->
                    
                      <!-- @endcan
                      @can('permanent_delete_user') -->
                      
                    <!-- @endcan -->
                    <!-- @endcan -->
                      </td>
                  
                  </tr>
                  <?php } ?>
                </tbody>
                
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

  <style>
    /* .action-button {
      margin-left: 5px;
    } */
  </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#deleted-jobseekers-list').DataTable( {
        stateSave: true,
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });

    $('.restore-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to restore the Admin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          //console.log("id", id);
          $.ajax({
            url: "{{ route('restore_admins') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response == 1) {
                $("#user_row_"+id).remove();
                $("#flash-message").removeClass("d-none");
                $("#flash-message").addClass("alert-success");
                $("#flash-message").css("display","block");
                $("#flash-message").text("Restored Successfully");
                setTimeout(function(){ $("#flash-message").remove(); }, 4000);
                /* console.log("response", response);
                obj.parent().parent().remove(); */
              } else {
               setTimeout(function () {  
                swal("Error!", "Something went wrong.", "error");  
              }, 500);  
              }
            }
          });
        } 
      });
    });

    
    $('.remove-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Permanently Delete this Record?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('permanent_delete_admins') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                 $("#user_row_"+id).remove();
                $("#flash-message").removeClass("d-none");
                $("#flash-message").addClass("alert-danger");
                $("#flash-message").css("display","block");
                $("#flash-message").text("Deleted Successfully");
                setTimeout(function(){ $("#flash-message").css("display","none"); }, 4000);
                /* console.log("response", response);
                obj.parent().parent().remove(); */
              }
              else {
                swal("Error!", "Something went wrong! Please try again.", "error");
                // console.log("FALSE");
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
    });
  </script>
@stop
