<?php
    session_start();
    require "../Bootstap/dbuser.php";
    require "../Model/DTO/User.php";
switch($_REQUEST["validationType"]){
    case "login" :
        validationLogin($dbuser);
        break; 
        case "register" :
            validationRegister($dbuser);
            break; 
    case "Logout":
        session_unset();
        //var_dump($_SESSION);
       header('Location: ../index.php');
        break ; 

        default:
        echo "salaaahsalaaah";
        break ; 
}

function  validationLogin($dbuser){
  
    if (!empty($_REQUEST["email"])&&!empty($_REQUEST["password"]) ){
        $data = $dbuser->checkUser($_REQUEST["email"], $_REQUEST["password"] ); 
        if ($data){
            //session_start();
            $_SESSION["authUsername"] = $data[0]["name"]; 
            $_SESSION["authEmail"] =  $data[0]["email"]; 
            $_SESSION["authImage"] =  $data[0]["image"]; 
            $_SESSION["authRole"] =  $data[0]["admin"]; 
            if ($data[0]["admin"]==1){
                header('Location: ../View/allUsers.php');
            }else { 
                header('Location: ../index.php');
                //var_dump($_SESSION);
                //header('Location: home.php');
            }
        }else { 
            // header('Location: ../index.php');
            header("location: ../index.php?"."&errors=User name or Password didn't match");
        }
    }
}


function  validationRegister($dbuser){
  
    //$passwordpattern = "/([a-z1-9_]){8,}/i";
    $passwordpattern = "/([a-z1-9_]){6,}/i";
    $errors="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        foreach ($_POST as $index => $value) {
            if (empty($_POST[$index]) && $index!="role")
                $errors = $errors . "</br>" . $index . " is required</br>;";
            if ($index == "password" && isset($value)  && !preg_match($passwordpattern, $value))
                $errors = $errors . "</br>Password is Only 8 chars, Doesn’t allow special chars -only underscore allowed, Doesn’t accept Capital characters</br>;";
            }
            var_dump($errors);
           if(empty($errors)){
            $data = $dbuser->checkUniqueEmail($_POST["email"] ); 
               if(empty($data)){
                   $role=false ; 
                   if (!empty($_POST["role"])){
                       $role=true ; 
                   }
                   $newUser = new User($_POST["name"],$_POST["email"],$_POST["password"],$_POST["room_number"],$_POST["image"],$role);
                   $dbuser->insertUser($newUser);
                   header('Location: ../View/allUsers.php');
                }
           } else {
            header("location: ../View/register.php?"."&errors=".$errors);
           }
    }
    else{
        var_dump("hellooo");
        return ; 
    }
}
?>