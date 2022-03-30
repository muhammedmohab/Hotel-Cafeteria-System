<?php
session_start();
require "../Bootstap/dbuser.php";
require "../Model/DTO/Product.php";
switch ($_REQUEST["validationType"]) {
    case "destroyProduct":
        deleteProduct($dbProduct);
        break;
    case "updateProduct":
        updateProduct($dbProduct);
        break;

    case "storeProduct":
        storeProduct($dbProduct);
        break;

    default:
        header('Location: ../index.php?errors="Some Thing Wrong Try Again"');
        break;
}
function validateImage(): bool
{
    $error = "";
    if (isset($_FILES['image'])) {
        $file_size = $_FILES['image']['size'];
        $file_ext = strtolower(explode('.', $_FILES['image']['name'])[1]);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $error = $error . "&imageError=extension not allowed, please choose a JPEG or PNG file.";
        }

        if (empty($_FILES['image']['name'])) {
            $error = $error . "&imageError=image upload is required";
        }
        if ($file_size > 2097152) {
            $error = $error . "&imageError=File size must be excately 2 MB";
        }
    } else
        $error = $error . "&imageError=This field is required";
    if (empty($error))
        return true;
    else
        header("location: ../View/editProduct.php?" . $error . "&id={$_REQUEST['productId']}");
    return false;
}

function validateProduct(ProductQueryModel $dbProduct)
{
    $errors = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        foreach ($_POST as $index => $value) {
            if (empty($value))
                $errors = $errors . "&" . $index . "Error=$index is required";
            if ($index == 'categoryId' && empty($dbProduct->checkCategory(intval($_REQUEST['categoryId']))))
                $errors = $errors . "&" . $index . "Error=this value not found";
        }
        if (empty($errors)) {
            if (empty($_POST['productId']))
                $productId = 0;
            else
                $productId = intval($_POST['productId']);
            $data = $dbProduct->checkUniqueName($productId, $_POST["name"]);
            if (empty($data)) {
                return true;
            } else {
                // echo "error ya abo 3mo";
                // return;
                header("location: ../View/editProduct.php?&productName=this product already exist&id={$_REQUEST['productId']}");
            }
        } else {
            // echo "error y abo 3mo";
            header("location: ../View/editProduct.php?& " . $errors . "&id={$_REQUEST['productId']}");
        }
    }
    return false;
}
function updateProduct(ProductQueryModel $dbProduct)
{
    $validateImage = true;
    $imageName = $_REQUEST['oldImage'];
    if (!empty($_FILES['image']['name']) && $_REQUEST['productId'] . $_FILES["image"]['name'] != $_REQUEST["oldImage"]) {
        $validateImage = validateImage();
        if ($validateImage) {
            $imageName = $_REQUEST["productId"] . $_FILES['image']['name'];
            if (!file_exists('../public/images/products_images')||!is_dir('../public/images/products_images')) {
                // var_dump("sssssssssssssssssssss");
                mkdir('../public/images/products_images', 0777, true);
            }
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                "../public/images/products_images/$imageName"
            );
        }
    }
    if (validateProduct($dbProduct) && $validateImage) {
        $available = true;
        if (empty($_REQUEST['available']))
            $available = false;
        $newProduct = new Product(
            intval($_REQUEST['categoryId']),
            $_REQUEST['name'],
            intval($_REQUEST['productPirce']),
            $imageName,
            boolval($available)
        );
        $newProduct->setID($_REQUEST['productId']);
        if ($dbProduct->updateProduct($newProduct))
            header("location: ../View/allProducts.php");
    }
}
function storeProduct(ProductQueryModel $dbProduct)
{
    $validateImage = validateImage();
    if ($validateImage) {
        $imageName = $_FILES['image']['name'];
    }
    if (validateProduct($dbProduct) && $validateImage) {
        $available = true;
        if (empty($_REQUEST['available']))
            $available = false;
        $newProduct = new Product(
            intval($_REQUEST['categoryId']),
            $_REQUEST['name'],
            intval($_REQUEST['productPirce']),
            $imageName,
            boolval($available)
        );
        if ($dbProduct->insertProduct($newProduct) && $dbProduct->updateProductImage()) {
            $imageid = $dbProduct->getlastProduct()['id'];
            if (!file_exists('../public/images/products_images')||!is_dir('../public/images/products_images')) {
                // var_dump("sssssssssssssssssssss");
                mkdir('../public/images/products_images', 0777, true);
            }
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                "../public/images/products_images/$imageid$imageName"
            );
            header("location: ../View/allProducts.php");
        }
    }
}
function deleteProduct($dbProduct)
{
    $error = "";
    if (!$dbProduct->deleteProduct(intval($_REQUEST["productId"]))) {
        $error = "failed to delete";
    }
    header("location: ../View/allProducts.php" . "?&errors=$error");
}
