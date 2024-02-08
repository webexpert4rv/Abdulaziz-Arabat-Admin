@extends('adminlte::page')

@section('title', 'Add Banner')

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
                <h3>{{ __('adminlte::adminlte.add_banner') }}</h3>
                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              </div>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                <form id="addBannerForm"  method="post", action="{{ route('banner.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">                
                    <div class="row">

                      <div class="col-12">
                        <div class="form-group">
                          <label for="image">{{ __('adminlte::adminlte.image') }}<span class="text-danger"> *</span></label>
                          <input onchange="ValidateSingleInput(this);"  type="file" placeholder="Name" name="image" class="form-control" id="image" maxlength="100" onchange="readURL(this)" >
                          <img width="25%" id="blah" src="" style="display:none;">
                        
                            <div class="error image_error"> @if($errors->has('image')){{ $errors->first('image') }} @endif</div>
                        
                        </div>
                        <img src="" style="display: none;">
                      </div>


                      <div class="col-6">
                        <div class="form-group">
                          <label for="title">{{ __('adminlte::adminlte.english_title') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Title (English)" name="title" class="form-control" id="title" maxlength="100">
                          @if($errors->has('title'))
                            <div class="error">{{ $errors->first('title') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="arabic_title">{{ __('adminlte::adminlte.arabic_title') }}<span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Title (Arabic)" name="arabic_title" value="" class="form-control" id="arabic_title" maxlength="100">
                        @if($errors->has('arabic_title'))
                          <div class="error">{{ $errors->first('arabic_title') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-6 company_div" >
                      <div class="form-group">
                        <label for="description">{{ __('adminlte::adminlte.english_description') }}<span class="text-danger"> *</span></label>
                        <textarea type="text" placeholder="Description (English)" name="description" class="form-control" id="company"></textarea> 
                        @if($errors->has('description'))
                          <div class="error">{{ $errors->last('description') }}</div>
                        @endif
                      </div>
                    </div>
          
                    <div class="col-6 company_div" >
                    <div class="form-group">
                      <label for="arabic_description">{{ __('adminlte::adminlte.arabic_description') }}<span class="text-danger"> *</span></label>
                      <textarea type="text" placeholder="Description (arabic)" name="arabic_description" class="form-control" id="arabic_description"></textarea> 
                      @if($errors->has('arabic_description'))
                        <div class="error">{{ $errors->last('arabic_description') }}</div>
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
    $("#addBannerForm").on("submit",function(){
      $(".image_error").html("");
    });
    // jQuery.validator.setDefaults({
    //   debug: true,
    //   success: "valid"
    // });
    $(document).ready(function() {
     
      $('#addBannerForm').validate({
        ignore: [],
        debug: false,
        rules: {
          image: {
            required: true,
           
          },
          title: {
            required: true
          },
          arabic_title: {
            required: true
          },
          description: {
            required: true
            
          },
          arabic_description: {
            required: true
            
          },
        
        },
        messages: {
          image: {
            required: "Image is required",
           
          },
          title: {
            required: "Title (English) is required"
          },
          arabic_title: {
            required: "Title (Arabic) is required"
          },
          description: {
            required: "Description (English) is required"
            
          },
          arabic_description: {
            required: "Description (Arabic) is required"
            
          },
        
        }
      });
    });



    $(document).on("change","#account_type",function(){
      
       var account_type=$("#account_type").val();
       if(account_type=='business'){
        $('.company_div').css("display","block");
        $('.location_div').css("display","block");
       }else{
      $('.company_div').css("display","none");
        $('.location_div').css("display","none");
       }
    });
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
             
               $('#blah').css("display","block");
                $('#blah').attr('src', e.target.result).width(200).height(200);
               
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png",".svg"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
              $(".image_error").html("allowed extensions are: " + _validFileExtensions.join(", "));
               // console.log("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
               
                return false;
            }
        }
    }
    $(".image_error").html("");
    return true;
}

  </script>
@stop
