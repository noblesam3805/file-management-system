  <?php

	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;

	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;

	?>
<!DOCTYPE html><html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head><meta charset="UTF-8"/><meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="homepage/public/landingAssets/images/favicon.html"/>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&amp;display=swap"rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"rel="stylesheet">
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/vendors/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/css/lightbox.min.css"/>
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/css/animate.css"/>
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/css/owl.carousel.css"/>
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/css/font-awesome.css"/>
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/fonts/flaticon.css"/>
<link rel="stylesheet" type="text/css" href="homepage/public/landingAssets/css/style.css"/>
<title>Delta State Government IDS & Repository</title>
</head>
<body id="top" data-spy="scroll" data-target="#myScrollspy" data-offset="20">
<div class="body-overlay"></div><div id="box-mobile-menu" class="box-mobile-menu">
<a href="javascript:void(0);" id="back-menu" class="back-menu">
<i class="fa fa-angle-left"></i></a><span class="box-title">Menu</span>
<a href="javascript:void(0);" class="close-menu"></a><div class="box-inner">
</div></div>
<header id="header" class="header"><div class="main-header header-fixed">
<div class="container-outer"><div class="row"><div class="col-lg-2 col-sm-3 col-xs-6 header-logo">
<div class="logo"><a href="index-2.html#">
<img class="img-responsive" src="homepage/public/landingAssets/images/logo.png" alt="logo" style="width:120px; height:auto; margin-top:-20px; margin-left:20px"/>
</a></div>
<!--end logo-->
</div>
<div class="col-lg-10 col-sm-9 col-xs-6 header-nav">
<!-- Button Menu Mobile -->
<a class="menu-bar mobile-navigation" href="javascript:void(0)">
<span class="menu-btn-icon"><span></span><span></span><span></span></span>
</a>
<!-- End Button Menu Mobile -->
<!-- Main Nav Menu -->
<nav id="primary-navigation" class="site-navigation">
<div class="main-menu-wrapper">
</div>
<div id="myScrollspy" class="main-navigation" data-width="991">
<ul id="menu-main-menu" class="nav menu-nav clone-main-menu nagrand-nav main-menu">
<li class="menu-item page-active"><a href="index.php">Home</a></li>
<li class="menu-item"><a href="#">About</a></li>
<li class="menu-item"><a href="#">|</a></li>
<li class="menu-item"><a href="<?php echo base_url() . 'index.php?login'; ?>">Login</a></li>
</ul></div>
</nav>
<!-- End Main Nav Menu --></div></div></div>
</div>
<div class="header-banner"><div class="banner-parallax">
<div class="banner-content"><div class="container">
<!-- <h3 class="smtitle-banner">SmART and professional </h3> -->
<h1 class="title-banner"><span>Delta State Infrastructural Desktop Solution</span></h1>
<div class="row"><div class="col-xs-11 col-sm-9 col-md-8 col-lg-7">
<h3 class="smtitle-banner">IDS & Document Management/Repository</h3>
</div>
</div><br />
<a href="<?php echo base_url() . 'index.php?login'; ?>" class="btn-banner">Login</a>
<a href="member/register.html" class="btn-banner" style="margin-left:20px">Support</a>
<br/><br/><br/><br/><br/><br/><br/>
<p  style="width:500px; height:auto; margin-bottom:0px; margin-left:20px; color: #fff;bottom:0px">© <?php echo date("Y")." "; echo $system_name;?> <br/><img class="img-responsive" src="images/cropped-Webp.net-resizeimage-4-1.png" alt="powered by " /></p>
</div></div>
<!-- <a href="index.html#about" class="icon-mouse"></a> --> </div></div>


</header>

