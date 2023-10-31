@foreach ($categories as $category)
    <tr class="category_tr" id="category-{{ $category->id }}">
        {{-- <td>{{ $user->_id }}</td> --}}
        <td class="category_tr_0">{{ $category->name }}</td>
        <td class="category_tr_1">{{ $category->slug }}</td>
        <td class="category_tr_2">{{ $category->created_at }}</td>
        <td class="category_tr_3">{{ $category->updated_at }}</td>
        <td>
            <a href="javascript::void(0);" class="btn btn-warning edit-button" data-bs-toggle="modal"
            data-bs-target="#editCategory" data-id="{{ $category->id }}">Edit</a>
            <a href="javascript::void(0);" class="btn btn-danger category-delete" data-id="{{ $category->_id }}">Delete</a>
        </td>
    </tr>
@endforeach
