
@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{ $task->title }}</h1>

        <div>
            <a href="/tasks" class="btn btn-secondary">
                ← {{ __('Back to Tasks') }}
            </a>

            <a href="/tasks/{{ $task->id }}/edit" class="btn">
                {{ __('Edit Task') }}
            </a>

            <form method="POST" action="/tasks/{{ $task->id }}" class="inline-form">
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger"
                    onclick="return confirm(@json(__('Delete this task?')))"
                >
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Task Details -->
    <div class="card">
        <p>
            <strong>{{ __('Category') }}:</strong>
            {{ $task->category->name }}
        </p>

        <p>
            <strong>{{ __('Status') }}:</strong>
            <span class="badge badge-{{ $task->status }}">
                {{ __(ucwords(str_replace('_', ' ', $task->status))) }}
            </span>
        </p>

        <p>
            <strong>{{ __('Due Date') }}:</strong>
            {{ $task->due_date?->format('Y-m-d') ?? __('No date') }}
        </p>

        <p>
            <strong>{{ __('Description') }}:</strong>
            <br>
            {{ $task->description ?: __('No description provided.') }}
        </p>
    </div>

    <!-- Assigned Students & Assign Form -->
    <div class="card">
        <h2>{{ __('Assigned Students') }}</h2>

        <form
            method="POST"
            action="/tasks/{{ $task->id }}/assign"
            class="filter-bar"
            style="margin-bottom: 1.5rem;"
        >
            @csrf

            <select name="student_id" required>
                <option value="">-- {{ __('Select a Student') }} --</option>

                @foreach ($students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->name }} ({{ $student->email }})
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn">
                {{ __('Assign Task') }}
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>{{ __('Student Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($task->students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>

                        <td>
                            <form
                                method="POST"
                                action="/tasks/{{ $task->id }}/students/{{ $student->id }}"
                                class="inline-form"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    {{ __('Remove') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            {{ __('No students assigned to this task yet.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