<!-- <div id="about"><div class="container"><div class="row"><div class="col-sm-12"><h2 class="section-title"><span>About Us</span></h2></div><div class="col-sm-12 col-md-6">
<div class="nagrand-video"><div class="video-content"><img src="https://c.oxygyn.com.ng/public/landingAssets/images/200.jpg" alt="about">
<a class="btn-video" href="index.html#" data-videosite="vimeo" data-videoid="185782885"><div class="videobox_animation circle_1">
</div><div class="videobox_animation circle_2"></div>
<div class="videobox_animation circle_3"></div></a></div></div>
<a class="quick-install"></a><div class="row"><div class="col-ts-12 col-xs-4 col-sm-4"><div class="nagrand-feature"><i class="fa fa-laptop"></i>
<h4 class="feature-title">Design</h4></div></div><div class="col-ts-12 col-xs-4 col-sm-4"><div class="nagrand-feature"><i class="fa fa-html5"></i>
<h4 class="feature-title">Development</h4></div></div><div class="col-ts-12 col-xs-4 col-sm-4"><div class="nagrand-feature"><i class="fa fa-rocket">
</i><h4 class="feature-title">Launch</h4></div></div></div></div><div class="col-sm-12 col-md-6"><div class="block-content-wrap">
<div class="block-content"><h3 class="block-title">Hi there! we are nagrand</h3>
<div class="block-subtitle">Digital Design, Development and Marketing Agency From UK</div>
<p>Nagrand is a creative studio that is specialized in brand strategy and digital creation.
We will work with you to design your brand identity and make it evolve in a consistenton each and every connected device.</p>
<p>We believe that individual talent can only take you so far in our industry.While personal excellence is highly valued at Nagrand.</p>
</div><div class="nagrand-skill"><p class="skill-name">DESIGN</p><div class="skill-bar skill-bar-80 wow slideInLeft animated">
<span class="skill-count">80%</span></div></div><div class="nagrand-skill"><p class="skill-name">HTML5</p><div class="skill-bar skill-bar-85 wow slideInLeft animated">
<span class="skill-count">85%</span></div></div><div class="nagrand-skill"><p class="skill-name">CSS3</p><div class="skill-bar skill-bar-95 wow slideInLeft animated">
<span class="skill-count">95%</span></div></div></div></div></div></div></div> --><!-- <div id="contact"><div class="container"><div class="row"><div class="col-sm-5">
<div class="contact-info"><h2 class="section-title style-02"><span>GET IN TOUCH </span></h2><p>Nulla metus metus ullamcorper vel tincidunt sed euismod nibh Quisque volutpat</p>
<div class="contact-intro"><span class="flaticon-address"></span><div class="contact-detail"><h4>Address</h4><div>NY 1017 United State USA</div></div></div>
<div class="contact-intro"><span class="flaticon-smartphone-1"></span><div class="contact-detail"><h4>Phone</h4><div>+55 555 645 333</div></div></div>
<div class="contact-intro"><span class="flaticon-letter"></span><div class="contact-detail"><h4>Email</h4><div><a href="mailto:Hello@nagrand.com">Hello@nagrand.com</a>
</div></div></div></div></div><div class="col-sm-7"><form class="contact-form"><div class="row"><div class="contact-name contact-input col-sm-12 col-md-6 col-lg-6"><label>Name<span class="required">*</span></label><input title="author" required="required" name="author" type="text"></div><div class="contact-email contact-input col-sm-12 col-md-6 col-lg-6"><label>Email <span class="required">*</span></label><input title="email" required="required" name="email" type="email"></div><div class="contact-message contact-input col-sm-12 col-md-12 col-lg-12"><label>Message <span class="required">*</span></label><textarea title="comment-form-comment" rows="4" required></textarea></div><div class="contact-submit col-sm-12 col-md-12 col-lg-12"><button name="submit" class="submit" type="submit" value="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>Submit</button></div></div></form></div></div></div></div> -->
<a href="index-2.html#top" class="backtotop">
<i class="fa fa-angle-up"></i></a>
<script type="text/javascript" src="homepage/public/landingAssets/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/lightbox.min.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/owl.carousel.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/waypoints.min.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/wow.min.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/jquery.counterup.min.js"></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/isotope.min.js"></script>
<script type='text/javascript'src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
<script type="text/javascript" src="homepage/public/landingAssets/js/autotype.js"></script><script type="text/javascript" src="landingAssets/js/function.js"></script>

</body>

</html>