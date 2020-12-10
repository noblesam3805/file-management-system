<!DOCTYPE html>

<html lang="en">

	<head>
<!-- Start of Smartsupp Live Chat script -->
<!-- Smartsupp Live Chat script -->
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '18813bc7e191a02eb971a1e3493efe1bd386df46';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
    <?php

	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;

	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;

	?>

		<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>



		<!-- META TAGS -->

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>



		<!-- FAVICON -->

		<link rel="shortcut icon" href="assets/images/favicon.png">



		<!-- CSS LINKS-->

		<link rel="stylesheet" type="text/css" href="assets/css/basic.css"/>

		<link rel="stylesheet" type="text/css" href="assets/css/basicQuery.css"/>

		<link rel="stylesheet" type="text/css" href="assets/fonts/icons.css"/>

		<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>

        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Nigerian Higher Education" />
		<meta name="keywords" content="Nigerian Higher Education, Federal Polythecnic Nekede , Federal College of Education" />
		
		<script>
			var link = document.createElement('link');
			link.rel = 'stylesheet'
			link.href = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
			document.head.appendChild(link);

			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';
			document.head.appendChild(script);

			var link = document.createElement('link');
			link.rel = 'stylesheet'
			link.href = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css';
			document.head.appendChild(link);

		</script>
		


		<!--?php include 'includes_top.php';?-->



		<!-- JAVASCRIPT -->

		<script type="text/javascript" src="/eduportal/livechat/php/app.php?widget-init.js"></script>

	</head>

	<body>

    <script type="text/javascript">

		var baseurl = '<?php echo base_url();?>';

	</script>

	<style type="text/css">
	.crumbs h3 {    
		font-family: 'Roboto-Light';
	    font-size: 32.5px;
	    /*margin-top: 40px;*/
	}

	.myText{
		width:90%;
		border-radius:0;
		padding:10px;
		margin:10px 0;
		font-size:16px;
		font-family:'Roboto-Light';
		background:#faffbd;
		color:#000000;
	}
	</style>



		<div class="document">

			<header>

				<section>

					<div class="headimg"><img src="assets/images/eduportal.png"/></div>

					<div class="headchatdiv">

						

						<p class="headchat">Call 24/7 &nbsp;  , Email: support@yabatech.edu.ng</p>

					</div>

				</section>

			</header>

			<section>

				<div class="crumbs">

					<div class="inner">

						<h3>Login</h3>

                        <!--div class="form-login-error">

          				<h3>Invalid login</h3> -->

          				<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>

          			    <!--</div-->

						<form method="post" role="form" id="form_login" action="<?php echo base_url() . 'index.php?login/ajax_login'; ?>">

							<input class="myText" type="text" name="email" id="email" placeholder="Portal ID" required/>

							<input class="myText" type="password" name="password" id="password" placeholder="Password" required/>

							<p class="small" style="font-size:13px;">Forgot your password? <a target='_blank' href='<?php echo base_url() . 'index.php?register/password'; ?>'>Click here.</a> 
            				</p>
            				<p class="small" style="font-size:23px;">Having issues? <a target='_blank' href="http://www.gtcocalscan.com/support">Let us know here!</a>
            				</p>
							<!--input type="submit" value="Login" class="btn" id='login' name='login' onclick="verify();"/-->

							<input type="submit" value="Login" class="btn" id='login' name='login'/>

						</form>
