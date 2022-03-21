<?php
session_start();
require "../Bootstap/dbuser.php";
require "../Model/DTO/User.php";
switch ($_REQUEST["validationType"]) {
    case "login":
        validationLogin($dbuser);
        break;
    case "register":
        validationRegister($dbuser);
        break;
    case "Logout":
        session_unset();
        header('Location: ../index.php');
        break;

    default:
        header('Location: ../index.php?errors="Some Thing Wrong Try Again"');
        break;
}

function  validationLogin($dbuser)
{

    if (!empty($_REQUEST["email"]) && !empty($_REQUEST["password"])) {
        $data = $dbuser->checkUser($_REQUEST["email"], $_REQUEST["password"]);
        if ($data) {
            $_SESSION["authUsername"] = $data[0]["name"];
            $_SESSION["authEmail"] =  $data[0]["email"];
            $_SESSION["authImage"] =  $data[0]["image"];
            $_SESSION["authRole"] =  $data[0]["admin"];
            $_SESSION["authId"] = $data[0]["id"];
            if ($data[0]["admin"] == 1) {
                header('Location: ../View/allUsers.php');
            } else {
                header('Location: ../index.php');
            }
        } else {
            header("location: ../index.php?" . "&errors=User name or Password didn't match");
        }
    }
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
        $error = $error . "This field is required";
    if (empty($error))
        return true;
    else
        header("location: ../View/register.php?&errors=" . $error);
    return false;
}
function  validationRegister($dbuser)
{
    $passwordpattern = "/([a-z1-9_]){6,}/i";
    $errors = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        foreach ($_POST as $index => $value) {
            if (empty($_POST[$index]) && $index != "role")
                $errors = $errors . "</br>" . $index . " is required</br>;";
            if ($index == "password" && isset($value)  && !preg_match($passwordpattern, $value))
                $errors = $errors . "</br>Password is Only 8 chars, Doesn’t allow special chars -only underscore allowed, Doesn’t accept Capital characters</br>;";
        }
        var_dump($errors);
        if (empty($errors)) {
            $data = $dbuser->checkUniqueEmail($_POST["email"]);
            if (empty($data)) {
                $role = false;
                if (!empty($_POST["role"])) {
                    $role = true;
                }
                // var_dump($_FILES);
                // return;
                // exit;
                if (validateImage()) {
                    $newUser = new User($_POST["name"], $_POST["email"], $_POST["password"], $_POST["room_number"], $_FILES["image"]['name'], $role);
                    $dbuser->insertUser($newUser);
                    move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        "../public/images/profile_images/".$_FILES['image']['name']
                    );
                    header('Location: ../View/allUsers.php');
                }
            }
        } else {
            header("location: ../View/register.php?" . "&errors=" . $errors);
        }
    } else {
        header("location: ../index.php?" . "&errors=some Thing wrong try again");
// return;
    }
}
