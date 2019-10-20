@extends('app')

@section('title', 'Sign in')

@section('content')
<main role="main" class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h1 class="h3 mb-3 font-weight-normal">
                @if (!empty($user))
                    Update user information
                @else
                    Please Sign in
                @endif
            </h1>
            <form action="{{ url(!empty($user) ? '/users/' . $user->id : '/signin') }}" method="POST" id="signInForm">
                @csrf

                @if (!empty($user))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="input1">Name</label>
                    <input type="text" name="name" class="form-control" id="input1" value="{{ old('name') ? old('name') : $user['name'] }}" placeholder="Enter your name"  max="255">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input2">Username</label>
                    <input type="text" name="username" class="form-control" id="input2" value="{{ old('username') ? old('username') : $user['username'] }}" placeholder="Enter your username" required max="255">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input3">E-mail</label>
                    <input type="email" name="email" class="form-control" id="input3" value="{{ old('email') ? old('email') : $user['email'] }}" placeholder="Enter your e-mail" required max="255">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input4">{{ !empty($user) ? 'New password' : 'Password' }}</label>
                    <input type="password" name="password" class="form-control" id="input4" value="{{ old('password') }}" placeholder="Enter your password" {{ empty($user) ? 'required' : '' }} max="255">
                    <small id="emailHelp" class="form-text text-muted">The password must be at least 8 characters</small>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input5">{{ !empty($user) ? 'Repeat new password' : 'Repeat password' }}</label>
                    <input type="password" name="password_confirmation" class="form-control" id="input5" value="{{ old('password_confirmation') }}" placeholder="Repeat your password" {{ empty($user) ? 'required' : '' }} max="255">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input6">Twitter username</label>
                    <input type="text" name="twitter_username" class="form-control" id="input6" value="{{ old('twitter_username') ? old('twitter_username') : $user['twitter_username'] }}" placeholder="@your-user" max="255">
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        @if (!empty($user))
                            Update
                        @else
                            Sign in
                        @endif
                    </button>
                </div>
                @if (empty($user))
                    <p>Already a member? Please <a href="{{ url('/login') }}">log in</a></p>
                @endif
            </form>
        </div>
    </div>
</main>
@endsection