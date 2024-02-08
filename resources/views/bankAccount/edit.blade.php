@extends('adminlte::page')

@section('title', 'Edit Price')

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
                            <h3>{{ __('adminlte::adminlte.edit-bank-account') }}</h3> 
                            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form id="editPricingForm" method="post", action="{{ route('bank-account.update',$data->id) }}">
                           @csrf
                          @method('PUT')
                            <div class="card-body">                
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="vendor_name">{{ __('adminlte::adminlte.vendor_name') }}<span class="text-danger"> *</span></label>
                                            <input type="text" value="{{@$data->vendor_name }}" name="vendor_name" class="form-control" id="vendor_name" maxlength="100"  placeholder="{{ __('adminlte::adminlte.vendor_name') }}">
                                               
                                        </div>
                                    </div> 
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="bank_name">{{ __('adminlte::adminlte.bank_name') }}<span class="text-danger"> *</span></label>
                                            <input type="text" value="{{@$data->bank_name}}" name="bank_name" class="form-control" id="bank_name" maxlength="100" placeholder="{{ __('adminlte::adminlte.bank_name') }}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="account_number">{{ __('adminlte::adminlte.account_number') }}<span class="text-danger"> *</span></label>
                                            <input type="text" value="{{@$data->account_number}}" name="account_number" class="form-control" id="account_number" maxlength="100" placeholder="{{ __('adminlte::adminlte.account_number') }}" >
                                            
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="iban_no">{{ __('adminlte::adminlte.iban_no') }}<span class="text-danger"> *</span></label>
                                            <input type="text" value="{{@$data->iban_no}}" name="iban_no" class="form-control" id="iban_no" maxlength="100" placeholder="{{ __('adminlte::adminlte.iban_no') }}">
                                           
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                            </div>
                        </form>
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
<script>
    $(document).ready(function() {


        $('#editPricingForm').validate({
            ignore: [],
            debug: false,
            rules: {

                vendor_name: {
                    required: true
                }, 
                bank_name: {
                    required: true
                },
                account_number: {
                    required: true,
                    number: true,
                },
                iban_no: {
                    required: true,
                    number: true,
                },



            },
            messages: {

                vendor_name: {
                    required: "The vendor name is required",
                }, 

                bank_name: {
                    required: "The bank name is required",
                },
                account_number: {
                    required: "The Account Number is required",
                    number: "Please enter a valid account number",
                },
                iban_no: {
                    required: "The IBAN No. is required",
                     number: "Please enter a valid IBAN No.",
                },


            }
        });
    });

</script>
@stop
