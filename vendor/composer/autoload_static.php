<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c44d6e83b2d52a8d851f6b2f4072802
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bluerhinos\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bluerhinos\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c44d6e83b2d52a8d851f6b2f4072802::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c44d6e83b2d52a8d851f6b2f4072802::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
