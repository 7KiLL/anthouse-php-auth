<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite2270834b79c70c3afa0144c0611f57a
{
    public static $files = array (
        'ba6cbcaab13dad368e8a18d07d1cd859' => __DIR__ . '/../..' . '/app/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite2270834b79c70c3afa0144c0611f57a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite2270834b79c70c3afa0144c0611f57a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
