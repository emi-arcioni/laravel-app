@extends('app')

@section('title', 'Log in')

@section('content')
<main role="main" class="container">
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <h1 class="h3 mb-3 font-weight-normal">Please Log in</h1>
            <form action="{{ url('/login') }}" method="POST" id="logInForm">
                @csrf

                <div class="form-group">
                    <input type="text" name="username" id="inputUsername" value="{{ old('username') }}" class="form-control" placeholder="Username" required autofocus>
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="inputPassword" value="{{ old('password') }}" class="form-control" placeholder="Password" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                </div>
                <p>Not a member? Please <a href="{{ url('/register') }}">register</a></p>
            </form>
        </div>
    </form>
</main>
@endsection