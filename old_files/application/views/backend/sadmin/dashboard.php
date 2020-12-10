<?php

$active_academic_session=$this->db->get_where('academic_session', array('status'=>'active'))->row()->academic_session;
$admitted_students=$this->db->get_where('eduportal_admission_list',array('session'=>$active_academic_session))->num_rows();
$school_fees_payment=$this->db->query("SELECT * FROM applicationinvoice_gen  WHERE (paymentName='SCHOOL FEE' OR paymentName='PART-TIME SCHOOL FEE') and acadsession='$active_academic_session' AND status='Approved'  ")->num_rows();
$acceptance_fees_payment=$this->db->query("SELECT * FROM eduportal_remita_accp_temp_data  WHERE session='$active_academic_session' AND status='Approved'  ")->num_rows();

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

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="widget stacked">
				<div class="widget-content">
					<div class="shortcuts">
						<?php if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '2'){?>
						<a class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id='etti' data-end=""
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $admitted_students; ?></div>       
                    
								<h3><?php echo get_phrase('admitted students '.$active_academic_session);?></h3>
							</span>
						</a>
						
						<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="unpaid" data-end="" 
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $school_fees_payment?></div>
						
								<h3><?php echo get_phrase('School Fees '.$active_academic_session);?></h3>
							</span>								
						</a>
						<?php } ?>
						
						<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" data-end="" 
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $acceptance_fees_payment;?></div>
                    
								<h3><?php echo get_phrase('Acceptance Fees '.$active_academic_session);?></h3>
							</span>	
						</a>
						<?php if($this->session->userdata('level') != '5'){?>
						<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="nceT" data-end="<?php $this->db->where('programme_type_id', '1');$this->db->where('session', $active_academic_session);$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '1');$this->db->where('session', $active_academic_session);$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>
                    
								<h3><?php echo get_phrase('ND FT Students '.$active_academic_session);?></h3>
							</span>	
							<!--div class="row">
								<div class="co-sm-2">	0	
								<div class="co-sm-2">	0							
								</div>						
								</div>
								
							</div-->
						</a>
						<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php $this->db->where('programme_type_id', '4');$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '4'); $this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>

								<h3><?php echo get_phrase('HND FT Students '.$active_academic_session);?></h3>
							</span>	
						</a>
						<hr>
							<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php $this->db->where('programme_type_id', '2');$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '2'); $this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>

								<h3><?php echo get_phrase('ND PT Students '.$active_academic_session);?></h3>
							</span>	
						</a>
								<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php $this->db->where('programme_type_id', '5');$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '5'); $this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>

								<h3><?php echo get_phrase('HND PT Students '.$active_academic_session);?></h3>
							</span>	
						</a>
									<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php $this->db->where('programme_type_id', '3');$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '3'); $this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>

								<h3><?php echo get_phrase('BSC FT Students '.$active_academic_session);?></h3>
							</span>	
						</a>
								<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php $this->db->where('programme_type_id', '7');$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '7'); $this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>

								<h3><?php echo get_phrase('BSC PT Students '.$active_academic_session);?></h3>
							</span>	
						</a>
								<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php $this->db->where('programme_type_id', '6');$this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php $this->db->where('programme_type_id', '6'); $this->db->where('session', $active_academic_session); $this->db->from('eduportal_admission_list'); echo $this->db->count_all_results(); ?></div>

								<h3><?php echo get_phrase('CERTIFICATE Students '.$active_academic_session);?></h3>
							</span>	
						</a>
						<?php } ?>

				
					</div> <!-- /shortcuts -->	
				
				</div> <!-- /widget-content -->
				
			</div> 
		</div>
		<div class="col-md-6">
			<div class="widget stacked">
					
				
				
			<div class="widget-content">
					
					<table class="table table-bordered mytable">
						<div class="widget-header">
					<i class="icon-check"></i>
					<h3>Recent News from the College Management</h3>
				</div> <!-- /widget-header -->
						<thead>
							<tr>
								<th>S/N</th>
								<th>Meeting Date</th>
								<th class="td-actions">Agenda</th>
								<th class="td-actions">Download</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($etz as $row):?>
							<tr>
								<td><?php echo $row['description'];?></td>
								<td><?php echo $row['payment_confirmation_date'];?></td>
								<td class="td-actions">
									<a href="javascript:;">
										<?php echo $row['payee_id'];?>										
									</a>
								</td>
								<td></td>
							</tr>
							<?php endforeach;?>
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
							
							foreach($reg as $row):
							$sn++;?>
							<tr>
								<td><?php echo $sn;?></td>
								<td><?php echo $row['reg_no'];?></td>
								<td class="td-actions">
									<a href="javascript:;">
										<?php echo $row['date_reg'];?> 										
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					
				</div> <!-- /widget-content -->
			
			</div> 
			<?php if($this->session->userdata('level') == '3' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '2'){?>
			<div class="widget widget-nopad stacked">
						
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>Recent News from the College Management</h3>
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
					<h3>Recent Minute from Management Meeting</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<table class="table table-bordered mytable">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Meeting Date</th>
								<th class="td-actions">Agenda</th>
								<th class="td-actions">Download</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($etz as $row):?>
							<tr>
								<td><?php echo $row['description'];?></td>
								<td><?php echo $row['payment_confirmation_date'];?></td>
								<td class="td-actions">
									<a href="javascript:;">
										<?php echo $row['payee_id'];?>										
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					
				</div> <!-- /widget-content -->
			
			</div>
			<?php } ?>
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
