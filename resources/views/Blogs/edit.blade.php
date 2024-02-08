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
              <h3>{{ __('adminlte::adminlte.edit_blog') }}</h3>
              <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <form id="editPricingForm" method="post" enctype="multipart/form-data" action="{{ route('blogs.update',$data->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.blog_title') }}<span class="text-danger"> </span></label>
                      <input type="text" placeholder="Blog title"  name="blog_title" class="form-control" value="{{$data->blog_title}}" id="blog_title" maxlength="100" >
                      @if($errors->has('blog_title'))
                      <div class="error">{{ $errors->first('blog_title') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">Arabic Blog Title<span class="text-danger"> *</span></label>
                      <input type="text" placeholder="Blog title" name="arabic_blog_title"value="{{$data->arabic_blog_title}}" class="form-control">
                      @if($errors->has('arabic_blog_title'))
                      <div class="error">{{ $errors->first('arabic_blog_title') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="image">{{ __('adminlte::adminlte.image') }}</label>
                          <input onchange="ValidateSingleInput(this);"  type="file" placeholder="Name" name="blog_image" class="form-control" id="image" maxlength="100" onchange="readURL(this)" >
                          <img width="25%" id="blah" src="" style="display:none;">
                         

                      @if($data['blog_image'])
                      <div class="error">
                         <a href="{{env('STORAGE_PATH')}}/{{$data['blog_image']}}" target="blank"><b>View Image</b></a>
                         
                      </div>
                      @endif
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group description_wrapper">
                      <label for="name">{{ __('adminlte::adminlte.description') }}<span class="text-danger"></span></label>                     
                      <textarea name="description" placeholder="Short description" class="ckeditor form-control">{{$data->description}}</textarea>
                      @if($errors->has('description'))
                      <div class="error">{{ $errors->first('description') }}</div>
                      @endif
                    </div>
                  </div>
                   <div class="col-12">
                    <div class="form-group description_wrapper">
                      <label for="name">Arabic Description<span class="text-danger">*</span></label> 
                       <textarea class="ckeditor form-control" placeholder="arabic description" name="arabic_description">{{$data->arabic_description}}</textarea>
                      @if($errors->has('arabic_description'))
                      <div class="error">{{ $errors->first('arabic_description') }}</div>
                      @endif
                    </div>
                  </div>
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
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
<script>
  $(document).ready(function() {


    $('#editPricingForm').validate({
      ignore: [],
      debug: false,
      rules: {
        arabic_blog_title: {
          required: true
        }, 

       /*  blog_title: {
          required: true
        }, */
       /* blog_image: {
          required: true
        },*/
        
       /* description: {
          required: function() {
            CKEDITOR.instances.description.updateElement();
          },
          minlength: 1
        }, */
        arabic_description: {
          required: function() {
            CKEDITOR.instances.arabic_description.updateElement();
          },
          minlength: 1
        }, 

      },
      messages: {
         blog_title: {
          required: "The Blog title is required",
        },        
        blog_image: {
          required: "The Blog image is required",
        },
        description: {
          required: "The description is required",
        },
         arabic_description: {
          required: "The Arabic description is required",
        },


      }
    });
  });

</script>
@stop
