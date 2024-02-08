<?php for ($i=0; $i < count((is_countable($adminsList)?$adminsList:[])); $i++) { 
  $role = \App\Models\Role::where('id', $adminsList[$i]->role_id)->get();
  ?>
  <tr>
    <td class="display-none"></td>
    <td>{{ $adminsList[$i]->email }}</td>
    <td>{{ $adminsList[$i]->full_name }}</td>
    <td>{{ $role[0]->name }}</td>
    <td>{{$adminsList[$i]->created_at->timezone(session('timezone')??'UTC')->format('d/m/Y h:i:s A T')}}</td>
    <td>{{$adminsList[$i]->updated_at->timezone(session('timezone')??'UTC')->format('d/m/Y h:i:s A T')}}</td>
    
    <td>
      
      <!-- @can('view_admin')
        <a class="action-button" title="View" href="view/{{$adminsList[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
      @endcan -->
     
        <a class="action-button" title="Edit" href="edit/{{$adminsList[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
     
        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $adminsList[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
     
    </td>
    
  </tr>
<?php } ?>