<?php


namespace Classes;

class DB
{
    public static $connection;

    private $query;

    private static $_instance = null;

    protected $table;

    private $output;

    public static function getInstance()
    {

        if(self::$_instance == null) {
            self::$_instance = new self();
        }

        self::connect();

        return self::$_instance;
    }

    public static function connect()
    {
//        try {
//            $config = config('DB_CONFIG');
//
//            self::$connection = call_user_func_array('mysqli_connect', $config);
//
//            if(mysqli_connect_errno()) {
//                throw new \Exception('Can not connect to DB');
//            }
//        } catch (\Exception $exception) {
//            var_dump('gag');
//        }
    }

    private function runQuery() {
        try {
            $this->output = mysqli_query(self::$connection, $this->query);

            if($errorCode = mysqli_errno(self::$connection)) {
              throw new \Exception(mysqli_error(self::$connection), $errorCode);
            }

            if (gettype($this->output) === 'boolean') {
                return $this->output;
            }

            $data = [];

            while ($row = mysqli_fetch_assoc($this->output)) {
                $data[] = $row;
            }

            return $data;
        }catch (\Exception $exception) {
            echo $exception->getMessage().' Code: '.$exception->getCode();die;
        }
    }

    public function where($colName, $operator, $value) {
        $query = " WHERE $colName $operator '$value'";
        $this->query .= $query;
        return $this;
    }

    public function orWhere($colName, $operator, $value) {
        $query = " OR $colName $operator '$value'";
        $this->query .= $query;
        return $this;
    }

    public function andWhere($colName, $operator, $value) {
        $query = " AND $colName $operator '$value'";
        $this->query .= $query;
        return $this;
    }

    public function select($columns = []){
        $cols = '*';
        if(count($columns)) {
            $cols = join(',', $columns);
        }
        $this->query = "SELECT $cols FROM $this->table";
        return $this;
    }

    public function update($data) {
        $cols = '';
        foreach ($data as $column => $value) {
            $cols .= "$column='$value',";
        }
        $cols = rtrim($cols, ',');
        $this->query = "UPDATE $this->table SET $cols";
        return $this;
    }

    public function insert($data) {
        $columns = array_keys($data);
        $values = array_map(function ($el) {
            return "'$el'";
        }, array_values($data));
        $columns = join(',', $columns);
        $values = join(',', $values);

        $this->query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        return $this->runQuery();
    }

    public function delete() {
        $this->query = "DELETE FROM $this->table";
        return $this->runQuery();
    }


    public function orderBy($column, $order = 'ASC') {
        $this->query .= " ORDER BY $column $order";
        return $this;
    }

    public function limit($limit) {
        $this->query .= "LIMIT $limit";
        return $this;
    }

    public function first() {
        $this->query .= " LIMIT 1";
        $data = $this->runQuery();
        return $data ? $data[0] : null;
    }

    public function fetch() {
        return $this->runQuery();
    }

    public function toSql()
    {
        echo $this->query;
    }
}