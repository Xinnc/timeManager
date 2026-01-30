<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Project\Model\Project;
use App\Domains\Shared\Model\Program;
use App\Domains\Task\Enums\TaskStatus;
use App\Domains\Task\Model\Task;
use App\Domains\TimeEntry\Model\TimeEntry;
use App\Domains\User\Models\User;

class GetSystemStatsAction
{
    public static function execute(): array
    {
        return [
            'users' => [
                'total' => User::count(),
                'active' => User::where('is_banned', false)->count(),
                'banned' => User::where('is_banned', true)->count(),
                'admins' => User::whereHas('role', fn($q) => $q->where('role', 'admin'))->count(),
                'managers' => User::whereHas('role', fn($q) => $q->where('role', 'manager'))->count(),
                'new_today' => User::whereDate('created_at', today())->count(),
            ],
            'time_entries' => [
                'total' => TimeEntry::count(),
                'active' => TimeEntry::whereNull('end_time')->count(),
                'total_minutes' => (int)(TimeEntry::sum('duration_seconds') / 60),
                'today_minutes' => (int)(
                    TimeEntry::whereNotNull('end_time')
                        ->whereDate('end_time', today())
                        ->sum('duration_seconds') / 60
                ),
                'week_minutes' => (int)(
                    TimeEntry::whereNotNull('end_time')
                        ->whereBetween(
                            'end_time',
                            [now()->startOfWeek(), now()->endOfWeek()]
                        )
                        ->sum('duration_seconds') / 60
                ),

            ],
            'programs' => [
                'total' => Program::count(),
                'active' => Program::where('is_active', true)->count(),
                'inactive' => Program::where('is_active', false)->count(),
            ],
            'projects' => [
                'total' => Project::count(),
                'active' => Project::where('status', ProjectStatus::Active)->count(),
                'paused' => Project::where('status', ProjectStatus::Paused)->count(),
                'completed' => Project::where('status', ProjectStatus::Completed)->count(),
            ],
            'tasks' => [
                'total' => Task::count(),
                'open' => Task::where('status', TaskStatus::Open)->count(),
                'in_progress' => Task::where('status', TaskStatus::InProgress)->count(),
                'done' => Task::where('status', TaskStatus::Done)->count(),
                'blocked' => Task::where('status', TaskStatus::Blocked)->count(),
            ]
        ];
    }
}
