<?php

namespace App\Services;

use App\Repositories\DashboardRepositoryInterface;

class DashboardService
{
    protected $dashboardRepo;

    public function __construct(DashboardRepositoryInterface $dashboardRepo)
    {
        $this->dashboardRepo = $dashboardRepo;
    }

    public function getDashboardData()
    {
        $data = $this->dashboardRepo->getDashboardData();
        $data['postCounts'] = $this->dashboardRepo->getPostCountsByMonth();
        $data['userRoles'] = $this->dashboardRepo->getUserRolesCounts();
        $data['commentsByUser'] = $this->dashboardRepo->getCommentsByUser();

        return $data;
    }

    public function formatChartData($postCounts, $userRoles, $commentsByUser)
    {
        return [
            'postsChartData' => [
                'categories' => array_map(fn($month) => date('F', mktime(0, 0, 0, $month, 1)), array_keys($postCounts)),
                'data' => array_values($postCounts),
            ],
            'usersChartData' => [
                'categories' => array_keys($userRoles),
                'data' => array_values($userRoles),
            ],
            'commentsChartData' => [
                'categories' => array_keys($commentsByUser),
                'data' => array_values($commentsByUser),
            ],
        ];
    }
}
