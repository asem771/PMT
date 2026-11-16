
@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{ __('Create New Task') }}</h1>
        <a href="/tasks" class="btn btn-secondary">
            ← {{ __('Back to Tasks') }}
        </a>
    </div>

    <div class="card">
        <form method="POST" action="/tasks">
            @csrf

            <div class="form-group">
                <label>{{ __('Title') }}</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
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
                >{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>{{ __('Category') }}</label>
                <select name="category_id" required>
                    <option value="">-- {{ __('Select Category') }} --</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ __('Status') }}</label>
                <select name="status" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                        {{ __('Pending') }}
                    </option>

                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>
                        {{ __('In Progress') }}
                    </option>

                    <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>
                        {{ __('Done') }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>{{ __('Due Date') }}</label>
                <input
                    type="date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                >
            </div>

            <button type="submit" class="btn">
                {{ __('Save Task') }}
            </button>
        </form>
    </div>
@endsection
