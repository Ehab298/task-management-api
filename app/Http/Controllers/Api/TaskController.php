<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    /**
     * Display a paginated, filtered list of the authenticated user's tasks.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $tasks = $this->taskService->getPaginatedForUser(
            $request->user(),
            $request->only(['status', 'priority', 'search']),
            (int) $request->integer('per_page', 15)
        );

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created task within the given project.
     */
    public function store(StoreTaskRequest $request, Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        $task = $this->taskService->create($project, $request->user(), $request->validated());

        return (new TaskResource($task))
            ->additional(['message' => 'Task created successfully.'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified task.
     */
    public function show(Request $request, Task $task): JsonResponse
    {
        $this->authorize('view', $task);

        return (new TaskResource($task))
            ->additional(['message' => 'Task retrieved successfully.'])
            ->response();
    }

    /**
     * Update the specified task.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);

        $task = $this->taskService->update($task, $request->validated());

        return (new TaskResource($task))
            ->additional(['message' => 'Task updated successfully.'])
            ->response();
    }

    /**
     * Remove the specified task (soft delete).
     */
    public function destroy(Request $request, Task $task): JsonResponse
    {
        $this->authorize('delete', $task);

        $this->taskService->delete($task);

        return response()->json([
            'message' => 'Task deleted successfully.',
        ]);
    }
}
