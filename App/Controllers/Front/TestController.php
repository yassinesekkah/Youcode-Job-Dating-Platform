<?php 

namespace App\Controllers\Front;

use App\Core\Controller;
// use App\Core\Validator;
// use App\Core\View;


// class TestController extends Controller
// {
//     public function form(){
//         View::render("test/form");
//     }

//     public function submit(){
//         $validator = new Validator($_POST);

//         $validator
//             ->required('email')
//             ->email('email')
//             ->required('password')
//             ->min('password', 6);

//         if ($validator->fails()) {
//             die(print_r($validator->errors()));
//         }

//         echo "Donnees valides";
//     }

// }