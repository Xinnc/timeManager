<?php

namespace App\Domains\Project\Actions;


use App\Domains\Project\DataTransferObjects\StoreProjectData;
use App\Domains\Project\Model\Project;

class StoreProjectAction
{
    public static function execute(StoreProjectData $data): Project
    {
        $project = Project::create([
            'name' => $data->name,
            'description' => $data->description,
            'deadline' => $data->deadline,
            'manager_id' => auth()->id(),
        ]);

        return $project;
    }
}
