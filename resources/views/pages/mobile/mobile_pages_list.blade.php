@extends('adminlte::page')

@section('title', 'Mobile Pages')

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
              <h3>{{ __('adminlte::adminlte.mobile_pages') }}</h3>
              @can('add_mobile_content')
              <a class="btn btn-success" href="{{ route('add_mobile_page') }}">Create Mobile Page</a>
              @endcan
            </div>
            <div class="card-body">
              <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>Title</th>
                    <!-- <th>Section</th>
                    <th>Status</th> -->
                    @can('manage_mobile_content_action')<th>Actions</th>@endcan
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < count($mobilePagesList); $i++) { ?>
                    <tr>
                      <td class="display-none"></td>
                      <td>{{ $mobilePagesList[$i]->title }}</td>
                      <!-- <td>{{ $mobilePagesList[$i]->section }}</td> -->
                      <!-- <td class="{{ $mobilePagesList[$i]->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $mobilePagesList[$i]->status == 'active' ? "Active" : "Inactive" }}</td> -->
                  
                        <td>
                           @can('view_mobile_content')
                            <a href="{{ route('view_mobile_page', ['id' => $mobilePagesList[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                            @endcan
                            @can('edit_mobile_content')
                            <a href="{{ route('edit_mobile_page', ['id' => $mobilePagesList[$i]->id]) }}" title="Edit"><i class="text-warning fa fa-edit"></i></a>
                        
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
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#pages-list').DataTable( {
      stateSave: true,
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
  </script>
@stop
