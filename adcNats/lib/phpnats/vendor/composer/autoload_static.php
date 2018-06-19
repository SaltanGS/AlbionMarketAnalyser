<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit487bdd426885994fd0cf6eee123d8b97
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SecurityLib' => 
            array (
                0 => __DIR__ . '/..' . '/ircmaxell/security-lib/lib',
            ),
        ),
        'R' => 
        array (
            'RandomLib' => 
            array (
                0 => __DIR__ . '/..' . '/ircmaxell/random-lib/lib',
            ),
        ),
        'N' => 
        array (
            'Nats\\Test' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
            'Nats' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit487bdd426885994fd0cf6eee123d8b97::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
