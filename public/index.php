<?php

// die(phpinfo());
//$conn = new PDO('postgres:host=db.mmucqujjuxgcszwyrbil.supabase.co;dbname=postgres', 'postgres', 'Ciabatta123!');

use App\DB\DbPdo;
use App\Controllers\BaseController;

chdir(dirname(__DIR__));

require_once 'core/bootstrap.php';
$data = require 'config/database.php';
$appConfig = require 'config/app.config.php';

$router = new Router($appConfig['routes']);
$arrController = $router->dispatch();
$controllerParams = $arrController[2] ?? [];

$conn = DbPdo::getInstance($data);
$controllerClass = $arrController[0];
$method = $arrController[1];
$controller = new $controllerClass(
    $conn
);

if (method_exists($controller, $method)) {
    $controller->$method(...$controllerParams);
}

if($controller instanceof BaseController)
    $controller->display();