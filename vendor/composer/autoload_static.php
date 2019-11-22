<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4a3458ddb15651e27061ecc6bc19f75c
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'edwrodrig\\qt_app_builder\\' => 25,
            'edwrodrig\\example\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'edwrodrig\\qt_app_builder\\' => 
        array (
            0 => __DIR__ . '/..' . '/edwrodrig/qt_app_builder/src',
        ),
        'edwrodrig\\example\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4a3458ddb15651e27061ecc6bc19f75c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4a3458ddb15651e27061ecc6bc19f75c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
