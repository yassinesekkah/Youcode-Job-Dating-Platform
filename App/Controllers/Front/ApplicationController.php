<?php

namespace App\Controllers\Front;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\core\View;
use App\Models\Announcement;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index(): void
    {
        Security::requireAuth();
        
        $studentId = $_SESSION['user']['id'];

        $applications = Application::getByStudent($studentId);

        View::render('front/applications/index', [
            'applications' => $applications
        ]);
    }

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

        View::render('front/applications/create', [
            'announcement' => $announcement,
            'csrf_token'   => Security::generateCsrfToken()
        ]);
    }

    public function store(): void
    {
        Security::requireAuth();

        Security::checkCsrfOrFail($_POST['csrf_token'] ?? null);

        $announcementId = $_POST['announcement_id'] ?? null;
        $studentId = $_SESSION['user']['id'];

        if (!$announcementId) {
            Session::set('error', 'Annonce invalide');
            $this->redirect('/');
            return;
        }

        //check announcement
        $announcement = Announcement::find($announcementId);

        if (!$announcement || $announcement['deleted'] == 1) {
            Session::set('error', "Cette offre n'est plus disponible");
            $this->redirect('/');
            return;
        }

        //postulation doublee
        if (Application::exists($studentId, $announcementId)) {
            Session::set('error', 'Vous avez déjà postulé à cette offre');
            $this->redirect('/show?id=' . $announcementId);
            return;
        }

        //validation
        $validator = new Validator($_POST);
        $validator->required('motivation');

        if ($validator->fails()) {
            View::render('applications/create', [
                'errors' => $validator->errors(),
                'announcement' => Announcement::findWithCompany($announcementId),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        $data = [
            'student_id' => $studentId,
            'announcement_id' => $announcementId,
            'motivation' => trim($_POST['motivation']),
            'cv_path' => null
        ];

        //Upload CV 
        if (!empty($_FILES['cv']['name'])) {
            $cvPath = $this->uploadCv($_FILES['cv']);
            if (!$cvPath) {
                Session::set('error', 'CV invalide (PDF uniquement)');
                $this->redirect('/applications/create?announcement_id=' . $announcementId);
                return;
            }
            $data['cv_path'] = $cvPath;
        }

        // insert
        if (!Application::create($data)) {
            Session::set('error', 'Erreur lors de la candidature');
            $this->redirect('/applications/create?announcement_id=' . $announcementId);
            return;
        }

        Session::set('success', 'Votre candidature a été envoyée avec succès');
        $this->redirect('/applications');
    }

    ///private 
    private function uploadCv(array $file): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if ($file['type'] !== 'application/pdf') {
            return null;
        }

        if ($file['size'] > 2 * 1024 * 1024) { // 2MB
            return null;
        }

        $filename = uniqid('cv_') . '.pdf';
        $path = '/assets/cv/' . $filename;
        $destination = __DIR__ . '/../../../public/' . $path;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return null;
        }

        return $path;
    }
}
