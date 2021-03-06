<?php
require "../Model/DTO/User.php";
require "../Bootstap/dbuser.php";
$op = $dbuser;


// validation
$errors = [];
$file_name = '';
$file_tmp = "";
$userid = $_REQUEST["id"];


foreach ($_REQUEST as $key => $val) {
    if ($key == "old_image") {
        continue;
    }
    if (empty($_REQUEST[$key])) {

        $errors[$key] = $key . " is required ";
    } else {
        if ($key == "username") {
            checkuser($val);
        }
        if ($key == "email") {
            checkemail($val, $userid);
        }
        if ($key == "password") {
            checkvalidpassword($val);
        }
    }
}



function checkvalidpassword($val)
{
    global $errors;
    $passwordpattern = "/([a-z1-9_]){6,}/i";


    if (!preg_match($passwordpattern, $val)) {
        $errors['password'] = 'Password is Only 8 chars, Doesn’t allow special chars -only underscore allowed, Doesn’t accept Capital characters';
    }
}
function checkequalpassword()
{
    if ($_REQUEST["password"] !== $_REQUEST["confirmpassword"]) {
        global $errors;
        $errors["confirmpassword"] = "passwords not equals";
    }
}
checkequalpassword();

// function to check username
function checkuser($val)
{
    if (strlen($val) < 10) {
        global $errors;
        $errors["username"] = "must greater than 10 quractrs";
        return;
    }
}

function checkemail($email, $id)
{
    global $errors, $op;
    if (!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email)) {
        $errors['email'] = "invallid email";
    } else {
        $allusers = $op->selectAllUsers();
        if (count($allusers) > 0) {
            foreach ($allusers as $user) {
                if ($user["email"] == $email && $user["id"] != intval($id)) {
                    $errors['email'] = "email already exit";
                }
            }
        }
    }
}



function checkfileextension()
{
    global $errors;
    global $file_name;
    global $file_tmp;

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(explode('.', $_FILES['image']['name'])[1]);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors["image"] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if (empty($_FILES['image']['name'])) {
            $errors["image"] = "image upload is required";
        }
        if ($file_size > 2097152) {
            $errors["image"] = 'File size must be excately 2 MB';
        }
    }
}

if ($_REQUEST["old_image"] && empty($_FILES['image']['name'])) {
    $file_name = preg_replace('/^' . $userid . '/', '', $_REQUEST["old_image"]);
    rename( "../public/images/profile_images/".$_REQUEST["old_image"],"../public/images/profile_images/".$userid . $file_name) ;
} else {
    checkfileextension();
}




$str = "../View/updateUser.php?id=" . $userid . "&";
if (count($errors) > 0) {
    foreach ($errors as $k => $val) {
        $str .= $k . "=" . $val . "&";
    }
    header("Location:" . $str);
    exit;
}



$userupdate = new User($_REQUEST["username"], $_REQUEST["email"], $_REQUEST["password"], $_REQUEST["roomNo"], $userid . $file_name);
$op->updateUser(intVal($userid), $userupdate);

if (!file_exists('../public/images/profile_images') || !is_dir('../public/images/profile_images')) {
    mkdir('../public/images/profile_images', 0777, true);
}

move_uploaded_file($file_tmp, "../public/images/profile_images/" . $userid . $file_name);
// show the lines (users) in file in the table

header("Location:../View/allUsers.php");
exit;
