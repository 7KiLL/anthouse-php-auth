<?php


namespace App\Classes;


class Database
{
    private static $instance = null;
    private $config;
    private $pdo;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): self
    {

        if (static::$instance === null) {
            $db = new static();
            $db->config = config('database');
            $db->setupPDO();
            static::$instance = $db;

        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getPdo() : \PDO
    {
        return $this->pdo;
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }

    private function setupPDO()
    {
        $config = $this->config;
        $dsn = sprintf("mysql:host=%s;dbname=%s;c",
            $config['host'], $config['db']
        );

        $pdo = new \PDO($dsn, $config['user'], $config['password']);

        $this->pdo = $pdo;
    }

}
