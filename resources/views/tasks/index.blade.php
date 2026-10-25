@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <div class="eyebrow">EVERYTHING IN ONE PLACE</div>
    <h1>Full task list<span class="accent">.</span></h1>
    <p class="lead">All tasks in the database, ordered from the earliest scheduled date.</p>
    <section class="section" aria-labelledby="all-heading">
        <div class="section-head"><div><div class="eyebrow">YOUR SCHEDULE</div><h2 id="all-heading">All tasks</h2></div><span class="count">{{ $tasks->count() }} total</span></div>
        <div class="table-scroll" role="region" aria-label="All tasks table" tabindex="0">
            <table>
                <thead><tr><th scope="col">Task</th><th scope="col">Date</th><th scope="col">Status</th></tr></thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr><td><strong>{{ $task->title }}</strong></td><td>{{ $task->task_date->format('M j, Y') }}</td><td><span class="badge {{ $task->status === 'completed' ? 'done' : ($task->status === 'in progress' ? 'progress' : 'pending') }}">{{ ucfirst($task->status) }}</span></td></tr>
                    @empty
                        <tr><td colspan="3" class="empty-state">No tasks found. Run the task seeder to add sample tasks.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
