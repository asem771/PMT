
@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>{{ __('Post Details') }}</h1>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
        {{ __('Back to Posts') }}
    </a>
</div>

<div class="card">
    <h2>{{ $post->title }}</h2>

    <p style="color: var(--muted);">
        {{ __('Created At') }}:
        {{ $post->created_at->format('Y-m-d H:i') }}
    </p>

    <hr>

    <div style="white-space: pre-wrap;">
        {{ $post->content }}
    </div>

    <div style="margin-top: 1.5rem;">

        <a href="{{ route('posts.edit', $post) }}" class="btn">
            {{ __('Edit Post') }}
        </a>

        <form action="{{ route('posts.destroy', $post) }}"
              method="POST"
              class="inline-form">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger"
                    onclick="return confirm(@json(__('Are you sure you want to delete this post?')))">
                {{ __('Delete Post') }}
            </button>

        </form>
    </div>
</div>

@endsection
