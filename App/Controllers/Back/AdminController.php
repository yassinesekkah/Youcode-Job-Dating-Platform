<?php

namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\Core\View;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        Security::requireRole('admin');

        View::render('admin/dashboard', [
            'title' => 'Admin Dashboard'
        ], 'back');
    }
    public function test(): void
    {
        $this->render("/login");
    }
}
