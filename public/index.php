<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\ErrorHandler;
set_exception_handler([ErrorHandler::class, 'handleException']);
set_error_handler([ErrorHandler::class, 'handleError']);

use App\Core\Session;
use App\Core\Router;
use App\Core\Model;
use App\Core\Database;


// start session
Session::start();

// inject database connection into Base Model
Model::setDatabase(
    Database::getInstance()->getConnection()
);

// router
$router = new Router();

// load routes
require_once __DIR__ . '/../config/routes.php';



// dispatch request
$router->dispatch();

 //////php -S localhost::8080