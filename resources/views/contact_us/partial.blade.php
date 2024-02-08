<?php for ($i=0; $i < count($contactUsMessagesList); $i++) { ?>
  <tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $contactUsMessagesList[$i]->name }}</td>
    <td>{{ $contactUsMessagesList[$i]->email }}</td>
    <td>{{ $contactUsMessagesList[$i]->phone_number }}</td>
    <td>{{ $contactUsMessagesList[$i]->subject }}</td> 
    <!-- <td>{{ $contactUsMessagesList[$i]->message }}</td>-->

    <td style="white-space:nowrap;">
      <select class="form-control" id="status" data-id="{{$contactUsMessagesList[$i]->id}}">
        @foreach(\App\Models\ContactUs::status() as $status)
        <option value="{{strtolower($status)}}" @if(strtolower($status)==$contactUsMessagesList[$i]->status) selected @endif>{{$status}}</option>
        @endforeach
      </select>
    </td>


    @can('view_feedbacks')
    <td>
      <a href="{{ route('view_contact_us_message', ['id' => $contactUsMessagesList[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
      <!-- <a title="Reply" href="mailto:{{ $contactUsMessagesList[$i]->email }}">
          <i class="fa fa-reply"></i>
      </a> -->
      <a href="{{route('contact_us.reply',$contactUsMessagesList[$i]->id)}}"><i class="fa fa-reply"></i></a>
    </td>
    @endcan
  </tr>
<?php } ?>