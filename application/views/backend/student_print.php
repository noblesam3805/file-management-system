<?php

	//session_start();
	/*if(!isset($_SESSION['putmeID'])){
		$_SESSION['serror'] = 'Start here please!';
		redirect(base_url() . 'index.php?putme/pre_registration');
	}*/

    $sys = $this->db->get_where('settings', array("type" => 'system_name'))->row();
    $pageTitle = $this->db->get_where('settings', array("type" => 'system_title'))->row();
    //$user = $this->db->get_where('prehnd_users', array("user_id" => $this->session->userdata('putme_userid')))->row();
    
    
?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta name="description" content="Nigerian Higher Education" />

	<meta name="author" content="Emmanuel Etti" />



        <title><?php echo 'Eduportal | ' . $page_title;?></title>



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
		 <script type="text/javascript">
	
		   function populateDepartments(str,str2){
		   
            if(str == ""){
                document.getElementById('depts').innerHTML = "<option value=''>Select a Department</option>";
                return;
            }
            if(str2 == ""){
                document.getElementById('depts').innerHTML = "<option value=''>Select a Department</option>";
                return;
            }

                // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                    document.getElementById('dept').innerHTML = xmlhttp.responseText;
					
                }
				
            }
            xmlhttp.open("GET", "assets/retrieveDepts.php?school=" + str+"&programme="+str2, true);
            xmlhttp.send();
        }

        function populateLGA(str){
            if(str == ""){
                document.getElementById('lga').innerHTML = "<option value=''>Select a L.G.A</option>";
                return;
            }
            if(str == ""){
                document.getElementById('lga').innerHTML = "<option value=''>Select a L.G.A</option>";
                return;
            }

                // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('lga').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/retrieveLGA.php?q=" + str, true);
            xmlhttp.send();
        }
        function checkInstitution(str){
            if(str == ""){
                document.getElementById('dept').innerHTML = "<option value='' selected='selected'>Select a School</option>";
                return;
            }
            // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('dept').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/retrieveDept.php?q=" + str, true);
            xmlhttp.send();
        }

        function courses(str){
            if(str == ""){
                document.getElementById('name').innerHTML = "<option value='' selected='selected'>Select a level</option>";
                return;
            }
            // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('name').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/courses.php?q=" + str, true);
            xmlhttp.send();
        }
		
		function showProgramme(str){
            if(str == ""){
                document.getElementById('prog_type').innerHTML = "<option value='' selected='selected'>Select a level</option>";
                return;
            }
			//getLevel(str);
            // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('progresult').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/getProgrammes.php?prog=" + str, true);
            xmlhttp.send();
        }
		
		function showProgramme2(str){
            if(str == ""){
                document.getElementById('prog_type').innerHTML = "<option value='' selected='selected'>Select a level</option>";
                return;
            }
            // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('progresult').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/getProgrammes2.php?prog=" + str, true);
            xmlhttp.send();
        }
		
		function getLevel(str){
            if(str == ""){
                document.getElementById('level').innerHTML = "<option value='' selected='selected'>Select a level</option>";
                return;
            }
            // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('result2').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/getLevel.php?progtype=" + str, true);
            xmlhttp.send();
        }
		function getLevel2(str){
            if(str == ""){
                document.getElementById('level').innerHTML = "<option value='' selected='selected'>Select a level</option>";
                return;
            }
            // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('result2').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "assets/getLevel2.php?progtype=" + str, true);
            xmlhttp.send();
        }
		
			function populateProgrammeTypes(str){
		   
            if(str == ""){
                document.getElementById('programmetypes').innerHTML = "<option value=''>Select a Programme</option>";
                return;
            }
           
                // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                    document.getElementById('programmetypes').innerHTML = xmlhttp.responseText;
					
                }
				
            }
            xmlhttp.open("GET", "assets/retrieveLProgrammes.php?programme="+str, true);
            xmlhttp.send();
        }
    </script>
    </head>
    <body>
        <div class="document">
			<div class="content-row">
				<?php include 'student/' . $page_name . '.php'; ?>
			</div>
			<?php include 'includes_bottom.php';?>
        </div>
    </body>
</html>

