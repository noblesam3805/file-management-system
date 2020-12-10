<?php

//$old = $this->db->count_all('etranzact_payment');
//$new = $this->db->count_all('eduportal_fee_payment');

//$paid = $old + $new;


/*$this->db->select('*');
$this->db->from('student as b');
//$this->db->where('a.customer_id = b.reg_no',NULL,FALSE);
$this->db->where('b.reg_no IN (SELECT a.customer_id FROM etranzact_payment a)', NULL, FALSE);
//$this->db->where('a.idno',$reg_no);
$query = $this->db->get()->num_rows();/

$this->db->where('whatever',);
$num = $this->db->count_all_results('table');*/

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
		<div class="col-md-6">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-check"></i>
					<h3>Event Schedule</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					<div class="calendar-env">
						<div class="calendar-body">
							<div id="notice_calendar"></div>
						</div>
					</div>
				</div>
			</div>
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
					
					editable: true,
					firstDay: 1,
					height: 530,
					droppable: true,
					
					events: [
						<?php 
						$notices	=	[];//$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});