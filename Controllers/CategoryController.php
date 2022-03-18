<?php
session_start();
require "../Bootstap/dbuser.php";
require "../Model/DTO/Category.php";
switch ($_REQUEST["validationType"]) {

    case "storeCategory":
        storeCategory($dbCategory);
        break;
    default:
        echo "Unexpected request type";
        break;
}
function validateCategory(CategoryQueryModel $dbCategory)
{
    $errors = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        foreach ($_POST as $index => $value) {
            if (empty($value))
                $errors = $errors . "&" . $index . "Error=$index is required";
        }
        if (empty($errors)) {
            $data = $dbCategory->selectSpecificCategory($_POST["CategoryName"]);
            if (empty($data)) {
                return true;
            } else {
                // echo "error ya abo 3mo";
                // return;
                header("location: ../View/addProduct.php?&CategoryNameError=this category already exist");
            }
        } else {
            // echo "error y abo 3mo";
            header("location: ../View/addProduct.php?& " . $errors);
        }
    }
    return false;
}
function storeCategory(CategoryQueryModel $dbCategory)
{
    $validate = validateCategory($dbCategory);
    if ($validate) {
        if ($dbCategory->insertCategory(new Category($_POST["CategoryName"])))
            header("location: ../View/addProduct.php");
        else
            header("location: ../View/addProduct.php?storeError=can't add this category");
    }
}
