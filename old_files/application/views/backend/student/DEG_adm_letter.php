<?php
$name = $this->db->get_where('eduportal_admission_list', array("application_no" => $_SESSION["application_no"]))->row();
$dept_id = $name->dept_id;
$dept = $this->db->get_where('department', array("deptID" => $dept_id))->row();//Department
$option = $this->db->get_where('dept_options', array("dept_option_id" => $name->dept_option_id))->row();//Department option

?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide{display:none !important;}ng\:form{display:block;}</style>



        <meta charset="utf-8">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1.0">



	<meta name="description" content="Nigerian Higher Education">



	<meta name="author" content="Sunday Okoi">







        <title>Pre - HND | Admission Letter</title>







        <style>.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }.file-input-name { margin-left: 8px; }</style><link href="Pre%20-%20HND%20_%20Admission%20Letter_files/style.css" rel="stylesheet">



		<link href="Pre%20-%20HND%20_%20Admission%20Letter_files/me.css" rel="stylesheet">



        <link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/jquery-ui-1.css">



        <link href="Pre%20-%20HND%20_%20Admission%20Letter_files/morris.css" rel="stylesheet">



        <link href="Pre%20-%20HND%20_%20Admission%20Letter_files/select2.css" rel="stylesheet">



		<link href="Pre%20-%20HND%20_%20Admission%20Letter_files/style_002.css" rel="stylesheet">



        <link rel="shortcut icon" href="http://162.144.134.70/eduportal/prehnd/assets/images/favicon.png">



        	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/entypo.css">



	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/css.css">



	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/bootstrap.css">



	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-core.css">



	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-theme.css">



	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-forms.css">

	

	<!-- My Styles -->

	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/eduportal-fullpage-style.css">

	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/base-admin.css">

	

	





    <!-- CSS LINKS-->



		<link rel="stylesheet" type="text/css" href="Pre%20-%20HND%20_%20Admission%20Letter_files/basic.css">

		<link rel="stylesheet" type="text/css" href="Pre%20-%20HND%20_%20Admission%20Letter_files/icons.css">



		<link rel="stylesheet" type="text/css" href="Pre%20-%20HND%20_%20Admission%20Letter_files/bootstrap_002.css">



        <script src="Pre%20-%20HND%20_%20Admission%20Letter_files/jquery-1.js"></script>



		<script type="text/javascript" src="Pre%20-%20HND%20_%20Admission%20Letter_files/me.js"></script>

		<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/ajaxScript.js"></script>

		

		

        

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

	

    </head>

    <body class="loaded">

        <div class="document">

			<div class="content-row">

				


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

	.foreign-form{

		display:none;

	}

	.country-line{

		padding:5px;

		background:#DEDEDE;

		margin:20px 0 0 10px;

		border:1px solid #999999;

		box-shadow:1px 1px 1px #DEDEDE;

	}

	.country-line span{

		color:#CB4A18;

		font-size:19px;

		margin-left:10px;

	}

	.country-line h5{

		margin:5px 0;

	}

	.letter p{

		margin:18px 0px;

	}

	.letter .tip{

		font-family:'Lato-Bold';

	}

	.widget .widget-content{

		border:none;

	}

</style>



