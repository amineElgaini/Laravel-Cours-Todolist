@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="card">
    <h1>{{ $task->title }}</h1>

    <p>
        Status:
        @if ($task->is_completed)
            <strong>✅ Completed</strong>
        @else
            <strong>⏳ Pending</strong>
        @endif
    </p>

    <p>Category: {{ $task->category->name ?? 'None' }}</p>

    <p>
        Due date:
        @if ($task->due_date)
            <span class="{{ $task->isOverdue() ? 'overdue' : '' }}">{{ $task->due_date->format('d M Y') }}</span>
        @else
            Not set
        @endif
    </p>

    <p>{{ $task->description ?: 'No description.' }}</p>

    @if ($task->attachment)
        <p><a href="{{ route('tasks.attachment', $task) }}">📎 Download attachment</a></p>
    @endif

    <p class="muted">Created {{ $task->created_at->diffForHumans() }}</p>

    <a href="{{ route('tasks.edit', $task) }}" class="btn">Edit</a>
    <a href="{{ route('tasks.index') }}" class="btn secondary">Back</a>

    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline"
          onsubmit="return confirm('Delete this task?')">
        @csrf
        @method('DELETE')
        <button class="btn danger">Delete</button>
    </form>
</div>
@endsection
