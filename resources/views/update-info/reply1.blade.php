@extends('adminlte::page')

@section('title', 'Reply To Contact Us')

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
                <h3>Reply to user</h3>
              </div>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form id="addPageForm" method="post", action="{{ route('update_information.send_reply1') }}">
                  @csrf

                  <input type="hidden" name="id" value="{{$update_information->id}}">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="page_title">Subject</label> 
                      <input type="subject" name="subject" class="form-control" id="subject" maxlength="100" value="">
                      @if($errors->has('title'))
                        <div class="error">{{ $errors->first('title') }}</div>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="section">Message</label>
                      <textarea id="message" name="message">{{$update_information->description}}</textarea>
                    </div>


                    <!-- signature -->
                    <div class="form-group">
                      <label for="section">Signature</label>
                      <textarea id="signature" name="signature">
                        <p>Kind Regards,</p>
                        <p>Arabat support team</p>
                      </textarea>
                    </div>
                    <!-- signature -->

                    <div class="form-group mb-0">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox" class="custom-control-input">
                      @if($errors->has('content'))
                        <div class="error">{{ $errors->first('content') }}</div>
                      @endif
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
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
<style type="text/css">
  #message-error{
    font-weight: 400 !important;
  }
</style>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      // content

      CKEDITOR.replace( 'message', {
        customConfig : 'config.js',
        toolbar : 'simple'
      })

      CKEDITOR.replace( 'signature', {
        customConfig : 'config.js',
        toolbar : 'simple'
      })
      $('#addPageForm').validate({
        ignore: [],
        debug: false,
        rules: {
          subject: {
            required: true,
            noSpace : true
          },
          message:{
            required: function() {
              CKEDITOR.instances.message.updateElement();
            },
            minlength:10
          },
          signature:{
            required: function() {
              CKEDITOR.instances.signature.updateElement();
            },
            minlength:5
          }
        },
        messages: {
          title: {
            required: "The Subject field is required."
          },
          message: {
            required: "The Message field is required.",
            minlength: "Minimum Length must be 10"
          },
          signature: {
            required: "The Signature field is required.",
            minlength: "Minimum Length must be 5"
          }
        }
      });

      $.validator.addMethod("noSpace", function(value, element) { 
        return $.trim(value).length!=0; 
      }, "No space please and don't leave it empty");

    });
  </script>
@stop
