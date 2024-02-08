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
              <h3>{{ __('adminlte::adminlte.edit_faq') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="editPricingForm" method="post", action="{{ route('faq.update',$data->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">                
                <div class="row">
                   

                  <div class="col-12">
                    <div class="form-group">
                      <label for="question">{{ __('adminlte::adminlte.faq_question') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Question" name="question" class="form-control" id="question" value="{{$data->question}}" >
                      @if($errors->has('question'))
                      <div class="error">{{ $errors->first('question') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="arabic_question">{{ __('adminlte::adminlte.faq_arabic_question') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Name" name="arabic_question" class="form-control" id="arabic_question"  value="{{$data->arabic_question}}" >
                      @if($errors->has('arabic_question'))
                      <div class="error">{{ $errors->first('arabic_question') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="answer">{{ __('adminlte::adminlte.faq_answer') }}<span class="text-danger"> *</span></label>
                      <textarea placeholder="Answer" name="answer" class="form-control" id="answer">{{$data->answer}}</textarea>
                      @if($errors->has('answer'))
                      <div class="error">{{ $errors->first('answer') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="arabic_answer">{{ __('adminlte::adminlte.faq_arabic_answer') }}<span class="text-danger"> *</span></label>
                      <textarea placeholder="Answer" name="arabic_answer" class="form-control" id="arabic_answer">{{$data->arabic_answer}}</textarea>
                      @if($errors->has('arabic_answer'))
                      <div class="error">{{ $errors->first('arabic_answer') }}</div>
                      @endif
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
        name: {
          required: true
        },

      },
      messages: {
        name: {
          required: "The Category name is required",
        },


      }
    });
  });

</script>
@stop
