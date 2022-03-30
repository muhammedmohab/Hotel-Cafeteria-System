<?php
session_start();
if (empty($_SESSION["authRole"])) {
    header('Location: ../index.php');
}
require "../Bootstap/dbuser.php";
$user = $dbuser->selectSpecificUser(intval($_REQUEST["id"]))[0];
$all_rooms = $dbuser->selectAllRoomNumbers();

?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../Assets/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Coffee</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="../Assets/css/linearicons.css">
    <link rel="stylesheet" href="../Assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/css/bootstrap.css">
    <link rel="stylesheet" href="../Assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../Assets/css/nice-select.css">
    <link rel="stylesheet" href="../Assets/css/animate.min.css">
    <link rel="stylesheet" href="../Assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../Assets/css/main.css">
    <style>
        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="../index.php"><img src="../Assets/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="../index.php">Home</a></li>
                        <li><a href="allProducts.php">Products</a></li>
                        <li><a class="text-center" href="allUsers.php">Users</a></li>
                        <li><a href="allOrders.php">Orders</a></li>
                        <li><a href="createOrder.php">Buy Now</a></li>
                        <li class="menu-has-children mousePointer " style="color:white "><a onclick=" event.preventDefault()">Pages</a>
                            <ul>
                                <li>
                                    <form action="Controllers/ValidationController.php" method="post">
                                        <input type="hidden" name="validationType" value="Logout">
                                        <input class="btn btn-block genric-btn primary radius" type="submit" value="Log out">
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->
    <!-- start banner Area -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-start">

            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h2 class="mb-5 mt-3" style="color:#543804;"> UpdateUser </h2>
                <form method="post" action="../Controllers/UpdateController.php" enctype="multipart/form-data">
                    <input name="id" value="<?php echo $user["id"]; ?>" hidden>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="exampleInputusername" class="form-label">Name :</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="exampleInputusername" name="username" value="<?php echo $user["name"]; ?>" />
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["username"])) {
                                        echo $_REQUEST["username"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $user["email"]; ?>">
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["email"])) {
                                        echo $_REQUEST["email"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $user["password"]; ?>">
                                <div class="col-auto">
                                    <span class="form-text" style="color: red">
                                        <?php if (!empty($_REQUEST["password"])) {
                                            echo $_REQUEST["password"];
                                        } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control" id="exampleInputPassword2" name="confirmpassword" value="<?php echo $user["password"]; ?>">
                                <div class="col-auto">
                                    <span class="form-text" style="color: red">
                                        <?php if (!empty($_REQUEST["confirmpassword"])) {
                                            echo $_REQUEST["confirmpassword"];
                                        } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label class="form-label">Room No</label>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="roomNo">
                                    <!-- <option value=""></option> -->
                                    <?php

                                    foreach ($all_rooms as $room) {


                                        echo '<option value="' . $room["roomNumber"] . '" id="flexCheckDefault1"' . (($user["roomNumber"] == $room["roomNumber"]) ? "selected" : "") . '>' . $room["roomNumber"] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["roomNo"])) {
                                        echo $_REQUEST["roomNo"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="formFileLg" class="form-label">Select Image</label>
                            </div>
                            <input name="old_image" value="<?php echo $user["image"]; ?>" hidden>
                            <div class="col-6">
                                <input class="form-control form-control-lg" id="formFileLg" type="file" name="image">
                                <span class="form-text" style="color: black">
                                    <?php echo $user["image"]; ?>
                                </span>
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["image"])) {
                                        echo $_REQUEST["image"];
                                    } ?>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="mb-2 mt-5 form-group">
                        <div class="row g-3 align-items-center">

                            <div class="col-auto mr-4">

                                <button type="submit" class="btn btn-warning  mb-4">Confirm</button>
                            </div>
                            <div class="col-auto">
                                <a class='btn btn-info mb-4' href='allUsers.php' role='button'>cancel</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <script src="../Assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../Assets/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="../Assets/js/easing.min.js"></script>
    <script src="../Assets/js/hoverIntent.js"></script>
    <script src="../Assets/js/superfish.min.js"></script>
    <script src="../Assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../Assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../Assets/js/owl.carousel.min.js"></script>
    <script src="../Assets/js/jquery.sticky.js"></script>
    <script src="../Assets/js/jquery.nice-select.min.js"></script>
    <script src="../Assets/js/parallax.min.js"></script>
    <script src="../Assets/js/waypoints.min.js"></script>
    <script src="../Assets/js/jquery.counterup.min.js"></script>
    <script src="../Assets/js/mail-script.js"></script>
    <script src="../Assets/js/main.js"></script>
</body>

</html>