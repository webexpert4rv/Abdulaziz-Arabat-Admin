@extends('adminlte::page')

@section('title', 'Add Mobile Page')

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
              <h3>Add Mobile Page</h3>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="addPageForm" method="post", action="{{ route('save_mobile_page') }}">
              @csrf
              <div class="card-body">

                <div class="form-group">
                  <label for="section">Section</label>
                  <select name="section" class="form-control" id="section">
                    @foreach($pageSections as $pageSection)
                    <option value="{{ $pageSection->slug }}">{{ $pageSection->title }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('section'))
                  <div class="error">{{ $errors->first('section') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="page_title">Title</label>
                  <input type="title" name="title" class="form-control" id="page_title" maxlength="100">
                  @if($errors->has('title'))
                  <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>

                <textarea id="content" name="content"></textarea>
                <div class="form-group mb-0">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="content" class="custom-control-input">
                    @if($errors->has('content'))
                    <div class="error">{{ $errors->first('content') }}</div>
                    @endif
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="arabic_page_title">Title (Arabic)</label>

                    <input type="text" name="arabic_title" class="form-control" id="arabic_page_title" placeholder="Title (Arabic)" >
                    @if($errors->has('arabic_title'))
                    <div class="error">{{ $errors->first('arabic_title') }}</div>
                    @endif
                  </div>
                </div>

                <div class="col-12 position-relative">  
                  <label for="arabic_content">Description (Arabic)</label>
                  <textarea   id="arabic_content"  class="arabic_description" name="arabic_content"> </textarea>
                  <div id="charNum"></div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="content" class="custom-control-input">
                      @if($errors->has('arabic_content'))
                      <div class="error">{{ $errors->first('arabic_content') }}</div>
                      @endif
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
</section>
@endsection

@section('css')
@stop

@section('js')

<!-- added later for test -->
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<!-- added later for test -->

<script>
  $(document).ready(function() {
      // content
    // CKEDITOR.replace( 'content', {
    //   customConfig : 'config.js',
    //   toolbar : 'simple'
    // })
    // var editors=  CKEDITOR.replace( 'arabic_content', {
    //   customConfig : 'config.js',
    //   toolbar : 'simple'
    // });

    initSample();

    CKEDITOR.replace('content', {
        customConfig: 'config.js',
        toolbar: 'simple',
        extraPlugins: 'lineheight',
        removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor',
        colorButton_colors: 'CF5D4E,454545,FFF,DDD,CCEAEE,66AB16',
        colorButton_enableAutomatic: 'false',
        allowedContent: true
    });

    CKEDITOR.replace('arabic_content', {
        customConfig: 'config.js',
        toolbar: 'simple',
        extraPlugins: 'lineheight',
        removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor',
        colorButton_colors: 'CF5D4E,454545,FFF,DDD,CCEAEE,66AB16',
        colorButton_enableAutomatic: 'false',
        allowedContent: true
    });

    $('#addPageForm').validate({
      ignore: [],
      debug: false,
      rules: {
        title: {
          required: true
        },
        content:{
          required: function() {
            CKEDITOR.instances.content.updateElement();
          },
          minlength:10
        }
      },
      messages: {
        title: {
          required: "The Page Title field is required."
        },
        content: {
          required: "The Page Content field is required.",
          minlength: "Minimum Length must be 10"
        }
      }
    });
  });
</script>
@stop
