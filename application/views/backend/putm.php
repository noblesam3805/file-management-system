<?php

	session_start();
	/*if(!isset($_SESSION['putmeID'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url() . 'index.php?putme/pre_registration');
	}*/

    $sys = $this->db->get_where('settings', array("type" => 'system_name'))->row();
    $pageTitle = $this->db->get_where('settings', array("type" => 'system_title'))->row();
    $user = $this->db->get_where('prehnd_users', array("user_id" => '1'))->row();
	
	$account_type 	=	$this->session->userdata('login_type');
    
    
?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta name="description" content="Nigerian Higher Education" />

	<meta name="author" content="Sunday Okoi" />



        <title><?php echo 'FPNO| ' . $page_title;?></title>



        <link href="css/style.default.css" rel="stylesheet">

		<link href="css/me.default.css" rel="stylesheet">

        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">

        <link href="css/morris.css" rel="stylesheet">

        <link href="css/select2.css" rel="stylesheet" />

		<link href="js/css3clock/css/style.css" rel="stylesheet">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">

	<link rel="stylesheet" href="assets/css/bootstrap.css">

	<link rel="stylesheet" href="assets/css/neon-core.css">

	<link rel="stylesheet" href="assets/css/neon-theme.css">

	<link rel="stylesheet" href="assets/css/neon-forms.css">
	
	<!-- My Styles -->
	<link rel="stylesheet" href="assets/css/eduportal-fullpage-style.css" />
	<link rel="stylesheet" href="assets/css/base-admin.css" />
	
	


    <!-- CSS LINKS-->

		<link rel="stylesheet" type="text/css" href="assets/css/basic.css"/>
		<link rel="stylesheet" type="text/css" href="assets/fonts/icons.css"/>

		<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>

        <script src="js/jquery-1.11.1.min.js"></script>

		<script type="text/javascript" src="js/me.js"></script>
		<script src="assets/js/ajaxScript.js"></script>
		
		
        
	<style type="text/css">
		.row{
			margin-left:0px !important;
			padding:10px 0px 0px 0px;
		}
		thead{
		}
		#nceLink, degreeLink{
			cursor:pointer;
		}
		.nav-tabs.bordered{
			margin:0px 15px !important;
		}
		.tab-content{
			padding:0px 15px !important;
			border:none !important;
		}
	</style>
	<?php  include 'js/javascript.php'; ?>
    </head>
    <body>
        <div class="document">
			<?php 
				if($page_name != 'receipt' || $page_name != 'bankprintout'){
					include 'payment_header.php'; 
				}
			?>
			<div class="content-row">
				<?php 
					if($account_type == 'sadmin'){
						include 'admin/' . $page_name . '.php';
					}else{
						include 'payment/' . $page_name . '.php';
					}
				?>
			</div>
			<?php include 'includes_bottom.php';?>
        </div>
    </body>
</html>

