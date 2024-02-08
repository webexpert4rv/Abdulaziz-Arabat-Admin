@extends('adminlte::page')

@section('title', 'Pricing')

@section('content_header')
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <div class="card-body d-none">
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
                      <div class="advance_options_btn" >  
                        <button class="btn btn-primary export-bulk-invoices"><i class="fas fa-download mr-2"></i>Download bulk invoices</button>
                      </div>
                  </div>
                </div>
            </div>
            </div>


            <div class="card-header alert d-flex justify-content-between align-items-center">
              <h3>{{ __('adminlte::adminlte.products') }}</h3>
            
              <a class="btn btn-sm btn-success" href="{{route('product.create')}}">Add Product</a>
          
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
                    <th>{{ __('adminlte::adminlte.name') }}</th>
                    <th>{{ __('adminlte::adminlte.product_arabic_name') }}</th>
                  
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  </tr>
                </thead>
                  <tbody id="tbody">
                  @foreach($products as $key=>$product)
                    <tr class="remove_product{{$product->id}}">
                        <td >{{$key+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->arabic_name}}</td>
                      
                        <td>
                            <a class="action-button" title="Edit" href="{{route('product.edit',$product->id)}}"><i class="text-warning fa fa-edit"></i></a>
                      
                            <a class="action-button delete-button" title="Delete" onclick="productDelete({{$product->id}});" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                      
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

  <script type="text/javascript">
     function productDelete(id){

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete the product?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
          $.ajax({
            url: "product/"+id,
            type: 'DELETE',
            data: {
               "id"      :   id,
              
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              $(".remove_product"+id).remove();
            }
          });
        } 
      });
  }
  </script>

@stop
