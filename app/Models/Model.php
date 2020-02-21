<?php


namespace App\Models;


use App\Classes\Database;

abstract class Model
{
    protected $table;

    private $database;

    private $select = '*';
    private $from;
    private $wheres;

    public function __construct()
    {


        $this->from = "FROM {$this->table}";
        $this->database = Database::getInstance();
    }


    /**
     * @param string|array $fields
     * @return self
     */
    public function select($fields)
    {
        $select = $fields;
        if (!is_array($fields)) {
            $select = [$fields];
        }
        $select = join(', ', $select);
        $this->select = $select;
        return $this;
    }

    /**
     * @param string $column
     * @param $value
     * @param string $operator
     * @return self
     */
    public function addWhere(string $column, $value, $operator = '=')
    {
        $this->wheres[] = sprintf("%s %s '%s'", $column, $operator, $value);
        return $this;
    }

    public function get(int $limit = 15)
    {
        $wheres = join(' AND ', $this->wheres);

        $sql = ["SELECT " . $this->select, $this->from, "WHERE " . $wheres, "LIMIT {$limit}"];
        $fetch = $this->database->getPdo()
            ->prepare(join(" ", $sql));
        $fetch->execute();
        return $fetch;
    }

    public function getPdo(): \PDO
    {
        return $this->database->getPdo();
    }


    public static function create(array $data)
    {
        $model = new static();
        $columns = join(', ', array_keys($data));
        $values = join(', ', array_map(function($item) {
            return "'$item'";
        },
            array_values($data)
        ));
        $query = $model->getPdo()->prepare("INSERT INTO {$model->table} ({$columns}) VALUES ({$values})");
        return $query->execute();
    }

}
