<script type="text/javascript">
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
    </script>

    <script>

    function checkPass()
    {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}

function validateNum(a){
	/*if(isNaN(a)){
		alert("You Must Enter A Number");
	}
	document.getElementById('stuphone')
	alert(a);*/
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
                        <li>Fees |</li>
                        <li>Personal Info</li>
                    </ul>
                    <h4>Step 2: Personal Information</h4>
                </div>
            </div><!-- media -->
        </div>
        <div class="span12">

            <?php echo form_open('register/register2' , array('class' => 'panel-wizard','target'=>'_top','id'=>'basicWizard'));?>
                <div style="width:80%; color:#9d0000; margin-left:20px;"><?= $error; ?></div>  

			<div class="form-group half">
                <label class=""> Title</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="col-sm-82">
                        <select type="text" class="form-control" name="title" >
                            <option>MR.</option>
                            <option>MASTER</option>
                            <option>MRS.</option>
                            <option>MISS</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group half">
                <label class="col-sm-4 dlabel2">Last Name</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="text" class="form-control" name="name" required value="<?= $fname; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group half">
                <label class="col-sm-4 dlabel2"> Other Names</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="text" class="form-control" name="fname" required value="<?= $name; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group half">
                <label class="col-sm-4 dlabel2"> Email</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="email" class="form-control" name="email" required value="<?= $email; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group half">
                <label class="col-sm-4 dlabel2">Registration No</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="text" class="form-control" readonly name="reg_no" required value="<?=$user?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
            </div>


            <div class="form-group half">
                <label for="field-2" class="col-sm-4 dlabel2"> Address</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-taxi"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="text" class="form-control" name="address" required value="<?= $address ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                    </div>
                </div>
            </div>
            <div class="form-group half">
                <label for="field-2" class="col-sm-4 dlabel2">Phone No</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="number" onkeyup="validateNum()" id="stuphone" class="form-control" name="phone" required data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                    </div>
                </div>
            </div>

            <div class="form-group half">
                <label class="col-sm-4 dlabel2">Password</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="password" class="form-control" required name="password" id='pass1' value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group half">
                <label class="col-sm-4 dlabel2">Confirm Password</label>
                <div class="form-div">
                    <div class="form-icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="col-sm-82">
                        <input type="password" class="form-control" required name="password_c" id="pass2" onkeyup="checkPass(); return false;" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        <span id="confirmMessage" class="confirmMessage"></span>
                        
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

	<?php 
		if(isset($_SESSION['err_msg'])){
			unset($_SESSION['err_msg']);
			
		}
	?>