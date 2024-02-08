@extends('adminlte::page')

@section('title', 'Add Tutorial')

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
              <h3>Add Tutorial</h3>
            </div>
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form id="addPageForm" method="post", action="{{ route('tutorials.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body-inner">
                    
                  <div class="form-group">
                    <label for="page_title">Title (English)</label>
                    <input type="text" name="title" class="form-control" id="page_title" placeholder="Title (English)" maxlength="100">
                    @if($errors->has('title'))
                      <div class="error">{{ $errors->first('title') }}</div>
                    @endif
                  </div>

                  
                  <div class="form-group mb-0">
                    <label for="page_title">Description (English)</label>
                    <textarea id="content" name="descritpion"></textarea>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="descritpion" class="custom-control-input">
                      @if($errors->has('content'))
                      <div class="error">{{ $errors->first('content') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="arabic_title">Title (Arabic)</label>
                    <input type="text" name="arabic_title" class="form-control" placeholder="Title (Arabic)" id="arabic_title" maxlength="100">
                    @if($errors->has('arabic_title'))
                      <div class="error">{{ $errors->first('arabic_title') }}</div>
                    @endif
                  </div>

                  
                  <div class="form-group mb-0">
                    <label for="arabic_content">Description (Arabic)</label>
                    <textarea id="arabic_content" name="arabic_description"></textarea>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="arabic_description" class="custom-control-input">
                      @if($errors->has('arabic_content'))
                      <div class="error">{{ $errors->first('arabic_content') }}</div>
                      @endif
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
  </div>
</section>
@endsection

@section('css')
@stop

@section('js')
  <script>
    $(document).ready(function() {
      // content
      CKEDITOR.replace( 'content', {
        customConfig : 'config.js',
        toolbar : 'simple'
      })

      CKEDITOR.replace( 'arabic_content', {
        customConfig : 'config.js',
        toolbar : 'simple'
      })
      $('#addPageForm').validate({
        ignore: [],
        debug: false,
        rules: {
          title: {
            required: true
          },
          description:{
            required: function() {
              CKEDITOR.instances.content.updateElement();
            },
            minlength:10
          }
        },
        messages: {
          title: {
            required: "The Title is required."
          },
          description: {
            required: "The  Description is required.",
            minlength: "Minimum Length must be 10"
          }
        }
      });
    });
     function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').css("display", "block");
                $('#blah').attr('src', e.target.result).width(200).height(200);
               
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
@stop
