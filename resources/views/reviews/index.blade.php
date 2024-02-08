@extends('adminlte::page')

@section('title', 'Reviews')

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
              <h3>Reviews</h3>
              <!-- <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> -->
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
                      <th>{{ __('adminlte::adminlte.reviews') }}</th>
                      <th>{{ __('adminlte::adminlte.message') }}</th> 
                      <th>{{ __('adminlte::adminlte.user_name') }}</th>
                    <!-- <th>Created at</th>
                      <th>Last updated at</th> -->
                      <th>{{ __('adminlte::adminlte.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                    @foreach($reviews as $key=>$review)
                    <tr class="remove_reviews_{{$review->id}}">
                      <td >{{$key+1}}</td>
                      <td>{{@$review->rating}}</td>
                      <td>{{@$review->comment}}</td>
                      <td>{{@$review->user->name}}</td>
                        <!-- <td>{{date('Y-m-d',strtotime($review->created_at))}}</td>
                          <td>{{date('Y-m-d',strtotime($review->updated_at))}}</td> -->
                          <td>
                            @can('view_review')
                            <a class="action-button" title="View" href="{{route('reviews.show',$review->id)}}"><i class="text-warning fa fa-eye"></i></a>
                            @endcan
                            @can('edit_review')
                            <a class="action-button" title="Edit" href="{{route('reviews.edit',$review->id)}}"><i class="text-primary fa fa-edit"></i></a>
                            @endcan
                            @can('delete_review')
                            <a class="action-button delete-button" onclick="reviewDelete({{$review->id}})" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
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
    @stop

    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
      function reviewDelete(id){

        swal({
          title: "Are you sure?",
          text: "Are you sure you want to delete the review ?",
          type: "warning",
          showCancelButton: true,
        }, function(willDelete) {
          if (willDelete) {
           
            $.ajax({
              url: "reviews/"+id,
              type: 'DELETE',
              data: {
               "id"      :   id,
               
             },
             dataType: "JSON",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              $(".remove_reviews_"+id).remove();
            }
          });
          } 
        });
      }

    </script>

    @stop
