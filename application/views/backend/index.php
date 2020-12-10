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
			background-color: #08899e;
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
<body class="page-body skin-blue loaded" >
	<div class="page-container eduportal-page <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?>" >
		<?php include $account_type.'/navigation.php';?>
		<div class="col-md-12 eduportal-topbar">
			<div class="edu-main-content">
				<?php include 'header.php';?>
			</div>
		</div>
		<div class="main-content eduportal-main-content" style="<?php if($page_name == 'my_profile'){ echo 'padding-right:0px !important; padding-left:0px !important; padding-top:15px !important;';} ?>" >
<div class="row"> <!-- Profile Info and Notifications --> <div class="col-md-6 col-sm-8 clearfix"> <ul class="user-info pull-left pull-none-xsm"> <!-- Profile Info --> <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right --> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="uploads/staff_images/<?php echo ucwords($this->session->userdata('sadmin_id'));?>.jpg" alt="" class="img-circle" width="44">
<?php echo ucwords($this->session->userdata('name'));?>
</a>
 <ul class="dropdown-menu"> <!-- Reverse Caret --> <li class="caret"></li> <!-- Profile sub-links --> <li> <a href="../../extra/timeline/index.html"> <i class="entypo-user"></i>
Edit Profile
</a> </li> <li> <a href="../../mailbox/main/index.html"> <i class="entypo-mail"></i>
Inbox
</a> </li> <li> <a href="../../extra/calendar/index.html"> <i class="entypo-calendar"></i>
Calendar
</a> </li> <li> <a href="#"> <i class="entypo-clipboard"></i>
Tasks
</a> </li> </ul> </li> </ul> <ul class="user-info pull-left pull-right-xs pull-none-xsm"> <!-- Raw Notifications -->
 <li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 
			<?php
$today_day = date("d");
$today_month = date("m");
$fulldate=$today_month.'-'.$today_day;
$query= $this->db->query("SELECT* FROM sadmin WHERE dob like '%$fulldate%'")->result_array();
$querycount= $this->db->query("SELECT* FROM sadmin WHERE dob like '%$fulldate%'")->num_rows();
?>
 <i class="entypo-attention"></i> <span class="badge badge-info"><?php echo $querycount;?></span> </a> <ul class="dropdown-menu"> <!-- TS159513862516780: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates --> <li class="top"> <p class="small"> <a href="#" class="pull-right">Mark all Read</a>
You have <strong><?php echo $querycount;?></strong> new notifications.
</p> </li> <li> <ul class="dropdown-menu-list scroller" tabindex="5001" style="overflow: hidden; outline: none;"> 
  <li class="external">
				  <br> <b>Today's Birthday Celebrants</b><br>
		
                     <table class="table table-bordered table-striped datatable" id="">
  <thead>
        <tr>
            <th width="2%"><strong><h5><?php echo get_phrase('s/n'); ?></strong></h5></th>
            <th width="20%"><strong><h5><?php echo get_phrase('Celebrant Name'); ?></strong></h5></th>
            <th width="15%"><strong><h5><?php echo get_phrase('phone_no'); ?></strong></h5></th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
		$id=1;
		foreach ($query as $row4) { ?>   
            <tr>
                <td> <?php echo $id ?></td>
                <td><?php echo $row4["name"]; ?></td>
                <td>
                    <?php echo $row4["phone"]; ?>
                </td>
              </tr>
			  
		
			
			
		<?php
		$id= $id + 1;
		}
?>
</tbody>
</table>
                    </li> </ul> </li> 