<br/>

					</div>

				</div>



				<div class="divider"></div>

				<div class="crumbs" style="width:50%">

				<div class="inner">	
					
				
					<h1 style="font-size:17px; color:#900;"><marquee>Kindly Note that to Pay School Fees, a Portal Account is Required.</marquee></h1>
					<div class="row" style="padding-top: 2px;">
			        	<div class="col-md-9">
			        	  <p style="font-family: OpenSans-Light;line-height: 30px; font-size: 16px;">DON'T HAVE A PORTAL ACCOUNT?</p></div>
						  <div class="col-md-9">
			        	<p style="font-size:16px; color:#215277;"><a target="" href="<?php echo base_url() . 'index.php?register/account_verification'; ?>">Create one Here!</a></p>
						</div>
			        </div>
			        
				
				
					<!--p>Click here for <a href="<?php echo base_url() . 'putme/'; ?>">POST-UTME Registration Do you want to pay your School fees</a></p-->
					

					<!--p class="stdreg">Are you new to this portal, and not registered? Then...<br/> <a href="index.php?login/register">Register Now &rsaquo;&rsaquo;</a></p-->
					
					<!--br /-->
					<!-- <h4 class="stdhead">Old Students</h3>
					<ul> -->
					<!--p style="font-size:16px;"><span style="color:#9d0000;">Note:</span> If the registration number you supplied in the bank is not the valid matric number (eg: BD/11/1234) or valid jamb reg number (eg: 12345678AB), go back to the bank and update your registration number. </p-->
					<!-- <li><p style="font-size:16px; color:#215277;"><a target="_blank" href="<?php echo base_url() . 'index.php?payment/morning_student'; ?>">HND/ND Morning</a> </p></li></li>
					
					<li><p style="font-size:16px; color:#215277;"><a target="_blank" href="<?php echo base_url() . 'index.php?payment/evening_student'; ?>">HND/ND Evening/ Weekend</a> </p></li></li>
					</ul> -->
					<!--/br-->
					<!--h4 class="stdhead">New Students</h3-->
					<!--p style="font-size:16px;"><span style="color:#9d0000;">Note:</span> If the registration number you supplied in the bank is not the valid matric number (eg: BD/11/1234) or valid jamb reg number (eg: 12345678AB), go back to the bank and update your registration number. </p-->
					<!--ul>
						<li><p style="font-size:16px; color:#215277;"><a target="_blank" href="<?php echo base_url() . 'index.php?payment/new_morning_student'; ?>">HND/ND Morning </a></p></li>
					
						<li><p style="font-size:16px; color:#215277;"><a target="_blank" href="<?php echo base_url() . 'index.php?payment/new_evening_student'; ?>">HND/ND Evening/ Weekend</a></p></li>
					</ul-->

					<!-- </hr> -->

		

					<!--p class="stdreg">Are you new to this portal, and not registered? Then...<br/> <a href="index.php?login/register">Register Now &rsaquo;&rsaquo;</a></p-->
					
					<!--br /-->
					<!-- <h4 class="stdhead">Old Students</h3> -->
					<!--p style="font-size:16px;"><span style="color:#9d0000;">Note:</span> If the registration number you supplied in the bank is not the valid matric number (eg: BD/11/1234) or valid jamb reg number (eg: 12345678AB), go back to the bank and update your registration number. </p-->
					<!-- <ul>
						<li><p style="font-size:16px; color:#215277;"><a target="_top" href="<?php echo base_url() . 'index.php?payment/remitaGetReceipt'; ?>">HND/ND Morning</a> </p></li>
					
						<li><p style="font-size:16px; color:#215277;"><a target="_top" href="<?php echo base_url() . 'index.php?payment/etranzactConfirmation'; ?>">HND/ND Evening/ Weekend</a> </p></li>
					</ul> -->
					<!--/br-->
					<!-- <h4 class="stdhead">New Students</h3> -->
					<!--p style="font-size:16px;"><span style="color:#9d0000;">Note:</span> If the registration number you supplied in the bank is not the valid matric number (eg: BD/11/1234) or valid jamb reg number (eg: 12345678AB), go back to the bank and update your registration number. </p-->
					<!-- <ul>
						<li><p style="font-size:16px; color:#215277;"><a target="_top" href="<?php echo base_url() . 'index.php?payment/remitaGetReceipt'; ?>">HND/ND Morning </a></p></li>
					
						<li><p style="font-size:16px; color:#215277;"><a target="_top" href="<?php echo base_url() . 'index.php?payment/etranzactConfirmation'; ?>">HND/ND Evening/ Weekend</a></p></li>
					</ul> -->


				</div>
				</div>

			</section>



			<footer>

				<div class="foot-top" >



				</div>

			</footer

		></div>
		<div  style="padding-bottom:10px;">
		</div>

     

        <script src="assets/js/gsap/main-gsap.js"></script>

    	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>

    	<script src="assets/js/bootstrap.js"></script>

    	<script src="assets/js/joinable.js"></script>

    	<script src="assets/js/resizeable.js"></script>

    	<!--script src="assets/js/neon-api.js"></script>

    	<script src="assets/js/jquery.validate.min.js"></script>

    	<script src="assets/js/neon-login.js"></script>

    	<script src="assets/js/neon-custom.js"></script>

    	<script src="assets/js/neon-demo.js"></script-->

		

		<?php

			if(isset($_SESSION['err_msg'])){

				unset($_SESSION['err_msg']);

			}

		?>
	<?php include 'includes_bottom.php';?>

	</body>

</html>

