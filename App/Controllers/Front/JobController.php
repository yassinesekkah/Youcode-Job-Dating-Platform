<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Models\Announcement;
use App\Core\Security;
use App\core\View;

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

    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(404);
            echo "Annonce introuvable";
            return;
        }

        $announcement = Announcement::findAnnouncement($id);


        if (!$announcement) {
            http_response_code(404);
            echo "Annonce introuvable";
            return;
        }

        View::render('front/jobs/show', [
            'announcement' => $announcement
        ]);
       
    
    }
    public function ajax(): void
{
    $q = $_GET['q'] ?? null;
    $company = $_GET['company'] ?? null;
    $contract = $_GET['contract'] ?? null;

    $announcements = Announcement::filter($q, $company, $contract);
    View::render('front/jobs/_list', [
        'announcements' => $announcements
    ]);
}

    
}