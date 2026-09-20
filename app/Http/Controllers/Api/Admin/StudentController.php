<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Resources\UserResource;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    public function __construct(
        private readonly StudentService $studentService
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection($this->studentService->getPaginated());
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = $this->studentService->create($request->validated());

        return (new UserResource($student))
            ->additional(['message' => 'Student created successfully.'])
            ->response()
            ->setStatusCode(201);
    }
}
