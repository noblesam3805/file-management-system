<?php





?>
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>

<div class="col-sm-3" style="margin-left:42%;"><?php if(isset($_SESSION['success'])){
					echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
	} ?></div>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Add Designation";?>

                    	</a></li>

									<li  class="">

            	<a href="<?php echo base_url();?>index.php?sadmin/view_des"><i class="entypo-menu"></i>

					<?php echo "View Added Designations";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END-->
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			
	
			<div style="margin-left:30px">
			
			  <p><div style="width:100%; height:100%" align="center">
<form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/add_des/'  >
	
                                
<p align="left">
							Designation: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="des" required="required" class="form-control eduportal-input"  placeholder="add new designation"  />
									</span>
							
</p></span>  </p>			
				  
                      <p align="left">
                        <input type="submit" name="submit" id="view" value="Add Designation" class="btn btn-primary"  >
                      </p>
                  </form>
                  
                </div>
				
                  
                </div>
				<div id='preview'>
				          
				</div>&nbsp;</p>
			  <p>&nbsp;</p>
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



