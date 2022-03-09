<?php  session_start();
    if (!$_SESSION["authRole"]){
        header('Location: ../index.php');
    }else if ($_SESSION["authRole"]==0){
       // header('Location: ../index.html');
       var_dump("U ARE USER");
    }
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
</head>

<body>

    <header id="header" id="home">
       
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="#"><img src="../Assets/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="../index.html">Home</a></li>
                        <li><a href="../Controllers/UserController.php">all users</a></li>
                        <li><a href="">Coffee</a></li>
                        <li><a href="">Review</a></li>
                        <li><a href="">Blog</a></li>
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

    <div class="container-fluid mt-3 text-center" style="height:100vh">
        <a class='genric-btn success my-3' href='register.php' role='button'>Add User</a>
        <div class="row">
            <div class="col text-center">
                <table class="table table-striped text-center">
                    <thead style="background:#B68834;" class="text-light">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Room No</th>
                            <th>image</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody class="bg-light">
                        <?php

                        require "../Bootstap/dbuser.php";
                        $alluser = $dbuser->selectAllUsers();
                        foreach ($alluser as $key => $value) {
                            echo "<tr>";
                            foreach ($value as $k => $val) {
                                $id = $value["id"];
                                if ($k == "admin"  || $k == "password") continue;
                                if ($k == "image") {
                                    echo "<td><img  src='../public/images/profile_images/" . $val . "' width=30px height=30px/></td>";
                                } else {
                                    echo "<td>" . $val . "</td>";
                                }
                            }
                            echo "
                           <td><a class='genric-btn info small' href='UpdateUser.php?id=$id' role='button'>Update</a>
                           </td>
                           <td><a class='genric-btn danger small' href='../Controllers/DeleteController.php?id=$id' role='button'>Delete</a>
                           </td>
                           </tr>";
                        }
                        ?>

                    </tbody>
                </table>

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