<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit12d4cdaa4ec46a4ecee140b3d0b27b36
{
    public static $files = array (
        'fedc00aa77a4fbdf15cc8604a047a417' => __DIR__ . '/../..' . '/registration.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'ShareThis\\ShareButtons\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ShareThis\\ShareButtons\\' => 
        array (
            0 => __DIR__ . '/../..' . '/ShareThis/ShareButtons',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit12d4cdaa4ec46a4ecee140b3d0b27b36::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit12d4cdaa4ec46a4ecee140b3d0b27b36::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit12d4cdaa4ec46a4ecee140b3d0b27b36::$classMap;

        }, null, ClassLoader::class);
    }
}