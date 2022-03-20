<?php
class OrderProduct{
    private $orderId;
    private $productId;
    private $productCount;
    private $price;

    public function __construct($orderId, $productId, $productCount,$price){
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->productCount = $productCount;
        $this->price = $price;
    }

    public function setOrderId(int $orderId){
        $this->orderId = $orderId;
    }
    public function setPrice(int $price){
        $this->price = $price;
    }

    public function setProductId(int $productId){
        $this->productId = $productId;
    }

    public function setProductCount(int $productCount){
        $this->productCount = $productCount;
    }

    public function getOrderId():int{
        return $this->orderId;
    }
    public function getProductId():int{
        return $this->productId;
    }    
    public function getProductCount():int{
        return $this->productCount;
    }    
    public function getPrice():int{
        return $this->price;
    }
}