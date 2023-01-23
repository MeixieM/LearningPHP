<?php

//Class and Instance

require_once "./Person.php";
require_once "./Student.php";

// $p = new Person("Alex", 22, null);
// echo $p->name . "<br>";
// echo $p->age . "<br>";
// echo $p->getSalary()."<br>";
// $p->setSalary(100.00);
// echo $p->getSalary() ."<br>";

//Instance of Student

$s = new Student("Alex", 22, 1234);

echo $s->name . $s->stdID;
