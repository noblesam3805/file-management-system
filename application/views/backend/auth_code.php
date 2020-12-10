<!doctype html><html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
   <?php

	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;

	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;

	?>

		<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" /><!-- App favicon --><link rel="shortcut icon" href="homepage/public/assets/images/logo.png">
<!-- Bootstrap Css -->
<link href="homepage/public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css --><link href="homepage/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css--><link href="homepage/public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head><body>
<div class="account-pages pt-sm-5" style="">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-lg-6 col-xl-5"><div class="text-center">

</div><div class="card overflow-hidden"><div class="bg-soft-primary"><div class="row">
<div class="col-7"><div class="text-primary p-4"><h3 class="text-primary">Auth Code Verification</h3>
<p>Login to Continue.
</p></div>
</div><div class="col-5 align-self-end">
<img src="homepage/public/assets/images/profile-img.png" alt="" class="img-fluid">
</div></div>
</div>
<div class="card-body pt-0">

<div><a href="index.html">
<div class="avatar-md profile-user-wid mb-4">
<span class="avatar-title rounded-circle bg-light">
<img src="homepage/public/assets/images/logo.svg" alt="" class="rounded-circle" height="34">
</span></div>
</a><?php if($_SESSION['err_msg']){ echo "<p style='color: red;'>".$_SESSION['err_msg']."</p>"; 
unset($_SESSION['err_msg']);

}?>
</div>
<div class="p-2">
<form class="form-horizontal" method="post" action="<?php echo base_url() . 'index.php?login/prowelcome'; ?>">
<div class="form-group"><label for="username">Enter Code</label>
<input type="text" class="form-control" id="email" name="email" placeholder="Enter username" required></div>

<div class="mt-3">
<button class="btn btn-primary btn-block waves-effect waves-light" name="submit" type="submit">Click to Proceed</button>
</div>
<div class="mt-4 text-center">
<a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Didn't Receive Code? Click to Resend</a>
</div>
</form>
</div></div>
</div>

 </p>
 <p  style="width:500px; height:auto; margin-bottom:0px; margin-left:20px; color: #fff;bottom:0px; background-color: #eee">© <?php echo date("Y")." "; echo $system_name;?> <br/><img class="img-responsive" src="images/cropped-Webp.net-resizeimage-4-1.png" alt="powered by " /></p>
</div></div></div></div></div><!-- JAVASCRIPT -->
 <script src="homepage/public/assets/libs/jquery/jquery.min.js"></script>
 <script src="homepage/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="homepage/public/assets/libs/metismenu/metisMenu.min.js"></script>
 <script src="homepage/public/assets/libs/simplebar/simplebar.min.js"></script>
 <script src="homepage/public/assets/libs/node-waves/waves.min.js"></script><!-- App js -->
 <script src="homepage/public/assets/js/app.js"></script>
 </body>

</html>

				
					