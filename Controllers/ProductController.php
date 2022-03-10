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
        updateProduct($dbProduct);
        break;

    default:
        echo "Unexpected request type";
        break;
} 
function validateImage():bool{
    $error="";
    if (isset($_FILES['image'])) {
        $file_size = $_FILES['image']['size'];
        $file_ext = strtolower(explode('.', $_FILES['image']['name'])[1]);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $error=$error."&imageError=extension not allowed, please choose a JPEG or PNG file.";
        }

        if (empty($_FILES['image']['name'])) {
            $error=$error."&imageError=image upload is required";
        }
        if ($file_size > 2097152) {
            $error=$error."&imageError=File size must be excately 2 MB";
        }
    }
    else
        $error=$error."&imageError=This field is required";
    if(empty($error))
        return true;
    else
        header("location: ../View/editProduct.php?". $error);
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
            $errors = $errors . "&" . $index . "Error=$index not found";
        }
        if (empty($errors)) {
            $data = $dbProduct->checkUniqueName( intval($_POST['productId']) , $_POST["name"]);
            if (empty($data)) {
                return true;
            }else{
                header("location: ../View/editProduct.php?&this product already exist");
            }
        } else {
            header("location: ../View/editProduct.php?& ". $errors);
        }
    }
    return false;
}
function updateProduct(ProductQueryModel $dbProduct)
{
    $validateImage=true;
    $imageName=$_REQUEST['oldImage'];
    if(!empty($_FILES['image']['name'])&& $_REQUEST['productId'].$_FILES["image"]['name']!=$_REQUEST["oldImage"]){
        $validateImage=validateImage();
        $imageName = $_REQUEST["productId"].$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 
        "../public/images/products_images/$imageName");
    }
    if (validateProduct($dbProduct)&&$validateImage) {
        $available=true;
        if(empty($_REQUEST['available']))
            $available=false;
        $newProduct = new Product(
            intval($_REQUEST['categoryId']),
            $_REQUEST['name'],
            intval($_REQUEST['productPirce']),
            $imageName,boolval($available)
        );
        $newProduct->setID($_REQUEST['productId']);
        if($dbProduct->updateProduct($newProduct))
            header("location: ../View/allProducts.php");    
    }
}
function deleteProduct($dbProduct)
{
    $errors = "";
    if (!$dbProduct->deleteProduct(intval($_REQUEST["productId"]))) {
        $errors = "failed to delete";
    }
    header("location: ../View/allProducts.php" . "?&errors=$errors");
}