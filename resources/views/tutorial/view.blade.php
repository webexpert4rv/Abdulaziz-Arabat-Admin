@extends('adminlte::page')

@section('title', 'Tutorial Content')

@section('content_header')
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <div class="card-header">
              <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              <h3>Tutorial Content</h3>
            </div>
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form class="form_wrap">
                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Title</label>
                      <input class="form-control" placeholder="{{ $tutorial->title }}" readonly>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Content</label>
                      <div style="background-color: #fffdf2; font-size: 14px; border: 1px dashed #ffcd00; padding: 15px; border-radius: 5px;">{!! $tutorial->description !!}<div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Title</label>
                      <input class="form-control" placeholder="{{ $tutorial->title_arabic }}" readonly>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Content</label>
                      <div style="background-color: #fffdf2; font-size: 14px; border: 1px dashed #ffcd00; padding: 15px; border-radius: 5px;">{!! $tutorial->description_arabic !!}<div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection