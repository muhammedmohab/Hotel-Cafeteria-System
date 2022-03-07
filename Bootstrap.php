<?PHP

require 'connection.php' ;

require 'UserQueryBuilder.php' ; 

return new QueryBuilder( Connection::make()) ;

?>