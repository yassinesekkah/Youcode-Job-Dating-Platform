<?php 
namespace App\Core;

abstract class Controller 
{
    protected string $viewsPath = __DIR__ . "/../views/";

    ///kaysaweb l path pour utiliser sur les classes enfants
    protected function renders(string $view, array $data = []): void
    {   
        ///hna extract kadir transfer lel keys l variables
        if(!empty($data)){
            extract($data);
        }

        require $this -> viewsPath . $view . ".php";
    }
    protected function render(string $view, array $data = []): void
    {   
         View::render($view, $data);
    }

    ///verify csrf
    protected function verifyCsrf(): void
    {
        if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? null)) {
            http_response_code(403);
            exit('Forbidden - CSRF token invalid');
        }
    }

    //// base redirect
    protected function redirect(string $path): void
    {
        header("Location: " . $path);
        exit;
    }

}