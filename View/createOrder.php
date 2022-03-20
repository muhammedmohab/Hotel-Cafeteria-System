<?php
session_start();
if (!isset($_SESSION['authId']))
    header('location:../index.php');
require "../Bootstap/dbuser.php";
$products = $dbProduct->selectAvailableProducts();
$users = $dbuser->selectAllUsers();
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../Assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="../Assets/js/vendor/bootstrap.min.js"></script>
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
    <script src="../Assets/js/main.js"></script>
</head>

<body>
    <header id="header">

        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="#"><img src="../Assets/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="../index.php">Home</a></li>
                        <!-- <li><a href="#about">About</a></li> -->
                        <?php
                        if ($_SESSION["authRole"] == 1) {
                            echo '<li><a href="allProducts.php">Products</a></li>';
                            echo '<li><a class="text-center" href="allUsers.php">Users</a></li>';
                            echo '<li><a href="allOrders.php">Orders</a></li>';
                        }else
                            echo '<li><a href="myOrders.php">My Orders</a></li>';
                        ?>
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
    <div class="container my-5" style="min-height: 30vh;">
        <h2 class="mb-5 mt-3" style="color:#543804;">Create Order</h3>
            <form class="col-md-7" action="../Controllers/OrderController.php" method="post">
                <input type="hidden" name="validationType" value="storeOrder">
                <input type="hidden" name="totalPrice" value="0">
                <div class="contener d-flex">
                    <div class="form-group col-md-11">
                        <select class="form-control select2 " id="item_picker">
                            <option disabled selected>Select Item</option>
                            <?php
                            foreach ($products as $product)
                                echo '<option value="' . $product["id"] . '"price="' . $product['price'] . '"
                    image="' . $product['image'] . '">' . $product['name'] . '</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-11" class="display-none" <?php if ($_SESSION['authRole'] == 0) echo 'style="display:none;"' ?>>
                        <select required name="userId" class="form-control select2 " id="users_picker">
                            <option selected <?php if ($_SESSION['authRole'] == 1) echo "disabled" ?> value="<?php echo $_SESSION['authId'] ?>">Select user</option>
                            <?php
                            foreach ($users as $user)
                                echo "<option value='{$user["id"]}'> {$user["name"]} </option>";
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-hover text-center">
                        <thead id="container_header" class="display-none" style="display:none;">
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Add</th>
                            <th>Remove</th>
                        </thead>
                        <tbody id="items_container">
                        </tbody>
                    </table>
                    <div id="totalPrice" class="display-none text-center" style="display:none;">

                    </div>
                </div>
                <div class="row m-auto col-3">
                    <button id="submit" disabled type="submit" class="btn genric-btn primary circle px-3">Create Order</button>
                </div>
            </form>
            <?php if (!empty($_REQUEST)) {
                echo '<div class="col-auto">';
                echo '<span class="form-text" style="color: red">';
                echo '<ul class="unordered-list">';
                foreach ($_REQUEST as $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul>';
                echo '</span>';
                echo '</div>';
            } ?>

    </div>
    <script>
        $(() => {
            var items = 0;
            var totalPrice = 0;
            var totalPriceInput = document.getElementsByName("totalPrice")[0];
            $("#item_picker").change(function() {
                items++;
                console.log(`ITEM AFTER ++ ` + items);
                $(".display-none").show();
                $('#submit').removeAttr("disabled")
                var price = $(this).find(":selected").attr('price');
                var name = $(this).find(":selected").text();
                var id = $(this).val();
                var image = $(this).find(':selected').attr('image');
                if (!$("#row" + id).length) {
                    $("#items_container").append(`
                    <tr id="row` + id + `">
                    <td class="pt-5">` + name + `</td>
                    <td class="pt-5">` + price + `</td>
                    <td><img src="../public/images/products_images/` + image + `" title="Product Image" height="100" width="100"></td>
                    <td id="quantityView` + id + `" class="pt-5">1</td>
                    <td hidden><input type="hidden" name="id[]" value="` + id + `" min="1"></td>
                    <td hidden><input type="hidden" id="quantity` + id + `" name="quantity[]` + id + `" value="1" min="1"></td>
                    <td hidden><input type="hidden" name="price[]" value="` + price + `"></td>
                    <td><button type="button" class="btn btn-success btn-sm rounded-pill ml-3 mt-4 " id="add` + id + `" >&plus;</button></td>
                    <td><button type="button" class="btn btn-danger btn-sm rounded-pill ml-3 mt-4 " id="remove` + id + `">&times;</button></td>
                    </tr>
                    `);
                    totalPrice = totalPrice + parseInt(price);
                    console.log(totalPrice);
                    var totalPriceDiv = document.getElementById("totalPrice");
                    totalPriceDiv.innerText = `Total Price:` + totalPrice;
                    totalPriceInput.value = totalPrice;
                }
                document.getElementById("item_picker").selectedIndex = 0;
                var quantity = document.getElementById("quantityView" + id);
                var quantityInput = document.getElementById("quantity" + id);
                console.log(items);
                $("#remove" + id).on('click', function() {
                    items--;
                    console.log(items);
                    // $("#row" + id).remove();
                    if (Number(quantity.innerText) > 1) {
                        quantity.innerText = Number(quantity.innerText) - 1;
                        quantityInput.val = Number(quantityInput.val()) - 1;
                        totalPrice -= price;
                        totalPriceDiv.innerText = "Total Price:" + totalPrice
                        totalPriceInput.value = totalPrice;
                    } else {
                        totalPrice -= price;
                        totalPriceInput.value = totalPrice;
                        $("#row" + id).remove();
                        $('#submit').attr("disabled", "true");

                    }
                    document.getElementById("item_picker").selectedIndex = 0;
                    console.log(items);
                    if (items == 0) {
                        $("#container_header").hide();
                        $("#totalPrice").hide();
                    }
                });
                $("#add" + id).on('click', function() {
                    items++;
                    quantity.innerText = Number(quantity.innerText) + 1;
                    quantityInput.value = Number(quantityInput.value) + 1;
                    console.log(price);
                    totalPrice += Number(price);
                    totalPriceDiv.innerText = "Total Price:" + totalPrice
                    totalPriceInput.value = totalPrice;
                });
            });
        });
    </script>
    <script>
        // Filter table
        $(document).ready(function() {
            $("#ordersTable").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".ordersTable option").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        $(".select2").select2({
            placeholder: "Choose product",
            theme: "classic"
        });
    </script>
</body>

</html>