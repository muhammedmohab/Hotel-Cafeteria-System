<?php
require "../Bootstap/dbuser.php";
$comming_id = intval($_REQUEST["id"]);
$op = $dbuser->deleteUser($comming_id);
header("Location:../View/allusers.php");
exit;
