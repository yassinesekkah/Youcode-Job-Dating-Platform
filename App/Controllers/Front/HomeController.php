<?php

namespace App\Controllers\Front;

use App\Core\Controller;
use App\Core\Validator;
use App\Models\User;
use App\Core\View;
use App\Core\Security;


class HomeController extends Controller
{
    public function index()
    {
        $users =  User::all();

        $userFound = User::find(7);

        View::renders('home/index', [
            'users' => $users,
            'title' => 'Liste des utilisateurs',
            'userFound' => $userFound
        ]);
    }

    public function store()
    {
        $this->verifyCsrf();

        $validator = new Validator($_POST);

        $validator
            ->required('email')
            ->email('email')
            ->required('password')
            ->min('password', 6);

        if ($validator->fails()) {
            die(print_r($validator->errors()));
        }

        $data = $validator->validated(['email', 'password']);

        $data['password'] = Security::hashPassword($data['password']);

        User::create($data);

        $this->redirect('/');
    }

    public function update()
    {
        $this->verifyCsrf();

        $validator = new Validator($_POST);
        $validator
            ->required('email')
            ->email('email');

        if (!empty($_POST['password'])) {
            $validator->min('password', 6);
        }

        if ($validator->fails()) {
            die(print_r($validator->errors()));
        }

        $data = $validator->validated(['email', 'password']);

        if (!empty($data['password'])) {
            $data['password'] = Security::hashPassword($data['password']);
        }

        User::update((int) $_POST['id'], $data);

        $this->redirect('/');
    }

    public function delete()
    {   
        Security::requirePermission('delete_users');
        
        $this->verifyCsrf();

        User::delete((int) $_POST['id']);

        $this->redirect('/');
    }
}
