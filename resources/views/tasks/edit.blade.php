
@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{ __('Edit Task') }}</h1>
        <a href="/tasks/{{ $task->id }}" class="btn btn-secondary">
            ← {{ __('Back to Task') }}
        </a>
    </div>

    <div class="card">
        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>{{ __('Title') }}</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    placeholder="{{ __('Enter task title...') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>{{ __('Description') }}</label>
                <textarea
                    name="description"
                    rows="4"
                    placeholder="{{ __('Enter task description...') }}"
                >{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="form-group">
                <label>{{ __('Category') }}</label>
                <select name="category_id" required>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ __('Status') }}</label>
                <select name="status" required>
                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                        {{ __('Pending') }}
                    </option>

                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>
                        {{ __('In Progress') }}
                    </option>

                    <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>
                        {{ __('Done') }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>{{ __('Due Date') }}</label>
                <input
                    type="date"
                    name="due_date"
                    value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                >
            </div>

            <button type="submit" class="btn">
                {{ __('Update Task') }}
            </button>
        </form>
    </div>
@endsection
