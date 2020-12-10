<?php


$active_academic_session=$this->db->get_where('erp_memo', array('uploaded_unit_id'=>'1'))->row()->memo_id;
$admitted_students=$this->db->get_where('erp_memo',array('uploaded_unit_id'=>'1'))->num_rows();
//$school_fees_payment=$this->db->query("SELECT * FROM applicationinvoice_gen  WHERE (paymentName='SCHOOL FEE' OR paymentName='PART-TIME SCHOOL FEE') and acadsession='$active_academic_session' AND status='Approved'  ")->num_rows();
//$acceptance_fees_payment=$this->db->query("SELECT * FROM eduportal_remita_accp_temp_data  WHERE session='$active_academic_session' AND status='Approved'  ")->num_rows();
$accounts=$this->db->query("SELECT * FROM sadmin ")->result_array();
$accounts_type=$this->db->query("SELECT * FROM erp_user_roles ")->result_array();
$all_staff=$this->db->query("SELECT * FROM erp_staff ")->num_rows();
$non_academic_staff=$this->db->query("SELECT * FROM erp_staff where staff_type='Non Teaching' ")->num_rows();
$academic_staff=$this->db->query("SELECT * FROM erp_staff where staff_type!='Non Teaching' ")->num_rows();
$sid=$this->session->userdata('sid');

$memodata=$this->db->get_where ('erp_memo_act',array('memo_status'=>'PENDING','send_to_sid'=>$sid))->result_array();

$pending_erp_meetings= $this->db->query("select* from erp_meetings where created_by='$sid' or requested_by='$sid' and (status='Not Commenced' or status='Commenced')")->num_rows();
$pending_erp_meetings_invites= $this->db->query("select* from erp_meetings a, erp_meeting_invitees b where a.meeting_uid=b.meeting_id and (a.created_by='$sid' or a.requested_by='$sid') and (a.status='Not Commenced' or a.status='Commenced')")->num_rows();


$pending_erp_meetings1= $this->db->query("select* from erp_meetings where created_by='$sid' or requested_by='$sid' and (status='Not Commenced' or status='Commenced')")->result_array();
$pending_erp_meetings_invites1= $this->db->query("select* from erp_meetings a, erp_meeting_invitees b where a.meeting_uid=b.meeting_id and (a.created_by='$sid' or a.requested_by='$sid') and (a.status='Not Commenced' or a.status='Commenced')")->result_array();

?>

<?php
	/*
	$this->db->select('*');
	$this->db->from('student');
	$this->db->order_by('id', 'desc');
	$this->db->limit('10');
	
	$s = $this->db->result_array();
	
	var_dump($s);*/
?>

<?php

/*$this->db->select('*');
//$this->db->from('etranzact_payment a,student b');
$this->db->from('student as b');
//$this->db->where('a.customer_id = b.reg_no',NULL,FALSE);
$this->db->where('b.reg_no NOT IN (SELECT a.customer_id FROM etranzact_payment a)', NULL, FALSE);
//$this->db->where('a.idno',$reg_no);
$unpaid = $this->db->get()->num_rows();
$manual = $this->db->count_all('manual_etranzact');

$total = $unpaid - $manual;*/

?>
<style type="text/css">
	.num{
		font-weight:bold;
		font-family:'Roboto-Light';
		font-size:40px;
	}
	.shortcut h3{
		font-size:18px;
	}
	.widget .table-bordered{
		border:1px solid #ebebeb;
	}
	.widget .table-bordered thead{
		background:gold !important;
		/*background: -moz-linear-gradient(top, #eeeeee 0%, #dadada 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #eeeeee), color-stop(100%, #dadada));
		background: -webkit-linear-gradient(top, #eeeeee 0%, #dadada 100%);
		background: -o-linear-gradient(top, #eeeeee 0%, #dadada 100%);
		background: -ms-linear-gradient(top, #eeeeee 0%, #dadada 100%);
		background: linear-gradient(top, #eeeeee 0%, #dadada 100%);
		-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#EEEEEE', endColorstr='#DADADA')";
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#EEEEEE', endColorstr='#DADADA');*/
	}
