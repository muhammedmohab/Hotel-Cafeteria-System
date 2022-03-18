<?php
class CategoryQueryModel{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selectAllCategories(){
        $stmt = $this->connection->prepare("SELECT * FROM category");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function selectSpecificCategory(string $categoryName){
        $query="select * from category where name =?";
        $stmt= $this->connection->prepare($query);
        $stmt->execute([$categoryName]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }
    public function insertCategory(Category $category):bool{
       $query="insert into category (name) Values(?)";
       $stmt= $this->connection->prepare($query);
       $result=$stmt->execute([$category->getName()]);
       return $result;
    }
}