<li class="external"> <a href="#">View all notifications</a> 
</li>
</ul> 
</li> <!-- Message Notifications --> <li class="notifications dropdown">
                <?php
                
                ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-mail"></i>
                    <?php $theusertype = $this->session->userdata('sadmin'); ?>
                        <span class="badge badge-info" id="<?php echo $theusertype . '_messageBox'; ?>"></span>
                </a>

                <ul class="dropdown-menu" >
                    <li>
                        <ul class="dropdown-menu-list scroller">


                            <?php
                            $current_user = 'sadmin-' .$this->session->userdata('sadmin_id');
                            $this->db->where('sender', $current_user);
                            $this->db->or_where('reciever', $current_user);
                            $message_threads = $this->db->get('message_thread')->result_array();
                            foreach ($message_threads as $row):

                                // defining the user to show
                                if ($row['sender'] == $current_user)
                                    $user_to_show = explode('-', $row['reciever']);
                                if ($row['reciever'] == $current_user)
                                    $user_to_show = explode('-', $row['sender']);
                                $user_to_show_type = $user_to_show[0];
                                $user_to_show_id = $user_to_show[1];
                                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                                if ($unread_message_number == 0)
                                    continue;

                                // the last sent message from the opponent user
                                $this->db->order_by('timestamp', 'desc');
                                $last_message_row = $this->db->get_where('message', array('message_thread_code' => $row['message_thread_code']))->row();
                                $last_unread_message = $last_message_row->message;
                                $last_message_timestamp = $last_message_row->timestamp;
                                ?>
                                <li class="active">
                                    <a href="<?php echo base_url(); ?>sadmin/message/message_read/<?php echo $row['message_thread_code']; ?>">
                                        <span class="image pull-right">
                                            <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $user_to_show_id); ?>" height="48" class="img-circle" />
                                        </span>

                                        <span class="line">
                                            <strong>
                                                <?php echo $this->db->get_where('sadmin', array( 'sadmin_id' => $user_to_show_id))->row()->name.' '.$this->db->get_where('sadmin', array( 'sadmin_id' => $user_to_show_id))->row()->name.' '.$this->db->get_where('sadmin', array( 'sadmin_id' => $user_to_show_id))->row()->name; ?>
                                            </strong>
                                            - <?php echo date("d M, Y", $last_message_timestamp); ?>
                                        </span>

                                        <span class="line desc small">
                                            <!-- preview of the last unread message substring -->
                                            <?php
                                            echo substr($last_unread_message, 0, 50);
                                            ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li class="external">
                        <a href="<?php echo base_url(); ?>sadmin/message">
                            <?php echo get_phrase('view_all_messages'); ?>
                        </a>
                    </li>				
                </ul>
            </li>  <!-- Task Notifications --> <li class="notifications dropdown"> 
<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-list"></i> 
<span class="badge badge-warning">1</span> </a> <ul class="dropdown-menu"> <!-- TS15951386253649: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->
 <li class="top"> <p>You have 6 pending tasks</p> </li> <li> </li> <li class="external"> <a href="#">See all tasks</a> </li>
 <div id="ascrail2003" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; cursor: default; position: 
 absolute; top: 0px; left: -10px; height: 0px; display: none;"><div style="position: relative; 
 0px; float: right; width: 5px; height: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204);
 background-clip: padding-box; border-radius: 1px;"></div></div><div id="ascrail2003-hr" class="nicescroll-rails" style="height: 
 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;"><div style="position: relative; top: 
 0px; height: 5px; width: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-radius: 1px;"></div>
 </div></ul> </li> </ul> </div> <!-- Raw Links --> <div class="col-md-6 col-sm-4 clearfix hidden-xs"> <ul class="list-inline links-list pull-right"> </a> </li>
 <li class="sep"></li>


 <li> <a href="#" data-toggle="chat" data-collapse-sidebar="1"> <i class="entypo-chat"></i>
Chat
<span class="badge badge-success chat-notifications-badge">3</span> </a> </li> <li class="sep"></li> <li> <a href="<?php echo base_url();?>index.php?login/logout">
Log Out <i class="entypo-logout right"></i> </a> </li> </ul> </div> </div>
			<?php if($page_name != 'my_profile'){ ?>

           <h3 style="margin:20px 0px; color:#818da1; font-weight:200;">
           	<i class="entypo-right-circled"></i> 
				<?php echo $page_title;?>
           </h3>
			<?php } ?>
			

			<?php include $account_type.'/'.$page_name.'.php';?>
			

			<?php include 'footer.php';?>

		</div>
		<?php include 'chat.php';?>
        	
	</div>
    <?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>
    
</body>
</html>