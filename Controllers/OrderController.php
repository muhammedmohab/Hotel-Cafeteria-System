<?php

use function PHPSTORM_META\type;

session_start();
require "../Bootstap/dbuser.php";
require "../Model/DTO/Order.php";
require "../Model/DTO/OrderProducts.php";
switch ($_REQUEST["validationType"]) {
    case "updateOrderStatus":
        updateOrder($dbOrder);
        break;
    case "cancelOrder":
        cancelOrder($dbOrder);
        break;

    case "storeOrder":
        storeOrder($dbOrder, $dbOrderProducts);
        break;

    default:
        echo "Unexpected request type";
        break;
}
function validateOrder()
{
    $errors = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $index => $value) {
            if (empty($value))
                $errors = $errors . "&" . $index . "Error=$index is required";
        }
        if (empty($_REQUEST['id']))
            $errors = $errors . "&productsError=you must add at least one product";
        if ($_SESSION['authRole'] == 1 &&  empty($_REQUEST['userId'])) {
            $errors = $errors . "&userError=you must choose user";
        }
        // var_dump($_SESSION['authRole']);
        if (!empty($errors)) {
            header("location:../View/createOrder.php?&$errors");
            return false;
        } else
            return true;
    }
    return false;
}
function storeOrder(OrderQueryModel $dbOrder, OrderProductsQueryModel $dbOrderProducts)
{
    if (validateOrder()) {
        $lastOrder = "";
        if ($dbOrder->insertOrder(new Order($_REQUEST["userId"], $_REQUEST["totalPrice"]))) {
            $lastOrder = $dbOrder->selectLastOrder();
        }
        foreach ($_REQUEST['id'] as $index => $ProductId) {
            $newProductOrder = new OrderProduct(
                $lastOrder['id'],
                $ProductId,
                $_REQUEST["quantity"][$index],
                $_REQUEST['price'][$index] * $_REQUEST["quantity"][$index]
            );
            echo "<br>";
            $dbOrderProducts->insertProductOrder($newProductOrder);
            header("location: ../View/myOrders.php");
        }
    }
}

function updateOrder($dbOrder)
{
    $errors = "";
    if (($_REQUEST["orderStatus"] == "In-Progress" || $_REQUEST["orderStatus"] == "Out-For-Delivery" || $_REQUEST["orderStatus"] == "Finished")) {
        if (!$dbOrder->updateOrder($_REQUEST["orderStatus"], $_REQUEST["orderId"])) {
            $errors = "Failed to update order status";
        }
    } else {
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