</style>
<div class="row"> <a href="<?php echo base_url().'index.php?sadmin/send_all_memo';?>">
<div class="col-sm-3 col-xs-6"> 
         <div class="tile-stats tile-red"> 
		 <div class="icon"><i class="entypo-users"></i></div>
		 <div class="num" data-start="0" data-end="<?php 
		 
		 echo $this->db->query("SELECT * FROM erp_memo_act where memo_initiator_sid='$sid'")->num_rows();?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $this->db->query("SELECT * FROM erp_memo_act where memo_initiator_sid='$sid'")->num_rows();?></div> <h3>Sent Memos</h3> 
		 <p>Displays a list of your Sent Memos</p> 
		 </div> 
</div></a> <a href="<?php echo base_url().'index.php?sadmin/memos/VIEW_PENDING_MEMO';?>">
		 <div class="col-sm-3 col-xs-6"> 
		 <div class="tile-stats tile-green"> 
		 <div class="icon"><i class="entypo-chart-bar"></i></div> 
		 <div class="num" data-start="0" data-end="<?php 
		 
		 echo $this->db->query("SELECT * FROM erp_memo_act where send_to_sid='$sid' and memo_status='PENDING'")->num_rows();?>" data-postfix="" data-duration="1500" data-delay="600"><?php 
		 
		 echo $this->db->query("SELECT * FROM erp_memo_act where send_to_sid='$sid' and memo_status='PENDING'")->num_rows();?></div> <h3>Received Memos</h3> 
		 <p>Displays a list of your Received Memos</p> 
		 </div> 
</div> </a>
<a href="<?php echo base_url().'index.php?sadmin/view_meetings';?>">
		 <div class="clear visible-xs"></div> 
		 <div class="col-sm-3 col-xs-6"> 
		 <div class="tile-stats tile-aqua"> 
		 <div class="icon"><i class="entypo-mail"></i></div> 
		 <div class="num" data-start="0" data-end="<?php 
		 
if(!$pending_erp_meetings)
{
		echo $pending_erp_meetings_invites;
}else{echo $pending_erp_meetings;}
		 ?>" data-postfix="" data-duration="1500" data-delay="1200"><?php 
		 
		 	
if(!$pending_erp_meetings)
{
		echo $pending_erp_meetings_invites;
}else{echo $pending_erp_meetings;}
		 ?></div> <h3>Meetings</h3> 
		 <p>Displays a list of your Meetings</p> 
		 </div> 
</div></a> <a href="<?php echo base_url().'index.php?sadmin/view_track_files';?>">
         <div class="col-sm-3 col-xs-6"> 
		 <div class="tile-stats tile-blue"> 
		 <div class="icon"><i class="entypo-rss"></i></div> 
		 <div class="num" data-start="0" data-end="<?php 
		 
		 echo $this->db->query("select* from erp_documents where addressed_to_id='$sid' or uploaded_by='$sid' or waiting_approval_by='$sid'")->num_rows();?>" data-postfix="" data-duration="1500" data-delay="1800"><?php 
		 
		 echo $this->db->query("select* from erp_documents where addressed_to_id='$sid' or uploaded_by='$sid' or waiting_approval_by='$sid'")->num_rows();?></div> <h3>Files/Repository</h3> 
		 <p>List files that you are have access to.</p> 
		 </div> 
</div> </a>
   </div>

<div class="row"> 
 <div class="col-sm-12">
 <div class="well"> <h1><?php echo $today = date("F j, Y");?></h1> <h3>Welcome to the site <strong><?php echo ucwords($this->session->userdata('name'));?></strong></h3> </div>
 </div> 
</div>


		<div class="col-md-6">
			<div class="widget stacked">
					
				
				
			<div class="widget-content">
					
					<table class="table table-bordered mytable">
						<div class="widget-header">
					<i class="icon-check"></i>
					<h3>Recent Meetings </h3>
				</div> <!-- /widget-header --><a href="<?php echo base_url().'index.php?sadmin/view_meetings';?>" class="btn btn-success">
											View All Meeting										
									</a>
						<thead>
							<tr>
								<th>S/N</th>
								<th>Meeting Time</th>
								<th class="td-actions">Agenda</th>
								<th class="td-actions">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							 $id;
$meetings= $pending_erp_meetings1;
if(!$pending_erp_meetings)
{
	$meetings= $pending_erp_meetings_invites1;
}$id=1;
							foreach($meetings as $row):?>
							<tr>
							<td><?php echo $id;?></td>
								<td><?php echo $row['meeting_agenda'];?></td>
								<td><?php echo $row['time_from'].' '.$row['time_to'];?></td>
								<td class="td-actions">
								<?php if($pending_erp_meetings)

