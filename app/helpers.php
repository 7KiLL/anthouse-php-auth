<?php
function views(string $name)
{
    return __DIR__ . '/../views/' . $name . '.php';
}

function layout(string $name)
{
    return __DIR__ . '/../layout/' . $name . '.php';
}

function config(string $key)
{
    $config = require_once __DIR__ . '/config.php';
    return $config[$key];
}

function get_class_name($classname)
{
    if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
    return $pos;
}

function bcrypt($password)
{
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 6]);
}

function auth()
{
    return \App\Classes\Auth::getInstance();
}

function redirect(string $url)
{
    $protocol = $_SERVER["HTTP_UPGRADE_INSECURE_REQUESTS"] ? 'http://' : 'https://';
    $fullUrl = $protocol.$_SERVER["HTTP_HOST"].$url;
    header( "Location: $fullUrl" );
    exit();
}
