<?php

namespace App\Controllers\Front;

use App\Core\View;
use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function loginForm()
    {
        Security::redirectIfLogged();
        View::render('front/auth/login', [
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function registerForm()
    {
        Security::redirectIfLogged();
        View::render('front/auth/register', [
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }


    public function register()
    {
        ///check dyal csrf token
        Security::checkCsrfOrFail($_POST['csrf_token'] ?? null);

        ///check dyal class validator 
        $validator = new Validator($_POST);
        $validator
            ->required('name')
            ->min('name', 3)
            ->required('email')
            ->email('email')
            ->required('password')
            ->min('password', 6)
            ->required('password_confirm');

        ////ila faila validator 3tini les errors
        if ($validator->fails()) {
            View::render('front/auth/register', [
                'errors' => $validator->errors(),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        // Password confirm
        if ($_POST['password'] !== $_POST['password_confirm']) {
            View::render('front/auth/register', [
                'errors' => [
                    'password' => ['Passwords do not match']
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        ////validi had 3 key mn lpost
        $data = $validator->validated(['name', 'email', 'password']);

        ///check wach deja kayen l email
        if (User::findByEmail($data['email'])) {
            View::render('front/auth/register', [
                'errors' => [
                    'email' => ['Email déjà utilisé']
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        ///hash lpassword
        $data['password'] = Security::hashPassword($data['password']);

        // Role apprenant
        $data['role'] = 'apprenant';

        ////creation 
        User::create($data);

        ///rediction
        $this->redirect('/login');
    }


    public function login()
    {
        ///check dyal csrf token
        Security::checkCsrfOrFail($_POST['csrf_token'] ?? null);

        ///check dyal class validator 
        $validator = new Validator($_POST);
        $validator
            ->required('email')
            ->email('email')
            ->required('password')
            ->min('password', 6);

        ////ila faila validator 3tini les errors
        if ($validator->fails()) {
            View::render('front/auth/login', [
                'errors' => $validator->errors(),
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        ////validi had 2 key mn lpost
        $data = $validator->validated(['email', 'password']);

        ////njibo had user mn database 
        $user = User::findByEmail($data['email']);

        ////verification dyal login: user wel password dyal db m3a dyal post
        if (!$user || !Security::verifyPassword($data['password'], $user['password'])) {
            View::render('front/auth/login', [
                'errors' => [
                    'auth' => ['Email ou mot de passe incorrect']
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        // Verifier role = apprenant
        if ($user['role'] !== 'apprenant') {
            View::render('front/auth/login', [
                'errors' => [
                    'auth' => ['Accès refusé']
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        // Session user (front)
        Session::set('user', [
            'id' => $user['id']
        ]);

        ////rediction
        $this->redirect('/');
    }


    public function logout()
    {
        Session::remove('user');
        Security::invalidateCsrfToken();
        $this->redirect('/login');
    }
}
