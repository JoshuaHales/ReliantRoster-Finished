<?php

class Roster {
    /* Variables */

    private $rosterID;
    private $title;
    private $description;
    private $monday;
    private $tuesday;
    private $wednesday;
    private $thursday;
    private $friday;
    private $saturday;
    private $sunday;
    private $total;

    //creating the constructor, needed as my above variables are private, so this is how i access them
    public function __construct($t, $d, $mon, $tue, $wed, $thu, $fri, $sat, $sun, $tl) {
        $this->title = $t;
        $this->description = $d;
        $this->monday = $mon;
        $this->tuesday = $tue;
        $this->wednesday = $wed;
        $this->thursday = $thu;
        $this->friday = $fri;
        $this->saturday = $sat;
        $this->sunday = $sun;
        $this->total = $tl;
    }

    //Gets and Sets  
    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getMonday() {
        return $this->monday;
    }

    public function getTuesday() {
        return $this->tuesday;
    }

    public function getWednesday() {
        return $this->wednesday;
    }

    public function getThursday() {
        return $this->thursday;
    }

    public function getFriday() {
        return $this->friday;
    }

    public function getSaturday() {
        return $this->saturday;
    }

    public function getSunday() {
        return $this->sunday;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setMonday($monday) {
        $this->monday = $monday;
    }

    public function setTuesday($tuesday) {
        $this->tuesday = $tuesday;
    }

    public function setWednesday($wednesday) {
        $this->wednesday = $wednesday;
    }

    public function setThursday($thursday) {
        $this->thursday = $thursday;
    }

    public function setFriday($friday) {
        $this->friday = $friday;
    }

    public function setSaturday($saturday) {
        $this->saturday = $saturday;
    }

    public function setSunday($sunday) {
        $this->sunday = $sunday;
    }

    public function setTotal($total) {
        $this->sunday = $total;
    }

}
