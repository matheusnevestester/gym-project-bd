<?php
header("Access-Control-Allow-Origin: *");

    // Autoload do composer.
    require_once __DIR__ . "/vendor/autoload.php";
    require_once __DIR__ . "/config/Settings.php";

    // Arquivo de Rotas
    use \Components\Router\Router;
    
    // Arquivo onde são definidas as Rotas do sistema.
    require_once "src/Routes.php";

    // Execução da requisição.
    echo Router::execute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
