@extends('adminlte::page')

@section('title', 'Banner')

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
              <h3>Banner</h3>
              @can('add_banner')
                <a class="btn btn-success" href="{{ route('banner.create') }}">Create Banner</a>
               @endcan 
            </div>
            <div class="card-body">
              <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th >Sr. No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($banners as $key=>$banner)
                    <tr class="_hidd{{$banner->id}}">
                        <td>{{$key+1}}</td>
                        <td>{{$banner->title}}</td>
                      
                        <td>{{$banner->description}}</td>
                        <td>@if($banner->status==1) Active @else Inactive @endif</td>
                        <td>
                            @can('edit_banner')
                            <a class="action-button" title="Edit" href="{{route('banner.edit',$banner->id)}}"><i class="text-warning fa fa-edit"></i></a>
                            @endcan
                            @can('view_banner')
                            <a class="action-button" title="View" href="{{route('banner.update',$banner->id)}}"><i class="text-primary fa fa-eye"></i></a>
                            @endcan
                            @can('delete_banner')
                            <a class="action-button delete-button" onclick="deleteTestimonial({{$banner->id}})" title="Delete"  data-id="" href="javascript:void(0)" ><i class="text-danger fa fa-trash-alt"></i></a>
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
</section>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });

   function deleteTestimonial(id){

        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete banner?",
            type: "warning",
            showCancelButton: true,
        }, function(willDelete) {
            if (willDelete) {
                  $.ajax({
                        url: "banner/"+id,
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
                      if(response.success == 1) {
                        $("._hidd"+id).remove()
                      //   /* console.log("response", response);*/
                      //   $( "#flash-message" ).css("display","block");
                      //   $( "#flash-message" ).removeClass("d-none");
                      //   $( "#flash-message" ).addClass("alert-danger");
                      //   Swal('','Banner deleted successfully', 'success') 
                      //  // $('#flash-message').html('User Deleted Successfully');
                      //   $("._hidd"+id).remove()
                      //   setTimeout(() => {
                      //   $( "#flash-message" ).addClass("d-none");
                      //   }, 5000);

                      }
                      else {
                        console.log("FALSE");
                        setTimeout(() => {
                        alert("Something went wrong! Please try again.");
                        }, 500);
                         swal("Error!", "Something went wrong! Please try again.", "error");
                        // swal("Something went wrong! Please try again.");
                      }
                    }
                  });
               
            } 
        });
      }
  </script>
@stop
