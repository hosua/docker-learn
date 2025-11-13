<?php

include_once "user.php";
include_once "db/conn.php";

class Chat
{
    public function addLog(User $user, string $log): void
    {
        $username = $user->getName();
        Db::executeSQL(
            "INSERT INTO chat (username, log) VALUES (:username, :log)",
            ["username" => $username, "log" => $log]
        );
    }

    public function getLogs(): string
    {
        $result = "";
        Db::query("SELECT username, log, ts FROM chat ORDER BY id ASC");
        while ($log = Db::fetch_next()) {
            $unix_ts = strtotime($log->ts);
            $ts = date("H:i:s A", $unix_ts);
            $result = $result . "[{$ts}] {$log->username}: {$log->log}<br>";
        }
        return $result;
    }
};
