@extends('adminlte::page')

@section('title', 'Wallets History')

@section('content_header')
@stop

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
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
                                    <th>{{ __('adminlte::adminlte.paid_amount') }}</th>
								</tr>
							</thead>
					<tbody id="tbody"> 
                        @foreach($user_refund as $key=>$history) 
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{date('d/m/Y',strtotime($history->paid_date))}}</td>
                          <td class="request_btn"> <span class="badge badge-success">{{$history->refund_amount}}</span></td>
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


@endsection

@section('css')

@stop 

@section('js')

@stop