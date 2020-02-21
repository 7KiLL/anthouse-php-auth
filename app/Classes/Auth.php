<?php


namespace App\Classes;


use App\Models\User;

class Auth
{
    private static $instance = null;

    private $user = null;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): self
    {
        if (static::$instance === null) {
            $auth = new static();
            if ($_SESSION['user_id']) {
                $auth->user = (new User())->getById($_SESSION['user_id']);
            }

            static::$instance = $auth;
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
    public function getUser()
    {
        return $this->user;
    }

    public function getId()
    {
        return $this->user['id'];
    }

    public function isAuthenticated() : bool
    {
        return (bool)$this->user;
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

    public function authUser(int $id)
    {
        $_SESSION['user_id'] = $id;
    }

    public function logoutUser()
    {
        unset($_SESSION['user_id']);
    }
}
