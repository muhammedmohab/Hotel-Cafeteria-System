<?php
session_start();

?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="Assets/img/fav.png">
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
	<link rel="stylesheet" href="Assets/css/linearicons.css">
	<link rel="stylesheet" href="Assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="Assets/css/bootstrap.css">
	<link rel="stylesheet" href="Assets/css/magnific-popup.css">
	<link rel="stylesheet" href="Assets/css/nice-select.css">
	<link rel="stylesheet" href="Assets/css/animate.min.css">
	<link rel="stylesheet" href="Assets/css/owl.carousel.css">
	<link rel="stylesheet" href="Assets/css/main.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
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
					<a href="index.html"><img src="Assets/img/logo.png" alt="" title="" /></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<!-- <li><a href="#about">About</a></li> -->
						<?php
						if (!empty($_SESSION["authId"])) {
							if ($_SESSION["authRole"] == 1) {
								echo '<li><a href="/View/allProducts.php">Products</a></li>';
								echo '<li><a class="text-center" href="/View/allUsers.php">Users</a></li>';
								echo '<li><a href="/View/allOrders.php">Orders</a></li>';
							} else
								echo '<li><a href="/View/myOrders.php">My Orders</a></li>';

							echo '<li class="menu-has-children mousePointer " style="color:white "><a onclick=" event.preventDefault()">Pages</a>
							<ul>
								<li>
									<form action="Controllers/ValidationController.php" method="post">
										<input type="hidden" name="validationType" value="Logout">
										<input class="btn btn-block genric-btn primary radius" type="submit" value="Log out">
									</form>
								</li>
							</ul>
						</li>';
						}
						?>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header><!-- #header -->

	<!-- start banner Area -->
	<section class="banner-area" id="home">
		<!-- Alert Section -->
		<!-- End of alert Section -->
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-start">
				<div class="banner-content col-lg-7">
					<h6 class="text-white text-uppercase">Now you can feel the Energy</h6>
					<h1>
						Start your day with <br>
						a black Coffee
					</h1>
					<!--  -->
					<!-- session for checking if user or admin login -->
					<?php
					if (empty($_SESSION["authUsername"])) {
						echo "<button type='button'class='primary-btn text-uppercase' data-bs-toggle='modal' data-bs-target='#exampleModal'>Login</button>";
						if (isset($_GET["errors"]))
							echo "<script>window.addEventListener('load', function(){var element = document.getElementById('alert'); element.classList.add('show');
											setTimeout(function() {
											$('#alert').hide()}, 5000);
											})</script>";
					} else
						echo "<a href='View/createOrder.php' class=' primary-btn text-uppercase'>Buy now</a>";
					?>
					<div id="alert" class="alert alert-dismissible fade mt-3 text-center" role="alert">
						<strong class="text-white">Holy guacamole! </strong>
						<p class="text-white d-inline"><?php echo " ${_GET['errors']}" ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- Start video-sec Area -->
	<section class="video-sec-area pb-100 pt-40" id="about">
		<div class="container">
			<div class="row justify-content-start align-items-center">
				<div class="col-lg-6 video-right justify-content-center align-items-center d-flex">
					<div class="overlay overlay-bg"></div>
					<a class="play-btn" href="https://www.youtube.com/watch?v=ARA0AxrnHdM"><img class="img-fluid" src="img/play-icon.png" alt=""></a>
				</div>
				<div class="col-lg-6 video-left">
					<h6>Live Coffee making process.</h6>
					<h1>We Telecast our <br>
						Coffee Making Live</h1>
					<p><span>We are here to listen from you deliver exellence</span></p>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temp or incididunt ut
						labore et dolore magna aliqua. Ut enim ad minim.
					</p>
					<img class="img-fluid" src="img/signature.png" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- End video-sec Area -->

	<!-- Start menu Area -->
	<section class="menu-area section-gap" id="coffee">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-60 col-lg-10">
					<div class="title text-center">
						<h1 class="mb-10">What kind of Coffee we serve for you</h1>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Cappuccino</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Americano</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Espresso</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Macchiato</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Mocha</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Coffee Latte</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Piccolo Latte</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Ristretto</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<h4>Affogato</h4>
							<p class="price float-right">
								$49
							</p>
						</div>
						<p>
							Usage of the Internet is becoming more common due to rapid advance.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End menu Area -->

	<!-- Start gallery Area -->
	<section class="gallery-area section-gap" id="gallery">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-60 col-lg-10">
					<div class="title text-center">
						<h1 class="mb-10">What kind of Coffee we serve for you</h1>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<a href="Assets/img/g1.jpg" class="img-pop-home">
						<img class="img-fluid" src="Assets/img/g1.jpg" alt="">
					</a>
					<a href="Assets/img/g2.jpg" class="img-pop-home">
						<img class="img-fluid" src="Assets/img/g2.jpg" alt="">
					</a>
				</div>
				<div class="col-lg-8">
					<a href="Assets/img/g3.jpg" class="img-pop-home">
						<img class="img-fluid" src="Assets/img/g3.jpg" alt="">
					</a>
					<div class="row">
						<div class="col-lg-6">
							<a href="Assets/img/g4.jpg" class="img-pop-home">
								<img class="img-fluid" src="Assets/img/g4.jpg" alt="">
							</a>
						</div>
						<div class="col-lg-6">
							<a href="Assets/img/g5.jpg" class="img-pop-home">
								<img class="img-fluid" src="Assets/img/g5.jpg" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End gallery Area -->

	<!-- Start review Area -->
	<section class="review-area section-gap" id="review">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-60 col-lg-10">
					<div class="title text-center">
						<h1 class="mb-10">What kind of Coffee we serve for you</h1>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 single-review">
					<img src="img/r1.png" alt="">
					<div class="title d-flex flex-row">
						<h4>lorem ipusm</h4>
						<div class="star">
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
						</div>
					</div>
					<p>
						Accessories Here you can find the best computer accessory for your laptop, monitor, printer,
						scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,
						printer, scanner, speaker.
					</p>
				</div>
				<div class="col-lg-6 col-md-6 single-review">
					<img src="img/r2.png" alt="">
					<div class="title d-flex flex-row">
						<h4>lorem ipusm</h4>
						<div class="star">
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
						</div>
					</div>
					<p>
						Accessories Here you can find the best computer accessory for your laptop, monitor, printer,
						scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,
						printer, scanner, speaker.
					</p>
				</div>
			</div>
			<div class="row counter-row">
				<div class="col-lg-3 col-md-6 single-counter">
					<h1 class="counter">2536</h1>
					<p>Happy Client</p>
				</div>
				<div class="col-lg-3 col-md-6 single-counter">
					<h1 class="counter">7562</h1>
					<p>Total Projects</p>
				</div>
				<div class="col-lg-3 col-md-6 single-counter">
					<h1 class="counter">2013</h1>
					<p>Cups Coffee</p>
				</div>
				<div class="col-lg-3 col-md-6 single-counter">
					<h1 class="counter">10536</h1>
					<p>Total Submitted</p>
				</div>
			</div>
		</div>
	</section>
	<!-- End review Area -->

	<!-- Start blog Area -->
	<section class="blog-area section-gap" id="blog">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-60 col-lg-10">
					<div class="title text-center">
						<h1 class="mb-10">What kind of Coffee we serve for you</h1>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 single-blog">
					<img class="img-fluid" src="Assets/img/b1.jpg" alt="">
					<ul class="post-tags">
						<li><a href="#">Travel</a></li>
						<li><a href="#">Life Style</a></li>
					</ul>
					<a href="#">
						<h4>Portable latest Fashion for young women</h4>
					</a>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
						labore et dolore.
					</p>
					<p class="post-date">
						31st January, 2018
					</p>
				</div>
				<div class="col-lg-6 col-md-6 single-blog">
					<img class="img-fluid" src="Assets/img/b2.jpg" alt="">
					<ul class="post-tags">
						<li><a href="#">Travel</a></li>
						<li><a href="#">Life Style</a></li>
					</ul>
					<a href="#">
						<h4>Portable latest Fashion for young women</h4>
					</a>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
						labore et dolore.
					</p>
					<p class="post-date">
						31st January, 2018
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- End blog Area -->


	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
							ut labore dolore magna aliqua.
						</p>
						<p class="footer-text">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;
							<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | This
							template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
				<div class="col-lg-5  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">
							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
								<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
								<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
								<div style="position: absolute; left: -5000px;">
									<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
								</div>

								<div class="info pt-20"></div>
							</form>
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



	<script src="Assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="Assetsjs/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="Assets/js/easing.min.js"></script>
	<script src="Assets/js/hoverIntent.js"></script>
	<script src="Assets/js/superfish.min.js"></script>
	<script src="Assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="Assets/js/jquery.magnific-popup.min.js"></script>
	<script src="Assets/js/owl.carousel.min.js"></script>
	<script src="Assets/js/jquery.sticky.js"></script>
	<script src="Assets/js/jquery.nice-select.min.js"></script>
	<script src="Assets/js/parallax.min.js"></script>
	<script src="Assets/js/waypoints.min.js"></script>
	<script src="Assets/js/jquery.counterup.min.js"></script>
	<script src="Assets/js/mail-script.js"></script>
	<script src="Assets/js/main.js"></script>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>

					<button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

				</div>
				<div class="modal-body">
					<form action="Controllers/ValidationController.php" method="post">

						<input type="hidden" name="validationType" value="login">
						<!-- Email input -->
						<div class="form-outline mb-4">
							<label class="form-label" for="EmailAddress" name="email">Email address</label>
							<input type="email" id="EmailAddress" class="form-control border" name="email" />
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4">
							<label class="form-label" for="Password" name="password">Password</label>
							<input type="password" id="Password" class="form-control border" name="password" />
						</div>

						<!-- 2 column grid layout for inline styling -->
						<div class="row mb-4">
							<div class="col d-flex justify-content-center">
								<!-- Checkbox -->
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="remember" name="rememberMe" checked />
									<label class="form-check-label" for="remember"> Remember me </label>
								</div>
							</div>

							<div class="col">
								<!-- Simple link -->
								<a href="#!">Forgot password?</a>
							</div>
						</div>

						<!-- Submit button -->
						<button type="submit" class="btn  btn-block mb-4 genric-btn primary radius">Sign in</button>


					</form>
				</div>

			</div>
		</div>
	</div>


</body>

</html>