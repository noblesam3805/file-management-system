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
	<link rel="stylesheet" href="assets/css/skins/blue.css" id="style-resource-9">
	<?php if ($text_align == 'right-to-left') :?>
    	<link rel="stylesheet" href="assets/css/neon-rtl.css">
	<?php endif;?>
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/scripts/jquery.form.js"></script>

    <?php if($account_type == 'student' || $account_type == 'admin' || $account_type == 'sadmin') :?>
    <script type="text/javascript">


	
		   function populateDepartments(str,str2){
		   
            if(str == ""){
                document.getElementById('depts').innerHTML = "<option value=''>Select a Programme</option>";
                return;
            }
            if(str2 == ""){
                document.getElementById('depts').innerHTML = "<option value=''>Select a Programme</option>";
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
		
		function populateDepartmentsOptions(str){
		   
            if(str == ""){
                document.getElementById('deptopts').innerHTML = "<option value=''>Select a Department</option>";
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
                    document.getElementById('deptopts').innerHTML = xmlhttp.responseText;
					
                }
				
            }
            xmlhttp.open("GET", "assets/retrieveDeptsOptions.php?dept=" + str, true);
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
                    document.getElementById('level').innerHTML = xmlhttp.responseText;
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
		
		$(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#date_of_birth" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
	
	 $('#photoimg').change(function(e)			{ 
			      
				   var prog=document.getElementById('imageform2').programme.value;
				   if(prog=="")
				   {
					   alert("Please Select Student Type");
					   document.getElementById('imageform2').programme.focus();
					   return false;
				   }
				
				    if((document.getElementById('imageform2').school.value)=="")
				   {
					    alert("Please Select School");
						document.getElementById('imageform2').school.focus();
						   return false;
				   }
				   
				    if((document.getElementById('imageform2').depts.value)=="")
				   {
					    alert("Please Select Department");
						document.getElementById('imageform2').depts.focus();
						   return false;
				   }
				   
				     if((document.getElementById('imageform2').deptsoptions.value)=="")
				   {
					    alert("Please Select Department Option");
						document.getElementById('imageform2').deptsoptions.focus();
						   return false;
				   }
				     if((document.getElementById('imageform2').prog_type.value)=="")
				   {
					    alert("Please Select Programme Type");
						document.getElementById('imageform2').prog_type.focus();
						   return false;
				   }
				   
				      if((document.getElementById('imageform2').batch.value)=="")
				   {
					    alert("Please Select Admissions List Batch");
						document.getElementById('imageform2').batch.focus();
						   return false;
				   }
				   
				        if((document.getElementById('imageform2').ltype.value)=="")
				   {
					    alert("Please Select Admissions Type");
						document.getElementById('imageform2').ltype.focus();
						   return false;
				   }
				   
				         if((document.getElementById('imageform2').session.value)=="")
				   {
					    alert("Please Select Session");
						document.getElementById('imageform2').session.focus();
						   return false;
				   }
				   
				   
				   
				// alert(document.getElementById('imageform2').school.value);
					   $("#preview").html('');
			    $("#preview").html('<img src="assets/images/preloader.gif" alt="Uploading...."/>');
				
				/* if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                   // document.getElementById('programmetypes').innerHTML = xmlhttp.responseText;
					 $("#preview").html('Processing File...');
                }
				
            }
            xmlhttp.open("GET", "assets/getUploadDetails.php?programme="+str, true);
            xmlhttp.send(); */
				
			$("#imageform2").ajaxForm({
						target: '#preview'
		}).submit();
		});	
		
		
		
			
	$("#staff_school").change(function(){
		
			getStaffDepartments();
		});
		function getStaffDepartments(){

			  var school = $("#staff_school").val();

			  if(school != ""){
				 $.ajax({
					type:"post",
					url:"<?php echo base_url() . 'index.php?sadmin/getStaffDepartments'; ?>",
					data:"school=" + school,
					success:function(data){
						//alert(data);
						
						$("#staff_dept").html(data);
					 }
				  });
			  }else{
				document.getElementById('result').innerHTML = '';
			  }  
		}


 $('#photoimgstaff').change(function(e)			{ 
			      
				  // alert("Hello");
			
				    if((document.getElementById('imageform2').school.value)=="")
				   {
					    alert("Please Select School");
						document.getElementById('imageform2').school.focus();
						   return false;
				   }
				   
				    if((document.getElementById('imageform2').depts.value)=="")
				   {
					    alert("Please Select Department");
						document.getElementById('imageform2').depts.focus();
						   return false;
				   }
				       $("#preview").html('<img src="assets/images/preloader.gif" alt="Uploading...."/>');
				 $("#imageform2").ajaxForm({
						target: '#preview'
		}).submit(); 
return false;
             });
			
 $('#photoimgnorminalrole').change(function(e)			{ 
			      
				   var prog=document.getElementById('imageform2').programme.value;
				   if(prog=="")
				   {
					   alert("Please Select Student Type");
					   document.getElementById('imageform2').programme.focus();
					   return false;
				   }
				
				    if((document.getElementById('imageform2').school.value)=="")
				   {
					    alert("Please Select School");
						document.getElementById('imageform2').school.focus();
						   return false;
				   }
				   
				    if((document.getElementById('imageform2').depts.value)=="")
				   {
					    alert("Please Select Department");
						document.getElementById('imageform2').depts.focus();
						   return false;
				   }
				   
				     if((document.getElementById('imageform2').deptsoptions.value)=="")
				   {
					    alert("Please Select Department Option");
						document.getElementById('imageform2').deptsoptions.focus();
						   return false;
				   }
				     if((document.getElementById('imageform2').prog_type.value)=="")
				   {
					    alert("Please Select Programme Type");
						document.getElementById('imageform2').prog_type.focus();
						   return false;
				   }
				   
				  
				
				   
				   
				   
				// alert(document.getElementById('imageform2').school.value);
					   $("#preview").html('');
			    $("#preview").html('<img src="assets/images/preloader.gif" alt="Uploading...."/>');
				
				/* if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                   // document.getElementById('programmetypes').innerHTML = xmlhttp.responseText;
					 $("#preview").html('Processing File...');
                }
				
            }
            xmlhttp.open("GET", "assets/getUploadDetails.php?programme="+str, true);
            xmlhttp.send(); */
				
			$("#imageform2").ajaxForm({
						target: '#preview'
		}).submit();
		});			
			 
			  $('#photoimglecturer').change(function(e)			{ 
			      
				 // alert("Hello");
			
				    if((document.getElementById('imageform2').school.value)=="")
				   {
					    alert("Please Select School");
						document.getElementById('imageform2').school.focus();
						   return false;
				   }
				   
				    if((document.getElementById('imageform2').depts.value)=="")
				   {
					    alert("Please Select Department");
						document.getElementById('imageform2').depts.focus();
						   return false;
				   }
				       $("#preview").html('<img src="assets/images/preloader.gif" alt="Uploading...."/>');
				 $("#imageform2").ajaxForm({
						target: '#preview'
		}).submit(); 
return false;
             });
  }
  
		

);
	function viewadmissionslist()
	{
		 var prog=document.getElementById('imageform2').programme.value;
				   if(prog=="")
				   {
					   alert("Please Select Student Type");
					   document.getElementById('imageform2').programme.focus();
					   return false;
				   }
				
				    if((document.getElementById('imageform2').school.value)=="")
				   {
					    alert("Please Select School");
						document.getElementById('imageform2').school.focus();
						   return false;
				   }
				   
				    if((document.getElementById('imageform2').depts.value)=="")
				   {
					    alert("Please Select Department");
						document.getElementById('imageform2').depts.focus();
						   return false;
				   }
				   
				     if((document.getElementById('imageform2').deptsoptions.value)=="")
				   {
					    alert("Please Select Department Option");
						document.getElementById('imageform2').deptsoptions.focus();
						   return false;
				   }
				     if((document.getElementById('imageform2').prog_type.value)=="")
				   {
					    alert("Please Select Programme Type");
						document.getElementById('imageform2').prog_type.focus();
						   return false;
				   }
				   
				      if((document.getElementById('imageform2').batch.value)=="")
				   {
					    alert("Please Select Admissions List Batch");
						document.getElementById('imageform2').batch.focus();
						   return false;
				   }
				   
				        if((document.getElementById('imageform2').ltype.value)=="")
				   {
					    alert("Please Select Admissions Type");
						document.getElementById('imageform2').ltype.focus();
						   return false;
				   }
				   
				         if((document.getElementById('imageform2').session.value)=="")
				   {
					    alert("Please Select Session");
						document.getElementById('imageform2').session.focus();
						   return false;
				   }
				    $("#preview").html('<img src="assets/images/preloader.gif" alt="Uploading...."/>');
				 $("#imageform2").ajaxForm({
						target: '#preview'
		}).submit(); 
return false;		
	}	

		function populateRooms(str){
		   
            if(str == ""){
                document.getElementById('roomno').innerHTML = "<option value=''>Select a Hostel</option>";
                return;
            }
           
		    document.getElementById('roomno').innerHTML = "Please Wait..."
                // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                    document.getElementById('roomno').innerHTML = xmlhttp.responseText;
					
                }
				
            }
            xmlhttp.open("GET", "assets/retrieveRooms.php?hostel="+str, true);
            xmlhttp.send();
        }

    function populateRoomSpaces(str,str2)
	{
		 if(str == "" || str2 == ""){
                document.getElementById('roomspace').innerHTML = "<option value=''>Select a Room Space</option>";
                return;
            }
           
		    document.getElementById('roomspace').innerHTML = "Please Wait..."
		//	alert('Hello');
                // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                    document.getElementById('roomspace').innerHTML = xmlhttp.responseText;
					
                }
				
            }
            xmlhttp.open("GET", "assets/retrieveRoomSpaces.php?hostel="+str2+"&room="+str, true);
            xmlhttp.send();
	}

	function OpenEditCourse(str){
		   
       document.getElementById("courseinput"+str).style.display="block";
	    document.getElementById("courseHint"+str).style.display="none";
		return false;
	}
	
	function checkCommentBoxInputKey(event,coursetitle,courseid) {
	 var commpostid= courseid;
	 ajax_response = "Please Wait...";
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		
	  if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
  if(coursetitle=="")
  {
	  document.getElementById("commload"+commpostid).innerHTML="Course Title Cannot be empty!";
	  return false;
  }
  
document.getElementById("commload"+commpostid).innerHTML=ajax_response;

    xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
				//	alert(commpostid);
				  document.getElementById("courseinput"+commpostid).style.display="none";
	    document.getElementById("courseHint"+commpostid).style.display="block";
		document.getElementById("commload"+commpostid).innerHTML="";
                    document.getElementById("courseHint"+commpostid).innerHTML = xmlhttp.responseText;
					
					
                }
	}
	
  xmlhttp.open("GET", "assets/UpdateCourseTitle.php?coursetitle="+coursetitle+"&courseid="+courseid, true);
            xmlhttp.send();	

		}
		


	}
	
		function OpenEditAssignCourse(str){
		   
       document.getElementById("courseinput"+str).style.display="block";
	    document.getElementById("courseHint"+str).style.display="none";
		return false;
	}
	
		function saveAssignedLecturer(lecturer,sessionid,courseassignedid,semester) {
	 var commpostid= courseassignedid;
	 ajax_response = "Please Wait...";

		
	  if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
  if(lecturer=="")
  {
	  document.getElementById("commload"+commpostid).innerHTML="Please Select Lecturer!";
	  return false;
  }
  
document.getElementById("commload"+commpostid).innerHTML=ajax_response;

    xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
				//	alert(commpostid);
				  document.getElementById("courseinput"+commpostid).style.display="none";
	    document.getElementById("courseHint"+commpostid).style.display="block";
		document.getElementById("commload"+commpostid).innerHTML="";
                    document.getElementById("courseHint"+commpostid).innerHTML = xmlhttp.responseText;
				document.getElementById("myAction"+commpostid).innerHTML ="<a href='#' onclick='javascript: UnAssignCourseFromLecturer("+commpostid+");'>Unassign Lecturer</a>";
					
                }
	}
	
  xmlhttp.open("GET", "assets/InsertCourseToLecturer.php?sessionid="+sessionid+"&courseassignedid="+courseassignedid+"&lecturer="+lecturer+"&semester="+semester, true);
            xmlhttp.send();	

		
		


	}
	
			function UnAssignCourseFromLecturer(courseassignedid) {
	 var commpostid= courseassignedid;
	 ajax_response = "Please Wait...";

		
	  if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }

