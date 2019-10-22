@foreach ($entries as $entry)
    <div class="entry row mb-4">
        <div class="col-md-12">
            <h2>{{ $entry->title }}</h2>    
        </div>
        <div class="col-md-12">
            @auth
                @if ($user_id == $entry->user->id)
                    <div class="btn-group mb-3">
                        <a class="btn btn-secondary" href="{{ url('/users/' . $entry->user->id . '/entries/' . $entry->id . '/edit') }}">Edit</a>
                        <a class="btn btn-secondary" href="javascript:;" data-remove-entry data-url="{{ url('/users/' . $entry->user->id . '/entries/' . $entry->id) }}" data-token="{{ csrf_token() }}">Remove</a>
                    </div>
                @endif
            @endauth
            <h5>{{ date('m-d-Y H:i', strtotime($entry->created_at)) }}</h5>
            <h5><a href="{{ url('/users/' . $entry->user->id) . '/entries' }}">{{ $entry->user->username }}</a></h5>
        </div>
        <div class="col-md-12">
            {!! nl2br(e($entry->content)) !!}
        </div>
    </div>
@endforeach

@if (!empty($paginator))
    {{ $paginator }}
@endif