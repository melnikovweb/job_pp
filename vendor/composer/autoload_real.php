<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit30d26c6efec8a7b29a00af6a65400bda
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit30d26c6efec8a7b29a00af6a65400bda', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit30d26c6efec8a7b29a00af6a65400bda', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit30d26c6efec8a7b29a00af6a65400bda::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
