<?PHP
require '../Model/DatabaseConnectionModel.php';
require '../Model/QueryModels/UserQueryModel.php'; 

   
  
     $DB = new DatabaseConnectionModel();
     $connect=$DB->connect();
    return new UserQueryModel($connect) ;

?>