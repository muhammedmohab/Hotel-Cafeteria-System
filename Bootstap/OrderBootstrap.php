<?PHP
require './Model/DatabaseConnectionModel.php' ;

require 'QueryBuilder.php' ; 
return new UserQueryModel( DatabaseConnectionModel::connect()) ;
?>