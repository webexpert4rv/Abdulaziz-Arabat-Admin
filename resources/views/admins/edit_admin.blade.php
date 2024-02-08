@extends('adminlte::page')

@section('title', 'Edit Admin')

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
              <h3>{{ __('adminlte::adminlte.edit_admin') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="updateAdminForm" method="post" action="{{ route('update_admin') }}">
              @csrf
              
              <input type="hidden" name="id" value="{{ $admin->id }}">
              <div class="card-body form">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="full_name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" value="{{ $admin->full_name }}" maxlength="100">
                      @if($errors->has('name'))
                      <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ $admin->email }}" maxlength="100">
                      @if($errors->has('email'))
                      <div class="error">{{ $errors->last('email') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-6">               
                    <div class="form-group">
                      <label for="role_id">{{ __('adminlte::adminlte.role') }}<span class="text-danger"> *</span></label>
                      <select name="role_id" class="form-control" id="role_id">
                        <!-- <option value="" hidden>Select Role</option> -->
                        <?php for ($i=0; $i < count($roles); $i++) { ?> 
                          <option value="{{ $roles[$i]->id }}">{{ $roles[$i]->name }}</option>
                        <?php } ?>
                      </select>
                      @if($errors->has('role_id'))
                      <div class="error">{{ $errors->last('role_id') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="password">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> </span></label>
                      <input type="password" name="password" class="form-control" id="password" maxlength="100">
                      
                      <div class="password_error error"> @if($errors->has('password')) {{ $errors->last('password') }}  @endif</div>
                      
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> </span></label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                      
                      <div class="confirm_password_error error">  @if($errors->has('confirm_password')) {{ $errors->last('confirm_password') }}  @endif</div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
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
    jQuery.validator.addMethod("validemail", function (value, element) {
      if (/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/.test(value)) {
        return true;
      } else {
        return false;
      };
    }, "Please enter a valid Email");
    $('#updateAdminForm').validate({
      ignore: [],
      debug: false,
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          validemail:true,
          email: true
        },
        role: {
          required: true
        },
        password: {
         
          minlength: 8
        },
        confirm_password: {
          
          minlength: 8,
          equalTo : "#password"
        },
      },
      messages: {
        name: {
          required: "Name  is required."
        },
        email: {
          required: "Email  is required.",
          email: "Please enter a valid Email"
        },
        role: {
          required: "Role  is required."
        },
        password: {
         
          minlength: "Minimum length should be 8"
        },
        confirm_password: {
         
          minlength: "Minimum length should be 8",
          equalTo : "Confirm Password must be equal to Password."
        },
      }
    });
  });
</script>
@stop