<div class="print_page">

	<div class="col-md-12">

		<div class="widget">

			<div class="widget-content" style="padding:10px 20px;">

				<div class="col-md-12 receipt-head">

					<div align="center"><h2>EBONYI STATE UNIVERSITY</h2>

					<h4>P.M.B 53, ABAKALIKI, EBONYI STATE, NIGERIA</h4>

					<p><em>Office Of The Registrar</em></p></div>

					<div class="col-md-12 no-p" style="margin-top:10px">

						<div style="text-align:left; float:left; width:33%;">

							<h4>Registrar</h4>

							<h3 style="line-height:17px">Mrs. Bibian N. Nwokwu</h3>

							<h6><em>B.Sc(ESUT), MBA(EBSU)</em> </h6>

						</div>

						<div style="float:left; width:33%;">

							<img src="<?php echo base_url(); ?>assets/images/ebsulogo2.png" width="100" height="100" />

							<p>&nbsp;</p>

						</div>

						<div style="float:left; width:33%;">

							

							<h5>&nbsp;</h5>

							<p>&nbsp;</p>

						</div>

						

					</div>

					<div class="col-md-12 no-p" style="margin-top:10px">

						<div style="text-align:left; float:left; width:66%">

							<h5 style="width:100%;">Our Ref: <strong class="tip">EBSU/RG/18/XLVII/55</strong></h5>

							<h5 style="width:100%;">Your Ref: .................................</h5>

						</div>

						<div style="float:left; width:33%;">

							<h5 style="width:100%;">Date: <?php echo date("d/m/y"); ?></h5>

							<h5>&nbsp;</h5>

						</div>

					</div>

					<div class="col-md-12" style="text-align:left; margin-top:15px;">

						<div class="col-md-12 letter">

							<h4>To: <?php echo $name->firstname." ".$name->middlename." ".$name->surname; ?></h4>

							<h4>Re - Jamb Registration No: <?php echo $_SESSION["application_no"]; ?></h4>

							<h3 style="margin-top:25px;"><strong class="tip">OFFER OF PROVISIONAL ADMISSION</strong></h3>

							<p>I am pleased to inform you that you have been offered provisional Ebonyi State University, Abakaliki.</p>

							<p><strong class="tip">PROGRAMME:</strong> DEGREE</p>

							<p><strong class="tip">DEPARTMENT:</strong> <?php echo $dept->deptName;if($option){ echo "(".$option->dept_option_name.")";} //?></p>
						
							<p><strong class="tip">ADMISSION MODE: </strong> <?php if($name->adm_type=="1"){ echo "MERIT";}
	  elseif($name->adm_type=="2"){ echo "SUPPLEMENTARY";}
	   elseif($name->adm_type=="3"){ echo "DIRECT ENTRY";}
	  ?></p>

						

							<p><strong class="tip">SESSION:</strong> <?php echo $name->session;?></p>

							<p>You are required to accept this offer by prompt payment of an 
acceptance fee of N25,050 (Twenty Five Thousand and Fifty Naira) on <strong class="tip">Remita
 Platform</strong> at any bank of your choice (Nationwide) within two weeks or have the admission forfeited.</p>
<p><strong class="tip">For futher details on payment procedure/process, log unto www.ebsu.edu.ng.</strong></p>

						  <p>You should proceed with your documents to the School Office where you will be issued with Registration materials and authorization paper to pay school fees.</p>
							<p>Registration must be completed within one month of acceptance of offer of admission. The admission lapses upon non compliance with this time duration.</p>
<p>Please, note that if any disparity is subsequently discovered 
  on relevant educational qualification which you claimed, you will be 
required to withdraw from the institution.</p>

							<p>Congratulations!</p>

							<p>Welcome to Ebonyi State University and say <strong class="tip">No</strong> to Cultism.</p>

							<h4 class="tip"><br>Mrs. Bibian N. Nwokwu
							<p>
							<img src="<?php echo base_url(); ?>assets/images/registrarsign.jpg" /></p>
						   <b>REGISTRAR</b> </h4>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
			</div>

			
 
    
    

	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/datatables.css">
	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/select2-bootstrap.css">
	<link rel="stylesheet" href="Pre%20-%20HND%20_%20Admission%20Letter_files/select2_002.css">

   	<!-- Bottom Scripts -->
   	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/angular.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/ui-bootstrap-tpls-0.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/app.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/main-gsap.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/jquery-ui-1.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/bootstrap.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/joinable.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/resizeable.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-api.js"></script>
    <script src="Pre%20-%20HND%20_%20Admission%20Letter_files/jquery.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/fullcalendar.js"></script>
    <script src="Pre%20-%20HND%20_%20Admission%20Letter_files/bootstrap-datepicker.js"></script>
    <script src="Pre%20-%20HND%20_%20Admission%20Letter_files/fileinput.js"></script>
    
    
    <script src="Pre%20-%20HND%20_%20Admission%20Letter_files/jquery_002.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/TableTools.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/dataTables.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/jquery_003.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/lodash.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/datatables.js"></script>
    <script src="Pre%20-%20HND%20_%20Admission%20Letter_files/select2.js"></script>
    
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-calendar.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-chat.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-custom.js"></script>
	<script src="Pre%20-%20HND%20_%20Admission%20Letter_files/neon-demo.js"></script>

    
<script type="text/Javascript">	
	$(document).ready(function(){

		var controller = 'sadmin';
		var base_url = 'http://162.144.134.70/eduportal/prehnd/index.php';
		
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
        </div>

    





</body></html>