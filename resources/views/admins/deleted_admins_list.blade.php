@extends('adminlte::page')

@section('title', 'Deleted Admins')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
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
            <table style="width:100%" id="exampleTable" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <!-- <th>Email Verified</th> -->
                  <!-- <th>Permissions</th> -->
                  @can('manage_recycle_bin_admins')
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count((is_countable($deletedAdmins)?$deletedAdmins:[])); $i++) { ?>
                  <tr>
                  <th class="display-none"></th>
                    <td>{{ $deletedAdmins[$i]->email }}</td>
                    <td>{{ $deletedAdmins[$i]->name }}</td>
                    <!-- <td>True</td> -->
                    <!-- <th>View</th> -->
                    @can('manage_recycle_bin_admins')
                      <td>
                        <!-- <a class="action-button" title="View" href="{{ route( 'view_admin', [ 'id' => $deletedAdmins[$i]->id ] ) }}"><i class="text-info fa fa-eye"></i></a> -->
                        @can('restore_admins')
                          <a class="action-button restore-button" title="Restore" href="javascript:void(0)" data-id="{{ $deletedAdmins[$i]->id}}"><i class="text-success fa fa-undo"></i></a>
                        @endcan
                        @can('permanent_delete_admins')
                          <a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $deletedAdmins[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>
                        @endcan
                      </td>
                    @endcan
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <!-- <th>Email Verified</th> -->
                  <!-- <th>Permissions</th> -->
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
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
          console.log("id", id);
          $.ajax({
            url: "{{ route('restore_admin') }}",
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
                window.location.reload();
                /* console.log("response", response);
                obj.parent().parent().remove(); */
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
            url: "{{ route('permanent_delete_admin') }}",
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
                window.location.reload();
                /* console.log("response", response);
                obj.parent().parent().remove(); */
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
    });
  </script>
@stop
