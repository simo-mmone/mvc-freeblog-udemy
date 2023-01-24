<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../app/DB/DBPDO.php';
require_once __DIR__ . '/../app/Controllers/BaseController.php';
require_once __DIR__ . '/../app/Controllers/PostController.php';
require_once __DIR__ . '/../app/Controllers/LoginController.php';
require_once __DIR__ . '/../app/Models/Post.php';
require_once __DIR__ . '/../app/Models/Comment.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../config/app.config.php';
require_once __DIR__ . '/../core/router.php';
