<?php
namespace App\core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static string $viewPath = __DIR__ . "/../views/";
    private static string $layoutPath = __DIR__ . "/../views/layouts/";

    public static function renders(
        string $view,
        array $data = [],
        string $layout = 'front'
    ): void 
    {
        if (!empty($data)) {
            extract($data);
        }

        ob_start();
        require self::$viewPath . $view . ".php";
        $content = ob_get_clean();

        require self::$layoutPath . $layout . ".php";
    }

    /// nman3o XSS
    public static function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

       private static ?Environment $twig = null;

    public static function render(string $template, array $data = []): void
    {
        if (self::$twig === null) {
            $view = __DIR__ . '/../views';
            $loader = new FilesystemLoader($view);
                
            self::$twig = new Environment($loader, [
                'cache' => false, // __DIR__ . '/../../storage/cache' in prod
                'debug' => true,
            ]);
        }

        echo self::$twig->render($template . '.twig', $data);
    }


}
