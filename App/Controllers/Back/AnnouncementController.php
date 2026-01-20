<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\core\View;
use App\Models\Announcement;
use App\Models\Company;

class AnnouncementController extends Controller
{
    public function createForm()
    {
        Security::requireAdmin();

        $companies = Company::all();

        View::render('back/announcements/create', [
            'csrf_token' => Security::generateCsrfToken(),
            'companies' => $companies
        ]);
    }

    public function store()
    {
        Security::requireAdmin();

        ///check dyal csrf token
        Security::checkCsrfOrFail($_POST['csrf_token'] ?? null);

        ///check dyal class validator 
        $validator = new Validator($_POST);
        $validator
            ->required('title')
            ->required('company_id')
            ->required('contract_type')
            ->required('location')
            ->required('description');

        ////ila faila validator 3tini les errors
        if ($validator->fails()) {
            View::render('back/announcements/create', [
                'errors' => $validator->errors(),
                'csrf_token' => Security::generateCsrfToken(),
                'companies' => Company::all()
            ]);
            return;
        }

        ////validi had 2 key mn lpost
        $data = $validator->validated([
            'title',
            'company_id',
            'contract_type',
            'location',
            'description',
            'skills'
        ]);

        $imagePath = null;

        if (!empty($_FILES['image']['name'])) {

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $fileType = mime_content_type($_FILES['image']['tmp_name']);

            if (!in_array($fileType, $allowedTypes)) {
                View::render('back/announcements/create', [
                    'errors' => ['image' => ['Format image invalide']],
                    'csrf_token' => Security::generateCsrfToken(),
                    'companies' => Company::all()
                ]);
                return;
            }

            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('ann_') . '.' . $extension;

            $uploadDir = __DIR__ . '/../../../public/assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName);

            $imagePath = '/assets/images/' . $fileName;
        }

        //nzido l image f data
        $data['image'] = $imagePath;


        ////insert
        $result = Announcement::create($data);

        ///check create
        if (!$result) {
            Session::set('error', 'Error while creating announcement');
            $this->redirect('/admin/announcements/create');
            return;
        }

        // message succès
        Session::set('success', 'Announcement created successfully');

        ////rediction
        $this->redirect('/admin/announcements');
    }

    public function index(): void
    {
        Security::requireAdmin();

        $announcements = Announcement::getActiveWithCompanies();

        View::render('back/announcements/index', [
            'announcements' => $announcements
        ]);
    }
}
