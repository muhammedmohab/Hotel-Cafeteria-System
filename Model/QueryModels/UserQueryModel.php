<?php
class UserQueryModel{
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selectAllUsers(){
        $stmt = $this->connection->prepare("SELECT * FROM user");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function selectSpecificUser(int $id){
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id =:userId");
        $stmt->bindParam(":userId",$id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    // $name,$email, $password, $roomNumber,$image, $isAdmin
    public function insertUser($user){
       $query="Insert INTO user (name, email, password, roomNumber, image, admin)Values(:user_name,:user_email, :user_password, :user_roomNumber, :user_image, :user_isAdmin)";
       $stmt= $this->connection->prepare($query);
       $stmt->bindValue(":user_name",$user->getName(), PDO::PARAM_STR);
       $stmt->bindValue(":user_email",$user->getEmail(), PDO::PARAM_STR);
       $stmt->bindValue(":user_password",$user->getPassword(), PDO::PARAM_STR);
       $stmt->bindValue(":user_roomNumber",$user->getRoomNumber(), PDO::PARAM_STR);
       $stmt->bindValue(":user_image",$user->getImage(), PDO::PARAM_STR);
       $stmt->bindValue(":user_isAdmin",$user->getIsAdmin(), PDO::PARAM_BOOL);
       $stmt->execute();
       return $this->connection->lastInsertId();
    }
   
    public function updateUser($id, $user){
       $query = "UPDATE user SET name =:user_name, email =:user_email, password =:user_password, roomNumber =:user_roomNumber, image =:user_image, admin =:user_isAdmin WHERE id=:user_id";
   
       $stmt= $this->connection->prepare($query);
       $stmt->bindValue(":user_name",$user->getName(), PDO::PARAM_STR);
       $stmt->bindValue(":user_email",$user->getEmail(), PDO::PARAM_STR);
       $stmt->bindValue(":user_password",$user->getPassword(), PDO::PARAM_STR);
       $stmt->bindValue(":user_roomNumber",$user->getRoomNumber(), PDO::PARAM_STR);
       $stmt->bindValue(":user_image",$user->getImage(), PDO::PARAM_STR);
       $stmt->bindValue(":user_isAdmin",$user->getIsAdmin(), PDO::PARAM_BOOL);
       $stmt->bindValue(":user_id",$id, PDO::PARAM_INT);
       $stmt->execute();
       return $this->connection->lastInsertId();
    }
   
    public function deleteUser($id){
        $query = "DELETE FROM user WHERE id=:user_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(":user_id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
   
    
}