<?php

namespace App\Http\Controllers\Project;

use App\Domains\Project\Actions\StoreProjectAction;
use App\Domains\Project\DataTransferObjects\StoreProjectData;
use App\Domains\Project\Model\Project;
use App\Domains\Project\Resources\ProjectResource;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }

    public function index()
    {
        return response()->json(ProjectResource::collection(Project::all()));
    }
    public function show(Project $project)
    {
        return response()->json(new ProjectResource($project));
    }
    public function store(StoreProjectData $data)
    {
        return response()->json([
            'message' => 'Проект успешно создан!',
            'project' => new ProjectResource(StoreProjectAction::execute($data))
        ]);
    }
    public function update()
    {

    }
    public function destroy()
    {

    }
}
