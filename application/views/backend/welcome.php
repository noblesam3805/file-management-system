<?php
$login_details=$this->db->get_where('sadmin',array('sadmin_id'=>$this->session->userdata('sadmin_id')))->row();
$sid=$login_details->sadmin_id;

$pending_memos=$this->db->query("SELECT * FROM erp_memo_act where send_to_sid='$sid' and memo_status='PENDING'")->num_rows();
$pending_files= $this->db->query("select* from erp_documents where waiting_approval_by='$sid'")->num_rows();
$pending_erp_meetings= $this->db->query("select* from erp_meetings where created_by='$sid' or requested_by='$sid' and (status='Not Commenced' or status='Commenced')")->num_rows();
$pending_erp_meetings_invites= $this->db->query("select* from erp_meetings a, erp_meeting_invitees b where a.meeting_uid=b.meeting_id and (a.created_by='$sid' or a.requested_by='$sid' or b.invitee_id='$sid') and (a.status='Not Commenced' or a.status='Commenced')")->num_rows();
//echo $pending_erp_meetings_invites;
//echo $sid;
?>
<!doctype html><html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
   <?php

	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;

	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;

	?>

		<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>

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
	<script type="text/javascript">
	function notify()
	{
		document.getElementById("trignotify").click();
		
	}
	</script>
	
		<?php include 'includes_top.php';?>
		</head>
		<body class="page-body skin-blue loaded" <?php if($pending_memos>0 || $pending_files>0 || $pending_erp_meetings>0 || $pending_erp_meetings_invites>0){?>onload="notify();"<?php }?>>
		<div class="col-md-12 eduportal-topbar">
			<div class="edu-main-content">
				<?php include 'header.php';?>
			</div>
		</div>
	<div class=""> 
 <div class="col-sm-12">
 <div class="well"> <h1><?php echo $today = date("F j, Y");?></h1> <h3>Welcome <strong><?php echo ucwords($this->session->userdata('name'));?></strong></h3> </div>
 </div> 
</div>
			<div class="page-container eduportal-page " >
<div class=""> <a href="<?php echo base_url() . 'index.php?sadmin/dashboard'; ?>">
<br/>
<div class="col-sm-4 col-xs-8" > 
         <div class="tile-stats " style="background: #fff;"> 
		 <div class="icon"><img src="homepage/public/assets/images/civilservant.png" alt="" class="img-fluid" style="width: 80%;"></div>
		<h3 style="color: #000"><br/><br/><br/> <br/><br/></h3> 
		 <p></p> 
		 </div> 
</div></a> 



<a href="<?php echo base_url() . 'index.php?sadmin/dashboard'; ?>">
<br/>
<div class="col-sm-4 col-xs-8" > 
         <div class="tile-stats " style="background: #fff;"> <br/>
		 <div class="icon"><img src="homepage/public/assets/images/admin.png" alt="" class="img-fluid" style="width: 80%;"></div>
		<h3 style="color: #000"><br/><br/><br/> <br/><br/></h3> 
		 <p></p> 
		 </div> 
</div></a> 
<a href="<?php echo base_url() . 'index.php?sadmin/view_meetings'; ?>">
<br/>
<div class="col-sm-4 col-xs-8" > 
         <div class="tile-stats " style="background: #fff;"> 
		 <div class="icon"><img src="homepage/public/assets/images/meeting.jpeg" alt="" class="img-fluid" style="width: 80%;"></div>
		<h3 style="color: #000"><br/><br/><br/> <br/><br/></h3> 
		 <p></p> 
		 </div> 
</div></a>
   </div>

<button
       data-toggle="modal" data-target="#notify"
       class="btn btn-warning" style="margin-top:10px; display: none;" id="trignotify" >Trigger Notifications</button>
      
      <!-- Modal -->
<div id="notify" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notifications</h4>
      </div>
      <div class="modal-body">
      <span style="font-size: 25px;">Welcome Back <?php echo ucwords(strtolower($this->session->userdata('name')));?></span></br></br></br>
	   <a href="<?php echo base_url().'index.php?sadmin/memos/VIEW_PENDING_MEMO';?>">
		 <div class="col-sm-3 col-xs-6"> 
		 <div class="tile-stats tile-green"> 
		 <div class="icon"><i class="entypo-chart-bar"></i></div> 
		 <div class="num" data-start="0" data-end="<?php 
		 
		 echo $this->db->query("SELECT * FROM erp_memo_act where send_to_sid='$sid' and memo_status='PENDING'")->num_rows();?>" data-postfix="" data-duration="1500" data-delay="600"><?php 
		 
		 echo $this->db->query("SELECT * FROM erp_memo_act where send_to_sid='$sid' and memo_status='PENDING'")->num_rows();?></div> <h3>Received Memos</h3> 
		
		 </div> 
