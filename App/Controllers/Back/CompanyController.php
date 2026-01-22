<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\Core\View;
use App\Models\Company;

class  CompanyController extends Controller
{
    public function createForm(): void
    {
        Security::requireAdmin();

        View::render("back/companies/create", [
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function store(): void
    {
        Security::requireAdmin();

        Security::checkCsrfOrFail($_POST["csrf_token"] ?? null);

        $validator = new Validator($_POST);
        $validator
            ->required('name')
            ->required('sector')
            ->required('location')
            ->required('email')
            ->email('email')
            ->required('phone');

        if ($validator->fails()) {
            View::render("back/companies/create", [
                'errors' => $validator->errors(),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        $data = $validator->validated([
            'name',
            'sector',
            'location',
            'email',
            'phone'
        ]);

        if (Company::emailExists($data['email'])) {
            View::render('back/companies/create', [
                'errors' => [
                    'email' => 'Email already exists'
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        $data['avatar'] = Company::generateAvatar($data['name']);

        if (!Company::create($data)) {
            Session::set('error', 'Error while creating company');
            $this->redirect('/admin/companies/create');
        }

        Session::set('success', "Company created successfully");
        $this->redirect('/admin/companies');
    }

    public function index(): void
    {
        Security::requireAdmin();

        $companies = Company::all();


        View::render("back/companies/index", [
            'companies' => $companies,
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function editForm(): void
    {
        Security::requireAdmin();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            Session::set('error', 'Invalid company');
            $this->redirect('/admin/companies');
            return;
        }

        $company = Company::find($id);

        if (!$company) {
            Session::set('error', 'Company not found');
            $this->redirect('/admin/companies');
            return;
        }

        View::render('back/companies/edit', [
            'company' => $company,
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function update(): void
    {
        Security::requireAdmin();
        Security::checkCsrfOrFail($_POST['csrf_token'] ?? null);

        $id = (int) ($_GET['id'] ?? 0);

        if (!$id) {
            Session::set('error', 'Invalid company');
            $this->redirect('/admin/companies');
            return;
        }

        $validator = new Validator($_POST);
        $validator
            ->required('name')
            ->required('sector')
            ->required('location')
            ->required('email')
            ->email('email')
            ->required('phone');

        if ($validator->fails()) {
            View::render("back/companies/edit", [
                'errors' => $validator->errors(),
                'company' => Company::find($id),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        $data = $validator->validated([
            'name',
            'sector',
            'location',
            'email',
            'phone'
        ]);

        if (Company::emailExistsExcept($data['email'], $id)) {
            View::render('back/companies/edit', [
                'errors' => [
                    'email' => ['Email already exists']
                ],
                'company' => Company::find($id),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        if (!Company::update($id, $data)) {
            Session::set('error', 'Error while updating company');
            $this->redirect('/admin/companies/edit?id=' . $id);
            return;
        }

        Session::set('success', 'Company updated successfully');
        $this->redirect('/admin/companies');
    }

    public function delete(): void
    {
        Security::requireAdmin();

        Security::checkCsrfOrFail($_GET['csrf_token'] ?? null);

        $id = (int) $_GET['id'] ?? 0;

        if (!$id) {
            Session::set('error', 'Invalid company');
            $this->redirect('/admin/companies');
            return;
        }

        if (Company::hasAnnouncements($id)) {
            Session::set('error', 'Cannot delete company because it has associated announcements');
            $this->redirect("/admin/companies");
            return;
        }

        if (!Company::delete($id)) {
            Session::set('error', 'Failed to delete company');
            $this->redirect('/admin/companies');
            return;
        }

        Session::set('success', 'Company deleted successfully');
        $this->redirect('/admin/companies');
    }
}
