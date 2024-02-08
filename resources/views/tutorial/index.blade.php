@extends('adminlte::page')

@section('title', 'Website Pages')

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
              <h3>{{ __('adminlte::adminlte.website_pages') }}</h3>
              @can('add_website_content')
              <a class="btn btn-success" href="{{ route('tutorials.create') }}">Create Tutorial</a>
              @endcan
            </div>
            <div class="card-body">
              <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="display-none"></th>
                    <th>Title</th>
                    <th>Description</th>
                    <!-- <th>Status</th> -->
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < count($tutorialList); $i++) { ?>
                    <tr class="_hidd{{$tutorialList[$i]->id}}">
                      <td class="display-none"></td>
                      <td>{{ $tutorialList[$i]->title }}</td>
                      <td>{{ $tutorialList[$i]->description }}</td>
                      <!-- <td>{{ $tutorialList[$i]->section }}</td>
                      <td class="{{ $tutorialList[$i]->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $tutorialList[$i]->status == 'active' ? "Active" : "Inactive" }}</td> -->
                      
                        <td>
                            <!-- @can('view_website_content') -->
                            <a href="{{ route('tutorials.show',$tutorialList[$i]->id) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                            <!-- @endcan
                            @can('edit_website_content') -->
                            <a href="{{ route('tutorials.edit',$tutorialList[$i]->id) }}" title="Edit"><i class="text-warning fa fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="deleteTutorial({{$tutorialList[$i]->id}})" title="Delete"><i class="text-danger fa fa-trash"></i></a>
                            
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });

function deleteTutorial(id){

    swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete tutorial?",
        type: "warning",
        showCancelButton: true,
    }, function(willDelete) {
        if (willDelete) {
            $.ajax({
                    url: "tutorials/"+id,
                    type: 'DELETE',
                    data: {
                    id: id
                    },
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                console.log(response.success);
               
                    $("._hidd"+id).remove()
                
               
                }
            });
        } 
    });
}
  </script>
@stop
