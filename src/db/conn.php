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
