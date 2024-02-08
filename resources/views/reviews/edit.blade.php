@extends('adminlte::page')

@section('title', 'Review Details')

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
              <h3>{{ __('adminlte::adminlte.edit_review') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>        
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              <form class="form_wrap" action="{{route('reviews.update',$review->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.reviews') }}</label>
                        <select class="form-control" name="rating">
                            <option value="">Select Rating</option>
                            <option value="1" {{$review->rating==1?'selected':''}}>1</option>
                            <option value="2" {{$review->rating==2?'selected':''}}>2</option>
                            <option value="3" {{$review->rating==3?'selected':''}}>3</option>
                            <option value="4" {{$review->rating==4?'selected':''}}>4</option>
                            <option value="5" {{$review->rating==5?'selected':''}}>5</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                    <div class="form-group">
                      <label>{{ __('adminlte::adminlte.message') }}</label>
                      <textarea class="form-control" placeholder="Message"  name="comment" rows="10">{{$review->comment}}</textarea>
                    </div>
                  </div>
                
                </div>
                <div class="card-footer">
                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
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

@section('css')
@stop

@section('js')
@stop
