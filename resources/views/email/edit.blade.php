@extends('adminlte::page')

@section('title', 'Edit Email Template')

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
                <h3>{{ __('adminlte::adminlte.edit_email_template') }}</h3>
                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              </div>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form id="editEmailTemplateForm" method="post", action="{{route('emails.update',$email_template->id)}}">
                  @csrf
                  @method('PUT')
                  <div class="card-body">                
                    <div class="row">

                      <div class="col-6">
                        <div class="form-group">
                          <label for="from_email">{{ __('adminlte::adminlte.from_email') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Email" name="from_email" class="form-control" value="{{$email_template->from_email}}" id="from_email" maxlength="100">
                          @if($errors->has('from_email'))
                            <div class="error">{{ $errors->first('from_email') }}</div>
                          @endif
                        </div>
                      </div>

                    
                    <div class="col-6">
                      <div class="form-group">
                        <label for="subject">{{ __('adminlte::adminlte.subject') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="subject" class="form-control" id="subject" value="{{$email_template->subject}}" placeholder="subject" maxlength="100">
                        <div id ="subject_error" class="error"></div>
                        @if($errors->has('subject'))
                          <div class="error">{{ $errors->last('subject') }}</div>
                        @endif
                      </div>
                    </div>
                    

                    <div class="col-12">
                      <div class="form-group">
                        <label for="to_email">{{ __('adminlte::adminlte.to_email') }}<span class="text-danger"> *</span></label>
                        <select name="user_id[]"  class="form-control" id="choices-multiple-remove-button" multiple>
                        
                        @foreach($users as $user)
                          <option value="{{$user->id}}" @foreach(explode(',',$email_template->user_id) as $user_id) {{ $user_id==$user->id?'selected':''}}@endforeach>{{$user->name}}</option>
                        @endforeach
                        
                        </select>
                        @if($errors->has('to_email'))
                          <div class="error">{{ $errors->last('to_email') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-12 mb-0">
                      <div class="form-group position-relative">
                        <label for="description">{{ __('adminlte::adminlte.description') }}<span class="text-danger"> *</span></label>
                        <textarea placeholder="Description" onkeyup="countChar(this)" name="description" class="form-control" id="description" rows="6" maxlength="100">{{$email_template->description}}</textarea>
                        <div id="charNum"></div>
                        @if($errors->has('description'))
                          <div class="error">{{ $errors->last('description') }}</div>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script>
  
function countChar(val) {
  var len = val.value.length;
  if (len >= 500) {
    val.value = val.value.substring(0, 501);
  } else {
    $('#charNum').text(500 - len+' character description');
  }
};
</script>
  <script>
      $(document).ready(function(){
    
     var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:5
      }); 
     
     
 });
    $(document).ready(function() {
      
       jQuery.validator.addMethod("validemail", function (value, element) {
      
      return this.optional( element ) || /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/.test( value );
          
      }, "Please enter a valid Email");
      $('#editEmailTemplateForm').validate({
        ignore: [],
        debug: false,
        rules: {
          from_email: {
            required: true,
             validemail: true
          },
          subject: {
            required: true,
           
          },
          "user_id[]": {
            required: true
          },
          description: {
            required: true,
            maxlength:500,
          },
         
        },
        messages: {
          from_email: {
            required: "The Email  is required"
          },
          subject: {
            required: "The Subject  is required",
           
          },
           "user_id[]": {
            required: "The User  is required"
          },
          description: {
            required: "The Description  is required"
          },
         
         
        }
      });
    });

  </script>
@stop
