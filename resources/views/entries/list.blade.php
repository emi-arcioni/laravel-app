@extends('app')

@section('title', 'List entries')

@section('content')
<main role="main" class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-12">
            <h1 class="h2 mb-3 font-weight-normal">User {{ $user->username }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3 class="font-weight-normal">Entries</h3>

            @include('entry-table', [
                'user_id' => $loggedUser ? $loggedUser->id : null,
                'entries' => $entries
            ])
        </div>
        <div class="col-md-4">
        <h3 class="font-weight-normal">Tweets</h3> 
        </div>
    </div>

</main>
@endsection