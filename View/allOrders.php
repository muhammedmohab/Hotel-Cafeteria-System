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
        <form id="theForm">
        <div class="row justify-content-center  d-flex mb-3">
            
            <div class="col ">
                <div class="input-group">
                    <input type="date" id="myInput1" class="form-control rounded" placeholder="Search For User By Name" aria-label="Search" aria-describedby="search-addon" />
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <input type="date" id="myInput2"  class="form-control rounded" placeholder="Search For User By Name" aria-label="Search" aria-describedby="search-addon" />
                </div>
            </div>
            <div class="col">
            <button type="button" class="genric-btn primary search" onclick="myFunction()">search</button>
            <button type="button" class="genric-btn info" onclick="resetfun()">reset</button>
     
            </div>
            
        </div>
        </form>

        <table class="table table-striped text-center mytable" id="example" >
          <thead style="background:#B68834;" class="text-light">
            <tr>
              <th>Show Products</th>
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
              $id = $Order["id"];
              $userId = $Order["userId"];
              $userRequested = $dbOrder->userRequested($userId); //name of the user requested
              $userName = $userRequested[0]["name"];
              echo '<tr class="productstr">';   
               echo '<td id="Order_' . $id . '"  class="products py-0 px-2"  
               orderid="'. $id .'"  val="order'.$id.'"  style="cursor:pointer"><span class="p-2 px-3 m-2 start-100 translate-middle badge badge-info" style="font-size:18px">+</span>
               </td>';           
             
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
              echo '
              <tr id="order'.$id.'" class="hide " >
              <td colspan="8">
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
  $('#updateModal').on('show.bs.modal', function (event) {
    let orderId = $(event.relatedTarget).data('id');
    $(this).find('.modal-body input').first().val(orderId);
  })
  $('#viewModel').on('show.bs.modal', function (event) {
    let orderId = $(event.relatedTarget).data('id');
    $(this).find('.modal-body input').first().val(orderId);
  })

  // get orders of product 

$(".products").click(function() {
  if(this.children[0].textContent=="+"){
    this.children[0].textContent="-"
  }else{
    this.children[0].textContent="+"

  }
  let id_name = $(this).attr("val");
$(this).parent().next().toggleClass('hide');
  $.ajax('../Controllers/productsOfOrderController.php', {
    type: 'POST', // http method
    data: {
      order_id: $(this).attr("orderid")
    }, // data to submit
    success: function(data, status, xhr) {
      $("#" + id_name + ' .accordion-body .container .row1').html(data);
    }

  });
});

// search for orders using start and end date
  // search by name for user
  function myFunction() {
    // Declare variables
    var input1,input2, filter1,filter2, table, tr, td1, td2, i, txtValue1,txtValue2;
    input1 = document.getElementById("myInput1");
    input2 = document.getElementById("myInput2");
    filter1 = input1.value.toUpperCase();
    filter2 = input2.value.toUpperCase();
    table = document.getElementsByClassName("mytable")[0];
    tr = document.getElementsByClassName("productstr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td1 = tr[i].getElementsByTagName("td")[5];
      td2 = tr[i].getElementsByTagName("td")[6];
      if (td1&&td2) {
        txtValue1 = (td1.textContent || td1.innerText);//start date
        txtValue2 = (td2.textContent || td2.innerText);// end date
        if ((txtValue1.toUpperCase().indexOf(filter1) > -1)&& (txtValue2.toUpperCase().indexOf(filter2)> -1)) {
          tr[i].style.display = "";
          tr[i].nextElementSibling.style.display="";

        } else {
          tr[i].style.display = "none";
          tr[i].nextElementSibling.style.display="none";
        }
      }
    }
  }
  function resetfun(){
  $("#theForm")[0].reset();
   e=document.getElementsByClassName('search')[0];
   e.onclick()
  }
</script>

</body>

</html>