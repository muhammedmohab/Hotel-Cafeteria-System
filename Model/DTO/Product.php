<?php
class Product{
    private $id;
    private $price;
    private $categoryID;
    private $available;
    private $name;
    private $image;
    public function __construct( $categoryID, $name, $price, $image, $available = true){
        $this->name = $name;
        $this->price = $price;
        $this->categoryID = $categoryID;
        $this->image = $image;
        $this->available = $available;
    }
    public function setID(int $ID){
        $this->id = $ID;
    }
    public function getID():int{
        return $this->id;
    }
    public function setName(String $name){
        $this->name = $name;
    }

    public function getName():String{
        return $this->name;
    }

    public function setImage(String $image){
        $this->image = $image;
    }

    public function getImage():String{
        return $this->image;
    }
    public function setPrice(float $price){
        $this->price = $price;
    }

    public function setcategoryID(int $categoryID){
        $this->categoryID = $categoryID;
    }

    public function setAvailable(bool $available){
        $this->available = $available;
    }

    public function getPrice():float{
        return $this->price;
    }

    public function getCategoryID():int{
        return $this->categoryID;
    }
    public function getAvailable():bool{
        return $this->available;
    }
}