<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\core\View;
use App\Models\Announcement;
use App\Models\Company;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index(): void
    {
        Security::requireAdmin();

        $data = [
            'activeAnnouncements'   => Announcement::countActive(),
            'archivedAnnouncements' => Announcement::countArchived(),
            'companiesCount'        => Company::countAll(),
            'studentsCount'         => Student::countAll(),
        ];

        View::render('back/dashboard/index', $data);
    }
}
