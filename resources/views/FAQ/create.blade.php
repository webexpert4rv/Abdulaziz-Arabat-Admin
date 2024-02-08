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
              <h3>{{ __('adminlte::adminlte.add-faq') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="editPricingForm" method="post", action="{{ route('faq.store') }}">
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-12">
                    <div class="form-group">
                      <label for="question">{{ __('adminlte::adminlte.faq_question') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="{{ __('adminlte::adminlte.faq_question') }}" name="question" class="form-control" id="question" >
                      @if($errors->has('question'))
                      <div class="error">{{ $errors->first('question') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="arabic_question">{{ __('adminlte::adminlte.faq_arabic_question') }}<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="{{ __('adminlte::adminlte.faq_arabic_question') }}" name="arabic_question" class="form-control" id="arabic_question"  >
                      @if($errors->has('arabic_question'))
                      <div class="error">{{ $errors->first('arabic_question') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="answer">{{ __('adminlte::adminlte.faq_answer') }}<span class="text-danger"> *</span></label>
                      <textarea placeholder="{{ __('adminlte::adminlte.faq_answer') }}" name="answer" class="form-control" id="answer"></textarea>
                      @if($errors->has('answer'))
                      <div class="error">{{ $errors->first('answer') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="arabic_answer">{{ __('adminlte::adminlte.faq_arabic_answer') }}<span class="text-danger"> *</span></label>
                      <textarea placeholder="{{ __('adminlte::adminlte.faq_arabic_answer') }}" name="arabic_answer" class="form-control" id="arabic_answer"></textarea>
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
        question: {
          required: true
        }, 
        arabic_question: {
          required: true
        }, 
        answer: {
          required: true
        },
        arabic_answer: {
          required: true
        }, 




      },
      messages: {
        question: {
          required: "The Question is required",
        }, 

        arabic_question: {
          required: "The Aarabic question is required",
        },  

        answer: {
          required: "The Answer is required",
        }, 

        arabic_answer: {
          required: "The Arabic answer is required",
        },       


      }
    });
  });

</script>
@stop
