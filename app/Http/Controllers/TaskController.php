<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function today(): View
    {
        $tasks = Task::query()
            ->whereDate('task_date', today())
            ->orderBy('id')
            ->get();

        return view('welcome', [
            'tasks' => $tasks,
            'today' => today(),
        ]);
    }

    public function index(): View
    {
        $tasks = Task::query()
            ->orderBy('task_date')
            ->orderBy('id')
            ->get();

        return view('tasks.index', compact('tasks'));
    }
}
