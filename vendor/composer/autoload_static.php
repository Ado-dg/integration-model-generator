<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitefcdae70fa13160395c6fd4b15418386
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'ado_dg\\IntegrationModelGenerator\\' => 33,
        ),
        'P' => 
        array (
            'PHPModelGenerator\\' => 18,
            'PHPMicroTemplate\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ado_dg\\IntegrationModelGenerator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPModelGenerator\\' => 
        array (
            0 => __DIR__ . '/..' . '/wol-soft/php-json-schema-model-generator/src',
            1 => __DIR__ . '/..' . '/wol-soft/php-json-schema-model-generator-production/src',
        ),
        'PHPMicroTemplate\\' => 
        array (
            0 => __DIR__ . '/..' . '/wol-soft/php-micro-template/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitefcdae70fa13160395c6fd4b15418386::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitefcdae70fa13160395c6fd4b15418386::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitefcdae70fa13160395c6fd4b15418386::$classMap;

        }, null, ClassLoader::class);
    }
}