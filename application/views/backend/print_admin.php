<!DOCTYPE html>
<?php $this->crud_model->clear_cache(); ?>
<html lang="en">

    <head>

        <meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />




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



    <style>

        body{

          color:#000000;

        }

        @media print

          body{

             background:url('images/alvan.png');

             no-repeat;

          }

    </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>

        <script src="js/html5shiv.js"></script>

        <script src="js/respond.min.js"></script>

        <![endif]-->

        <!-- My added javascript -->

		<script type="text/javascript" src="js/me.js"></script>



        <script>

function printDiv() {

     var printContents = document.getElementById('print').innerHTML;

     var originalContents = document.body.innerHTML;



     document.body.innerHTML = printContents;



     window.print();



     document.body.innerHTML = originalContents;

}



</script>

    </head>



    <body   onLoad="window.print();">



        <header>

        <!-- headerwrapper -->

        </header>

        <section>

                   <?php include 'sadmin/'.$page_name.'.php';?>

        </section>





        <script src="js/jquery-1.11.1.min.js"></script>

        <script src="js/jquery-migrate-1.2.1.min.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/modernizr.min.js"></script>

        <script src="js/pace.min.js"></script>

        <script src="js/retina.min.js"></script>

        <script src="js/jquery.cookies.js"></script>



        <script src="js/flot/jquery.flot.min.js"></script>

        <script src="js/flot/jquery.flot.resize.min.js"></script>

        <script src="js/flot/jquery.flot.spline.min.js"></script>

        <script src="js/jquery.sparkline.min.js"></script>

        <script src="js/morris.min.js"></script>

        <script src="js/raphael-2.1.0.min.js"></script>

        <script src="js/bootstrap-wizard.min.js"></script>

        <script src="js/select2.min.js"></script>

		<script src="js/css3clock/js/css3clock.js"></script>

        <script src="js/custom.js"></script>

        <script src="js/dashboard.js"></script>

        <!-- Bottom Scripts -->

	<script src="assets/js/gsap/main-gsap.js"></script>

	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>

	<script src="assets/js/bootstrap.js"></script>

	<script src="assets/js/joinable.js"></script>

	<script src="assets/js/resizeable.js"></script>

	<script src="assets/js/neon-api.js"></script>

    <script src="assets/js/jquery.validate.min.js"></script>

	<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>

    <script src="assets/js/bootstrap-datepicker.js"></script>

    <script src="assets/js/fileinput.js"></script>



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









    </body>

</html>

<?php //$this->session->unset_userdata();

        //$this->session->sess_destroy(); ?>