<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\View;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index(): void
    {
        Security::requireAdmin();
        $announcementId = $_GET['announcement_id'] ?? null;



        if (!$announcementId) {
            Session::set('error', 'Invalid announcement');
            $this->redirect('/admin/announcements');
            return;
        }

        $applications = Application::getByAnnouncement($announcementId);

        View::render('back/applications/index', [
            'applications' => $applications,
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function updateStatus(): void
    {

        Security::requireAdmin();
        Security::checkCsrfOrFail($_POST['csrf_token']);

        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;


        if (!$id  || !in_array($status, ['pending', 'accepted', 'rejected'])) {
            Session::set('error', 'Invalid status');
            $redirect = $_SERVER['HTTP_REFERER'] ?? '/admin/dashboard';
            $this->redirect($redirect);
            return;
        }

        Application::updateStatus($id, $status);

        Session::set('success', 'Application status updated');
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/admin/dashboard';
        $this->redirect($redirect);
    }
}