</div> </a>

<a href="<?php echo base_url().'index.php?sadmin/view_meetings';?>">
		 <div class="clear visible-xs"></div> 
		 <div class="col-sm-3 col-xs-6"> 
		 <div class="tile-stats tile-aqua"> 
		 <div class="icon"><i class="entypo-mail"></i></div> 
		 <div class="num" data-start="0" data-end="<?php 
			echo $pending_erp_meetings;
if(!$pending_erp_meetings)
{
		echo $pending_erp_meetings_invites;
}
		?>" data-postfix="" data-duration="1500" data-delay="1200"><?php 
		 
		 	echo $pending_erp_meetings;
if(!$pending_erp_meetings)
{
		echo $pending_erp_meetings_invites;
}
		 ?></div> <h3>Meeting Invites</h3> 
		 
		 </div> 
</div></a>

<a href="<?php echo base_url().'index.php?sadmin/view_track_files';?>">
         <div class="col-sm-3 col-xs-6"> 
		 <div class="tile-stats tile-blue"> 
		 <div class="icon"><i class="entypo-rss"></i></div> 
		 <div class="num" data-start="0" data-end="<?php 
		 
		 echo $this->db->query("select* from erp_documents where waiting_approval_by='$sid'")->num_rows();?>" data-postfix="" data-duration="1500" data-delay="1800"><?php 
		 
		 echo $this->db->query("select* from erp_documents where waiting_approval_by='$sid'")->num_rows();?></div> <h3>Untreated Files</h3> 
		 
		 </div> 
</div> </a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 </p></p></p></p>
 <p  style="width:500px; height:auto; margin-bottom:0px; margin-left:20px; position:fixed; color: #fff;bottom:0px; background-color: #eee">© <?php echo date("Y")." "; echo $system_name;?> <br/><img class="img-responsive" src="images/cropped-Webp.net-resizeimage-4-1.png" alt="powered by " /></p>
</div></div></div></div></div><!-- JAVASCRIPT -->
        <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" style="height:25px;" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" >
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delta State Infrastructural Desktop Solution</h4>
                </div>
                
                <div class="modal-body" style="height:500px; overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url , post_refresh_url)
	{
		$('#preloader-delete').html('');
		jQuery('#modal_delete').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute("onClick" , "delete_data('" + delete_url + "' , '" + post_refresh_url + "')" );
		document.getElementById('delete_link').focus();
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal_delete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                	<span id="preloader-delete"></span>
                    </br>
                	  <button type="button" class="btn btn-danger" id="delete_link" onClick="">Delete</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="delete_cancel_link">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>       
    
    

	<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="assets/js/select2/select2.css">

   	<!-- Bottom Scripts -->
   	<script src="assets/js/angular.min.js"></script>
	<script src="assets/js/ui-bootstrap-tpls-0.10.0.min.js"></script>
	<script src="assets/js/app/app.js"></script>
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/fileinput.js"></script>
    
   
	<script src="assets/js/bootstrap-timepicker.min.js" id="script-resource-13"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatables/TableTools.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="assets/js/datatables/lodash.min.js"></script>
	<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
    <script src="assets/js/select2/select2.min.js"></script>
    
	<script src="assets/js/neon-calendar.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

 <script src="assets/js/gsap/TweenMax.min.js" id="script-resource-1"></script>
 
 <script src="assets/js/cookies.min.js" id="script-resource-7"></script>
 <script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js" id="script-resource-8">
 </script> 
 <script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js" id="script-resource-9">
 </script> 
 <script src="assets/js/jquery.sparkline.min.js" id="script-resource-10"></script> 
 <script src="assets/js/rickshaw/vendor/d3.v3.js" id="script-resource-11"></script> 
 <script src="assets/js/rickshaw/rickshaw.min.js" id="script-resource-12"></script> 
 <script src="assets/js/raphael-min.js" id="script-resource-13"></script> 
 <script src="assets/js/morris.min.js" id="script-resource-14"></script> 
 <script src="assets/js/toastr.js" id="script-resource-15"></script>
    
<script type="text/Javascript">	
	$(document).ready(function(){

		var controller = 'sadmin';
		var base_url = 'http://localhost/DeltaMemoMgt/index.php';
		
		function showEditForm(a){
			$.ajax({
			type:"post",
			url:base_url + '?' + controller + '/do_ajax/edit/' + a,
			data:{'type' : 'value'},
			success:function(data){
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$("#editResult").html(data);
				document.getElementById('result').innerHTML = '';
				
				//$("#search").val("");
			 }
		  });
		}
	});
</script>




<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script> 
 </body>

</html>

				
					