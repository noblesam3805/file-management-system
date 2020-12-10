<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta name="description" content="Nigerian Higher Education" />

	<meta name="author" content="Emmanuel Etti" />



        <title><?php echo $page_title;?></title>



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
		
		<!-- My Javascript -->
    <script type="text/javascript" src="formValidation.js"></script>
    <script type="text/javascript" src="bootstrap.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>


        
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
	.form-groups-bordered > .form-group{
		border-bottom:none;
		padding-top:0px;
	}
	.content-row .form-group label {
		margin-top: 7px;
	}
</style>

    </head>
    <body>
        <div class="document">
			<header style="background:#303641;" id="heada">
                <div class="col-md-10 middle header-div" style="margin-top:0px !important;">
					<div class="col-md-3 logo-div heada-divs">
						<p>
							<a href="<?php echo base_url(); ?>">
								<img src="assets/images/eduportal.png" width="150px"/>
							</a>
						</p>
					</div>
					<div class="col-md-6 heada-divs">
						<p><?php echo $system_name; ?></p>
					</div>
					<div class="col-md-3 heada-divs">
						<p style="font-size:17px;"><?php echo $app_type; ?></p>
					</div>
				</div>
            </header>
			<div class="content-row">
				<div class="col-md-4 middle p20">
					<div class="widget stacked">
						<div class="widget-header">
							<h4> &nbsp; &nbsp; <span class="glyphicon glyphicon-user" style="color:#999;"></span> &nbsp; &nbsp; &nbsp; Login To Register Student</h4>
						</div>
						<div class="widget-content" style="padding:10px 20px;">
							<p style="font-size:14px; color:#820E29;">
								<?php 
									if($this->session->userdata('err_msg') != ''){
										echo $this->session->userdata('err_msg');
									} 
								?>
							</p>
							<p style="font-size:14px; color:#820E29;">
								<?php 
									if(isset($_SESSION['err_msg'])){
										echo $_SESSION['err_msg'];
									} 
								?>
							</p>
							<?php echo form_open('registration/login' , array('class' => 'form-groups-bordered validate','target'=>'_top'));?>
								<div class="form-group eduportal-form-group">
									<label class="label-control" for="course name">Username</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
										<input type="text" name="username" class="form-control eduportal-input" required placeholder="Enter Your Username"/>
									</div>
								</div>
								<div class="form-group eduportal-form-group">
									<label class="label-control" for="course name">Password</label>
									<div class="input-group input-group-lg eduportal-input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>			
										<input type="password" name="password" class="form-control eduportal-input" required placeholder="Enter Your Password"/>
									</div>
								</div>
								<div class="col-md-12 no-p">
									<div class="form-group eduportal-form-group">
										<input type="submit" value="Login" style="width:100px;padding:10px; 35px" class="btn btn-info" id='login' name='login'/>
									</div>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4 middle login-instruct">
						<!--p><span class="note"> Note:</span> Student registration permission for post-utme is assigned to persons with registration rights from the school.</p-->
						<!--p><span class="note">[ For Cafe Owners ]</span> To apply for permissions to register students, please call these numbers 0-98765456789, 0-98767898765</p-->
					</div>
				</div>
			</div>
			<?php include 'includes_bottom.php';?>
        </div>
    </body>
</html>

