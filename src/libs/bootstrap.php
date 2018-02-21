<?php
class Bootstrap
{
    function __construct()
    {
        // Turn on error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (!isset($_GET['url'])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }

        $url = rtrim($_GET['url'], '/');
        $url = explode('/', $url);
        $file = 'controllers/' . $url[0] . '.php';

        if (!file_exists($file)) {
            require 'controllers/fof.php';
            $controller = new Fof("The file: $file does not exists.");
            return false;
        }

        require $file;
        $controller = new $url[0];
        $controller->loadModel($url[0]);

        if (isset($url[2])) {
            $controller->{$url[1]}($url[2]);
        } else if (isset($url[1])) {
            $controller->{$url[1]}();
        } else {
            $controller->index();
        }
    }
}