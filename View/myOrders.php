<?php
session_start();
if (!$_SESSION['authId'])
  header('location:../index.php');
require "../Bootstap/dbuser.php";
$userId = $_SESSION["authId"];
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
    .hide {
      display: none;
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
            <!-- <li><a href="#about">About</a></li> -->
            <?php
            if ($_SESSION["authRole"] == 1) {
              echo '<li><a href="allProducts.php">Products</a></li>';
              echo '<li><a class="text-center" href="allUsers.php">Users</a></li>';
              echo '<li><a href="allOrders.php">Orders</a></li>';
            } else
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

  <div class="container mt-3 text-center" style="height:100vh">
    <div class="row">
      <div class="col text-center">
        <div class="container mb-3">

        </div>
        <table class="table table-striped text-center" id="example">
          <thead style="background:#B68834;" class="text-light">
            <tr>
              <th>Total</th>
              <th>Status</th>
              <th>Order Date</th>
              <th colspan="3">Actions</th>
            </tr>
          </thead>

          <tbody class="bg-light">
            <?php
            $allUserOrders = $dbOrder->selectUserOrders($userId);
            foreach ($allUserOrders as $index => $Order) {
              $id = $Order["id"];
              echo '<tr id="Order_' . $id . '"  class="products py-0 px-2"  
                orderid="' . $id . '"  val="order' . $id . '"  style="cursor:pointer">';
              foreach ($Order as $attribute => $attributeValue) {
                if ($attribute == "created_at" || $attribute == "status" || $attribute == "totalPrice") {
                  if ($attribute == "created_at" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                  if ($attribute == "status" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                  if ($attribute == "totalPrice" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                }
              }
              echo "
                               <td>";
              echo "<div class='d-inline'><a class='genric-btn primary circle small py-1' href='#viewModel' role='button' data-bs-toggle='modal' data-bs-target='#viewModel' data-id='$id'>View</a></div>";
              if ($Order['status'] == 'In-Progress') {
                echo "
                    <form class='d-inline' action='../Controllers/OrderController.php' method='post' >
                        <input type='hidden' name='validationType' value='cancelOrder'>
                        <input type='hidden' value='$id' name='orderId'>
                        <input class='genric-btn danger circle small py-1' type='submit'value='Cancel'>
                    </form>";
              }
              "
                               
              </tr>";
              echo '
              <tr id="order' . $id . '" class="hide " >
              <td colspan="7">
              <div class="accordion-body">
              <div class="container">
                <div class="row row1">
    
                </div>
                <div class="row mt-2 card">
                <h5 class="text-center text-primary p-3">Total Price : <span style="color:#B68834;">' . $Order["totalPrice"] . ' LE</span></h5>
              </div>
                </div>
              </div>
              </td>
              </tr>
             
              
              ';
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>





  <script src="Scripts/jquery-3.3.1.min.js"></script>
  <script src="../Assets/js/jquery-ui.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="../Assets/js/filterbydate.js"></script>
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
  <!-- Modal UPDATE-->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Status</h5>

          <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
          <form action="../Controllers/OrderController.php" method="post">
            <input type="hidden" class="orderId" name="orderId" value="id">
            <input type="hidden" name="validationType" value="updateOrderStatus">

            <div class="">
              <label class="form-label">Order Status</label>
            </div>
            <div class="mb-4">
              <select required class="form-select" name="orderStatus">
                <option value="In-Progress">In-Progress</option>
                <option value="Out-For-Delivery">Out-For-Delivery</option>
                <option value="Finished">Finished</option>
              </select>
            </div>
            <!-- Submit button -->
            <div>
              <button type="submit" class="btn btn-block mb-2 genric-btn primary radius">Update</button>
              <button type="button" class="btn btn-block mb-2 genric-btn danger radius" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Script to show the order ID -->
  <script>
    $('#updateModal').on('show.bs.modal', function(event) {
      let orderId = $(event.relatedTarget).data('id');
      $(this).find('.modal-body input').first().val(orderId);
    })
    $('#viewModel').on('show.bs.modal', function(event) {
      let orderId = $(event.relatedTarget).data('id');
      $(this).find('.modal-body input').first().val(orderId);
    })

    // get orders of product 

    $(".products").click(function() {
      let id_name = $(this).attr("val");
      $(this).next().toggleClass('hide');
      $.ajax('../Controllers/productsOfOrderController.php', {
        type: 'POST', // http method
        data: {
          order_id: $(this).attr("orderid")
        }, // data to submit
        success: function(data, status, xhr) {
          console.log(data);
          $("#" + id_name + ' .accordion-body .container .row1').html(data);
        }

      });
    });
  </script>

</body>

</html>