<?php 
	foreach($result_data->result() as $row)
{

?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Achieved Results";?>

                    	</a></li>

          <li >



		</ul>

    	<!--CONTROL TABS END--><form id="imageform" name="imageform" method="post"  action='index.php?sadmin/ajax_update_sessional_result' >
		<div class="widget stacked widget-table">
			<div class="widget-content">
				<div class="tab-content">
					<div class="tab-pane box active" id="manage" style="padding: 5px">
							<div class="box-content">
						
							<ul class="list-group">
							 <div id="table-content">
			
			<h3>Result Details!</h3>
			<hr />
	
			<div style="margin-left:30px">
			
			  <p> <div style="width:100%; height:100%" align="center">
                  
                     
                      <p align="left">
                      Student Name: <?php echo $row->students_name;?>
                      </p>
                       <p align="left">
                      Reg No.: <?php echo $row->regno;?>
                      </p>
                      <p align="left">
                      Programme: <?php echo $row->programme;?>
                      </p>
                      
                          <p align="left">
                      School: <?php echo  $row->school;?>

                      </p>
                      
                       <p align="left">
                      Department: <?php echo  $row->department; ?>
                     </p>
                     
                        <p align="left">Programme Type:
                      <?php echo  $row->programme_type;?>
                         </p>
                      
                       <p align="left">
                      Level:
                      <?php echo  $row->level;?>
                         </p>
                       
                  
                      
                      <p align="left">
                      Semester: <?php echo  $row->semester;?>
                      
                      </p>
                      <p align="left">
                      Session: <?php echo  $row->session;?>
                      
                      </p>
                        <p align="left">
                      Course Title: <?php echo  $row->course_title;?>
                      
                      </p>
                      
                  
                      
                      
                <p></p><span style="color:#900"><?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?></span>
                <br />
				<div id='preview'>
				  </p>
                    <table width="387"  cellpadding="10" cellspacing="10">
				    <tr>
				      <td width="123">Test Score:</td>
				      <td width="192"><input name="testscore_a" type="text" value="<?php  echo  $row->testscore;?>"></td>
				      </tr>
				    <tr>
				      <td>Exam Score:</td>
				      <td><input name="examscore_a" type="text"  value="<?php  echo  $row->examscore;?>"></td>
				      </tr>
				    <tr>
				      <td>Total Score:</td>
				      <td><input name="totalscore_a" type="text" value="<?php  echo $row->totalscore;?>"></td>
				      </tr>
				    </table>
                   <input type="hidden" name="id" value="<?php echo $row->id;?>"/>
				                 
                  <p align="center"><br>
                        <input type="submit" name="submit" id="submit" value="Update Result" height="35px">|
                      <a href="<?php echo base_url().'index.php?sadmin/view_sessional_results_two';?>">Close</a></p>
                  
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

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}

}?>

