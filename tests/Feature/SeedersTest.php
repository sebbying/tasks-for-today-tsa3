<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use Tests\TestCase;

#[RequiresPhpExtension('pdo_sqlite')]
class SeedersTest extends TestCase
{
    use RefreshDatabase;

    public function test_schema_and_seeders_match_the_activity_and_can_run_twice(): void
    {
        foreach (['title', 'status', 'task_date', 'created_at', 'updated_at'] as $field) {
            $this->assertTrue(Schema::hasColumn('tasks', $field));
        }
        foreach (['username', 'full_name', 'email'] as $field) {
            $this->assertTrue(Schema::hasColumn('users', $field));
        }
        $this->seed();
        $this->seed();
        $this->assertDatabaseCount('tasks', 9);
        $this->assertDatabaseCount('users', 1);
        $this->assertGreaterThanOrEqual(3, Task::distinct('task_date')->count('task_date'));
        $this->assertSame(4, Task::whereDate('task_date', today())->count());

        Task::create(['title' => 'Check status default', 'task_date' => today()]);
        $this->assertDatabaseHas('tasks', ['title' => 'Check status default', 'status' => 'pending']);
    }
}
