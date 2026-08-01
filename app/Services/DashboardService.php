<?php

namespace App\Services;

use App\Models\User;
use stdClass;

class DashboardService
{
    /**
     * Compute dashboard statistics scoped to the given user.
     *
     * @return array<string, int>
     */
    public function getStatistics(User $user): array
    {
        $projects = $this->aggregateProjects($user);
        $tasks = $this->aggregateTasks($user);

        return [
            'total_projects' => (int) ($projects->total ?? 0),
            'active_projects' => (int) ($projects->active ?? 0),
            'total_tasks' => (int) ($tasks->total ?? 0),
            'completed_tasks' => (int) ($tasks->completed ?? 0),
            'pending_tasks' => (int) ($tasks->pending ?? 0),
            'overdue_tasks' => (int) ($tasks->overdue ?? 0),
        ];
    }

    /**
     * Aggregate project counts for the user.
     */
    protected function aggregateProjects(User $user): stdClass
    {
        return $user->projects()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("COUNT(CASE WHEN status = 'active' THEN 1 END) as active")
            ->toBase()
            ->first();
    }

    /**
     * Aggregate task counts for the user.
     *
     * Pending = not done (todo + in_progress).
     * Overdue = due date passed and not done.
     */
    protected function aggregateTasks(User $user): stdClass
    {
        return $user->tasks()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("COUNT(CASE WHEN status = 'done' THEN 1 END) as completed")
            ->selectRaw("COUNT(CASE WHEN status != 'done' THEN 1 END) as pending")
            ->selectRaw("COUNT(CASE WHEN due_date IS NOT NULL AND due_date < NOW() AND status != 'done' THEN 1 END) as overdue")
            ->toBase()
            ->first();
    }
}
