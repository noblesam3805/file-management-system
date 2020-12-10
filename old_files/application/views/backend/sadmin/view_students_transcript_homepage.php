
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['error'])){echo $_SESSION['error'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Students Transcript";?>

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
			
			<h3>View Students Transcript!</h3>
			<hr />
	
			<div style="margin-left:40px">
			
			  <p> <div style="width:100%; height:100%" align="center">
                  <form id="imageform" name="imageform" method="post"  action='index.php?sadmin/process_view_students_transcript' >
                  
                      
                       <p align="left">
                         <span style=" padding-right:30px;" >  Matric Number:</span>
                         <input type="text" name="regno" id="regno" class="form-input required" placeholder="Enter Student's Matric No"  style="height:25px; width:250px;"/>
                       </p>
                       <br />
                      
                      <p align="left" style="margin-left:109px;">
                        <input type="submit" name="submit" id="submit" value="Proceed">
                      </p>
                  </form>
                  
                </div>
				<div id='preview'></div>&nbsp;</p>
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

<?php if(isset($_SESSION["error"]))
{
	unset( $_SESSION["error"]);
}?>

