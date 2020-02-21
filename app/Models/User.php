<?php


namespace App\Models;


class User extends Model
{
    public function __construct()
    {
        $classname = strtolower(get_class_name(__CLASS__));

        $this->table = $classname . 's';
        parent::__construct();
    }

    public function getByEmail(string $email)
    {
        return $this->addWhere('email', $email)->get(1)->fetch();
    }

    public function getById(int $id)
    {
        return $this->addWhere('id', $id)->get(1)->fetch();

    }


}
