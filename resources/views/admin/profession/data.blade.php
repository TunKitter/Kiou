@foreach ($professions as $key => $profession)
<tr id="profession-{{$profession->_id}}">
    <td>{{ $profession->_id }}</td>
    <td>{{ $profession->name }}</td>
    <td class="parent_name">
        @php
            $x = '';
           
        @endphp
            @foreach ($profession->parent_profession as $parent)
            @php
                $name = App\Models\Profession::where('_id', $parent)->first();
                $x .= $name->name . ', ';
              
            @endphp
            @endforeach
    
        {{ rtrim($x, ', ') }} 
    </td>
    <td></td>
  
    <td>
        {{ $profession->created_at }}
    </td>
    <td>
        <a href="javascript:void(0);" data-toggle="modal" data-target="#professionEdit" 
            data-id="{{$profession->_id}}" class="btn btn-warning btn-edit">Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger profession-delete" data-id="{{$profession->_id}}">Delete</a>
       
    </td>
</tr>
@endforeach  
