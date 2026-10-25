<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // No additional container bindings are needed for this activity.
    }

    public function boot(): void
    {
        // No additional application boot steps are needed.
    }
}
