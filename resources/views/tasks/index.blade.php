@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<div class="header">
    <h1>My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn">+ New task</a>
</div>

<div class="stats">
    <span>Total: <strong>{{ $stats['total'] }}</strong></span>
    <span>Pending: <strong>{{ $stats['pending'] }}</strong></span>
    <span>Completed: <strong>{{ $stats['completed'] }}</strong></span>
</div>

{{-- Filters use GET: the values go in the URL --}}
<form method="GET" action="{{ route('tasks.index') }}" class="filters">
    <select name="status">
        <option value="">All tasks</option>
        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        <option value="completed" @selected(request('status') === 'completed')>Completed</option>
    </select>

    <select name="category">
        <option value="">All categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button class="btn small">Filter</button>

    @if (request()->hasAny(['status', 'category']))
        <a href="{{ route('tasks.index') }}">Reset</a>
    @endif
</form>

@forelse ($tasks as $task)
    <div class="task {{ $task->is_completed ? 'done' : '' }}">
        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
            @csrf
            @method('PATCH')
            <button class="check-btn" title="Mark as done / pending">
                {{ $task->is_completed ? '☑' : '☐' }}
            </button>
        </form>

        <div class="info">
            <a href="{{ route('tasks.show', $task) }}" class="title">{{ $task->title }}</a>
            <div class="meta">
                @if ($task->category)
                    <span class="badge" style="background: {{ $task->category->color }}">{{ $task->category->name }}</span>
                @endif

                @if ($task->due_date)
                    <span class="{{ $task->isOverdue() ? 'overdue' : '' }}">
                        Due {{ $task->due_date->format('d M Y') }}
                        @if ($task->isOverdue()) (overdue) @endif
                    </span>
                @endif

                @if ($task->attachment) <span>📎 File</span> @endif
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline"
                  onsubmit="return confirm('Delete this task?')">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">No tasks found. Click "New task" to add one.</div>
@endforelse
@endsection
