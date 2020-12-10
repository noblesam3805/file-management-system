<!DOCTYPE html>
<html lang="en">
<head>
<title>Welcome to YABATECH ERP Portal</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="homepage/styles/bootstrap4/bootstrap.min.css">
<link href="homepage/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="homepage/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="homepage/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="homepage/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="homepage/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="homepage/styles/responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header d-flex flex-row" style="opacity: 0.5">
		<div class="header_content d-flex flex-row align-items-center" >
			<!-- Logo -->
			<div class="logo_container">
				<div class="logo" >
					<img src="assets/images/logo.png" alt="">
		
				</div>
			</div>

			<!-- Main Navigation -->

		</div>
			
		<div class="header_side d-flex flex-row justify-content-center align-items-center" style="color:#fff">
			<img src="homepage/images/login.svg" alt="">
			<h1><a href="index.php?login" style="color:#fff">LOGIN</a></h1>
		</div>

		<!-- Hamburger -->

	</header>

	<!-- Menu -->
	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
				
				</ul>

				<!-- Menu Social -->

				<div class="menu_social_container menu_mm">
					<ul class="menu_social menu_mm">
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
					</ul>
				</div>

				
			</div>

		</div>

	</div>

	<!-- Home -->

	<div class="home">

		<!-- Hero Slider -->
		<div class="hero_slider_container">
			<div class="hero_slider owl-carousel">


				<!-- Hero Slide -->
				<div class="hero_slide">
					<div class="hero_slide_background" style="background-image:url(assets/images/2.jpg)"></div>
					<div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
						<div class="hero_slide_content text-center">
							<h2 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut"><span style="font-size:44px;color:#fff">Welcome to YABATECH ERP Portal.</span></h2>
						</div>
					</div>
				</div>


			</div>


		</div>

	</div>


	<div class="hero_boxes">
	  <div class="hero_boxes_inner">
	    <div class="container">
	      <div class="row">

	        <div class="col-lg-4 hero_box_col">
	          <div class="hero_box d-flex flex-row align-items-center justify-content-start">
	            <img src="homepage/images/credit-card.svg" class="svg" alt="">
	            <div class="hero_box_content">
	              <h2 class="hero_box_title">Acceptance Fee</h2>
	              <a href="<?php echo base_url() . 'index.php?register/account_verification_acceptancefees'; ?>" class="hero_box_link">Generate Acceptance Fee Invoice</a>  <br/> <a href="<?php echo base_url() . 'index.php?register/pay_acp_fees'; ?>" class="hero_box_link">Get Acceptance Fee Receipt</a>
	            </div>
	          </div>
	        </div>


	        <div class="col-lg-4 hero_box_col">
	          <div class="hero_box d-flex flex-row align-items-center justify-content-start">
	            <img src="homepage/images/password.svg" class="svg" alt="">
	              <div class="hero_box_content">
	              <h2 class="hero_box_title">Portal ID</h2>
	              <a href="<?php echo base_url() . 'index.php?register/account_verification'; ?>" class="hero_box_link">Get a Portal ID</a>
	            </div>
				 <div class="hero_box_content">
	              <h2 class="hero_box_title">New Applicant?</h2>
	              <a href="http://erp.yabatech.edu.ng/application" class="hero_box_link">Apply Here</a>
	            </div>
	          </div>
	        </div>


	        <div class="col-lg-4 hero_box_col">
	          <div class="hero_box d-flex flex-row align-items-center justify-content-start">
	            <img src="homepage/images/financial.svg" class="svg" alt="">
	            <div class="hero_box_content">
	              <h2 class="hero_box_title">Fees Confirmation</h2>
	              <a href="<?php echo base_url() . 'index.php?register/remitaGetReceipt'; ?>" class="hero_box_link">Get Payment Receipt</a><br/>
				 
	            </div>
	          </div>
	        </div>

	      </div>
	    </div>
	  </div>
	</div>
	<!-- Register -->


</div>

<script src="homepage/js/jquery-3.2.1.min.js"></script>
<script src="homepage/styles/bootstrap4/popper.js"></script>
<script src="homepage/styles/bootstrap4/bootstrap.min.js"></script>
<script src="homepage/plugins/greensock/TweenMax.min.js"></script>
<script src="homepage/plugins/greensock/TimelineMax.min.js"></script>
<script src="homepage/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="homepage/plugins/greensock/animation.gsap.min.js"></script>
<script src="homepage/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="homepage/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="homepage/plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="homepage/plugins/easing/easing.js"></script>
<script src="homepage/js/custom.js"></script>

</body>
</html>
