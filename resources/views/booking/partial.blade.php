
@foreach($bookings as $key=>$booking)

<tr>
	<td>{{$key+1}}</td>
	<td>{{@$booking->book_id}}</td>
	<td>{{@$booking->job->job_ID}}</td>
	<td>{{@$booking->booking_fee}}</td>
	<td>{{@$booking->user->name}}</td>
	<td>{{@$booking->driver->name}}</td>
	<td>{{@$booking->driver->transporter->name}}</td>
	<td>{{@$booking->payment_status}}</td>
	<td>{{ucfirst(str_replace('_', ' ', @$booking->status))}}</td>
	<td>{{date('d/m/Y',strtotime(@$booking->booked_on))}}</td>
	<td>
		<a class="action-button" title="View" href="{{route('view-booking',$booking->id)}}"><i class="text-info fa fa-eye"></i></a>
		<!-- <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a> -->
	</td> 
</tr>
@endforeach
