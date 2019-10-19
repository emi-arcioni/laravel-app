@extends('app')

@section('title', 'Home')

@section('content')
<main role="main" class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            @include('entry-table', [
                'user_id' => $user ? $user->id : null,
                'entries' => $entries
            ])
        </div>
    </div>

</main><!-- /.container -->
@endsection