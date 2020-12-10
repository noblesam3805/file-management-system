
 
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

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/ajax_verify_pin_manual_etranzact' >
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
			    
			    <p align="left"><a href="index.php?sadmin/update_live_payment_session"  style="font-size:16px; color:#660000"><strong>Click here to update Live Etranzact Payment Session</strong></a></p>
			    <p align="left">&nbsp;</p>
			    <p align="left">Enter Fees Confirmation No:
			      <input name="pin" type="text" id="pin" style="width:250px; height:25px;">
			      </p>
			  </div>
			  
			  <p align="left"><br>
			    <input type="submit" name="submit" id="submit" value="  Proceed   " height="35px">
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

