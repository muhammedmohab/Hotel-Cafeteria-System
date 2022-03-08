<?php
class Order{
    private $usrId;
    private $totalPrice;
    private $status;

    public function __construct($usrId, $totalPrice, $status){
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
        $this->status = $status;
    }

    public function setUserId(int $userId){
        $this->userId = $userId;
    }
    public function setTotalPrice(double $totalPrice){
        $this->totalPrice = $totalPrice;
    }
    public function setStatus(String $status){
        $this->status = $status;
    }
    public function getUsreId():int{
        return $this->userId;
    }
    public function getTotalPrice():double{
        return $this->totalPrice;
    }
    public function getStatus():String{
        return $this->status;
    }    
}