@extends('adminlte::page')

@section('title', 'Email Template')

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
              <h3>{{ __('adminlte::adminlte.email_template') }}</h3>
              @can('add_email')
              <a class="btn btn-sm btn-success" href="{{route('emails.create')}}">Add Email Template</a>
              @endcan
            </div> 

            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <div class="table-responsive">
              <table style="width:100%" id="exampleTable" class="table table-bordered table-hover datatable">
                <thead>
                  <tr>
                    <th >Sr.No.</th>
                    <th>{{ __('adminlte::adminlte.from') }}</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('adminlte::adminlte.subject') }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>{{ __('adminlte::adminlte.description') }}</th>
                  <th>{{ __('adminlte::adminlte.created_at') }}</th>
                   
                 <!--    <th>Last updated at</th> -->
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('adminlte::adminlte.actions') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  </tr>
                </thead>
                  <tbody id="tbody">
                @foreach($email_templates as $key=>$email_template)
                    <tr class="remove_template_{{$email_template->id}}">
                        <td >{{$key+1}}</td>
                        <td>{{$email_template->from_email}}</td>
                        <td>{{$email_template->subject}}</td>
                        <td>{{$email_template->description}}</td>
                        <td>&nbsp;&nbsp;{{date('d/m/Y',strtotime($email_template->created_at))}}&nbsp;&nbsp;</td>
                       <!--  <td>{{date('d/m/Y',strtotime($email_template->updated_at))}}</td> -->
                          <td>
                            @can('edit_email')
                            <a class="action-button" onclick="sendEmailUsers({{$email_template->id}});" title="Send Mail" href="javascript:void(0);"> <i class="text-primary  fa fa-envelope" aria-hidden="true"></i></a>
                            @endcan
                            @can('view_email')
                            <a class="action-button" title="View" href="{{route('emails.show',$email_template->id)}}"><i class="text-info fa fa-eye"></i></a>
                            @endcan
                            @can('edit_email')
                            <a class="action-button" title="Edit" href="{{route('emails.edit',$email_template->id)}}"><i class="text-warning fa fa-edit"></i></a>
                            @endcan
                            @can('delete_email')
                            <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="emailTemplateDelete({{$email_template->id}})"data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                            @endcan
                          </td> 
                    </tr>
                  @endforeach
                  </tbody>
                
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>
    function emailTemplateDelete(id){

      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete the email template?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
         
          $.ajax({
            url: "emails/"+id,
            type: 'DELETE',
            data: {
               "id"      :   id,
              
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              $(".remove_template_"+id).remove();
            }
          });
        } 
      });
  }

  function sendEmailUsers(id){
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to send email to users?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
     $.ajax({
            url: "{{route('send.email.users')}}",
            type: 'post',
            data: {
               "id"      :   id,
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
             
            }
          });
     
      } 
      });
  }
  </script>

@stop
