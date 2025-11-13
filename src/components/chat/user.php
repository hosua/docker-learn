<?php

class User
{
    private $name;
    public function __construct(string $username)
    {
        $this->name = $username;
    }

    public function getName(): string
    {
        return $this->name;
    }

};
