<?php

namespace people;

abstract class Person
{
    const BIG = 'big';
    const SMALL = 'small';

    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->setName($name);
        $this->setAge($age);
    }

    /**
     * @param mixed $age
     * @throws \Exception
     */
    public function setAge($age)
    {
        $age = (int)$age;
        if($age < 0)
            throw new \Exception("Age must be positive");
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    abstract public function getType();
}