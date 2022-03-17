<?php
class Order{
    private $orderId;
    private $userId;
    private $totalPrice;
    private $status;
    private $createdAt;
    private $finishedAt;

    public function __construct($userId, $totalPrice, $status){
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
        $this->status = $status;
    }

    public function setId(int $orderId){
        $this->orderId = $orderId;
    }

    public function setUserId(int $userId){
        $this->userId = $userId;
    }
    public function setTotalPrice(float $totalPrice){
        $this->totalPrice = $totalPrice;
    }
    public function setStatus(String $status){
        $this->status = $status;
    }
    public function setCreatedAt(DateTime $createdAt){
        $this->createdAt = $createdAt;
    }
    public function setFinishedAt(DateTime $finishedAt){
        $this->finishedAt = $finishedAt;
    }

    public function getId():int{
        return $this->orderId;
    }
    public function getUserId():int{
        return $this->userId;
    }
    public function getTotalPrice():float{
        return $this->totalPrice;
    }
    public function getStatus():String{
        return $this->status;
    }    
    public function getCreatedAt():DateTime{
        return $this->createdAt;
    }
    public function getFinishedAt():DateTime{
        return $this->finishedAt;
    }
}