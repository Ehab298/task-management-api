<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService
{
    /**
     * Get a paginated list of the user's projects with optional status filter.
     */
    public function getPaginatedForUser(User $user, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $user->projects()
            ->filter($filters)
            ->withCount('tasks')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Create a new project for the given user.
     */
    public function create(User $user, array $data): Project
    {
        return $user->projects()->create($data);
    }

    /**
     * Update an existing project.
     */
    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project->fresh();
    }

    /**
     * Soft delete a project.
     */
    public function delete(Project $project): bool
    {
        return $project->delete();
    }
}
