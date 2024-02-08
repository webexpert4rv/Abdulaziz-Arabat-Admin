@extends('adminlte::page')

@section('title', 'Contact Messages')

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
              <h3>Special Request</h3>
              <!-- <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> -->
            </div>
            <div class="card-body pb-0 mb-2 card_inner">
              <div class="text-right mb-3">
                <div class="advance-options" style="display: none;">
                  <div class="title">
                    <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                  </div>
                  <div class="left_option">
                    <div class="left_inner">
                      <h6>Select Status</h6>
                      <div class="date-picker-new">
                        <div class="apply_reset_btn">
                          <div class="button_input_wrap">
                            <div class="form-group">
                              <select class="form-control" id="filter">  
                                <option value="" selected="" disabled="">Select</option>
                                @foreach(\App\Models\ContactUs::status() as $status)
                                <option value="{{strtolower($status)}}">{{$status}}</option>
                                @endforeach                       

                              </select>
                            </div>
                          </div>
                          <!-- <button class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button> -->
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
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="pages-list" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Description</th>
                   <!--    <th>Actions</th> -->

                    </tr>
                  </thead>
                  <tbody id="tbody">

                    @foreach ($specialRequests as $key => $value)
                    <tr>
                    <td>{{ $key+1 }}</td>
                       <td>{{ $value->name }}</td>
                       <td>{{ $value->email }}</td>
                       <td>{{ $value->mobile }}</td>
                       <td>{{ $value->description }}</td>
                    <!--    <td> <a href="" title="View"><i class="text-info fa fa-eye"></i></a> </td> -->
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
</script>

@stop
