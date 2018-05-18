<?php
//base class for employee
class Employee {
    //variables
    private $id;
    private $name;
    private $email;

    //creating the constructor, accesses private variables
    public function __construct($n, $e) {
        $this->name = $n;
        $this->email = $e;
    }
    //gets name
    public function getName() {
        return $this->name;
    }
    //sets name
    public function setName($name) {
        $this->name = $name;
    }
    //gets email
    public function getEmail() {
        return $this->email;
    }
    //sets email
    public function setEmail($email) {
        $this->email = $email;
    }
}