<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Relative dates keep today's page populated whenever the seeder runs.
        $tasks = [
            ['title' => 'Outline the weekly study plan', 'status' => 'completed', 'offset' => -2],
            ['title' => 'Review the systems analysis notes', 'status' => 'completed', 'offset' => -1],
            ['title' => 'Prepare IT0049 Laravel activity', 'status' => 'pending', 'offset' => 0],
            ['title' => 'Check the task database records', 'status' => 'in progress', 'offset' => 0],
            ['title' => 'Read the cybersecurity module', 'status' => 'pending', 'offset' => 0],
            ['title' => 'Organize group project notes', 'status' => 'completed', 'offset' => 0],
            ['title' => 'Submit the weekly reflection', 'status' => 'pending', 'offset' => 1],
            ['title' => 'Review upcoming quiz topics', 'status' => 'pending', 'offset' => 3],
            ['title' => 'Prepare next week task list', 'status' => 'pending', 'offset' => 5],
        ];

        foreach ($tasks as $item) {
            Task::updateOrCreate(
                ['title' => $item['title']],
                [
                    'status' => $item['status'],
                    'task_date' => today()->addDays($item['offset'])->toDateString(),
                ],
            );
        }
    }
}
