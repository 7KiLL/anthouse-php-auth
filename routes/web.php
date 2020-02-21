<?php
$router = \App\Classes\Router::getInstance();

$router->addRoute('/register', '\App\Controllers\RegisterController@register');
$router->addRoute('/login', '\App\Controllers\LoginController@login');
$router->addRoute('/logout', '\App\Controllers\LogoutController@logout');
$router->addRoute('/profile', '\App\Controllers\ProfileController@home');

$router->addRoute('/test', function ($renderer, \App\Classes\Request $request) {
    echo $request->getMethod();
});
