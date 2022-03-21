<?php
session_start();
if (empty($_SESSION["authRole"]) || $_SESSION["authRole"] == 0) {
    header('Location: ../index.php');
}
require "../Bootstap/dbuser.php";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
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
                    <a href="../index.php"><img src="../Assets/img/logo.png" alt="cafe logo" title="cafe logo" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="../index.php">Home</a></li>
                        <!-- <li><a href="#about">About</a></li> -->
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
    <div class="col-10 m-auto">
        <div class="col-auto" id="CategoryName">
            <span class="form-text" style="color: red">
                <?php if (!empty($_REQUEST["CategoryNameError"])) {
                    echo $_REQUEST["CategoryNameError"];
                    echo "<script>window.addEventListener('load', function(){
                            setTimeout(function() {
                            $('#CategoryName').hide()}, 5000);
                            })</script>";
                } ?>
            </span>
        </div>
        <div class="row">
            <div class="col-8">
                <h2 class="mb-5 mt-3" style="color:#543804;"> add Product </h2>
                <form method="post" action="../Controllers/ProductController.php" enctype="multipart/form-data">
                    <input required type='hidden' name='validationType' value='storeProduct'>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="productName" class="form-label">Name :</label>
                            </div>
                            <div class="col-6">
                                <input required type="text" class="form-control" id="productName" name="name" placeholder="Product Name" ?>
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["nameError"])) {
                                        echo $_REQUEST["nameError"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label for="productPrice" class="form-label">Price</label>
                            </div>
                            <div class="col-6">
                                <input required placeholder="Product Price" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="productPirce" name="productPirce" value="<?php echo $Product["price"]; ?>">
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["productPirceError"])) {
                                        echo $_REQUEST["productPirceError"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 form-group d-flex align-items-center justify-content-between " style="width: 65.5%;">
                        <label for="switch-wrap">Availability</label>
                        <div class="primary-switch">
                            <input checked name="available" type="checkbox" id="switch-wrap" value="true">
                            <!-- not available -->
                            <label for="switch-wrap"></label>
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
                                        echo '<option value="' . $category["id"] . '"'
                                            . (($Product["categoryId"] == $category["id"]) ? "selected" : "")
                                            . '>' . $category["name"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <a class='genric-btn info circle small py-1' href='#addModal' role='button' data-bs-toggle='modal' data-bs-target='#addModal'>Add Category</a>
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["categoryIdError"])) {
                                        echo $_REQUEST["categoryIdError"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 form-group">
                        <div class="row g-3 align-items-center">
                            <div class="col-2">
                                <label class="form-label">Select Image</label>
                            </div>
                            <div class="col-6">
                                <input class="form-control form-control-lg" type="file" name="image">
                            </div>
                            <div class="col-auto">
                                <span class="form-text" style="color: red">
                                    <?php if (!empty($_REQUEST["imageError"])) {
                                        echo $_REQUEST["imageError"];
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="my-5 w-50 mx-auto  form-group">
                        <div class="row align-items-center m-auto">
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
    <!-- Modal UPDATE-->
    <div class="modal fade" id="addModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Category</h5>

                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <form action="../Controllers/CategoryController.php" method="post">
                        <input type="hidden" name="validationType" value="storeCategory">
                        <!-- <div class="">
                            <label class="form-label"></label>
                        </div> -->
                        <div class="mb-4">
                            <input required type="text" class="form-control form-control-lg" placeholder="Category Name" name="CategoryName">
                        </div>
                        <!-- Submit button -->
                        <div class="d-flex justify-content-center ">
                            <button type="button" class="btn btn-md mb-2 mx-1 genric-btn danger circle" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-md mb-2 mx-1 genric-btn success circle">Add Category</button>
                        </div>

                    </form>
                </div>
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