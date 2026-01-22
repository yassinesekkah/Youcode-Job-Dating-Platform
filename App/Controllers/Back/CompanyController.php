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
            -> required('name')
            -> required('sector')
            -> required('location')
            -> required('email')
            -> email('email')
            -> required('phone');
        
        if($validator->fails()){
            View::render("back/companies/create",[
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

        if(Company::emailExists($data['email'])){
            View::render('back/companies/create',[
                'errors' => [
                    'email' => 'Email already exists'
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }
        
        $data['avatar'] = Company::generateAvatar($data['name']);

        if(!Company::create($data)){
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
}