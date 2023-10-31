@foreach ($users as $user)
    <tr class="user_tr" id="user-{{ $user->id }}">
        {{-- <td>{{ $user->_id }}</td> --}}
        <td class="user_tr_0">{{ $user->username }}</td>
        <td class="user_tr_1">{{ $user->name }}</td>
        <td class="user_tr_2">{{ $user->email }}</td>
        <td class="user_tr_3">{{ $user->phone }}</td>
        {{-- <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td> --}}
        <td>
            <a href="javascript::void(0);" class="btn btn-warning edit-button" data-bs-toggle="modal"
                data-bs-target="#editUser" data-id="{{ $user->id }}">Edit</a>
            <a href="javascript::void(0);" class="btn btn-danger user-delete" data-id="{{ $user->_id }}">Delete</a>
        </td>
    </tr>
@endforeach
