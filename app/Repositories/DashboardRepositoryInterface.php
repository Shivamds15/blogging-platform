<?php

namespace App\Repositories;

interface DashboardRepositoryInterface
{
    public function getPostCountsByMonth();
    public function getUserRolesCounts();
    public function getCommentsByUser();
    public function getDashboardData();
}
