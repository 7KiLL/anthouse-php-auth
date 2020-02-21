<?php
session_start();
require_once '../vendor/autoload.php';


//echo '<pre>';
//var_dump($_SERVER);
//echo '</pre>';

$request = \App\Classes\Request::capture();

$app = new \App\Application($request);

$app->handle();
