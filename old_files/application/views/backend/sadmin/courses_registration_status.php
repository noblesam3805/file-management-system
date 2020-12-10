<?php 
$status = $this->db->query("select status from course_status")->row();

   
?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Course Registration";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END-->
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Course Registration Status</h3>
			<hr />
	
				<div id='preview'><p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span></p>
				  <table   cellpadding="10" cellspacing="10">
				    <tr>
				
				
				    <tr>
				      <td style="font-size: 18px">Status: </td>
				      <td style="font-size: 18px"> <b> <strong><?php echo $status->status; ?> </strong></b></td>
				      </tr>
				    </table>
				</div>&nbsp;</p>
				<?php if($status->status=="off"){?>
				  <form id="imageform" name="imageform" method="post"  action='index.php?sadmin/courses_registration_status/on' >
				  		<div class="widget stacked widget-table">
				  
                  <p align="left"><br>
                    <input type="submit" name="submit" id="submit" value="  Enable Course Registration " height="35px">
                  </p>
				     </form><?php
				     	
				 }else{
				     ?>
					  <form id="imageform" name="imageform" method="post"  action='index.php?sadmin/courses_registration_status/off' >
					  		<div class="widget stacked widget-table">
				  
	                  <p align="left"><br>
	                    <input type="submit" name="submit" id="submit" value=" Disable Course Registration " height="35px">
	                  </p>
					     </form><?php
				     	
					 }?>
                  
			</div>
			</div>
							</ul>						
		                </div>
		            </div>
				</div>
			</div>
		</div>
 
               
	</div>

</div>

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

<?php if(isset($_SESSION["err_msg"])){ unset($_SESSION["err_msg"]);}?>