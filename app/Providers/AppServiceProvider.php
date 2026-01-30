<?php

namespace App\Providers;

use App\Domains\Project\Model\Project;
use App\Domains\Project\Policies\ProjectPolicy;
use App\Domains\Shared\Exceptions\ForbiddenForYouException;
use App\Domains\Shared\Model\Program;
use App\Domains\Shared\Policies\ProgramPolicy;
use App\Domains\Task\Model\Task;
use App\Domains\Task\Policies\TaskPolicy;
use App\Domains\TimeEntry\Model\TimeEntry;
use App\Domains\TimeEntry\Policies\TimeEntryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin-access', function ($user) {
            if ($user->role_name !== 'admin') {
                throw new ForbiddenForYouException();
            }
            return true;
        });
        Gate::policy(Project::class, ProjectPolicy::class);
        Gate::policy(Task::class, TaskPolicy::class);
        Gate::policy(TimeEntry::class, TimeEntryPolicy::class);
        Gate::policy(Program::class, ProgramPolicy::class);
    }
}
