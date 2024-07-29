@extends('adminlte::page')

@section('title', 'Update Information')

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
              <h3>Update Information Messages</h3>
              <!-- <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a> -->
            </div>
            

            <div class="card-body">
              <div class="table-responsive">
              <table id="pages-list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Old Mobile Number</th>
                    <th>Old Email</th>
                     <th>New Mobile Number</th>
                    <th>New Email</th>
                    <th>Description</th>
                    <th>{{__('adminlte::adminlte.status') }}</th> 
                    <th>Date</th>
                    <th>Actions</th>
                
                  </tr>
                </thead>
                <tbody id="tbody">
                  <?php for ($i=0; $i < count($updateinformationlist); $i++) { ?>
                    <tr>
                      <td>{{ $i+1 }}</td>
                      <td>{{ $updateinformationlist[$i]->old_mobile_number }}</td>
                      <td>{{ $updateinformationlist[$i]->old_email }}</td>
                      <td>{{ $updateinformationlist[$i]->mobile_number }}</td>
                      <td>{{ $updateinformationlist[$i]->email }}</td>
                      

                      <td>{{ $updateinformationlist[$i]->description }}</td>

                      <td>{{ $updateinformationlist[$i]->is_updated==1?'Updated':'Pending ' }}</td>
                      <td>{{ $updateinformationlist[$i]->created_at->format('d-m-Y') }}</td>

                      <td>
                      @if($updateinformationlist[$i]->is_updated==0)
                      <a class="nav-link" href="javascript:void(0)" onclick="approvePayments(this,{{$updateinformationlist[$i]->user_id}})" 
                      style="background-color: blueviolet; color: #fff; padding: 6px 10px 8px 7px;">
                                                    <span class="button-text">Pending</span>
                                                    <span class="loader" style="display: none;"></span>
                                                </a>
                                                @else

                                                <a class="nav-link" href="javascript:void(0)"   style="background-color: #000000; color: #fff; padding: 6px 10px 8px 7px;">
                                                    <span class="button-text">Updated</span>
                                                </a>
                                                 
                                                @endif

                        <!-- @can('view_feedback')
                        <a href="{{ route('view_update_information_list_message', ['id' => $updateinformationlist[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                      
                        @endcan -->
                      
                        <!-- @can('reply_feedback')
                        <a href="{{route('update_info.reply1',$updateinformationlist[$i]->id)}}"><i class="fa fa-reply"></i></a>
                        @endcan -->
                        
                      </td>
                    
                    </tr>
                  <?php } ?>
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
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
  </script>


  <!-- update status -->
  <script type="text/javascript">

function approvePayments(button,user_id) {

Swal.fire({
    title: "Are you sure",
    text: "You want to Update information this user",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: "Yes it",
}).then((result) => {
    
    if (result.isConfirmed) {

var loader = button.querySelector('.loader');
var buttonText = button.querySelector('.button-text');

buttonText.textContent = 'Processing...';
loader.style.display = 'inline-block';
button.onclick = null;
    $.ajax({
        type:'POST',
        url:"{{route('user_update_information')}}",
        data:{
        "_token"      : "{{ csrf_token() }}", 
        "user_id"    : user_id,
        },
        success:function(response){

            if(response==1){
                $('#remove'+user_id).hide();
                Swal.fire({ 
                text: "Information update successfully",
                icon: "success", 
                });
                buttonText.textContent = 'Updated';
                loader.style.display = 'none';
                button.onclick = function() { approvePayments(button, user_id); };
                window.location.reload();
                
            }else{
                Swal.fire({ 
                text: "Something went wrong.",
                icon: "error", 
                });
            }
        }
    });

    }
});

}



  
  </script>
  <!-- update status -->

 

  <script>
     $('body').on('click','.show-advance-options',function(e){
       e.preventDefault();
       $('.advance-options').slideToggle();
     });
  </script>
  <!-- filter by status -->

@stop
