
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <br>
        <br>
        <div style="margin-left:auto; margin-right:auto; text-align:center;">
          <img src="{{asset('assets/images/arabat-logo.png')}}" style="display: block; margin-bottom: 20px; width: 200px;"/>
        </div>
        <br>
        <div id="content1">
          <table id="demo" class="table table-bordered" style="border: 1px solid rgb(179, 179, 179);">
            <thead style="text-align: center;">
              <tr>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">Sr.No.</th>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.booking_id') }}</th>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.job_id') }}</th>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.booking_fee') }}(SAR)</th>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.user_name')}}</th>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.driver_name')}}</th>
                <!-- <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.transporter_name')}}</th> -->
                <!-- <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.payment_status')}}</th> -->
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.booking_status')}}</th>
                <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.booked_on')}}</th>

              </tr>
            </thead>



            <tbody style="text-align: center;">
              @foreach($bookings as $key=>$booking)

              <tr>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{$key+1}}</td>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->book_id}}</td>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->job->job_ID}}</td>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->booking_fee}}</td>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->user->name}}</td>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->driver->name}}</td>
             <!--   <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->driver->transporter->name}}</td> -->
              <!--  <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$booking->payment_status}}</td>  -->              
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ucfirst(str_replace('_', ' ', @$booking->status))}}</td>
               <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{date('d/m/Y',strtotime(@$booking->booked_on))}}</td>

             </tr>

              
             @endforeach
           </tbody>
         </table>
       </div>
     </div>
   </div>

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 </body>
 </html>

