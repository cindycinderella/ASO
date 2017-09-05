<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit547f1ba8138a17d6b867624279d0c7eb
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\composer\\' => 15,
            'think\\' => 6,
        ),
        'Q' => 
        array (
            'QL\\Ext\\Lib\\' => 11,
            'QL\\Ext\\' => 7,
            'QL\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'think\\' => 
        array (
            0 => __DIR__ . '/../..' . '/thinkphp/library/think',
        ),
        'QL\\Ext\\Lib\\' => 
        array (
            0 => __DIR__ . '/..' . '/jaeger/curlmulti',
            1 => __DIR__ . '/..' . '/jaeger/http',
        ),
        'QL\\Ext\\' => 
        array (
            0 => __DIR__ . '/..' . '/jaeger/querylist-ext-aquery',
            1 => __DIR__ . '/..' . '/jaeger/querylist-ext-multi',
            2 => __DIR__ . '/..' . '/jaeger/querylist-ext-request',
            3 => __DIR__ . '/..' . '/jaeger/querylist-ext-login',
            4 => __DIR__ . '/..' . '/jaeger/querylist-ext-dimage',
        ),
        'QL\\' => 
        array (
            0 => __DIR__ . '/..' . '/jaeger/querylist',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static $classMap = array (
        'Callback' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'CallbackBody' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'CallbackParam' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'CallbackParameterToReference' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'CallbackReturnReference' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'CallbackReturnValue' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'DOMDocumentWrapper' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'DOMEvent' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'ICallbackNamed' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'phpQuery' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'phpQueryEvents' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'phpQueryObject' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
        'phpQueryPlugins' => __DIR__ . '/..' . '/jaeger/phpquery-single/phpQuery.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit547f1ba8138a17d6b867624279d0c7eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit547f1ba8138a17d6b867624279d0c7eb::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit547f1ba8138a17d6b867624279d0c7eb::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit547f1ba8138a17d6b867624279d0c7eb::$classMap;

        }, null, ClassLoader::class);
    }
}
