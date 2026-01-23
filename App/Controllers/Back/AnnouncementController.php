<?php
namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\Core\View;
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
            'announcements' => $announcements,
            'csrf_token' => Security::generateCsrfToken(),
        ]);

    }

    public function editForm()
    {
        Security::requireAdmin();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            Session::set('error', 'Invalid announcement');
            $this->redirect('/admin/announcements');
            return;
        }

        $announcement = Announcement::find($id);
        $companies = Company::all();

        View::render('back/announcements/edit', [
            'announcement' => $announcement,
            'companies' => $companies,
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function update(): void
    {
        Security::requireAdmin();

        // CSRF
        Security::checkCsrfOrFail($_POST['csrf_token'] ?? null);

        $id = $_GET['id'] ?? null;

        if (!$id) {
            Session::set('error', 'Invalid announcement');
            $this->redirect('/admin/announcements');
            return;
        }

        // Validation
        $validator = new Validator($_POST);
        $validator
            ->required('title')
            ->required('company_id')
            ->required('contract_type')
            ->required('location')
            ->required('description');

        if ($validator->fails()) {
            View::render('back/announcements/edit', [
                'errors' => $validator->errors(),
                'announcement' => Announcement::find($id),
                'companies' => Company::all(),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        // Data validee
        $data = $validator->validated([
            'title',
            'company_id',
            'contract_type',
            'location',
            'description',
            'skills'
        ]);

        //image
        if (!empty($_FILES['image']['name'])) {

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $fileType = mime_content_type($_FILES['image']['tmp_name']);

            if (!in_array($fileType, $allowedTypes)) {
                View::render('back/announcements/edit', [
                    'errors' => ['image' => ['Invalid image format']],
                    'announcement' => Announcement::find($id),
                    'companies' => Company::all(),
                    'csrf_token' => Security::generateCsrfToken()
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

            $data['image'] = '/assets/images/' . $fileName;
        }

        // update annonce
        if (!Announcement::update($id, $data)) {
            Session::set('error', 'Update failed');
            $this->redirect('/admin/announcements/edit?id=' . $id);
            return;
        }

        Session::set('success', 'Announcement updated successfully');
        $this->redirect('/admin/announcements');
    }

    public function archive(): void
    {
        Security::requireAdmin();

        Security::checkCsrfOrFail($_GET['csrf_token'] ?? null);

        $id = $_GET['id'] ?? null;

        if (!$id) {
            Session::set('error', 'Invalid announcement');
            $this->redirect('/admin/announcements');
            return;
        }

        if (!Announcement::softDelete($id)) {
            Session::set("error", "Failed to archive announcement");
            $this->redirect("/admin/announcements");
            return;
        }

        Session::set('success', "Announcement archived successfully");
        $this->redirect('/admin/announcements');
    }

    public function archivedIndex(): void
    {
        Security::requireAdmin();

        $archivedAnnouncements = Announcement::getArchived();

        View::render('back/announcements/archived', [
            'archived' => $archivedAnnouncements,
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function restore(): void
    {
        Security::requireAdmin();

        Security::checkCsrfOrFail($_GET['csrf_token'] ?? null);

        $id = $_GET["id"] ?? null;

        if(!$id){
            Session::set('error', 'Invalid announcement');
            $this->redirect('/admin/announcements/archived');
            return;
        }

        if(!Announcement::restore($id)){
            Session::set('error', "Failed to restored announcement");
            $this->redirect('/admin/announcements/archived');
            return;
        }

        Session::set('success', "Announcement restored successfully");
        $this -> redirect('/admin/announcements/archived');


    }
}