document.getElementById("commload"+commpostid).innerHTML=ajax_response;

    xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
				//	alert(commpostid);
				  document.getElementById("courseinput"+commpostid).style.display="none";
	    document.getElementById("courseHint"+commpostid).style.display="block";
		document.getElementById("commload"+commpostid).innerHTML="";
                    document.getElementById("courseHint"+commpostid).innerHTML = xmlhttp.responseText;
					    document.getElementById("myText"+commpostid).innerHTML = xmlhttp.responseText;
					document.getElementById("myAction"+commpostid).innerHTML ="<a href='#' onclick='javascript: OpenEditAssignCourse("+commpostid+");'>Assign Lecturer</a>";
					
                }
	}
	
  xmlhttp.open("GET", "assets/UnassignCourseFromLecturer.php?courseassignedid="+courseassignedid, true);
            xmlhttp.send();	

		
		


	}

	function OpenUploadMarkSheet(str){
		   
       document.getElementById("courseinput"+str).style.display="block";
	    document.getElementById("courseHint"+str).style.display="none";
		return false;
	}	
	
function getCourseTitle(session,programme,school,depts,programme_type_id,level,semester)
	{
     if(session == ""){
                document.getElementById('courses').innerHTML = "Please Select a Session!";
                return;
            }
             document.getElementById('courses').innerHTML = "Please Wait...";
                // if the browser understands this command
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();

            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 ){
					//alert("ready");
                    document.getElementById('courses').innerHTML = xmlhttp.responseText;
					
                }
				
            }
            xmlhttp.open("GET", "assets/retrieveCoursesResultTitle.php?programme="+programme+"&programme_type_id="+programme_type_id+"&session="+session+"&depts="+depts+"&level="+level+"&semester="+semester+"&school="+school, true);
            xmlhttp.send();
	}
	
