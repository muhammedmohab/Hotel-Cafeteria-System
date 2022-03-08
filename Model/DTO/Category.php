<?php
class Category{
    private $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function setName(String $name){
        $this->name = $name;
    }

    public function getName():String{
        return $this->name;
    }
}