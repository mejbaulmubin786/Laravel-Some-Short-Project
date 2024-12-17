@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    value="{{ old('title', $post->title) }}"
                    required
                >
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Body Field -->
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea
                    name="body"
                    id="body"
                    rows="5"
                    class="form-control @error('body') is-invalid @enderror"
                    required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
