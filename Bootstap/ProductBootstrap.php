<?PHP
require_once '../Model/DatabaseConnectionModel.php' ;
require_once '../Model/QueryModels/ProductQueryModel.php';
    return new ProductQueryModel(Connection::make()) ;
?>