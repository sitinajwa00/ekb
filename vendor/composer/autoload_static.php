<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9896c3af7deae6d890142bf334d55241
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9896c3af7deae6d890142bf334d55241::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9896c3af7deae6d890142bf334d55241::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9896c3af7deae6d890142bf334d55241::$classMap;

        }, null, ClassLoader::class);
    }
}
