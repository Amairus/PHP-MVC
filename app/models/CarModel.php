<?php

class CarModel {

    public $id;
    public $user_id;
    public $ordered_by;
    public $status;
    public $brand;
    public $type;
    public $year;
    public $engine;
    public $milleage;
    public $price;
    public $photo;

    public function __construct()
    {

    }
    public function getPhoto()
    {
        return $this->photo;
    }

    public function getCarForm()
    {
        if ($this->milleage < 100000)
            return 'A+';
        if (100000 < $this->milleage && $this->milleage < 150000 )
            return 'A';
        if (150000 < $this->milleage && $this->milleage < 200000 )
            return 'B';
        if (200000 < $this->milleage && $this->milleage < 250000 )
            return 'C';
        else
            return 'D';
    }

    public function setKilometers()
    {
        $this->kilometers =  $this->milleage * 1.60934;
    }
}