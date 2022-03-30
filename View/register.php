<?php
		session_start();
		if (!$_SESSION["authRole"]) {
			header('Location: ../index.php');
		} else if ($_SESSION["authRole"] == 0) {
			header('Location: ../index.html');
			// var_dump("U ARE USER");
		}

		if (!empty($_GET["errors"])){
			$errors= explode(";",$_GET["errors"]);
		$errorsFounded =[]; 
		if (!empty($_GET["errors"])){
			$errors= explode(";",$_GET["errors"]);
		}
		foreach ($errors as $err){
			if (strpos($err,"name")!=false){
				$errorsFounded["name"]=$err;
			}
			if (strpos($err,"email")!=false){
				$errorsFounded["email"]=$err;
			}
			if (strpos($err,"password")!=false){
				$errorsFounded["password"]=$err;
			}
			if (strpos($err,"room_number")!=false){
				$errorsFounded["room_number"]=$err;
			}
			if (strpos($err,"image")!=false){
				$errorsFounded["image"]=$err;
			}
			if (strpos($err,"imageSize")!=false){
				$errorsFounded["imageSize"]=$err;
			}
			if (strpos($err,"imageExtension")!=false){
				$errorsFounded["imageExtension"]=$err;
			}
		}
	}
							?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="../Assets/img/elements/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="colorlib">
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
	<link rel="stylesheet" href="../Assets/css/owl.carousel.css">
	<link rel="stylesheet" href="../Assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../Assets/css/nice-select.css">
	<link rel="stylesheet" href="../Assets/css/magnific-popup.css">
	<link rel="stylesheet" href="../Assets/css/bootstrap.css">
	<link rel="stylesheet" href="../Assets/css/main.css">
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

	<!-- Start banner Area -->
	<section class="generic-banner login-banner-area">
		<div class="container">
			<div class="row height align-items-center justify-content-center">
				<div class="col-lg-10">
					<div class="generic-banner-content">
						<h2 class="text-white">Welcome</h2>
						<p class="text-white">You wish, we make!</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<!-- This is login form -->
	<div class="container">
		<!-- <form action="Controllers/ValidationController.php" method="post"></form> -->
		<div class="section-top-border">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<h3 class="mb-30">Add User</h3>
					<form action="../Controllers/ValidationController.php" enctype="multipart/form-data" method="post">
					<input type="hidden" name="validationType" value="register">
						<div class="mt-10">
							<input type="text" name="name" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'"  class="single-input">
							<?php 
							if (isset($errorsFounded['name']))
								echo "<p class='text-danger message'> ${errorsFounded['name']}</p>";
							?>
						</div>
						<!-- <div class="mt-10">
							<input type="text" name="last_name" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'"  class="single-input">
						</div> -->
						<div class="mt-10">
							<input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"  class="single-input">
							<?php 
								if (isset($errorsFounded['email']))
								echo "<p class='text-danger message'> ${errorsFounded['email']}</p>";
							?>
						</div>
						<div class="mt-10">
							<input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"  class="single-input">
							<?php 
								if (isset($errorsFounded['password']))
								echo "<p class='text-danger message'> ${errorsFounded['password']}</p>";
							?>
						</div>
						<!-- <div class="mt-10">
							<input type="password" name="confirm_password" placeholder="Conf. Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Conf. Password'"  class="single-input">
						</div> -->
						<div class="mt-10">
							<input type="text" name="room_number" placeholder="Room Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Room Number'" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  class="single-input">
							<?php 
								if (isset($errorsFounded['room_number']))
								echo "<p class='text-danger message'> ${errorsFounded['room_number']}</p>";
							?>
						</div>
						<div class="mt-10">
							<input type="file" name="image" placeholder="Image" onfocus="this.placeholder = ''" onblur="this.placeholder = 'image'"   class="form-control ">
							<?php 
								if (isset($errorsFounded['image']))
								echo "<p class='text-danger message'> ${errorsFounded['image']}</p>";
								if (isset($errorsFounded['imageSize']))
								echo "<p class='text-danger message'> ${errorsFounded['imageSize']}</p>";
								if (isset($errorsFounded['imageExtension']))
								echo "<p class='text-danger message'> ${errorsFounded['imageExtension']}</p>";
							?>
						</div>
						<div class="switch-wrap d-flex justify-content-between mt-3 ml-15 border p-2">
							<p>Admin?</p>
							<div class="primary-switch">
								<input name="role" type="checkbox" id="default-switch" value="admin">
								<label for="default-switch"></label>
							</div>
						</div>
						<section class="button-area">
							<div class="container border-top-generic">
								<button type="submit" class="genric-btn primary circle my-3 ">Register</button>
							</div>
						</section>
				</div>
			</div>
		</div>
		
	</div>
	<!-- End of register form -->

	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
						</p>
						<p class="footer-text">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
				<div class="col-lg-5  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">
							<!-- <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
								<input class="form-control" name="" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"  type="email">
								<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
								<div style="position: absolute; left: -5000px;">
									<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
								</div>

								<div class="info pt-20"></div>
							</form> -->
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->


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
	<script src="../Assets/js/mail-script.js"></script>
	<script src="../Assets/js/main.js"></script>
	<script type="text/javascript">
			setTimeout(function() {
				$('.message').hide()
					}, 4000);
	</script>
</body>

</html>