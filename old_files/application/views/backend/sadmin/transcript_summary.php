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
		<div class="col-md-12">
			<div class="widget stacked">
				<div class="widget-content">
					<div class="shortcuts">
						<?php if($this->session->userdata('level') == '8' || $this->session->userdata('level') == '1' || $this->session->userdata('level') == '2'){?>
						<a href="<?php echo base_url();?>index.php?sadmin/remita" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id='' data-end="<?php echo $this->db->count_all('`ebsuedu1_etranscript`.`hnd_applicants_form`');?>"
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $this->db->count_all('ebsuedu1_etranscript.hnd_applicants_form');?></div>       
                    
								<h3><?php echo get_phrase('Transcript Applicants');?></h3>
							</span>
						</a>
						
						<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="unpaid" data-end="<?php echo $this->db->where('status', 'Submitted Application'); $this->db->from('`ebsuedu1_etranscript`.`hnd_applicants_form`'); echo $this->db->count_all_results();;?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $this->db->where('status', 'Submitted Application'); $this->db->from('`ebsuedu1_etranscript`.`hnd_applicants_form`'); echo $this->db->count_all_results();;?></div>
						
								<h3><?php echo get_phrase('Pending Applications');?></h3>
							</span>								
						</a>
							<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="unpaid" data-end="<?php echo $this->db->where('status', 'Posted'); $this->db->from('`ebsuedu1_etranscript`.`hnd_applicants_form`'); echo $this->db->count_all_results();;?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $this->db->where('status', 'Posted'); $this->db->from('`ebsuedu1_etranscript`.`hnd_applicants_form`'); echo $this->db->count_all_results();;?></div>
						
								<h3><?php echo get_phrase('Pending Applications');?></h3>
							</span>								
						</a>
						<!--<a href="javascript:;" class="shortcut col-md-2">
							<span class="shortcut-label">
								<div class="num" data-start="0" id="degreeT" data-end="<?php //$this->db->where('programme', '2'); $this->db->from('student'); echo $this->db->count_all_results(); ?><?php echo $this->db->where('service_type', '538814560'); $this->db->from('eduportal_remita_payment'); echo $this->db->count_all_results();;?>" 
								data-postfix="" data-duration="1500" data-delay="0"><?php echo $this->db->where('service_type', '538814560'); $this->db->from('eduportal_remita_payment'); echo $this->db->count_all_results();//$this->db->count_all('eduportal_remita_payment') - $this->db->count_all('eduportal_fees_payment_log'); ?></div>

								<h3><?php echo get_phrase('Hostel Fee Payments');?></h3>
							</span>	
						</a>-->
						<?php } ?>
						
						
					
    
    
</div></div></div></div></div></div>



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
