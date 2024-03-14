@extends('adminlte::page')

@section('title', 'Add Market')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                    <h3>Add Market</h3>
                    <a class="btn btn-sm btn-success" href="{{ route('show_market') }}">Back</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="post" action="{{ route('add_market') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading">Heading</label>
                                        <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading">
                                        @error('heading')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="text">Text</label>
                                        <textarea name="text" class="form-control" id="text" placeholder="Enter text"></textarea>
                                        @error('text')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control-file" id="image">
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="file">Video</label>
                                        <input type="file" name="media" class="form-control-file" id="media">
                                        @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address" placeholder="Enter address"></textarea>
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
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
