<?php
session_start();
require "../Bootstap/dbuser.php";
require "../Model/DTO/Order.php";
switch ($_REQUEST["validationType"]) {
  case "updateOrderStatus":
        updateOrder($dbOrder);
        break;
  case "cancelOrder":
        cancelOrder($dbOrder);
        break;

    default:
        echo "Unexpected request type";
        break;
} 
function updateOrder($dbOrder)
{
    $errors = "";
    // var_dump($_REQUEST["orderStatus"],$_REQUEST["orderId"]);

    if(($_REQUEST["orderStatus"]=="In-Progress" || $_REQUEST["orderStatus"]=="Out-For-Delivery" || $_REQUEST["orderStatus"]=="Finished")){
        if(!$dbOrder->updateOrder($_REQUEST["orderStatus"],$_REQUEST["orderId"])){
            $errors = "Failed to update order status";
        }
    }else{
        $errors = "You need to select a proper Order Status";
    }
    header("location: ../View/allOrders.php" . "?&errors=" . $errors);
}          
function cancelOrder($dbOrder)
{
    $errors = "";
    if (!$dbOrder->deleteOrder(intval($_REQUEST["orderId"]))) {
        $errors = "failed to cancel order";
    }
    header("location: ../View/allOrders.php" . "?&errors=:" . $errors);
}