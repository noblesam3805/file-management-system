<script type="text/javascript">
		function getXMLHTTP(){
		var xmlHttp=null;
		try{
			xmlHttp=new XMLHttpRequest();}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
			catch(e){
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
		}return xmlHttp;}
		
        function populateLGA(str){
            if(str == ""){
                document.getElementById('lga').innerHTML = "<option value=''>SELECT A L.G.A</option>";
                return;
            }
            if(str == ""){
                document.getElementById('lga').innerHTML = "<option value=''>SELECT A L.G.A</option>";
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
                document.getElementById('dept').innerHTML = "<option value='' selected='selected'>SELECT A SCHOOL</option>";
                return;
            }
			document.getElementById('dep').style.display = "block";
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
		function showProgramme(a){
			
			//alert(a);
			var req = getXMLHTTP(); // fuction to get xmlhttp object

			strURL = "assets/getProgrammes.php?prog=" + a;
			if (req){
				req.onreadystatechange = function(){
					if (req.readyState == 4){ //data is retrieved from server
						if (req.status == 200){ // which reprents ok status
							//document.getElementById('named').value=req.responseText;
							var result = req.responseText;
							document.getElementById('progresult').innerHTML = result;
						}else{alert("There was a problem while using XMLHTTP:\n");}
					}
				}
				req.open("GET", strURL, true); //open url using get method
				req.send();
			}else{alert('failed');}
		}
		function showProgramme2(a){
			
			//alert(a);
			var req = getXMLHTTP(); // fuction to get xmlhttp object

			strURL = "assets/getProgrammes2.php?prog=" + a;
			if (req){
				req.onreadystatechange = function(){
					if (req.readyState == 4){ //data is retrieved from server
						if (req.status == 200){ // which reprents ok status
							//document.getElementById('named').value=req.responseText;
							var result = req.responseText;
							document.getElementById('prog_type').innerHTML = result;
						}else{alert("There was a problem while using XMLHTTP:\n");}
					}
				}
				req.open("GET", strURL, true); //open url using get method
				req.send();
			}else{alert('failed');}
		}
		function getLevel(a){
			//alert(a);
			var req = getXMLHTTP(); // function to get xmlhttp object

			strURL = "assets/getLevel.php?progtype=" + a;
			if (req){
				req.onreadystatechange = function(){
					if (req.readyState == 4){ //data is retrieved from server
						if (req.status == 200){ // which reprents ok status
							//document.getElementById('named').value=req.responseText;
							var result = req.responseText;
							document.getElementById('result2').innerHTML = result;
						}else{alert("There was a problem while using XMLHTTP:\n");}
					}
				}
				req.open("GET", strURL, true); //open url using get method
				req.send();
			}else{alert('failed');}
		}
		function getLevel2(a){
			//alert(a);
			var req = getXMLHTTP(); // function to get xmlhttp object

			strURL = "assets/getLevel2.php?progtype=" + a;
			if (req){
				req.onreadystatechange = function(){
					if (req.readyState == 4){ //data is retrieved from server
						if (req.status == 200){ // which reprents ok status
							//document.getElementById('named').value=req.responseText;
							var result = req.responseText;
							document.getElementById('result2').innerHTML = result;
						}else{alert("There was a problem while using XMLHTTP:\n");}
					}
				}
				req.open("GET", strURL, true); //open url using get method
				req.send();
			}else{alert('failed');}
		}
		function showNationality(a){
			if(a == "Nigerian"){
				document.getElementById("nationality").style.display = "block";
				document.getElementById("othernationality").style.display = "none";
				document.getElementById('lgas').style.display = "block";
			}else if(a == "Non-Nigerian"){
				document.getElementById("othernationality").style.display = "block";
				document.getElementById("nationality").style.display = "none";
				document.getElementById('lgas').style.display = "none";
			}
		}
    </script>
	<div class="mycontainer themiddle myclass" style="padding:0;">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body kk">
                                <ul class="breadcrumb">
                                    <li>Fee</li>
                                    <li>Additional Personal Info</li>
                                </ul>
                                <h4>Step 3: Additional Personal Information</h4>
                            </div>
                        </div><!-- media -->
                    </div>
                    <div class="span12">
                    	<?php echo form_open('register/register3/info' , array('class' => 'panel-wizard','target'=>'_top','id'=>'basicWizard'));?>
                   
                            <div class="form-group hidden">
                                <label class="col-sm-4 dlabel2"> Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" value="<?=$title?>" />
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label class="col-sm-4 dlabel2">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" value="<?=$name?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-sm-4 dlabel2"> Other Names</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="fname" value="<?=$fname?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-sm-4 dlabel2"> Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" value="<?=$email?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-sm-4 dlabel2">Registration No</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control f" name="reg_no" value="<?=$reg_no?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
							
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2">Date Of Birth</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-calendar"></i>
									</div>
									<div class="col-sm-82">
										<input type="text" class="form-control datepicker" required name="birthday" data-start-view="2"/>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2"> Sex</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-82">
										<select required name="sex" class="form-control">
											<option value="">SELECT AN OPTION</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2">Marital Status</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-life-ring"></i>
									</div>
									<div class="col-sm-82">
										<select type="text" required name="marital_status" class="form-control">
											<option value="">SELECT AN OPTION</option>
											<option value="Single">Single</option>
											<option value="Married">Married</option>
											<option value="Divorced">Divorced</option>
											<option value="Widowed">Widowed</option>
										  </select>
									</div>
								</div>
                            </div>
                            <div class="form-group hidden">
						        <label for="field-2" class="col-sm-4 dlabel2"> Address</label>
  						    <div class="col-sm-8">
  							    <input type="text" class="form-control" name="address"  value="<?=$address?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
  						    </div>
					        </div>
                            <div class="form-group hidden">
						        <label for="field-2" class="col-sm-4 dlabel2">Phone No</label>
  						    <div class="col-sm-8">
  							    <input type="text" class="form-control" name="phone"  value="<?=$phone?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
  						    </div>
					        </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2"> Nationality</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-flag"></i>
									</div>
									<div class="col-sm-82">
									   <select name="nationality" class="form-control" required onChange="showNationality(this.value);">
											<option value="Nigerian">Nigerian</option>
											<option value="Non-Nigerian">Non Nigerian</option>
										 </select>
									</div>
								</div>
                            </div>
                            <div class="form-group half" id="nationality">
                                <label class="col-sm-4 dlabel2">State Of Origin</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-flag"></i>
									</div>
									<div class="col-sm-82">
										<select name="state"  class="form-control"  onChange="populateLGA(this.value)">
										   <option value=''>SELECT YOUR STATE</option>
												<option value ='Abia'> Abia </option><option value ='FCT'> FCT </option><option value ='Adamawa'> Adamawa </option><option value ='Akwa Ibom'> Akwa Ibom </option><option value ='Anambra'> Anambra </option><option value ='Bauchi'> Bauchi </option><option value ='Bayelsa'> Bayelsa </option><option value ='Benue'> Benue </option><option value ='Borno'> Borno </option><option value ='Cross River'> Cross River </option><option value ='Delta'> Delta </option><option value ='Ebonyi'> Ebonyi </option><option value ='Edo'> Edo </option><option value ='Ekiti'> Ekiti </option><option value ='Enugu'> Enugu </option><option value ='Gombe'> Gombe </option><option value ='Imo'> Imo </option><option value ='Jigawa'> Jigawa </option><option value ='Kaduna'> Kaduna </option><option value ='Katsina'> Katsina </option><option value ='Kano'> Kano </option><option value ='Kebbi'> Kebbi </option><option value ='Kogi'> Kogi </option><option value ='Kwara'> Kwara </option><option value ='Lagos'> Lagos </option><option value ='Nasarawa'> Nasarawa </option><option value ='Niger'> Niger </option><option value ='Ogun'> Ogun </option><option value ='Ondo'> Ondo </option><option value ='Osun'> Osun </option><option value ='Oyo'> Oyo </option><option value ='Plateau'> Plateau </option><option value ='Rivers'> Rivers </option><option value ='Sokoto'> Sokoto </option><option value ='Taraba'> Taraba </option><option value ='Yobe'> Yobe </option><option value ='Zamfara'> Zamfara </option>
										</select>
									</div>
								</div>
                            </div>
							<div class="form-group half" style="display:none;" id="othernationality">
                                <label class="col-sm-4 dlabel2">Country</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-flag"></i>
									</div>
									<div class="col-sm-82">
										<select name="country"  class="form-control">
											<option value=''>CHOOSE COUNTRY</option>
											<?php 
											for($i = 0; $i < count($country); $i++){
												echo "<option value='" . $country[$i]['country'] . "'>" . $country[$i]['country'] . "</option>";
											}
										?>
										</select>
									</div>
								</div>
                            </div>

                            <div class="form-group half" id="lgas">   <div id="val"></div>
                                <label class="col-sm-4 dlabel2">L  G  A Of Origin</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-flag"></i>
									</div>
									<div class="col-sm-82">
										<select class="form-control" id="lga" name="lga">
											<option value="">SELECT AN OPTION</option>
										</select>
									</div>
								</div>
                            </div>

                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2"> School</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-building"></i>
									</div>
									<div class="col-sm-82">
										<select class="form-control" id="school" name="school" required  onChange="checkInstitution(this.value)">
											<option value="">SELECT YOUR SCHOOL</option>
											<option value ='4'>SCHOOL OF ARTS </option>
											<option value ='1'>SCHOOL OF AGRIC AND VOCATIONAL STUDIES </option>
											<option value ='5'>SCHOOL OF EDUCATION </option>
											<option value ='2'>SCHOOL OF NATURAL SCIENCES </option>
											<option value ='3'>SCHOOL OF SOCIAL SCIENCES </option>
										</select>
									</div>
								</div>
                            </div>
                            <div class="form-group half" required id="dep">
                                <label class="col-sm-4 dlabel2"> Department</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-building"></i>
									</div>
									<div class="col-sm-82">
										<select class="form-control" id="dept" name="dept">
											<option value="">SELECT YOUR DEPARTMENT</option>
										</select>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2"> Programme</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-mortar-board"></i>
									</div>
									<div class="col-sm-82">
										<select class="form-control" required name="programme" onChange="showProgramme2(this.value)"/>
										<option value="" >SELECT YOUR PROGRAMME</option>
										   <option value="PRE-NCE">PRE-NCE</option>
										   <option value="NCE">NCE</option>
										   <option value="DEGREE">DEGREE</option>
										 </select>
									</div>
								</div>
                            </div>
							
                            <input type="hidden" class="form-control" name="password" id='pass1' value="<?=$password?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2">Programme Type</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-book"></i>
									</div>
									<div class="col-sm-82" id="prog_type">
										<select required  class="form-control">
											  <option value="" >SELECT YOUR PROGRAMME TYPE</option>
											</select>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2"> Level</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-list-ol"></i>
									</div>
									<div class="col-sm-82" id="result2">
										<select id="level" required    class="form-control">
											<option value="">SELECT YOUR CURRENT LEVEL</option>
										</select>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2"> Semester</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="col-sm-82">
										<select id="semester" required name="semester" reqired="data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"" class="form-control">
											<option value="">SELECT CURRENT SEMESTER</option>
											<option value="FIRST">First </option>
											<option value="SECOND">Second </option>
									  </select>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2">Name Of Parent /Guardian</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-82">
										<input type="text" class="form-control" required name="parent_name" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2">Phone No Of Parent</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-phone"></i>
									</div>
									<div class="col-sm-82">
										<input type="text" class="form-control" required name="parent_phone" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
                            </div>
                            <div class="form-group half">
                                <label class="col-sm-4 dlabel2">Address Of Parent</label>
								<div class="form-div">
									<div class="form-icon">
										<i class="fa fa-map-marker"></i>
									</div>
									<div class="col-sm-82">
										<input type="text" class="form-control" required name="parent_address" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
                            </div>
                            <div class="form-group lastsubmit">
				                <div class="">
				                 <input type="submit" name="submit" style="height:40px; border-radius:2px;" class="btn btn-info pull-right" value="Proceed"/>
				                 </div>
				            </div>
						</div>
          			</div>