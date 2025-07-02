<?php 

/**
 * Class DB
 *
 * Implements the Singleton design pattern to ensure only one instance of the DB class exists.
 * The constructor is private, so the class cannot be instantiated directly using `new`.
 * Instead, use the static `getInstance()` method to get the single instance.
 *
 * Note: If the constructor were changed to public and the class was instantiated with `new` multiple times,
 * the message 'Instance Created' would be printed each time, resulting in multiple instances.
 * By keeping the constructor private and using the Singleton pattern, only one instance is created and reused.
 *
 */


namespace App;

class DB {
    private static ?DB $instance = null;

    private function __construct(public array $config)
    {
        echo 'Instance Created<br />';
    }

    public static function getInstance(array $config): DB 
    {
        if(self::$instance === null)
        {
            self::$instance = new DB($config);
        }

        return self::$instance;
    }
}