<?php 
use App\core\Router;

 /** @var Router $router */

$router->get('/', 'Front\\HomeController@index');

// $router->get('/test', 'Front\\TestController@form');
// $router->post('/test', 'Front\\TestController@submit');

// $router->post('/users/store', 'Front\\HomeController@store');
// $router->post('/users/update', 'Front\\HomeController@update');
// $router->post('/users/delete', 'Front\\HomeController@delete');

// $router->get('/register', 'Front\\AuthController@registerForm');
// $router->post('/register', 'Front\\AuthController@register');

// $router->get('/login', 'Front\\AuthController@loginForm');
// $router->post('/login', 'Front\\AuthController@login');
// $router->get('/logout', 'Front\\AuthController@logout');

//admin routes
// $router->get('/twig', 'Back\\AdminController@test');


// Admin login
$router->get('/admin/login', 'Back\AuthController@loginForm');
$router->post('/admin/login', 'Back\AuthController@login');
$router->get('/admin/logout', 'Back\AuthController@logout');

// Admin dashboard
$router->get('/admin/dashboard', 'Back\DashboardController@index');

// Apprenant
// $router->get('/login', 'Front\TestController@index');
$router->get('/login', 'Front\AuthController@loginForm');
$router->post('/login', 'Front\AuthController@login');
$router->get('/register', 'Front\AuthController@registerForm');
$router->post('/register', 'Front\AuthController@register');
$router->get('/logout', 'Front\AuthController@logout');

///jobs
// $router->get('/jobs', 'Front\JobController@index');
$router->get('/jobs', 'Front\JobController@index');
$router->get('/announcements/{id}', 'AnnouncementController@show');



//creation des annonneces
$router->get('/admin/announcements/create', 'Back\AnnouncementController@createForm');
$router->post('/admin/announcements/create', 'Back\AnnouncementController@store');
///affichage des annonneces active
$router->get('/admin/announcements', 'Back\AnnouncementController@index');
///edit une annonce
$router->get('/admin/announcements/edit', 'Back\AnnouncementController@editForm');
$router->post('/admin/announcements/update', 'Back\AnnouncementController@update');
////les annonces archive
$router->get('/admin/announcements/archive', 'Back\AnnouncementController@archive');
///archived annonneces afichage
$router->get('/admin/announcements/archived', 'Back\AnnouncementController@archivedIndex');
////restor anonnece
$router->get('/admin/announcements/restore', 'Back\AnnouncementController@restore');   


/// company create
$router->get('/admin/companies/create', 'Back\\CompanyController@createForm');
$router->post('/admin/companies/store', 'Back\\CompanyController@store');

/// affichage des entreprises
$router->get('/admin/companies', 'Back\\CompanyController@index');

/// edit entreprise
$router->get('/admin/companies/edit', 'Back\\CompanyController@editForm');
$router->post('/admin/companies/update', 'Back\\CompanyController@update');

/// delete entreprise
$router->get('/admin/companies/delete', 'Back\\CompanyController@delete');


///student affichage
$router->get('/admin/students', "Back\\StudentController@index");






