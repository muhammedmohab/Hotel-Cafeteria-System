<?php

require '../../Model/DatabaseConnectionModel.php';
require '../../Model/QueryModels/UserQueryModel.php';
$DB = new DatabaseConnectionModel();
$connect = $DB->connect();
$database = new UserQueryModel($connect);
$comming_id = intval($_REQUEST["id"]);
$op = $database->deleteUser($comming_id);
header("Location:../../View/allusers.php");
exit;
