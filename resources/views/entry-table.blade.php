<table class="table">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">User</th>
            @auth
                <th scope="col">Actions</th>
            @endauth
        </tr>
    </thead>
    <tbody>
        @foreach ($entries as $entry)
        <tr>
            <td>{{ $entry->created_at }}</td>
            <td>{{ $entry->title }}</td>
            <td>{{ $entry->content }}</td>
            <td><a href="{{ url('/users/' . $entry->user->id) . '/entries' }}">{{ $entry->user->username }}</a></td>
            @auth
                <td>
                    @if ($user_id == $entry->user->id)
                        <a href="{{ url('/users/' . $entry->user->id . '/entries/' . $entry->id . '/edit') }}">Edit</a>
                        <a href="javascript:;" data-remove-entry data-url="{{ url('/users/' . $entry->user->id . '/entries/' . $entry->id) }}" data-token="{{ csrf_token() }}">Remove</a>
                    @endif
                </td>
            @endauth
        </tr>
        @endforeach
    </tbody>
</table>