<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite73e01107e2a2654a762d538be3c9e7a
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Braintree\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Braintree\\' => 
        array (
            0 => __DIR__ . '/..' . '/braintree/braintree_php/lib/Braintree',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite73e01107e2a2654a762d538be3c9e7a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite73e01107e2a2654a762d538be3c9e7a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite73e01107e2a2654a762d538be3c9e7a::$classMap;

        }, null, ClassLoader::class);
    }
}
