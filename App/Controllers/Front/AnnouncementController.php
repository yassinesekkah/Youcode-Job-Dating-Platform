<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Announcement;

class AnnouncementController
{
    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(404);
            echo "Annonce introuvable";
            return;
        }

        $announcement = Announcement::find($id);

        if (!$announcement) {
            http_response_code(404);
            echo "Annonce introuvable";
            return;
        }

        View::render('front/announcements/show', [
            'announcement' => $announcement
        ]);
    }
}
