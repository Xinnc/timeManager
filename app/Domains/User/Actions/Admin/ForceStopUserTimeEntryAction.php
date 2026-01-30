<?php

namespace App\Domains\User\Actions\Admin;

use App\Domains\Shared\Exceptions\ConflictHttpException;
use App\Domains\TimeEntry\Model\TimeEntry;
use App\Domains\User\Models\User;
use Carbon\Carbon;

class ForceStopUserTimeEntryAction
{
    public static function execute(User $user): TimeEntry
    {
        $timeEntry = TimeEntry::where('user_id', $user->id)->whereNull('end_time')->first();
        if (!$timeEntry) {
            throw new ConflictHttpException(409, 'Нет активной записи времени.');
        }
        $timeEntry->update([
            'end_time' => Carbon::now(),
            'duration_seconds' => (int)$timeEntry->start_time->diffInSeconds(Carbon::now()),
        ]);

        return $timeEntry;
    }
}
