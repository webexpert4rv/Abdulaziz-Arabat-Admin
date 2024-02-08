<?php $i=1;?>
                @foreach($jobs as $key=>$job)
                 @if(@$job->status=='in-progress')
                    <tr class="job_remove{{$job->id}}">
                       <td>{{@$i++}}</td>
                         <td>{{@$job->job_ID}}</td>
                        <td>{{$job->title}}</td>
                        <td>{{date('d/m/Y',strtotime($job->schedule_date))}}</td>
                        <td>{{date('h:i A',strtotime($job->schedule_time))}}</td>
                        <td>{{@$job->PickupRegion->name}} {{@$job->PickupSubRegion->name}}</td>
                        <td>{{@$job->JobReceiver->DestinationRegion->name}} {{@$job->JobReceiver->DestinationSubRegion->name}}</td>
                       
                        <td>{{$job->number_of_vehicle}}</td>
                        <td>{{ucfirst($job->status)}}</td>
                        <td>
                          <a class="action-button" title="View" href="{{route('jobs.show',$job->id)}}"><i class="text-info fa fa-eye"></i></a>
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="deleteJob({{$job->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                        </td> 
                    </tr>
                    @endif
                @endforeach
                @foreach($jobs as $key=>$job)
                 @if(@$job->status!='in-progress')
                    <tr class="job_remove{{$job->id}}">
                       <td>{{@$i++}}</td>
                         <td>{{@$job->job_ID}}</td>
                        <td>{{$job->title}}</td>
                        <td>{{date('d/m/Y',strtotime($job->schedule_date))}}</td>
                        <td>{{date('h:i A',strtotime($job->schedule_time))}}</td>
                        <td>{{@$job->PickupRegion->name}} {{@$job->PickupSubRegion->name}}</td>
                        <td>{{@$job->JobReceiver->DestinationRegion->name}} {{@$job->JobReceiver->DestinationSubRegion->name}}</td>
                       
                        <td>{{$job->number_of_vehicle}}</td>
                        <td>{{ucfirst($job->status)}}</td>
                        <td>
                          <a class="action-button" title="View" href="{{route('jobs.show',$job->id)}}"><i class="text-info fa fa-eye"></i></a>
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" onclick="deleteJob({{$job->id}})" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
                        </td> 
                    </tr>
                    @endif
                @endforeach