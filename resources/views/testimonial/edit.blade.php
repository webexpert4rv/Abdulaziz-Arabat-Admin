@extends('adminlte::page')

@section('title', 'Add Testimonial')

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
                <h3>{{ __('adminlte::adminlte.add_testimonial') }}</h3>
                <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                 <form id="editTestimonialForm" method="post", action="{{ route('testimonials.update',$testimonial->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="card-body">                
                    <div class="row">

                      <div class="col-12">
                        <div class="form-group">
                          <label for="image">{{ __('adminlte::adminlte.image') }}<span class="text-danger"> *</span></label>
                          <input type="file"  onchange="readURL(this)" placeholder="Name" name="image" class="form-control" id="image" maxlength="100">
                          @if($errors->has('image'))
                            <div class="error">{{ $errors->first('image') }}</div>
                          @endif
                        </div>
                        <img width="25%" id="blah" src="{{env('STORAGE_PATH')}}/{{$testimonial->image}}" >
                      </div>


                      <div class="col-6">
                        <div class="form-group">
                          <label for="name">{{ __('adminlte::adminlte.testimonial_english_name') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Name (English)" name="name" class="form-control" id="name" value="{{$testimonial->name}}"maxlength="100">
                          @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                          @endif
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="arabic_name">{{ __('adminlte::adminlte.testimonial_arabic_name') }}<span class="text-danger"> *</span></label>
                          <input type="text" placeholder="Name (Arabic)" name="arabic_name" class="form-control" id="arabic_name" value="{{$testimonial->arabic_name}}"maxlength="100">
                          @if($errors->has('arabic_name'))
                            <div class="error">{{ $errors->first('arabic_name') }}</div>
                          @endif
                        </div>
                      </div>

                    <div class="col-6 company_div " >
                      <div class="form-group position-relative">
                        <label for="description">{{ __('adminlte::adminlte.testimonial_english_description') }}<span class="text-danger"> *</span></label>
                        <textarea type="text" rows="6" onkeyup="countChar(this)" placeholder="Description (English)" name="description" class="form-control" id="company" maxlength="500"><?php echo $testimonial->description ?></textarea> 
                        <div id="charNum"></div>
                        @if($errors->has('description'))
                          <div class="error">{{ $errors->last('description') }}</div>
                        @endif
                      </div>
                    </div>
          
                    <div class="col-6 company_div " >
                      <div class="form-group position-relative">
                        <label for="arabic_description">{{ __('adminlte::adminlte.arabic_description') }}<span class="text-danger"> *</span></label>
                        <textarea type="text" rows="6" onkeyup="countChar(this)" placeholder="Description (Arabic)" name="arabic_description" class="form-control" id="arabic_description" maxlength="500"><?php echo $testimonial->arabic_description ?></textarea> 
                        <div id="charNum"></div>
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
  </div>
</section>
@endsection

@section('css')
@stop

@section('js')
<script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
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
    jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
    $(document).ready(function() {
     
      $('#editTestimonialForm').validate({
        ignore: [],
        debug: false,
        rules: {
          image: {
            
            accept: "image/",
          },
          name: {
            required: true
          },
          description: {
            required: true
            
          },
          name: {
            required: true
          },
          description: {
            required: true
            
          },
          arabic_name: {
            required: true
          },
          arabic_description: {
            required: true
            
          },
        
        },
        messages: {
          image: {
            accept: "Image is required",
           
          },
          name: {
            required: "Name is required"
          },
          description: {
            required: "Description is required"
            
          },
          name: {
            required: "Name is (English) required"
          },
          description: {
            required: "Description (English) is required"
            
          },
          arabic_name: {
            required: "Name (arabic) is required"
          },
          arabic_description: {
            required: "Description (arabic) is required"
            
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
                $('#blah').css("display", "block");
                $('#blah').attr('src', e.target.result).width(200).height(200);
               // $('.crosstab').css("display", "block");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
@stop
