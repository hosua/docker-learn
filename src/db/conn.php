<?php

class Db
{
    private static ?\PgSql\Connection $conn = null;
    private static ?\PgSql\Result $res = null;

    public static function connect(): void
    {
        if (self::$conn === null) {
            self::$conn = pg_connect("host=db dbname=my_db user=admin password=admin")
                or die('Connection failed: ' . pg_last_error());
        }
    }

    public static function getConn(): \PgSql\Connection
    {
        if (self::$conn === null) {
            self::connect();
        }
        return self::$conn;
    }

    public static function executeSQL(string $sql, array $params = []): bool
    {
        $conn = self::getConn();
        $paramValues = [];
        $paramIndex = 1;
        $replacements = [];

        foreach ($params as $key => $value) {
            $placeholder = ':' . $key;
            $positionalPlaceholder = '$' . $paramIndex;
            $replacements[$placeholder] = $positionalPlaceholder;
            $paramValues[] = $value;
            $paramIndex++;
        }

        foreach ($replacements as $placeholder => $positionalPlaceholder) {
            $sql = str_replace($placeholder, $positionalPlaceholder, $sql);
        }

        self::$res = pg_query_params($conn, $sql, $paramValues);
        if (!self::$res) {
            die('Query failed: ' . pg_last_error());
            return false;
        }
        return true;
    }

    public static function query(string $sql): bool
    {
        self::$res = pg_query(self::getConn(), $sql);
        if (!self::$res) {
            die('Query failed: ' . pg_last_error());
            return false;
        }
        return true;
    }

    public static function num_rows(): int
    {
        return pg_num_rows(self::$res);
    }

    public static function fetch_next(): object|bool
    {
        return pg_fetch_object(self::$res);
    }

    public static function close(): void
    {
        if (self::$conn !== null) {
            pg_close(self::$conn);
            self::$conn = null;
        }
    }
}
