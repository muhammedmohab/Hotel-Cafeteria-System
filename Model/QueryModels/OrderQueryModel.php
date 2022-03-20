<?php
class OrderQueryModel{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selectAllOrders(){
        $stmt = $this->connection->prepare("SELECT * FROM orders");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function selectSpecificOrder(int $id){
        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id =:order");
        $stmt->bindParam(":order",$id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertOrder(Order $order):bool{
        $today = new DateTime();$today = $today->format('Y-m-d H:i:s');
        $query="Insert INTO orders (userId, totalPrice, status, created_at)Values(?,?,?,?)";
       $stmt= $this->connection->prepare($query);
       $result=$stmt->execute([$order->getUserId(),$order->getTotalPrice(),$order->getStatus()
       ,$today]);
       return $result;
    }
    public function updateOrder(String $status, int $id):bool{
        if($status == "Finished"){
            $today = new DateTime();
            $today = $today->format('Y-m-d H:i:s');
            $query = "update orders SET status =?, finshed_at=? WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $result=$stmt->execute([$status,$today,$id]);
        }else{
            $query = "update orders SET status =? WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $result=$stmt->execute([$status,$id]);
        }
        return $result;
    }
    public function deleteOrder($id):bool{
        $query = "delete FROM orders WHERE id=:order_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(":order_id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function userRequested($id){
        $stmt = $this->connection->prepare("SELECT name FROM user WHERE id =:userId");
        $stmt->bindParam(":userId",$id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getProductsOfOrder($order_id)
    {
        $products = array();
        $sql = "SELECT p.name,p.image, p.price, op.count FROM product p, orderproduct op WHERE p.id = op.productId AND op.orderId = :order_id;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $products; 
    }
    public function selectUserOrders($id){
        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE userId =:userId");
        $stmt->bindParam(":userId",$id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function selectLastOrder(){
        $stmt = $this->connection->prepare("select * from orders order by id desc limit 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }
}