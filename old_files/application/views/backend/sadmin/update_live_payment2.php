
 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Fee Payments";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/ajax_update_pin_live_etranzact' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>&nbsp;</h3>
			<div style="margin-left:30px">
			  <p> <div style="width:100%; height:100%" align="center">
			    
			    <p align="left">Select New Session to Update fee:
			      <p align="left">Fees Confirmation No: <?php echo $confirm_code;?></p>
			      </p>
                  
                   <p align="left">
                       
                      Session:  <select name="session" id="session" class="form-select required">
                      <option value ="<?php echo $session_pay;?>" selected="selected"> <?php echo $session_pay;?> </option>
                      <option value="0"  >- Select Session -</option>
                      <option value="2014/2015"  >2014/2015</option>
                      <option value="2013/2014"  >2013/2014</option>
                      <option value="2012/2013"  >2012/2013</option>
                      <option value="2011/2012"  >2011/2012</option>
                      <option value="2010/2011"  >2010/2011</option>
                         
                      


               
                      </select>
                      </p>
					  
					      <p align="left">
                       
                      Session:  <select name="level" id="level" class="form-select required">
                      <option value ="<?php echo $paylevel;?>" selected="selected"> <?php echo $paylevel;?> </option>
                      <option value="0"  >- Select level -</option>
                      <option value="NCE 1"  >NCE 1</option>
					  <option value="NCE 2"  >NCE 2</option>
					  <option value="NCE 3"  >NCE 3</option>
					  <option value="DEGREE 1"  >DEGREE 1</option>
					  <option value="DEGREE 2"  >DEGREE 2</option>
					  <option value="DEGREE 3"  >DEGREE 3</option>
					  <option value="DEGREE 4"  >DEGREE 4</option>
					  <option value="DEGREE 5"  >DEGREE 5</option>
                      
                         
                      


               
                      </select>
                      </p>
			    
			    </div>
			  
			  <p align="left"><br>
              <input type="hidden" name="confirm_code"  value="<?php echo $confirm_code;?>"/>
			    <input type="submit" name="submit" id="submit" value=" Update" height="35px">
			    </p>
			  
			  </div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>
 
                  </form>
	</div>

</div>

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

