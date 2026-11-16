
@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>{{ __('Edit Post') }}</h1>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
        {{ __('Back to Posts') }}
    </a>
</div>

<div class="card">
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">{{ __('Post Title') }}</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $post->title) }}"
                placeholder="{{ __('Enter post title...') }}"
                required
            >

            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">{{ __('Post Content') }}</label>

            <textarea
                id="content"
                name="content"
                rows="8"
                placeholder="{{ __('Write your article here...') }}"
                required
            >{{ old('content', $post->content) }}</textarea>

            @error('content')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">
            {{ __('Update Post') }}
        </button>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
            {{ __('Cancel') }}
        </a>
    </form>
</div>

@endsection
