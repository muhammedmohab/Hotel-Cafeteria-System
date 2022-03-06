<?php 

$database = require 'Bootstrap.php' ; 

$users = $database->selectALL('users');
?>