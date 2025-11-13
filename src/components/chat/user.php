<?php

class User
{
    private $name;
    public function __construct(string $username)
    {
        self::$name = $username;
    }

    public function getName(): string
    {
        return self::$name;
    }

};
