<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class StudentService
{
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            return User::create([
                ...$data,
                'role' => User::ROLE_STUDENT,
                'is_active' => true,
            ]);
        });
    }

    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return User::where('role', User::ROLE_STUDENT)
            ->latest()
            ->paginate($perPage);
    }
}
