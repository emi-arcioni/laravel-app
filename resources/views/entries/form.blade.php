@extends('app')

@section('title', 'New Entry')

@section('content')
<main role="main" class="container">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <h1 class="h3 mb-3 font-weight-normal">New Entry</h1>
            <form action="{{ url('/users/' . $user->id . '/entries' . ($entry ? '/' . $entry->id : '')) }}" method="POST" id="entriesForm">
                @csrf

                @if ($entry)
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="input1">Title</label>
                    <input type="text" name="title" class="form-control" id="input1" value="{{ old('title') ? old('title') : $entry['title'] }}" placeholder="Enter a title" max="255" required>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input2">Content</label>
                    <textarea name="content" id="input2" class="form-control cols="30" rows="10" placeholder="Enter the content" required>{{ old('content') ? old('content') : $entry['content'] }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-lg btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection