<?php
class OrderProductsQueryModel{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }
    public function selectProductsOrder(int $orderId){
        $stmt = $this->connection->prepare("select * from orderproduct WHERE orderId =:orderId");
        $stmt->bindParam(":orderId",$orderId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function selectProductOrder(int $orderId,int $productId){
        $stmt = $this->connection->prepare("select * from orderproduct WHERE orderId =:orderId and productId =:productId");
        $stmt->bindParam(":orderId",$orderId, PDO::PARAM_INT);
        $stmt->bindParam(":productId",$productId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertProductOrder(OrderProduct $Product):bool{
       $query="insert into orderproduct (orderId, productId, count, price)values(?,?,?,?)";
       $stmt= $this->connection->prepare($query);
       $result=$stmt->execute([$Product->getOrderId(),$Product->getProductId(),$Product->getProductCount()
       ,$Product->getPrice()]);
       return $result;
    }
    // public function updateOrder(String $status, int $id):bool{
    //     if($status == "Finished"){
    //         $today = new DateTime();
    //         $today = $today->format('Y-m-d H:i:s');
    //         $query = "update orders SET status =?, finshed_at=? WHERE id=?";
    //         $stmt = $this->connection->prepare($query);
    //         $result=$stmt->execute([$status,$today,$id]);
    //     }else{
    //         $query = "update orders SET status =? WHERE id=?";
    //         $stmt = $this->connection->prepare($query);
    //         $result=$stmt->execute([$status,$id]);
    //     }
    //     return $result;
    // }
    // public function deleteOrder($id):bool{
    //     $query = "delete FROM orders WHERE id=:order_id";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bindValue(":order_id", $id, PDO::PARAM_INT);
    //     return $stmt->execute();
    // }
    // public function userRequested($id){
    //     $stmt = $this->connection->prepare("SELECT name FROM user WHERE id =:userId");
    //     $stmt->bindParam(":userId",$id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $result = $stmt->fetchAll();
    //     return $result;
    // }
}