function filter_depts(factId){
	if(factId == "none"){
		document.getElementById("dept_area").innerHTML="<select name='dept_code' class='pointers' id='dept_code' required='required'><option value=''>Choose Division/School first</option></select>";
	}
	else{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange=function()
		  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("dept_area").innerHTML=xmlhttp.responseText;
				}
				 else{
				  document.getElementById("dept_area").innerHTML="<span class='smallText'>Please wait...</span>";
				 }
		  }
	
	 xmlhttp.open("GET", "assets/filtered_depts.php?faculty_id="+factId,true);
	xmlhttp.send();	
	}
	
}

function filter_act_depts(factId){
	if(factId == "none"){
		document.getElementById("dept_area").innerHTML="<select name='dept_code' class='pointers' id='dept_code' required='required'><option value=''>Choose Division/School first</option></select>";
	}
	else{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange=function()
		  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("dept_area").innerHTML=xmlhttp.responseText;
				}
				 else{
				  document.getElementById("dept_area").innerHTML="<span class='smallText'>Please wait...</span>";
				 }
		  }
	
	 xmlhttp.open("GET", "assets/filtered_act_depts.php?faculty_id="+factId,true);
	xmlhttp.send();	
	}
	
}

function filter_staff(deptCode){
if(deptCode == "none"){
		document.getElementById("staff_area").innerHTML="<select name='sid' class='pointers' id='sid' required='required'><option value=''>Choose Department First</option></select>";
	}
	else{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange=function()
		  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("staff_area").innerHTML=xmlhttp.responseText;
				}
				 else{
				  document.getElementById("staff_area").innerHTML="<span class='smallText'>Please wait...</span>";
				 }
		  }
	
	 xmlhttp.open("GET", "assets/filtered_staff.php?dept_code="+deptCode,true);
	xmlhttp.send();	
	}
		

}

