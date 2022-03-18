<?PHP
require_once '../Model/DatabaseConnectionModel.php';
require_once '../Model/QueryModels/CategoryQueryModel.php'; 
return new CategoryQueryModel( Connection::make()) ;
?>