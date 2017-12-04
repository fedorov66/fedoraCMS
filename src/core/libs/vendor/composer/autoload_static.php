<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5ad946e3a7c1b56c88f35712121f581
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dwoo\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dwoo\\' => 
        array (
            0 => __DIR__ . '/..' . '/dwoo/dwoo/lib/Dwoo',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5ad946e3a7c1b56c88f35712121f581::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5ad946e3a7c1b56c88f35712121f581::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
