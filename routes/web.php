<?php
    $router = \App\Classes\Router::getInstance();

    $router->addRoute('/login', function (\App\Classes\Renderer $renderer) {
        return $renderer->render('login', []);
    });

    $router->addRoute('/test', function () {
       echo "test form";
    });
