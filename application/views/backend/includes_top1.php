<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
    <link rel="stylesheet" href="assets/css/hostels.css">
    <link rel="stylesheet" href="assets/botstrap/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="assets/css/basicQuery.css">
    
	
	<link rel="stylesheet" href="assets/css/base-admin.css">
	
	
	
	
	<link rel="stylesheet" type="text/css" href="assets/css/basic.css"/>
	<link rel="stylesheet" type="text/css" href="assets/fonts/icons.css"/>
	
    <link rel="stylesheet" href="assets/css/eduportalSettings.css">
	
    
    
	<link rel="stylesheet" href="assets/css/custom.css">
	<?php if ($text_align == 'right-to-left') :?>
    	<link rel="stylesheet" href="assets/css/neon-rtl.css">
	<?php endif;?>
	<script src="assets/js/jquery-1.11.0.min.js"></script>

    <?php if($account_type == 'student' || $account_type == 'admin' || $account_type == 'sadmin') :?>
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
    <?php endif;?>


	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">

    
    

	<link rel="stylesheet" href="assets/js/vertical-timeline/css/component.css">
    <link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">