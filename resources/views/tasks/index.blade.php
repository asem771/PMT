
@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>{{ __('Tasks') }}</h1>

    <a href="/tasks/create" class="btn">
        + {{ __('Create Task') }}
    </a>
</div>

{{-- Search and Filter Bar --}}
<div class="card">
    <form method="GET" action="/tasks" class="filter-bar">

        <input
            type="text"
            name="search"
            placeholder="{{ __('Search title or description...') }}"
            value="{{ request('search') }}"
        >

        <select name="status">
            <option value="">{{ __('All Statuses') }}</option>

            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                {{ __('Pending') }}
            </option>

            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                {{ __('In Progress') }}
            </option>

            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>
                {{ __('Done') }}
            </option>
        </select>

        <select name="category_id">
            <option value="">{{ __('All Categories') }}</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ __($category->name) }}
                </option>
            @endforeach
        </select>

        <select name="student_id">
            <option value="">{{ __('All Students') }}</option>

            @foreach ($students as $student)
                <option value="{{ $student->id }}"
                    {{ request('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">
            {{ __('Filter') }}
        </button>

        <a href="/tasks" class="btn btn-secondary">
            {{ __('Reset') }}
        </a>

    </form>
</div>

{{-- Tasks List Table --}}
<div class="card">
    <table>
        <thead>
            <tr>
                <th>{{ __('Task') }}</th>
                <th>{{ __('Category') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Due Date') }}</th>
                <th>{{ __('Assigned Students') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>
                        <a href="/tasks/{{ $task->id }}"
                           style="font-weight: 700; color: var(--text); text-decoration: none;">
                            {{ __($task->title) }}
                        </a>
                    </td>

                    <td>{{ __($task->category->name) }}</td>

                    <td>
                        <form method="POST"
                              action="/tasks/{{ $task->id }}/status"
                              class="inline-form">

                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="badge badge-{{ $task->status }}">

                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                    {{ __('Pending') }}
                                </option>

                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                    {{ __('In Progress') }}
                                </option>

                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>
                                    {{ __('Done') }}
                                </option>

                            </select>
                        </form>
                    </td>

                    <td>
                        {{ $task->due_date?->format('Y-m-d') ?? __('No date') }}
                    </td>

                    <td>
                        {{ $task->students->pluck('name')->join(', ') ?: __('Unassigned') }}
                    </td>

                    <td>
                        <a href="/tasks/{{ $task->id }}"
                           class="btn btn-sm">
                            {{ __('View / Assign') }}
                        </a>

                        <a href="/tasks/{{ $task->id }}/edit"
                           class="btn btn-sm">
                            {{ __('Edit') }}
                        </a>

                        <form method="POST"
                              action="/tasks/{{ $task->id }}"
                              class="inline-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm(@json(__('Delete this task?')))">
                                {{ __('Delete') }}
                            </button>

                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6">
                        {{ __('No tasks found.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">

        @if ($tasks->previousPageUrl())
            <a href="{{ $tasks->previousPageUrl() }}"
               class="btn btn-secondary btn-sm">
                {{ __('Previous') }}
            </a>
        @endif

        <span style="margin: 0 0.5rem;">
            {{ __('Page') }} {{ $tasks->currentPage() }}
            {{ __('of') }} {{ $tasks->lastPage() }}
        </span>

        @if ($tasks->nextPageUrl())
            <a href="{{ $tasks->nextPageUrl() }}"
               class="btn btn-secondary btn-sm">
                {{ __('Next') }}
            </a>
        @endif

    </div>
</div>

@endsection
