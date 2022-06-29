<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {

    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class.'.php');
    include $classPath;

    if (!class_exists($class, false)) {
        trigger_error("Не удалось загрузить класс: $class", E_USER_WARNING);
    }
});

require_once "MVC.php";
require_once "helpers.php";

$mvc = new MVC();

\Classes\DB::connect();

$mvc->init();