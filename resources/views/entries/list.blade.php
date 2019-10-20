@extends('app')

@section('title', 'List entries')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h1 class="h2 font-weight-normal">User {{ $user->username }}</h1>
        </div>
        <div class="col-md-8">
            <main>
                <h3 class="font-weight-normal">Entries</h3>
            
                @include('entry-table', [
                    'user_id' => $loggedUser ? $loggedUser->id : null,
                    'entries' => $entries
                ])
            </main>
        </div>
        @if (!empty($user->twitter_username))
            <div class="col-md-3">
                <aside>
                    <h3 class="font-weight-normal">Tweets ({{ $user->twitter_username }})</h3> 
                    @if (!empty($tweets->errors))
                        @foreach ($tweets->errors as $error)
                            <div class="alert alert-info">{{ $error->message }}</div>
                        @endforeach
                    @else
                        @foreach($tweets as $tweet)
                            <div class="card mb-3">
                                @if (!empty($tweet->entities->media))
                                    <img src="{{ $tweet->entities->media[0]->media_url }}" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $tweet->created_at }}</h6>
                                    <p class="card-text">{{ $tweet->text }}</p>
                                    <p><a href="https://twitter.com/{{ $user->twitter_username }}/status/{{ $tweet->id }}" class="card-link" target="_blank">View in twitter.com</a></p>
                                    @if ($loggedUser && $loggedUser->id == $user->id)
                                        <button class="btn btn-primary" data-hide-tweet-btn data-id="{{ $tweet->id }}">Hide</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </aside>
            </div>
        @endif
    </div>
</div>
@endsection