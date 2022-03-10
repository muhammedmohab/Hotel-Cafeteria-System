<?php
session_start();
if (!$_SESSION["authRole"] || $_SESSION["authRole"] == 0) {
    header('Location: ../index.php');
}
require "../Bootstap/dbuser.php";
$Product = $dbProduct->selectSpecificProduct(intval($_REQUEST["id"]))[0];
$Categories = $dbProduct->selectAllCategories();
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
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
                        <ul>
                            <li>
                                Mon-Fri: 8am to 2pm
                            </li>
                            <li>
                                Sat-Sun: 11am to 4pm
                            </li>
                            <li>
                                <a href="tel:(012) 6985 236 7512">(012) 6985 236 7512</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="../index.html"><img src="../Assets/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#coffee">Coffee</a></li>
                        <li><a href="#review">Review</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li class="menu-has-children"><a href="">Pages</a>
                            <ul>
                                <li><a class="text-center" href="View/generic.html">Generic</a></li>
                                <li><a class="text-center" href="View/elements.html">Elements</a></li>
                                <?php
                                if (isset($_SESSION["authRole"])) {
                                    if ($_SESSION["authRole"] == 1) {
                                        echo '<li><a class="text-center" href="View/allUsers.php">All Users</a></li>';
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


    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h2 class="mb-5 mt-3" style="color:#543804;"> Update Product </h2>
                <form method="post" action="../Controllers/ProductController.php" enctype="multipart/form-data">
                    <input required name="productId" value="<?php echo $Product["id"]; ?>" hidden>
                    <input required type='hidden' name='validationType' value='updateProduct'>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="productName" class="form-label">Name :</label>
                            </div>
                            <div class="col-6">
                                <input required type="text" class="form-control" id="productName" name="name" value="<?php echo $Product["name"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="productPrice" class="form-label">Price</label>
                            </div>
                            <div class="col-6">
                                <input required type="text"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="productPirce" name="productPirce" value="<?php echo $Product["price"]; ?>">
                            </div>

                        </div>
                    </div>
                    <!-- <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">!empty($_FILES['image']
                            <div class="col-2">
                                <label for="exampleInputPassword1" class="form-label">Product Image</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- ml-15 -->
                    <div class="mb-2 form-group d-flex align-items-center justify-content-between border" style="width: 66%;">
                        <label for="switch-wrap">Availability</label>
                        <div class="primary-switch" >
                            <?php 
                                if($Product['available']==0)
                                    echo '<input name="available" type="checkbox" id="switch-wrap">';
                                else
                                    echo '<input checked name="available" type="checkbox" id="switch-wrap" value="true">';
                            ?>
                            <!-- not available -->
                            <label for="switch-wrap" ></label>
                            <!-- available -->
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label class="form-label">Category</label>
                            </div>
                            <div class="col-6">
                                <select required class="form-select" name="categoryId">
                                    <?php
                                    foreach ($Categories as $category) {
                                        echo '<option value="'.$category["id"].'"'
                                            . (($Product["categoryId"] == $category["id"]) ? "selected" : "")
                                            . '>' . $category["name"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label class="form-label">Select Image</label>
                            </div>
                            <input name="oldImage" value="<?php echo $Product["image"]; ?>" hidden>
                            <div class="col-6">
                                <input class="form-control form-control-lg" type="file" name="image">
                                <span class="form-text" style="color: black">
                                    <?php echo $Product["image"]; ?>
                                </span>
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    
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