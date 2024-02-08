@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <div class="card-header">
              <h3>{{ __('adminlte::adminlte.roles') }}</h3>
              @can('add_role')
              <a class="btn btn-sm btn-success float-right clear" href="add">Create New Role</a>
              @endcan
            </div>
            <div class="card-body">
            
            <!--  <a class="btn btn-sm btn-success float-right clear" href="add">Create New Role</a> -->
            
              <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>{{ __('adminlte::adminlte.name') }}</th>
                  
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < count($roles); $i++) { ?>
                    <tr>
                      <th class="display-none"></th>
                      <td>{{ $roles[$i]->name }}</td>
                      
                      <td>
                        @can('view_role')
                          <a href="{{ route('view_role', ['id' => $roles[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                        @endcan
                        @can('edit_role')
                          <a title="Edit" href="{{ route('edit_role', ['id' => $roles[$i]->id]) }}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_role')
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $roles[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                        @endcan
                      
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
Swal.fire({
       title: "Are you sure?",
            text: "Are you sure you want to delete this Role?",
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Recycle Bin',
            denyButtonText: `Delete Forever`,
            cancelButtonText:'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        var link = "{{ route('delete_role') }}";
        deleteFunctionalityCommonMethod(id,link);
        
      } else if (result.isDenied) {
        var link = "{{ route('delete_role_permanantly') }}";
        deleteFunctionalityCommonMethod(id,link);
      }else{
        console.log('canceled');
      }
    });

    });
  </script>
@stop
