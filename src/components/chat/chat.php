<?php

include_once "user.php";
include_once "../db/conn.php";

class Chat
{
    private $logs = [];

    public function addLog(User $user, string $log): void
    {
        $username = $user->getName();
        array_push("{$username}: {$log}");
        // add actual query
    }
};
