<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    /**
     * Get a paginated, filtered list of the user's tasks across all projects.
     *
     * @param  array<string, mixed>  $filters
     */
    public function getPaginatedForUser(User $user, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $user->tasks()
            ->filter($filters)
            ->with('project:id,name')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Create a new task within the given project for the given user.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(Project $project, User $user, array $data): Task
    {
        return $project->tasks()->create(array_merge($data, [
            'user_id' => $user->id,
        ]));
    }

    /**
     * Update an existing task.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task->fresh();
    }

    /**
     * Soft delete a task.
     */
    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
