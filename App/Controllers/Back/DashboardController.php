<?php
namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\core\View;

class DashboardController extends Controller
{
    public function index(): void
    {
        // check dyal role
        Security::requireAdmin();

        View::render('back/dashboard/index',[
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }
}