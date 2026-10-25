<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use Tests\TestCase;

#[RequiresPhpExtension('pdo_sqlite')]
class PagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_filters_to_today_and_all_tasks_are_sorted_by_date(): void
    {
        $this->travelTo(\Illuminate\Support\Carbon::parse('2026-10-25 12:00:00', 'Asia/Manila'));
        $this->seed();

        $this->assertDatabaseCount('tasks', 9);
        $this->assertSame(4, Task::whereDate('task_date', today())->count());
        $this->get('/')->assertOk()->assertSee('Prepare IT0049 Laravel activity')->assertDontSee('Outline the weekly study plan');
        $this->get('/tasks')->assertOk()->assertSeeInOrder([
            'Outline the weekly study plan',
            'Review the systems analysis notes',
            'Prepare IT0049 Laravel activity',
            'Submit the weekly reflection',
            'Review upcoming quiz topics',
        ]);

        // Changing the clock changes the Welcome result without altering its view.
        $this->travelTo(\Illuminate\Support\Carbon::parse('2026-10-26 12:00:00', 'Asia/Manila'));
        $this->get('/')->assertOk()->assertSee('Submit the weekly reflection')->assertDontSee('Prepare IT0049 Laravel activity');
    }

    public function test_profile_and_navigation_show_the_single_user(): void
    {
        $this->seed();
        $this->assertDatabaseCount('users', 1);
        $this->get('/profile')->assertOk()->assertSee('John Xavier Tumbokon')->assertSee('student@example.com');
        foreach (['/', '/tasks', '/profile', '/about'] as $uri) {
            $this->get($uri)->assertOk()->assertSee('href="'.route('home').'"', false)
                ->assertSee('href="'.route('tasks.index').'"', false)
                ->assertSee('href="'.route('profile').'"', false)
                ->assertSee('href="'.route('about').'"', false);
        }
    }
}
