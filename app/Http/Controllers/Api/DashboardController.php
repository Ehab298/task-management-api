<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboardService
    ) {}

    /**
     * Return aggregated statistics for the authenticated user.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $statistics = $this->dashboardService->getStatistics($request->user());

        return (new DashboardResource($statistics))
            ->additional(['message' => 'Dashboard statistics retrieved successfully.'])
            ->response();
    }
}
