<?php
spl_autoload_register('autoLoader');

function autoLoader($className) {

    $className = str_replace("\\","/", $className);

    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/classes/' . strtolower($className) . '.class.php';
    if (!file_exists($fullPath)) return false; else include_once $fullPath;

}
