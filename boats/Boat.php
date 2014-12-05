<?php

namespace boats;

use people\Person;

class Boat
{
    private static $instance;
    private $persons = [];

    private function __construct() { }

    /**
     * @return Boat
     */
    public static function getInstance()
    {
        if(empty(self::$instance))
        {
            self::$instance = new Boat();
        }
        return self::$instance;
    }

    /**
     * @param Person $person
     * @throws \Exception
     */
    public function addPersonToBoat(Person $person)
    {
        $accept = $this->acceptPerson();
        if(!$accept)
            throw new \Exception('Boat is busy');

        if(is_array($accept))
        {
            if(in_array($person->getType(), $accept))
            {
                $this->persons[] = $person;
            }
        }
    }

    /**
     * @return array|bool
     */
    private function acceptPerson()
    {
        switch (count($this->persons))
        {
            case 0:
                //The boat is empty, can accept small and big person
                return [Person::SMALL, Person::BIG];
                break;
            case 1:
                //One person is in boat
                //Only small person is acceptable
                if($this->persons[0]->getType() == Person::SMALL)
                    return [Person::SMALL];
                else
                    //The boat is full
                    return false;
                break;
            case 2:
                //The boat is full
                return false;
                break;
        }
    }

    /**
     * @param Person $person
     */
    public function removePersonFromBoat(Person $person)
    {
        $this->persons = array_udiff($this->persons, array($person), function($a, $b) { return ($a === $b)?0:1; });
    }

    /**
     *
     */
    public function crossTheRiver()
    {
        $whom = '';
        foreach($this->persons as $person)
        {
            $whom.=$person->getName().', ';
        }
        $this->persons = [];
        echo "Boat crossed: $whom".PHP_EOL;
        echo '-----------------------------------------'.PHP_EOL;
    }

    /**
     * @return int
     */
    public function countPersonsInBoat()
    {
        return count($this->persons);
    }

    public function cleanBoat()
    {
        $this->persons = [];
    }
}