{?>
								<a href="<?php echo base_url().'index.php?sadmin/start_meeting/'.$row['meeting_uid'];?>" class="btn btn-success">
											Start Meeting										
									</a>
<?php } else {?>
<a href="<?php echo base_url()."index.php?sadmin/startvirtualmeetings/".$row['meeting_uid'];?>" class="btn btn-success">
											Join Meeting										
									</a>
									
<?php }?>
								</td>
								<td></td>
							</tr>
							<?php $id++;
							endforeach;?>
						</tbody>
					</table>
					
				</div> <!-- /widget-content -->
				
					
			<div class="widget-content">
					
					<table class="table table-bordered mytable datatable" id="table_export">
						<div class="widget-header">
							<a href="<?php echo base_url();?>index.php?sadmin/add_new_user_account">
					<button type="button" class="btn btn-success">ADD NEW USER ACCOUNT</button>
						</a>
					<i class="icon-check"></i>
					<h3>List of System User Type</h3>
				</div> <!-- /widget-header -->
						<thead>
							<tr>
								<th>S/N</th>
								<th>User Role Id</th>
								<th>User Type</th>
								<th class="td-actions">Action</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							  $sn;
							foreach($accounts_type as $user_role):
							
							?>
							<tr>
								<td><?php echo $sn?></td>
								<td><?php echo $user_role['user_role_id'];?></td>
								<td><?php echo $user_role['user_type'];?></td>
							<td><a href="index.php?sadmin/edituser_type/<?php echo  $user_role['user_role_id'];?>" class="btn btn-danger btn-sm " >
                       Edit
                     </a>| <a href="index.php?sadmin/delete_usertype/<?php echo $user_role['user_role_id'];?>" class="btn btn-success btn-sm "  onclick="checkdel()">
                        Delete  </a></td>
							</tr>
							<?php
  $sn++;
							endforeach;?>
						</tbody>
					</table>
					
				</div> <!-- /widget-content -->
			</div>
		</div>
		<div class="col-md-6">
			<div class="widget stacked widget-table">
					
				<div class="widget-header">
					<button type="button" class="btn btn-danger">ATTENTION!</button>
					<h3>Pending Memo for Action</h3>
				</div> <!-- /widget-header -->
				<br />
				<div class="widget-content">
					
					<table class="table table-bordered mytable">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Memo Subject</th>
								<th>Sender</th>
								<th>Sender Department</th>
								<th>Memo Date</th>
								<th class="td-actions">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sn=0;
							
							foreach($memodata as $memo):
							$sn++;?>
							<tr>
								<td><?php echo $sn;?></td>
								<td><?php echo $memo['memo_title'];?></td>
								<td><?php echo $staff_name=$this->db->get_where('sadmin',array('sadmin_id'=>$memo['memo_initiator_sid']))->row()->name;?></td>
								<td><?php echo $dept_name=$this->db->get_where('department',array('deptID'=>$memo['initiator_dept_id']))->row()->deptName;?></td>
								<td><?php echo $memo['memo_date'];?></td>
								<td><a href="index.php?sadmin/memos/REPLY_MEMO_DETAILS/<?php echo $memo['id'];?>/<?php echo $memo['memo_tracking_id'];?>" class="btn btn-info btn-sm " style="margin-left: 7px">Reply |  </a></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					
				</div> <!-- /widget-content -->
			
			</div> 
			<?php if($this->session->userdata('level') == '8' || $this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '2'){?>
			<div class="widget widget-nopad stacked">
						
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>Recent News on the Ministry Notice Board</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<ul class="news-items">
						<li>
							
							<div class="news-item-detail">										
								<a href="javascript:;" class="news-item-title">Duis aute irure dolor in reprehenderit</a>
								<p class="news-item-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
							</div>
							
							<div class="news-item-date">
								<span class="news-item-day">08</span>
								<span class="news-item-month">Mar</span>
							</div>
						</li>
					</ul>
					
				</div> <!-- /widget-content -->
			
			</div>
			
		
			
		
			
			
			<div class="widget stacked widget-table">
					
				<div class="widget-header">
					<i class="icon-info-sign"></i>
					<h3>Staff Nominal Roll Analysis</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<table class="table table-bordered mytable">
						<thead>
							<tr>
								
								<th>Staff Type</th>
								<th class="td-actions">Total on Roll</th>
								<th class="td-actions">Action</th>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<td><?php echo 'ALL STAFF';?></td>
								<td><?php echo $all_staff;?></td>
								<td class="td-actions">
									<a href="index.php?sadmin/staff/<?php echo  'ALL_STAFF';?>" class="btn btn-success btn-sm " >
                       View Detailed Records
                     </a>
								</td>
							</tr>
							<tr>
								<td><?php echo 'CLERK';?></td>
								<td><?php echo $academic_staff;?></td>
								<td class="td-actions">
									<a href="index.php?sadmin/edituser_type/<?php echo  'ACADEMIC_STAFF';?>" class="btn btn-success btn-sm " >
                       View Detailed Records
                     </a>
								</td>
							</tr>
							<tr>
								<td><?php echo 'MESSENGERS';?></td>
								<td><?php echo $non_academic_staff;?></td>
								<td class="td-actions">
									<a href="index.php?sadmin/edituser_type/<?php echo  'NON_ACADEMIC_STAFF';?>" class="btn btn-success btn-sm " >
                       View Detailed Records
                     </a>
								</td>
							</tr>
							
						</tbody>
					</table>
					
				</div> <!-- /widget-content -->
			
			</div>
			<?php } ?>
		</div>
		
		<div class="widget stacked widget-table">
					
				
				
			
			</div> 
	</div>
    
    
