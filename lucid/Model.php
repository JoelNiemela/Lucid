<?php

require LUCID . 'database.php';

class Model {
    private static function table(): string {
		$class = static::class;
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $class));
    }

    private static function model(): string {
		return static::class;
    }

    public static function all(): array {
        $table = static::table();
        $stmt = DB::query("
            SELECT *
              FROM {$table};
        ");

        $model = static::model();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $result = $stmt->fetchAll();

        if ($result === false) {
            throw new ErrorException("Error fetching all {$model}s.");
        }

        return $result;
	}

	public static function where(array $params): array {
        $param_columns = array_keys($params);
        $param_values = array_values($params);

        $conditions = [];
        foreach ($param_columns as $column) {
            $conditions[] = "{$column} = ?";
        }
        $where = implode(" AND ", $conditions);

        $table = static::table();
        $stmt = DB::query("
            SELECT *
              FROM {$table}
             WHERE {$where};
        ", ...$param_values);

        $model = static::model();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $result = $stmt->fetchAll();

        if ($result === false) {
            $params_str = implode(', ', array_map(fn($col) => "'{$col}' => {$params[$col]}", $param_columns));
            throw new ErrorException("Error in query: {$model}.where([{$params_str}])");
        }

        return $result;
    }

	public static function find(array $params): static {
        $param_columns = array_keys($params);
        $param_values = array_values($params);

        $conditions = [];
        foreach ($param_columns as $column) {
            $conditions[] = "{$column} = ?";
        }
        $where = implode(" AND ", $conditions);

        $table = static::table();
        $stmt = DB::query("
            SELECT *
              FROM {$table}
             WHERE {$where};
        ", ...$param_values);

        $model = static::model();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $result = $stmt->fetch();

        if ($result === false) {
            $params_str = implode(', ', array_map(fn($col) => ":{$col} = {$params[$col]}", $param_columns));
            throw new ErrorException("Not Found: No {$model} where {$params_str} found.");
        }

        return $result;
	}

    public static function new(array $params): static {
        $param_columns = array_keys($params);
        $param_values = array_values($params);

        $columns_arr = [];
        foreach ($param_columns as $column) {
            $columns_arr[] = strval($column);
        }
        $columns = implode(", ", $columns_arr);
        $values = implode(", ", array_fill(0, count($params), '?'));

        $table = static::table();
        $stmt = db::query("
            SHOW keys
            FROM {$table}
           WHERE key_name = 'primary';
        ");

        $primary_key = $stmt->fetch()['Column_name'];
        $stmt = DB::query("
            INSERT INTO {$table} ($columns)
            VALUES ({$values})
         RETURNING {$primary_key};
        ", ...$param_values);

        $id = $stmt->fetch()[$primary_key];
        return static::find([$primary_key => $id]);
	}

    public static function delete(array $params): bool {
        $param_columns = array_keys($params);
        $param_values = array_values($params);

        $conditions = [];
        foreach ($param_columns as $column) {
            $conditions[] = "{$column} = ?";
        }
        $where = implode(" AND ", $conditions);

        $table = static::table();
        $stmt = DB::query("
            DELETE
              FROM {$table}
             WHERE {$where};
        ", ...$param_values);

        return $stmt->rowCount() > 0;
	}
}
