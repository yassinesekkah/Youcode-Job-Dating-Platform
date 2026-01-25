<?php

namespace App\Controllers\Front;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\core\View;
use App\Models\Announcement;

class ApplicationController extends Controller
{
    public function createForm(): void
    {
        Security::requireAuth();

        $announcementId = $_GET['announcement_id'] ?? null;

        if (!$announcementId) {
            Session::set('error', 'invalid announcements');
            $this->redirect('/');
            return;
        }

        $announcement = Announcement::findWithCompany($announcementId);

        if (!$announcement || $announcement['deleted'] == 1) {
            Session::set('error', 'Cette offre n’est plus disponible');
            $this->redirect('/jobs');
            return;
        }

        View::render('front/application/create', [
            'announcement' => $announcement,
            'csrf_token'   => Security::generateCsrfToken()
        ]);

    }
}
