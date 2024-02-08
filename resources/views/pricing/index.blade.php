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
          <div class="card-body">
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


         <!--  <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.transporter') }}</h3>
           
            <a class="btn btn-sm btn-success" href="{{route('transporters.create')}}">Add Transporter</a>
         
          </div>  -->

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
               
                  <th>{{ __('adminlte::adminlte.tax') }}</th>
                  <th>{{ __('adminlte::adminlte.commision') }}</th>
                  <th>{{ __('adminlte::adminlte.base_fee') }}</th>
                  <th>Created at</th>
                  <th>Last updated at</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
              	<tbody id="tbody">
               
	                <tr>
	                    <td >1</td>
	                   
	                    <td>5%</td>
	                    <td>5%</td>
                        <td>500</td>
	                    <td>2022-08-27</td>
	                     <td>2022-08-27</td>
	                    <td>
                     
	                        <a class="action-button" title="Edit" href="{{route('pricing.edit',1)}}"><i class="text-warning fa fa-edit"></i></a>
	                   
	                    </td> 
	                </tr>
                 <!--  <tr>
	                    <td >2</td>
	                    <td>Commission</td>
	                    <td>2%</td>
	                 
	                    <td>2022-08-27</td>
	                     <td>2022-08-27</td>
	                    <td>
                      
	                        <a class="action-button" title="Edit" href="{{route('pricing.edit',1)}}"><i class="text-warning fa fa-edit"></i></a>
	                   
	                       
	                    </td> 
	                </tr> -->
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

  

@stop
