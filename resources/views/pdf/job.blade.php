
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
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <br>
          <br>
          <div style="margin-left:auto; margin-right:auto; text-align:center;">
            <img src="{{asset('assets/images/arabat-logo.png')}}" style="display: block; margin: auto; width: 200px;"/>
          </div>
          <br>
          <div id="content1">
            <table id="demo" class="table table-bordered" style="border: 1px solid rgb(179, 179, 179);">
              <thead style="text-align: center;">
              <tr >
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">Sr.No.</th>
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.title') }}</th>
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.schedule_date') }}</th>
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{ __('adminlte::adminlte.schedule_time') }}</th>
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{__('adminlte::adminlte.pick_up_address') }}</th>
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{__('adminlte::adminlte.destination_address') }}</th>
                    <th style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{__('adminlte::adminlte.number_of_vehicle') }}</th>
                    
                  </tr>
            
              </thead>
              <tbody style="text-align: center;">
              @foreach($jobs as $key=>$job)
                    <tr>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{$key+1}}</td>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;"> {{$job->title}}</td>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{date('d/m/Y',strtotime($job->schedule_date))}}</td>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{date('h:i A',strtotime($job->schedule_time))}}</td>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$job->PickupRegion->name}} {{@$job->PickupSubRegion->name}}</td>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{@$job->JobReceiver->DestinationRegion->name}} {{@$job->JobReceiver->DestinationSubRegion->name}}</td>
                        <td style="border: 1px solid rgb(179, 179, 179); padding:7px;">{{$job->number_of_vehicle}}</td>
                       
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

