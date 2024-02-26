<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit765647f7aee7e9065fbac560f20a7f60
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DgoraWcas\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DgoraWcas\\' => 
        array (
            0 => __DIR__ . '/../..'.'/composer' . '/../includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit765647f7aee7e9065fbac560f20a7f60::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit765647f7aee7e9065fbac560f20a7f60::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit765647f7aee7e9065fbac560f20a7f60::$classMap;

        }, null, ClassLoader::class);
    }
}
