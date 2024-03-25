<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

use Composer\Autoload\ClassLoader;

class ComposerStaticInita1bb8cf49111bdc17501671db876c705
{
    public static $files = array (
        'e39a8b23c42d4e1452234d762b03835a' => __DIR__ . '/..' . '/ramsey/uuid/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' =>
        array (
            'Ramsey\\Uuid\\' => 12,
            'Ramsey\\Collection\\' => 18,
        ),
        'B' =>
        array (
            'Brick\\Math\\' => 11,
        ),
        'A' =>
        array (
            'App\\View\\' => 9,
            'App\\Util\\' => 9,
            'App\\Modal\\' => 10,
            'App\\Controller\\' => 15,
            'App\\Abstraction\\Exception\\' => 26,
            'App\\Abstraction\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ramsey\\Uuid\\' =>
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Ramsey\\Collection\\' =>
        array (
            0 => __DIR__ . '/..' . '/ramsey/collection/src',
        ),
        'Brick\\Math\\' =>
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
        'App\\View\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app/views',
        ),
        'App\\Util\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app/utils',
        ),
        'App\\Modal\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app/modals',
        ),
        'App\\Controller\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
        'App\\Abstraction\\Exception\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app/abstractions/exception',
        ),
        'App\\Abstraction\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app/abstractions',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita1bb8cf49111bdc17501671db876c705::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita1bb8cf49111bdc17501671db876c705::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita1bb8cf49111bdc17501671db876c705::$classMap;

        }, null, ClassLoader::class);
    }
}
