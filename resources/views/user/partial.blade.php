@foreach($users as $key=>$user)
    <tr>
         <td >{{$key+1}}</td>  
        <td>{{$user->unique_ID}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->name}}</td>
        <td>@if($user->account_type==0) User Personal  @endif @if($user->account_type==1) User Business @endif</td>
         <td>{{$user->booking_count}}</td>
                <td>{{date('d/m/Y',strtotime($user->created_at))}}</td>
        <!--<td>{{date('d/m/Y',strtotime($user->updated_at))}}</td> -->
        <td>
            <label class="switch">
                <input type="checkbox" onchange="updateStatus({{$user->id}},{!! $user->status == 1 ? '0' : '1' !!})" type="checkbox" id="demo{{$user->id}}" {{$user->status==1?'checked':''}}>
                <span class="slider round"></span>
            </label>
        </td>
        <td>

            <a class="action-button" title="View" href="{{route('users.show',$user->id)}}"><i class="text-info fa fa-eye"></i></a>
            <a class="action-button" title="Edit" href="{{route('users.edit',$user->id)}}"><i class="text-warning fa fa-edit"></i></a>
            <a class="action-button delete-button" onclick="userDelete({{$user->id}})" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>
        </td> 
    </tr>
@endforeach