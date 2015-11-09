<?php
//Autloload
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function __autoload($class_name) {
    require_once "Class_".$class_name . '.php';
}
