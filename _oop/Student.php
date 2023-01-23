<?php

require_once "./Person.php";

class Student extends Person {

    public int $stdID;
    public function __construct($name, $age, $stdID)
    {
        $this->stdID = $stdID;
        parent::__construct($name, $age, null);
    }
}