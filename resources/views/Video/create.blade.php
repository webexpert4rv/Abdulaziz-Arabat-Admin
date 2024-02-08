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
                            <h3>{{ __('adminlte::adminlte.add_video') }}</h3>
                            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                        </div>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form id="editPricingForm" enctype="multipart/form-data" method="post", action="{{ route('video.store') }}">
                            @csrf
                            <div class="card-body">                
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="question">{{ __('adminlte::adminlte.video_title_name') }}<span class="text-danger"> *</span></label>
                                            <input type="text" placeholder="{{ __('adminlte::adminlte.video_title_name') }}" name="video_title" class="form-control" id="video_title" >
                                            @if($errors->has('video_title'))
                                            <div class="error">{{ $errors->first('video_title') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="question">{{ __('adminlte::adminlte.arabic_video_title') }}<span class="text-danger"> *</span></label>
                                            <input type="text" placeholder="{{ __('adminlte::adminlte.arabic_video_title') }}" name="arabic_video_title" class="form-control" id="arabic_video_title" >
                                            @if($errors->has('arabic_video_title'))
                                            <div class="error">{{ $errors->first('arabic_video_title') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="arabic_question">{{ __('adminlte::adminlte.video') }}<span class="text-danger"> *</span></label>
                                            <input type="file" onchange="ValidateSingleInput(this);" placeholder="{{ __('adminlte::adminlte.video') }}" name="video" class="form-control" id="video"  >
                                            @if($errors->has('video'))
                                            <div class="error">{{ $errors->first('video') }}</div>
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

  var _validFileExtensions = [".MP4", ".MOV", ".WMV", ".AVCHD", ".MKV",".F4V",".SWF"];    
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

$(document).ready(function() {


    $('#editPricingForm').validate({
        ignore: [],
        debug: false,
        rules: {
            video_title: {
                required: true
            }, 
            arabic_video_title: {
                required: true
            },
            video: {
                required: true
            }, 
        },
        messages: {
            video_title: {
                required: "The video title is required",
            }, 

            arabic_video_title: {
                required: "The arabic video title is required",
            },  

            video: {
                required: "The video is required",
            },
        }
    });
});

</script>
@stop
