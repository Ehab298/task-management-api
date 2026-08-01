<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService
    ) {}


    public function index(Request $request): AnonymousResourceCollection
    {
        $projects = $this->projectService->getPaginatedForUser(
            $request->user(),
            $request->only(['status', 'search']),
            (int) $request->integer('per_page', 15)
        );

        return ProjectResource::collection($projects);
    }


    public function store(StoreProjectRequest $request): JsonResponse
    {
        $this->authorize('create', Project::class);

        $project = $this->projectService->create($request->user(), $request->validated());

        return (new ProjectResource($project))
            ->additional(['message' => 'Project created successfully.'])
            ->response()
            ->setStatusCode(201);
    }


    public function show(Request $request, Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        $project->loadCount('tasks');

        return (new ProjectResource($project))
            ->additional(['message' => 'Project retrieved successfully.'])
            ->response();
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $project = $this->projectService->update($project, $request->validated());

        return (new ProjectResource($project))
            ->additional(['message' => 'Project updated successfully.'])
            ->response();
    }


    public function destroy(Request $request, Project $project): JsonResponse
    {
        $this->authorize('delete', $project);

        $this->projectService->delete($project);

        return response()->json([
            'message' => 'Project deleted successfully.',
        ]);
    }
}
