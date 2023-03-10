<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5fa0d367e0fdf15c47d9c7facfd804bf
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Ausra\\Atsiskaitymas\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ausra\\Atsiskaitymas\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5fa0d367e0fdf15c47d9c7facfd804bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5fa0d367e0fdf15c47d9c7facfd804bf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5fa0d367e0fdf15c47d9c7facfd804bf::$classMap;

        }, null, ClassLoader::class);
    }
}
