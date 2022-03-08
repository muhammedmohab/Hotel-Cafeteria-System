<?php
class OrderProduct{
    private $orderId;
    private $productId;
    private $productCount;

    public function __construct($orderId, $productId, $productCount){
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->productCount = $productCount;
    }

    public function setOrderId(int $orderId){
        $this->orderId = $orderId;
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
}