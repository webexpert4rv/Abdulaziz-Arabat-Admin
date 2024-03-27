@extends('adminlte::page')

@section('title', 'Market Page')

@section('content_header')
    <h1>Welcome to Our Market</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $marketData->heading }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ asset($marketData->image) }}" alt="Market Image">
                        </div>
                        <div class="text-container">
                            <p>{{ $marketData->text }}</p>
                        </div>
                        <div class="address-container">
                            <h2>Address</h2>
                            <p>{{ $marketData->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
