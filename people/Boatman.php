<?php

namespace people;

class Boatman extends Person
{
    public function __construct($name, $age)
    {
        parent::__construct($name, $age);
    }

    public function getType()
    {
        return self::BIG;
    }
}