<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92faf4688fe81bc4ba5d0eea3cc67475
{
    public static $files = array (
        'b85fe277c4712f6cf4552ce8dcab2b9c' => __DIR__ . '/../..' . '/helpers/logger.php',
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92faf4688fe81bc4ba5d0eea3cc67475::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92faf4688fe81bc4ba5d0eea3cc67475::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit92faf4688fe81bc4ba5d0eea3cc67475::$classMap;

        }, null, ClassLoader::class);
    }
}