<?php

class DB {
    private static ?DB $database = null;

    private PDO $PDO;

    private function __construct() {
        $config = parse_ini_file(APP . '/config/db_config.ini');

        $dsn = "mysql:dbname={$config['db_name']};host={$config['host']}";

        $this->PDO = new PDO($dsn, $config['user'], $config['password']);
    }

    private static function get_database(): PDO {
        if (!isset(DB::$database)) {
            DB::$database = new DB();
        }

        return DB::$database->PDO;
    }

    private static function get_PDO_type(mixed $value) {
        if (is_int($value)) {
            return PDO::PARAM_INT;
        } elseif (is_bool($value)) {
            return PDO::PARAM_BOOL;
        } elseif (is_null($value)) {
            return PDO::PARAM_NULL;
        } else {
            return PDO::PARAM_STR;
        }
    }

    public static function query(string $query, ...$params): PDOStatement {
        $stmt = DB::get_database()->prepare($query);

        foreach ($params as $name => $value) {
            if (is_int($name)) {
                $stmt->bindValue($name+1, $value, DB::get_PDO_type($value));
            } else {
                $stmt->bindValue($name, $value, DB::get_PDO_type($value));
            }
        }

        $stmt->execute();

        return $stmt;
    }
}
