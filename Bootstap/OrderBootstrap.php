<?PHP
require './Model/DatabaseConnectionModel.php' ;

require 'QueryBuilder.php' ; 
return new UserQueryModel( Connection::make()) ;
?>