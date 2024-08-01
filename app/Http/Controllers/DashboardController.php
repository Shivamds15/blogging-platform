<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $data = $this->dashboardService->getDashboardData();
        $chartData = $this->dashboardService->formatChartData(
            $data['postCounts'],
            $data['userRoles'],
            $data['commentsByUser']
        );

        return view('admin.dashboard', array_merge($data, $chartData));
    }
}
