@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="eyebrow">YOUR DAILY OVERVIEW</div>
    <h1>Tasks for today<span class="accent">.</span></h1>
    <p class="lead">Focus on what matters today. Tasks scheduled for other dates are in your full task list.</p>
    <div class="summary-card">
        <div><span class="small-label">TODAY</span><h2>{{ $today->format('l, F j, Y') }}</h2><p>{{ $tasks->count() }} {{ $tasks->count() === 1 ? 'task' : 'tasks' }} scheduled</p></div>
        <a class="button" href="{{ route('tasks.index') }}">View all tasks <span aria-hidden="true">→</span></a>
    </div>
    <section class="section" aria-labelledby="today-heading">
        <div class="section-head"><div><div class="eyebrow">ON YOUR LIST</div><h2 id="today-heading">Today’s tasks</h2></div><span class="count">{{ $tasks->count() }} total</span></div>
        <div class="task-list">
            @forelse ($tasks as $task)
                <div class="task-row"><span class="task-icon" aria-hidden="true">{{ $task->status === 'completed' ? '✓' : '○' }}</span><div class="task-info"><strong>{{ $task->title }}</strong><span>Scheduled for today</span></div><span class="badge {{ $task->status === 'completed' ? 'done' : ($task->status === 'in progress' ? 'progress' : 'pending') }}">{{ ucfirst($task->status) }}</span></div>
            @empty
                <div class="empty-state">No tasks are scheduled for today. <a href="{{ route('tasks.index') }}">View all tasks</a>.</div>
            @endforelse
        </div>
    </section>
@endsection
