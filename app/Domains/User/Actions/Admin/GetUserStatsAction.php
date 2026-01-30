<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Project\Model\Project;
use App\Domains\Shared\Exceptions\ForbiddenForYouException;
use App\Domains\Shared\Model\Program;
use App\Domains\Shared\Model\Role;
use App\Domains\Task\Model\Task;
use App\Domains\TimeEntry\Model\TimeEntry;
use App\Domains\User\DataTransferObjects\CreateRoleUserData;
use App\Domains\User\DataTransferObjects\UpdateRoleUserData;
use App\Domains\User\Models\User;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class GetUserStatsAction
{
    public static function execute(User $user): array
    {
        return [
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role_name,
                'is_banned' => $user->is_banned,
                'created_at' => $user->created_at,
            ],

            'time_entries' => [
                'total' => $user->timeEntries()->count(),
                'active' => $user->timeEntries()->whereNull('end_time')->count(),
                'total_minutes' => (int) ($user->timeEntries()->sum('duration_seconds') / 60),
                'today_minutes' => (int) (
                    $user->timeEntries()
                        ->whereDate('start_time', today())
                        ->sum('duration_seconds') / 60
                ),
            ],

            'projects' => [
                'managed' => Project::where('manager_id', $user->id)->count(),
                'active' => Project::where('manager_id', $user->id)
                    ->where('status', ProjectStatus::Active)
                    ->count(),
            ],

            'tasks' => [
                'assigned' => Task::whereHas('timeEntries', fn ($q) =>
                $q->where('user_id', $user->id)
                )->distinct()->count(),

                'done' => Task::where('status', 'done')
                    ->whereHas('timeEntries', fn ($q) =>
                    $q->where('user_id', $user->id)
                    )->count(),
            ],
        ];
    }
}
