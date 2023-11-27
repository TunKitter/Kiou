@foreach ($posts as $post)
    <tr>
        {{-- <td>{{ $user->_id }}</td> --}}
        <td class="user_tr_0">{{ $post->title }}</td>
        <td class="user_tr_1">{{ $post->content_path }}</td>
        <td class="user_tr_2">{{ $post->created_at }}</td>
        <td class="user_tr_3">{{ $post->updated_at }}</td>
        <td>
            <a href="#" class="btn btn-warning">Sửa</a>
            <a href="#" class="btn btn-danger">Xóa</a>
        </td>
    </tr>
@endforeach
