<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\Core\View;
use App\Models\User;

class AuthController extends Controller
{

    public function loginForm(): void
    {
        View::render('back/auth/login', [
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function login(): void
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
            View::render('back/auth/login', [
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
            View::render('back/auth/login', [
                'errors' => [
                    'auth' => ['Email ou mot de passe incorrect']
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }

        ///verification dyal role wach admin
        if ($user['role'] !== 'admin') {
            View::render('back/auth/login', [
                'errors' => [
                    'auth' => ['Accès refusé']
                ],
                'csrf_token' => Security::generateCsrfToken()
            ]);
            return;
        }
        ///set dyal admin f session
        Session::set('admin', [
            'id'   => $user['id'],
        ]);

        ////rediction
        $this->redirect('/admin/dashboard');
    }

    public function logout(): void
    {
        ///delete admin mn session
        Session::remove('admin');
        ///delete csrf token mn session
        Security::invalidateCsrfToken();
        ///redirection  lpage login admin
        $this->redirect('/admin/login');
    }
}
