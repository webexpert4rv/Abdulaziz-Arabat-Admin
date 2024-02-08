@extends('adminlte::page')

@section('title', 'Wallets History')

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
						<h3>{{ __('adminlte::adminlte.payment_history') }}</h3> 
						<a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
					</div>
					<div class="card-body"> @if (session('status'))
						<div class="alert alert-success" role="alert"> {{ session('status') }} </div> @endif
						<div class="table-responsive">
							<table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
								<thead>
									<tr>
										<th>Sr.No.</th>
										<th>{{ __('adminlte::adminlte.name') }}</th>
										<th>{{ __('adminlte::adminlte.paid_date') }}</th>
										<!-- <th>{{ __('adminlte::adminlte.paid_amount') }}</th>
										<th>{{ __('adminlte::adminlte.commission') }}</th> -->
										<th>{{ __('adminlte::adminlte.total_paid') }}</th>
									
										
									</tr>
								</thead>
								<tbody id="tbody"> 
									@foreach($transporter_wallet_history as $key=>$history) 
								
									<tr>
							<td>{{$key+1}}</td>
							<td>{{$transporter->name}}</td>
							<td>{{date('d/m/Y',strtotime($history->paid_date))}}</td>
							<td class="request_btn"> <span class="badge badge-success">{{$history->amount}}</span></td>
							<!-- <td class="request_btn"> <span class="badge badge-primary">{{$history->admin_commission}}</span></td> -->
							
						<!-- 	<td class="request_btn"> <span class="badge badge-success">{{$history->amount+$history->admin_commission}}</span></td> -->
							
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

@stop 

@section('js')

@stop