</div>



    <script>
  $(document).ready(function() {
      
      var calendar = $('#notice_calendar');
                
                $('#notice_calendar').fullCalendar({
                    header: {
                        left: 'title',
                        right: 'today prev,next'
                    },
                    
                    //defaultView: 'basicWeek',
                    
                    editable: false,
                    firstDay: 1,
                    height: 530,
                    droppable: false,
                    
                    events: [
                        <?php 
                       // $notices    =   $this->db->get('noticeboard')->result_array();
                        //foreach($notices as $row):
                        ?>
                        {
                            title: "<?php //echo $row['notice_title'];?>",
                            start: new Date(<?php //echo date('Y',$row['create_timestamp']);?>, <?php //echo date('m',$row['create_timestamp'])-1;?>, <?php //echo date('d',$row['create_timestamp']);?>),
                            end:    new Date(<?php //echo date('Y',$row['create_timestamp']);?>, <?php //echo date('m',$row['create_timestamp'])-1;?>, <?php //echo date('d',$row['create_timestamp']);?>) 
                        },
                        <?php 
                       // endforeach
                        ?>
                        
                    ]
                });
    });
  </script>



<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function(){
    $.ajax({
    url: "<?php echo base_url().'index.php?admin/display';?>",
    type: 'POST',
    dataType : 'json',
    //data: {name: result},
    success: function(res) {
    if (res)
    {
    console.log('PASSED');
    jQuery("div#etti").html(res.name);
    }
    },
    error : function () {
        console.log('failure');
    }
})

},10);
});
</script>



<script type="text/javascript">
$(document).ready(function() {
      //var querydb = $("form").serialize();
    $.ajax({
    url: "<?php echo base_url().'index.php?admin/display_un';?>",
    type: 'POST',
    dataType : 'json',
    //data: {name: result},
    success: function(res) {
    if (res)
    {
    console.log('PASSED');
    jQuery("div#unpaid").html(res.name);
    }
    },
    error : function () {
        console.log('failure');
    }
});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $.ajax({
    url: "<?php echo base_url().'index.php?admin/nce';?>",
    type: 'POST',
    dataType : 'json',
    success: function(res) {
    if (res)
    {
    console.log('PASSED');
    jQuery("div#nceT").html(res.name);
    }
    },
    error : function () {
        console.log('failure');
    }
});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $.ajax({
    url: "<?php echo base_url().'index.php?admin/degree';?>",
    type: 'POST',
    dataType : 'json',
    success: function(res) {
    if (res)
    {
    console.log('PASSED');
    jQuery("div#degreeT").html(res.name);
    }
    },
    error : function () {
        console.log('failure');
    }
});
});
</script>
