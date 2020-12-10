<?php



$user_type = $this->db->query("select *  from erp_user_roles where user_role_id='$user_role_id'")->row();


?>
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage User Type";?>

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
<form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/process_editusertype/<?php echo $user_role_id;?>'  >
	<p align="left">
	
	
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="hidden" name="user_role_id" required="required" readonly class="form-control eduportal-input"  value="<?php  echo $user_role_id; ?>"  />
									</span>
									
	</p>
                                
<p align="left">
							User Type Name: 
<span class="input-group input-group-lg eduportal-input-group">
									  <input type="text" name="user_type_name" required="required" class="form-control eduportal-input"  value="<?php  echo $user_type->user_type; ?>"  />
									</span>

							
</p>
	

           </span>  </p>			  
				
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="Update User Type" class="btn btn-primary"  >
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



