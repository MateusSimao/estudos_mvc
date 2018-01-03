<?php
define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PATH_VIEW', $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/');

require_once PATH_ROOT . '/../vendor/autoload.php';
require_once PATH_ROOT . '/../app/Config/Env.php';

$application = new App\Application();
$application->runApplication();