<?PHP
require_once '../Model/DatabaseConnectionModel.php' ;
require_once '../Model/QueryModels/OrderProductsQueryModel.php';
return new OrderProductsQueryModel(Connection::make()) ;
?>