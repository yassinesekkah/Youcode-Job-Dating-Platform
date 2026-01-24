<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\View;
use App\Models\Announcement;
use App\Models\Company;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index(): void
    {
        Security::requireAdmin();
        $recentAnnouncements = Announcement::getRecent(3);

        $data = [
            'activeAnnouncements'   => Announcement::countActive(),
            'archivedAnnouncements' => Announcement::countArchived(),
            'companiesCount'        => Company::countAll(),
            'studentsCount'         => Student::countStudent(),
            'recentAnnouncements'   => $recentAnnouncements,
        ];

        View::render('back/dashboard/index', $data);
    }
}
