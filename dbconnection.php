<?php 

$database = require 'Bootstrap.php' ; 

$users = $database->selectALL('user');
//var_dump($users);
?>