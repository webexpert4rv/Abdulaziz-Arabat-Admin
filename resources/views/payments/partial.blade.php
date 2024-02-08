@foreach($transactions as $key=>$transaction)
@if(isset($transaction->job))
 
<tr>
    <td>{{$key+1}}</td>
    <!--    <td>{{$transaction->booking->book_id}}</td> -->
    <td>
       <!--  <a class="action-button" title="Job Details" href="{{route('jobs.show',$transaction->job->id)}}"></a> -->{{$transaction->job->job_ID}}



   </td>
                      <!--  <td>{{@$transaction->user->name}}</td>
                         <td>{{$transaction->driver->name}}</td> -->
                         <td>{{$transaction->transaction_id}}</td>                      
                         <td>{{$transaction->amount}}</td>
                         <!--   <td>{{$transaction->bank_account_id}}</td> -->
                       <!-- <td>{{$transaction->bank_name}}</td>
                       <td>{{$transaction->account_info}}</td>
                       <td>{{$transaction->remitter_name}}</td>
                       <td>


                        @if($transaction->bank_rceipt)
                        <a href="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" target="_blank">
                          <img src="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" alt="Dew drop" style="width: 300px">
                        </a>
                        @endif
                    -->




                </td>
                <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                <td>
                    @can('view_payment')
                    <a class="action-button" title="Job Details" href="javascript.void();"  data-toggle="modal" data-target="#exampleModal-{{$transaction->id}}"><i class="text-info fa fa-eye"></i></a>
                  <a class="action-button" title="Job Details" href="{{route('jobs.show',$transaction->job->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a> 
                    @endcan
                    <!--  <a class="action-button" title="View" href="{{route('payments.show',$transaction->id)}}"><i class="text-info fa fa-eye"></i></a>  -->
                    @if($transaction->bank_rceipt)
                    <a href="{{env('STORAGE_PATH')}}/{{$transaction->bank_rceipt}}" target="_blank"  class="action-button btn btn-danger"  download>
                    Rrceipt Download </a>  
                    @endif



                </td> 
            </tr>
            @endif
            @endforeach