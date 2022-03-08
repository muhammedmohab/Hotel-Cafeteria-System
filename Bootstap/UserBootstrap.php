<?PHP
require '../Model/DatabaseConnectionModel.php';
require '../Model/QueryModels/UserQueryModel.php'; 

   
    return new UserQueryModel(Connection::make()) ;

?>