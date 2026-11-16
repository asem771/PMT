
@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>{{ __('Post Management') }}</h1>

    <a href="{{ route('posts.create') }}" class="btn">
        + {{ __('Create Post') }}
    </a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Content') }}</th>
                <th>{{ __('Created At') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>

                    <td>{{ $post->title }}</td>

                    <td>
                        {{ Str::limit($post->content, 80) }}
                    </td>

                    <td>
                        {{ $post->created_at->format('Y-m-d') }}
                    </td>

<td>
    <div style="display: flex; align-items: center; gap: 6px; flex-wrap: nowrap;">

        <a href="{{ route('posts.show', $post) }}"
           class="btn btn-sm">
            {{ __('View') }}
        </a>

        <a href="{{ route('posts.edit', $post) }}"
           class="btn btn-sm">
            {{ __('Edit') }}
        </a>

        <form action="{{ route('posts.destroy', $post) }}"
              method="POST"
              style="display: inline-flex; margin: 0;">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm(@json(__('Are you sure you want to delete this post?')))">
                {{ __('Delete') }}
            </button>
        </form>

    </div>
</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        {{ __('No posts found. Create your first post.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $posts->links() }}
    </div>
</div>

@endsection
