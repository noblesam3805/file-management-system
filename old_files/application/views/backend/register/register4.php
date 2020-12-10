<script type="text/javascript">
        function fee(){
            var terminal = document.confirm_form.TERMINAL_ID.value;
            var con_no = document.confirm_form.CONFIRMATION_NO.value;
            var res_url = document.confirm_form.RESPONSE_URL.value;
            //alert(terminal + ' ' + com_no + ' ' + res_url);
            var url = "http://demo.etranzact.com/WebConnectPlus/query.jsp";
            /*if(com_no == ""){
                document.getElementById('result').innerHTML = "Please Enter Confirmation Code";
                return;
            }*/
            // if the browser understands this command
            var parameter = "TERMINAL_ID=0000000001&CONFIRMATION_NO=500856741337711398213";
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }else{
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
            }
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById('result').innerHTML = xmlhttp.responseText;
                }
            }
            //xmlhttp.open("POST", url, true);
            xmlhttp.open("GET", "http://demo.etranzact.com/WebConnectPlus/query.jsp?TERMINAL_ID=0000000001&CONFIRMATION_NO=500856741337711398213", true);
            //xmlhttp.open("GET", "http://demo.etranzact.com/WebConnectPlus/query.jsp?TERMINAL_ID=" + terminal + "&CONFIRMATION_NO=" + con_no, true);
            xmlhttp.send();
            xmlhttp.send(parameter);
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
                <li>Process Fee</li>
            </ul>
            <h4>Step 5: Process Fees</h4>
        </div>
    </div><!-- media -->
    </div><!-- pageheader -->
    <div class="span12">
    <?php $paytype = $this->session->userdata('paytype');?>


    <!-- BASIC WIZARD -->
        <?php echo form_open('register/register5/' . $paytype , array('class' => 'panel-wizard','target'=>'_top','id'=>'basicWizard'));?>

        <p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
        <p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['prn_msg'])){echo $_SESSION['prn_msg'];} ?></p>
        <?php if(!isset($_SESSION['prn_msg'])) {?>

            <div class="form-group half">
                <label class="col-sm-3 dlabel">Reg No:</label>
    			<div class="form-div">
    				<div class="form-icon">
    					<i class="fa fa-globe"></i>
    				</div>
    				<div class="col-sm-82">
    					<input name="serial" type="text" placeholder="Enter Reg No" value="<?=$reg_no?>" id="serial" required="required" class="form-control" />
    				</div>
    			</div>
            </div><!-- form-group -->

            <div class="form-group half">
                <label class="col-sm-3 dlabel">Confirmation No:</label>
    			<div class="form-div">
    				<div class="form-icon">
    					<i class="fa fa-thumbs-up"></i>
    				</div>
    				<div class="col-sm-82">
    					<input name='CONFIRMATION_NO' type="text" placeholder="Enter Confirmation No" value="" id="confirmation" required="required" class="form-control" />
    				</div>
    			</div>
            </div><!-- form-group -->

            <div class="form-group half">
                <label class="col-sm-3 dlabel">Payment For:</label>
    			<div class="form-div">
    				<div class="form-icon">
    					<i class="fa fa-money"></i>
    				</div>
    				<div class="col-sm-82">
    					<select type="text" name="payment" required="required" class="form-control">
    						 <option >Payment For...</option>
    						 <option selected="selected">School Fees</option>

    					 </select>
    				</div>
    			</div>
            </div><!-- form-group -->

            <div class="form-group half">
                <label class="col-sm-3 dlabel">Payment Session</label>
    			<div class="form-div">
    				<div class="form-icon">
    					<i class="fa fa-clock-o"></i>
    				</div>
    				<div class="col-sm-82">
    					<select type="text" name="session" required="required" class="form-control">
    						 <option>Select Session</option>
    						 <option>2014/2015</option>
    						 <option>2013/2014</option>
                             <option>2012/2013</option>
                             <option>2011/2012</option>
                             <option>2010/2011</option>
                             <option>2010/2011</option>
                             <option>2009/2010</option>
                             <option>2008/2009</option>
                             <option>2007/2008</option>
    					 </select>
    				</div>
    			</div>
            </div><!-- form-group -->

            <input type=hidden name = 'TERMINAL_ID' value='2140214016'>
            <!--input type=hidden name = 'CONFIRMATION_NO' value='500856741337711398213'-->
            <input type=hidden name= 'RESPONSE_URL' value='http://localhost/eduportal/index.php?register/register5'>
    		<div class="form-group lastsubmit">
                <div class="">
                    <input type="submit" name="proceed" style="width:250px;" style="height:40px; border-radius:2px;" class="btn btn-info pull-right" value="Process Fees"/>
    			</div>
            </div>
        </div>
    </div>
<?php
}else{
	echo $_SESSION['prn_msg'];
}
if(isset($_SESSION['err_msg'])){
unset($_SESSION['err_msg']);
unset($_SESSION['prn_msg']);
}?>
<?php unset($_SESSION['prn_msg']);?>
