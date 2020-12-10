<?php
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	//$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	$text_align	=	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;
	$academic_year	=	$this->db->get_where('settings' , array('type'=>'academic_year'))->row()->description;
	$account_type 	=	$this->session->userdata('login_type');

    if($account_type == 'student'){

        $reg_no = $this->session->userdata('reg_no');
        $portal_id = $this->session->userdata('portal_id');
        $check = $this->db->get_where('nekede_etranzact_payment', array('portal_id' => $portal_id, 'session'=>$academic_year))->result_array();
        $payee = $this->db->get_where('nekede_etranzact_payment', array('portal_id' => $portal_id,'status'=>'NOT PAID'))->result_array();
        $level = $this->db->get_where('student', array('reg_no' => $reg_no))->row()->level;
        //$status = $this->db->get_where('student', array('reg_no' => $reg_no))->row()->update_status;
        $page_title = $page_name && count($payee) > 0 ? 'Confirm Fee Payment' : $page_title;
    }
	?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>" ng-app="myApp">
<head>
<!-- Smartsupp Live Chat script -->

	<title><?php echo $page_title;?> | <?php echo $system_name?></title>
    
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta name="keywords" content="YCT ERP Portal" />
	
	<link rel="stylesheet" href="assets/css/eduportal-fullpage-style.css" />
	<link rel="stylesheet" href="assets/css/base-admin.css" />
	
	<!-- Ekabody -->
	<link rel="stylesheet" type="text/css" href="assets/css/student_my_profile.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.default.css">
	<link rel="stylesheet" type="text/css" href="assets/css/prettyPhotos.css">
	<link rel="stylesheet" type="text/css" href="assets/css/enterprise.css">
	
	<style type="text/css">
	
		label{
			font-size:16px !important;
		}
	
		/*.eduportal-main-content .table-bordered{
			border:1px solid #999 !important;
			color:#333 !important;
		}
		.eduportal-main-content .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
			border:1px solid #999 !important;
		}
		.eduportal-main-content .table-bordered > thead > tr > th, .table-bordered > thead > tr > td{
			color:#333 !important;
			font-weight:bold;
			font-size:15px;
		}*/
		.eduportal-topbar{
			padding:5px;
			background-color: #105618;
			border-bottom: 1px solid #252C41;
			float:left;
		}
		.eduportal-topbar .eduportal-topbar-wrap{
			width:100%;
			padding:0px 20px;
			float:left;
		}
		.eduportal-topbar ul{
			margin-bottom:0px !important;
		}
		.eduportal-topbar h3{
			color:#e5e5e5;
		}
		.eduportal-topbar ul li a{
			color:#e5e5e5;
		}
		.eduportal-topbar .user-detail ul{
			margin-right:20px;
		}
		.eduportal-topbar .language-selector.open > .dropdown-toggle{
			background:#2B303A;
		}
		.eduportal-topbar .language-selector .dropdown-menu{
			background:#2B303A;
		}
		.eduportal-topbar .language-selector .dropdown-menu > li{
			border-bottom:1px solid #303641;
		}
		.eduportal-topbar .language-selector .dropdown-menu > li:hover{
			border-bottom:1px solid #2B303A;
			background:#303641;
		}
	</style>
	


	<?php include 'includes_top.php';?>
	
</head>
<body class="page-body" >
	<div class="page-container eduportal-page <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?>" >
		<?php include $account_type.'/navigation.php';?>
		<div class="col-md-12 eduportal-topbar">
			<div class="edu-main-content">
				<?php include 'header.php';?>
			</div>
		</div>
		<div class="main-content eduportal-main-content" style="<?php if($page_name == 'my_profile'){ echo 'padding-right:0px !important; padding-left:0px !important; padding-top:15px !important;';} ?>" >

			<?php if($page_name != 'my_profile'){ ?>

           <h3 style="margin:20px 0px; color:#818da1; font-weight:200;">
           	<i class="entypo-right-circled"></i> 
				<?php echo $page_title;?>
           </h3>
			<?php } ?>

			<?php include $account_type.'/'.$page_name.'.php';?>
			

			<?php include 'footer.php';?>

		</div>
		<?php //include 'chat.php';?>
        	
	</div>
    <?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>
    
</body>
</html>