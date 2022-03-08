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
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $val);
    $lowercase = preg_match('@[a-z]@', $val);
    $number    = preg_match('@[0-9]@', $val);
    $specialChars = preg_match('@[^\w]@', $val);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($val) < 8) {
        $errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
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
    $file_name = $_REQUEST["old_image"];
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



$userupdate = new User($_REQUEST["username"], $_REQUEST["email"], $_REQUEST["password"], $_REQUEST["roomNo"], $file_name);
$op->updateUser(intVal($userid), $userupdate);


move_uploaded_file($file_tmp, "../public/images/profile_images/" . $file_name);
// show the lines (users) in file in the table

header("Location:../View/allUsers.php");
exit;
