<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Models\Announcement;
use App\Core\Security;

class JobController extends Controller
{
    public function index(): void
    {
         Security::requireAuth();
        $announcements = Announcement::getActiveWithCompanies();
        $this->render('front/jobs/index', [
            'announcements' => $announcements
        ]);
    }
}