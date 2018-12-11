<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4b78a052637bb8c8d5e56eed98d0719d
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4b78a052637bb8c8d5e56eed98d0719d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4b78a052637bb8c8d5e56eed98d0719d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
