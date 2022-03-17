<?PHP
require_once '../Model/DatabaseConnectionModel.php';
require_once '../Model/QueryModels/OrderQueryModel.php'; 
return new OrderQueryModel( Connection::make()) ;
?>