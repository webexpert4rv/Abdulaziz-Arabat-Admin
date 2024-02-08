@foreach($users as $key=>$user)
<tr>
   <td >{{$key+1}}</td>  
   <td>{{$user->unique_ID}}</td>
    <td>{{$user->email}}</td> 
    <td>{{$user->name}}</td>  
   <td>
    <label class="switch">
        <input type="checkbox" onchange="updateStatus({{$user->id}},{!! $user->status == 1 ? '0' : '1' !!})" type="checkbox" id="demo{{$user->id}}" {{$user->status==1?'checked':''}}>
        <span class="slider round"></span>
    </label>
</td>
<td class="approve_css approve_status{{$user->id}}">
    <div class="loader_css
    forgot_loader_img{{$user->id}}">

</div>
@can('edit_transporter') 
@if($user->is_approve==0)
<a class="action-button btn btn-danger" onclick="transporterApproveStatus({{$user->id}},1)" href="javascript:void(0)">Pending</a>
@else
<a class="action-button btn btn-success"  onclick="transporterUnApproveStatus({{$user->id}},0)"  href="javascript:void(0)">Approved</a>
@endif
@endcan
</td>
<td>

    <a class="action-button" title="View" href="{{route('users.show',$user->id)}}"><i class="text-info fa fa-eye"></i></a>
    <a class="action-button" title="Edit" href="{{route('users.edit',$user->id)}}"><i class="text-warning fa fa-edit"></i></a>
    <a class="action-button delete-button" onclick="userDelete({{$user->id}})" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
</td> 
</tr>
@endforeach