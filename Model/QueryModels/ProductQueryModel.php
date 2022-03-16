<?php
class ProductQueryModel{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selectAllProducts(){
        $stmt = $this->connection->prepare("SELECT * FROM product");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function selectSpecificProduct(int $id){
        $stmt = $this->connection->prepare("SELECT * FROM product WHERE id =:product");
        $stmt->bindParam(":product",$id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertProduct(Product $product):bool{
       $query="Insert INTO product (name, price, categoryId, image, available)Values(?,?,?,?,?)";
       $stmt= $this->connection->prepare($query);
       $result=$stmt->execute([$product->getName(),$product->getPrice(),$product->getCategoryID()
       ,$product->getImage(),$product->getAvailable()]);
       return $result;
    }
    public function updateProductImage(){
        $query="update product set image=? where id = ?";
        $stmt= $this->connection->prepare($query);
        $lastProduct=$this->getlastProduct();
        $result=$stmt->execute([$lastProduct['id'].$lastProduct['image'] , $lastProduct['id']]);
        return $result;
    }
    public function getlastProduct(){
        $query="select * from product order by id desc limit 1";
        $stmt= $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
     }
    public function updateProduct(Product $product):bool{
        $query = "UPDATE product SET name =?, price =?, categoryId =?,image =?, available =? WHERE id=?";
        $stmt = $this->connection->prepare($query);
        $result=$stmt->execute([$product->getName(),$product->getPrice(),$product->getCategoryID()
        ,$product->getImage(),$product->getAvailable(),$product->getID()]);
        return $result;
    }
    public function deleteProduct($id):bool{
        $query = "DELETE FROM product WHERE id=:product_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(":product_id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function checkUniqueName(int $id , string $productName){
        $query = "select name from product WHERE name = ? and id != ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$productName,$id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function checkCategory(int $categoryId){
        $query = "select id from category WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$categoryId]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function selectAllCategories(){
        $stmt = $this->connection->prepare("SELECT * FROM category");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
}