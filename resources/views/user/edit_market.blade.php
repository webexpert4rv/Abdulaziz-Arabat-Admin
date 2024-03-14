@extends('adminlte::page')

@section('title', 'Edit Market')

@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Market</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }} 
                        </div>
                    @endif

                    <form method="post" action="{{ route('update-market', $market->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" name="heading" class="form-control" id="heading" value="{{ $market->heading }}" placeholder="Enter heading">
                            @error('heading')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="text">Text</label>
                            <textarea name="text" class="form-control" id="text" placeholder="Enter text">{{ $market->text }}</textarea>
                            @error('text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" placeholder="Enter address">{{ $market->address }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if($market->image)
                                <img src="{{ env('STORAGE_PATH').'/'.$market->image }}" alt="Current Image">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" name="media" class="form-control-file" id="media">
                            @error('media')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <!-- Display current video if available -->
                            <div>
                                <video width="320" height="240" controls>
                                    <source src="{{ env('STORAGE_PATH').'/'.$market->media }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
