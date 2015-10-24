<?php
//Autloload
function __autoload($class_name) {
    require_once "Class_".$class_name . '.php';
}