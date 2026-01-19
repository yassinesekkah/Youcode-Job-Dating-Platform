<?php 
namespace App\Controllers\Front;

use App\Core\Security;
use App\core\View;

class JobController
{
    public function index(): void
{
    Security::requireAuth(); 
    View::render('front/jobs/index');
}
}