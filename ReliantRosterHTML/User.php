<?php
/* user base class */
class User {
    //variables
    private $id;
    private $username;
    private $password;
    private $fullname;
    private $emailaddress;
    private $customTime;
    
    /* constructor */
    public function __construct($u, $p, $fn, $ea, $ct) {
        $this->username = $u;
        $this->password = $p;
        $this->fullname = $fn;
        $this->emailaddress = $ea;
        $this->customTime = $ct;
    }
    
    //get and sets
    public function getUsername() {
        return $this->username;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getEmailaddress() {
        return $this->emailaddress;
    }  
    
    public function getCustomTime() {
        return $this->customTime;
    }  
}