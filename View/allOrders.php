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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
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

  <div class="container mt-3 text-center" style="height:100vh">
    <div class="row">
      <div class="col text-center">
        <div class="container mb-3">
        
        </div>
        <table class="table table-striped text-center" id="example">
          <thead style="background:#B68834;" class="text-light">
            <tr>
              <th>Id</th>
              <th>Requested By</th>
              <th>Total</th>
              <th>Status</th>
              <th>Created date</th>
              <th>Finished date</th>
              <th colspan="3">Actions</th>
            </tr>
          </thead>

          <tbody class="bg-light">
            <?php
            require "../Bootstap/dbuser.php";
            $allOrders = $dbOrder->selectAllOrders();

            foreach ($allOrders as $index => $Order) {
              echo "<tr>";
              $id = $Order["id"];
              $userId = $Order["userId"];
              $userRequested = $dbOrder->userRequested($userId); //name of the user requested
              $userName = $userRequested[0]["name"];
              // $totalPrice = $Order["totalPrice"];
              // $status = $Order["status"];
              // $createdAt = $Order["created_at"];
              // if($status=="Finished") $finishedAt = $Order["finished_at"];

              foreach ($Order as $attribute => $attributeValue) {
                // var_dump($attribute);
                // return 0;
                if ($attribute == "id" || $attribute == "userId" || $attribute == "totalPrice" || $attribute == "status" || $attribute == "created_at" || $attribute == "finshed_at") {
                  if ($attribute == "id" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                  if ($attribute == "userId" && !empty($attributeValue)) {
                    echo "<td>${userName}</td>";
                  }
                  if ($attribute == "totalPrice" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                  if ($attribute == "status" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                  if ($attribute == "created_at" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                  if ($attribute == "finshed_at" && empty($attributeValue)) {
                    echo "<td class='text-danger'>--</td>";
                  }
                  if ($attribute == "finshed_at" && !empty($attributeValue)) {
                    echo "<td>${attributeValue}</td>";
                  }
                }
              }
              echo "
                               <td>";
              if ($Order['status'] != 'Finished' || empty($Order['finshed_at'])) {
                echo "
                      <div class='d-inline mr-1'>
                      <a class='genric-btn info circle small py-1' href='#updateModal' role='button' data-bs-toggle='modal' data-bs-target='#updateModal' data-id='$id'>Update</a></div>";
              }
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
            <input type="hidden" class="orderId" name="orderId" value="id" >
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
  <!-- Modal VIEW-->
  <div class="modal fade" id="viewModel" tabindex="-1" aria-labelledby="viewModelLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModelLabel">View Order</h5>

          <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
          <!-- contain the id of the order -->
          <input type="hidden" class="orderId" name="orderId" value="id" > 
          <div class="container">
            <h3>Order</h3>
            <?php
              
            ?>
            <!-- write order details here -->
          </div>
          <button type="button" class="btn btn-block mb-2 genric-btn danger radius" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </div>

        </form>
      </div>
    </div>
  </div>
  </div>
  <!-- Script to show the order ID -->
  <script>
  $('#updateModal').on('show.bs.modal', function (event) {
    let orderId = $(event.relatedTarget).data('id') 
    $(this).find('.modal-body input').first().val(orderId)
  })
  $('#viewModel').on('show.bs.modal', function (event) {
    let orderId = $(event.relatedTarget).data('id') 
    $(this).find('.modal-body input').first().val(orderId)
  })
</script>
</body>

</html>