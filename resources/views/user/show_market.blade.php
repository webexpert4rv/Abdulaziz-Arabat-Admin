@extends('adminlte::page')

@section('title', 'Market Table')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                    <h3>Market Table</h3>
                    <a class="btn btn-sm btn-success" href="{{ route('create-market') }}">Add Market</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table id="market-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SR No</th>
                                <th>Heading</th>
                                <th>Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($markets as $index => $market)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $market->heading }}</td>
                                <td>{{ $market->text }}</td>
                                <td>
                                    <a href="{{ route('edit-market', $market->id) }}" class="btn btn-sm btn-primary">Edit</a>
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
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#market-table').DataTable();

        // Delete market data
        $(document).on('click', '.delete-market', function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to delete this market?")) {
                var marketId = $(this).data('market-id');
                $.ajax({
                    type: 'POST',
                    url: '/delete-market/' + marketId,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
</script>
@stop
