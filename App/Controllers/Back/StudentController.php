<?php
namespace App\Controllers\Back;

use App\Core\Controller;
use App\Core\Security;
use App\core\View;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(): void
    {
        Security::requireAdmin();

        $students = Student::getStudents();
        
        View::render('back/students/index', [
            'students' => $students
        ]);
    }
}