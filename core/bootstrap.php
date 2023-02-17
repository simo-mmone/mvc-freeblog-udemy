<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../helpers/functions.php';

function loadClass($className){
    $filename1 = str_replace(
        ['App', 'Controllers', 'Models', 'DB', '\\'],
        ['app', 'controllers', 'models', 'db', '/'],
        $className
    ) . '.php';
    $filename2 = str_replace('app\\', '', $filename1) . '.php';
    $filename3 = "core/$className.php";
    if (file_exists($filename1))
        require_once $filename1;
    else if (file_exists($filename2))
        require_once $filename2;
    else if (file_exists($filename3))
        require_once $filename3;
        
}

spl_autoload_register('loadClass');

// require_once __DIR__ . '/../app/DB/DbPdo.php';
// require_once __DIR__ . '/../app/Controllers/BaseController.php';
// require_once __DIR__ . '/../app/Controllers/PostController.php';
// require_once __DIR__ . '/../app/Controllers/LoginController.php';
// require_once __DIR__ . '/../app/Models/Post.php';
// require_once __DIR__ . '/../app/Models/Comment.php';
// require_once __DIR__ . '/../app/Models/User.php';
// require_once __DIR__ . '/../config/app.config.php';
// require_once __DIR__ . '/../core/router.php';
