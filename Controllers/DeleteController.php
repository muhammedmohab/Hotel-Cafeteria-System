<?php
require "../Bootstap/dbuser.php";
$comming_id = intval($_REQUEST["id"]);
if($dbOrder->deleteUserOrders($comming_id))
    $op = $dbuser->deleteUser($comming_id);
header("Location:../View/allUsers.php");
exit;
