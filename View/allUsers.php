<?php session_start();
if (!$_SESSION["authRole"]) {
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
                        <li><a href="allProducts.php">Products</a></li>
                        <!-- <li><a class="text-center" href="allUsers.php">Users</a></li> -->
                        <li><a href="allOrders.php">Orders</a></li>
                        <li><a href="createOrder.php">Buy Now</a></li>
                        <li class="menu-has-children mousePointer " style="color:white "><a onclick=" event.preventDefault()" class="sf-with-ul">Pages</a>
							<ul>
								<li>
									<form action="../Controllers/ValidationController.php" method="post">
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

    <div class="container-fluid mt-3 text-center w-75" style="height:100vh">

        <div class="row justify-content-center  d-flex">

            <div class="col-md-6">
                <div class="input-group">
                    <input type="search" id="myInput" onkeyup="myFunction()" class="form-control rounded" placeholder="Search For User By Name" aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="genric-btn primary small">search</button>
                </div>
            </div>

        </div>
        <a class='genric-btn primary circle my-3 ' href='register.php' role='button'>Add User</a>
        <div class="row">
            <div class="col text-center">
                <table class="table table-striped text-center" id="mytable">
                    <thead style="background:#B68834;" class="text-light">
                        <tr>
                            <th>Show Orders</th>
                            <!-- <th>Id</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Room No</th>
                            <th>image</th>
                            <th>Actions</th>
                            <!-- <th>Delete</th> -->
                        </tr>
                    </thead>

                    <tbody class="bg-light">
                        <?php

                        require "../Bootstap/dbuser.php";
                        $alluser = $dbuser->selectAllUsers();
                        foreach ($alluser as $key => $value) {
                            $id = $value["id"];
                            echo '<tr class="orderstr" >';

                            if ($value['email'] == $_SESSION['authEmail'])
                                continue;
                            echo '<td class="orders py-0 px-2"  
                                userid="' . $id . '"  val="user' . $id . '"  style="cursor:pointer"><span class="p-2 px-3 m-2 start-100 translate-middle badge badge-info" style="font-size:18px">+</span></td>';
                            foreach ($value as $k => $val) {
                                $id = $value["id"];
                                if ($k == "admin" || $k == "id"  || $k == "password") continue;
                                if ($k == "image") {
                                    echo "<td><img class='hoverImage'  src='../public/images/profile_images/" . $val . "' width=50px height=50px/></td>";
                                } else {
                                    echo "<td>" . $val . "</td>";
                                }
                            }
                            echo "
                           <td><a class='genric-btn info circle small py-1 my-2' href='updateUser.php?id=$id' role='button'>Update</a>
                           <a class='genric-btn danger circle small py-1 my-2' style='color:white' role='button' data-bs-toggle='modal' data-bs-target='#DeleteModal' data-id='$id'>Cancel</a>
                           </td>
                           </tr>";
                            echo '
                           <tr id="user' . $id . '" class="hide bg-light " >
                           <td colspan="8">
                           <div class="container">
                             <div class="row row1">
                             <div class="col mt-3">
                             <table class="table table-striped text-center">
                             <thead style="background:#B68834;" class="text-light">
                                <tr>
                                    <th>Show Products</th>
                                     <th>OrderDte</th>
                                     <th>Amount</th>
                                     
                                </tr>
                             </thead>
                             
                             <tbody class="bg-light ordersbody">
                             </tbody>
                             </table>
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




    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <div class="modal-body"></div>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div>
                        <div>
                            <h4>Are you sure you want delete this user?</h4>
                        </div>
                        <div class="d-flex mt-4 justify-content-around ">
                            <a class='genric-btn danger circle small py-1 col-5' href='' role='button'>Delete</a>
                            <a class="text-white genric-btn primary circle small py-1  radius col-5" data-bs-dismiss="modal" aria-label="Close">Close</a>
                        </div>
                    </div>
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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script>
        // get orders of user 
        $('#DeleteModal').on('show.bs.modal', function(event) {
            let orderId = $(event.relatedTarget).data('id');
            $(this).find('.modal-body a').first().attr('href', "../Controllers/DeleteController.php?id=" + orderId);
        })
        $(".orders").click(function() {
            if (this.children[0].textContent == "+") {
                this.children[0].textContent = "-"
            } else {
                this.children[0].textContent = "+"

            }
            let id_name = $(this).attr("val");
            $(this).parent().next().toggleClass('hide');
            $.ajax('../Controllers/ordersOfUserController.php', {
                type: 'POST', // http method
                data: {
                    user_id: $(this).attr("userid")
                }, // data to submit
                success: function(data, status, xhr) {
                    $("#" + id_name + '  .container .row1 .ordersbody').html(data);
                }

            });
        });

        // get products of orders of user
        function getProducts(e) {
            if (e.children[0].textContent == "+") {
                e.children[0].textContent = "-"
            } else {
                e.children[0].textContent = "+"

            }
            let id_name = $(e).attr("val");
            $(e).parent().next().toggleClass('hide');
            $.ajax('../Controllers/productsOfOrderController.php', {
                type: 'POST', // http method
                data: {
                    order_id: $(e).attr("orderid")
                }, // data to submit
                success: function(data, status, xhr) {
                    $("#" + id_name + ' .accordion-body .container .row1').html(data);
                }

            });
        }
        // search by name for user
        function myFunction() {

            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable");

            tr = document.getElementsByClassName("orderstr");


            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        tr[i].nextElementSibling.style.display = "";

                    } else {
                        tr[i].style.display = "none";
                        tr[i].nextElementSibling.style.display = "none";
                    }
                }
            }
        }
    </script>


</body>

</html>