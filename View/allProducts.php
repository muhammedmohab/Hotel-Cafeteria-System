<?php
    session_start();
    if (empty($_SESSION["authRole"]) || $_SESSION["authRole"] == 0) {
        header('Location: ../index.php');
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
                    <a href="../index.php"><img src="../Assets/img/logo.png" alt="cafe logo" title="cafe logo" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="index.php">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="../View/allProducts.php">Coffee</a></li>
                        <li><a href="#review">Review</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li class="menu-has-children"><a class="mousePointer" style="color:white ">Pages</a> 
                            <ul>
                                <li><a class="text-center" href="View/generic.html">Generic</a></li>
                                <li><a class="text-center" href="View/elements.html">Elements</a></li>
                                <?php
                                if (isset($_SESSION["authRole"])) {
                                    if ($_SESSION["authRole"] == 1) {
                                        echo '<li><a class="text-center" href="../View/allUsers.php">All Users</a></li>';
                                    }
                                    echo '<li><form action="Controllers/ValidationController.php" method="post">
										<input type="hidden" name="validationType" value="Logout">
										<input class="btn btn-block mb-4 genric-btn primary radius" type="submit"  value="Log out">
										</form></li>';
                                }
                                ?>

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

    <div class="container mt-3 text-center" style="height:100vh">
        <a class='genric-btn primary circle my-3 ' href='#' role=' button'>Add Product</a>
        <div class="row">
            <div class="col text-center">
                <table class="table table-striped text-center">
                    <thead style="background:#B68834;" class="text-light">
                        <tr>
                            <th>Name</th>
                            <th>price</th>
                            <th>image</th>
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-light">
                        <?php

                        require "../Bootstap/dbuser.php";
                        $allProducts = $dbProduct->selectAllProducts();
                        foreach ($allProducts as $index => $Product) {
                            echo "<tr>";
                            $id = $Product["id"];
                            if($Product['available']==1)
                               $available='available';
                            else
                                $available='not available';
                            foreach ($Product as $attribute  => $attributeValue) {
                                if ($attribute == "name" || $attribute == "price" || $attribute == "image") {
                                    // var_dump($attribute);

                                    if ($attribute == "image" && !empty($attributeValue)) {
                                        echo "<td>
                                            <img class='hoverImage' src='../public/images/products_images/". $attributeValue . "' width=30px height=30px/>
                                        </td>";
                                    } else if ($attribute == "image" && empty($attributeValue)) {
                                        echo "<td>
                                        <img class='hoverImage' src='../public/images/products_images/notFound.png' width=50px height=50px/>
                                    </td>";
                                    } else
                                        echo "<td>
                                            $attributeValue
                                        </td>";
                                }
                            }
                            echo "
                                <td>
                                    $available
                                </td>
                               <td>
                                    <a class='genric-btn info circle small py-1' href='editProduct.php?id=$id' role='button'>Update</a>
                                    <form class='d-inline mx-2' action='../Controllers/ProductController.php' method='post' >
                                        <input type='hidden' name='validationType' value='destroyProduct'>
                                        <input type='hidden' value='$id' name='productId'>
                                        <input class='genric-btn danger circle small py-1' type='submit'value='Delete'>
                                    </form>
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