<?php

/**
 * QueryConnector: Makes conection with database and returns a PDO object
 */
namespace App\Libraries\QueryBuilder;

class QueryConnector{
    /**
    * Create a new PDO connection.
    *
    * @param array $config
    */
    private static $config = [];


    private static function prepareConfig()
    {
        self::$config['connection'] = 'localhost';
        self::$config['username'] = 'root';
        self::$config['password'] = '';
        self::$config['options'] = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
          );
          self::$config['name'] = 'mvc';
    }

    public static function make()
    {
        self::prepareConfig();
        try {
            return new \PDO(
                'mysql:host='.self::$config['connection'].';dbname='.self::$config['name'],
                self::$config['username'],
                self::$config['password'],
                self::$config['options']
            );
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}