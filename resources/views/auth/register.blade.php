@extends('app')

@section('title', 'Sign in')

@section('content')
<main role="main" class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h1 class="h3 mb-3 font-weight-normal">Please Sign in</h1>
            <form action="{{ url('/signin') }}" method="POST" id="signInForm">
                @csrf

                <div class="form-group">
                    <label for="input1">Name</label>
                    <input type="text" name="name" class="form-control" id="input1" value="{{ old('name') }}" placeholder="Enter your name"  max="255">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input2">Username</label>
                    <input type="text" name="username" class="form-control" id="input2" value="{{ old('username') }}" placeholder="Enter your username" required max="255">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input3">E-mail</label>
                    <input type="email" name="email" class="form-control" id="input3" value="{{ old('email') }}" placeholder="Enter your e-mail" required max="255">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input4">Password</label>
                    <input type="password" name="password" class="form-control" id="input4" value="{{ old('password') }}" placeholder="Enter your password" required max="255">
                    <small id="emailHelp" class="form-text text-muted">The password must be at least 8 characters</small>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input5">Repeat password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="input5" value="{{ old('password_confirmation') }}" placeholder="Repeat your password" required max="255">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input6">Twitter username</label>
                    <input type="text" name="twitter_username" class="form-control" id="input6" value="{{ old('twitter_username') }}" placeholder="@your-user" max="255">
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </div>
                <p>Already a member? Please <a href="{{ url('/login') }}">log in</a></p>
            </form>
        </div>
    </div>
</main>
@endsection