function filter_act_staff(deptCode){
if(deptCode == "none"){
		document.getElementById("staff_area").innerHTML="<select name='sid' class='pointers' id='sid' required='required'><option value=''>Choose Unit/Department First</option></select>";
	}
	else{
		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange=function()
		  {
			  //alert(xmlhttp.status);
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("staff_area").innerHTML=xmlhttp.responseText;
				}
				 else{
				  document.getElementById("staff_area").innerHTML="<span class='smallText'>Please wait...</span>";
				 }
		  }
	
	 xmlhttp.open("GET", "assets/filtered_acct_staff.php?dept_code="+deptCode,true);
	xmlhttp.send();	
	}
		

}
	
	
function filter_staff_email(sid){
if(sid == "none"){
		document.getElementById("email_area").innerHTML="<input name='email' class='form control' id='sid' required='required'>";
	}
	else{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange=function()
		  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("email_area").innerHTML=xmlhttp.responseText;
				}
				 else{
				  document.getElementById("email_area").innerHTML="<span class='smallText'>Please wait...</span>";
				 }
		  }
	
	 xmlhttp.open("GET", "assets/get_staff_email.php?sid="+sid,true);
	xmlhttp.send();	
	}
		

}

function get_phone_num(email){
if(email == "none"){
		document.getElementById("phone_area").innerHTML="<input name='email' class='form control' id='email' required='required'>";
	}
	else{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
			else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange=function()
		  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("phone_area").innerHTML=xmlhttp.responseText;
				}
				 else{
				  document.getElementById("phone_area").innerHTML="<span class='smallText'>Please wait...</span>";
				 }
		  }
	
	 xmlhttp.open("GET", "assets/get_staff_phone_num.php?email="+email,true);
	xmlhttp.send();	
	}
		

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