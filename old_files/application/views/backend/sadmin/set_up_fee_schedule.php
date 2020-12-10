<?php $school = $this->db->query("select *  from schools order by schoolname");
$student_type = $this->db->query("select *  from student_type order by student_type_name");
//$semester = $this->db->query("select *  from course_semester order by semester_name");
//$session = $this->db->query("select *  from course_session order by sessionn_name");
$programme_type = $this->db->query("select *  from programme_type order by 	programme_type_id");?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Fees";?>

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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/feesetup'  >
                      <p align="left">
                      Student Type
                        <select name="programme"  id="programme" class="form-select required" onChange="javascript: populateProgrammeTypes(this.value); "><option value="" selected="selected" >- Select -</option>
<?php foreach($student_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->student_type_id;?>"><?php  echo $row->student_type_name;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                  
 

                      
                     
                    
                     <p align="left">
                     Progamme Type
                       <span  id="programmetypes">
                       <select  name="prog_type" id="prog_type" class="form-select required" "><option value="" selected="selected" >- Select Programme Type -</option>
                       <?php foreach($programme_type->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->programme_type_id;?>"><?php  echo $row->programme_type_name;?></option>
<?php 
	}
	?>

 </select>
                    </span>  </p>
                    
                     
                     <p align="left">
                      Year
                       <select  name="year" id="year" class="form-select required"><option value="" selected="selected" onChange="">- Select Level-</option>

 <option value="1">ND I</option>
 <option value="2">ND II</option>
  <option value="3">HND I</option>
   <option value="4">HND II</option>

 </select>
                      </p>                    
                     
                      
                      <p align="left">
                      Session
                       <select  name="session" id="session" class="form-select required"><option value="" selected="selected" onChange="">- Select Session-</option>

 <option value="2018/2019">2018/2019</option>

 </select>
                      </p>
					  
					           <p align="left">
                      Fee Payment Type
                       <select  name="feetype" id="feetype" class="form-select required"><option value="" selected="selected" onChange="">- Select Fee Payment Type-</option>

 <option value="2">FPN SCHOOL FEE</option>

 </select>
                      </p>
					
					
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="View Fee Setup" class="btn btn-primary" >
                      </p>
                  </form>
                  
                </div>
				
                  
                </div>
		<form id="imageform" name="imageform"  method="post" enctype="multipart/form-data" action='index.php?sadmin/processfeesetup'  >
				          <table width="943"  class=""  cellpadding="15px" cellspacing="15px">
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
     <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">PROGRAMME </span></div></th>
	  <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">STUDENT TYPE </span></div></th>
          <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">FACULTY </span></div></th>
		    <th width="157"><div align="left" class="style6"><span class="style4" style="color:#000">YEAR </span></div></th>
 <th width="157" align="center"><div align="left" class="style6"><span class="style4" style="color:#000">DEPARTMENT</span></div></th>
  <th width="157" align="center"><div align="left" class="style6"><span class="style4" style="color:#000">DEPARTMENT OPTION</span></div></th>
  <th width="157" align="center"><div align="left" class="style6"><span class="style4" style="color:#000">AMOUNT</span></div></th>

        </tr>
      </thead>
	  <tbody>
                        <?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
                        <?php $i=1;?>
                        <?php
                      if($this->input->post('view'))
						  {
							  $programme = $this->input->post('programme');
							  $prog_type = $this->input->post('prog_type');
							  $session = $this->input->post('session');
							  $year = $this->input->post('year');
						$fee_schedule=$this->db->query("select* from department")->result_array();
						foreach($fee_schedule as $row):?>
                        <tr>
                            <td><?php echo $i;?></td>
							<td><?php 
					
								$prog=$this->db->get_where('programme_type', array('programme_type_id'=>$prog_type))->row();
							echo $prog->programme_type_name;
					$fee_schedule=$this->db->query("select* from fedponek_fee_schedule where student_type_id='$prog_type' and level='$year' and session='$session' and fee_type='2' and dept_id=$row[deptID]")->row();
							?></td>
                            <td><?php $prog=$this->db->get_where('student_type', array('student_type_id'=>$programme))->row();
							echo $prog->student_type_name;?></td>
							 
                               <td><?php $school=$this->db->get_where('schools', array('id'=>$row['schoolid']))->row();
							echo $school->schoolname;?></td>
							 <td><?php 
							echo $fee_schedule->level;?></td>
							<td><?php echo $row['deptName'];
							
							?>
							<input type="hidden" name="dept_id[]" value="<?php echo $row["deptID"];?>" /> 
							</td>
							<td><?php echo $row['deptName'];
							
							?>
							<input type="hidden" name="dept_option_id[]" value="<?php echo $row["deptID"];?>" /> 
							</td>
                         
                            <td> <input type="text" name="indigene_amount[]"  class="form-control eduportal-input" placeholder="" value="<?php echo $fee_schedule->indigene_amount;?>" /></td>
                            <td> <input type="text" name="nonindigene_amount[]"  class="form-control eduportal-input" placeholder="" value="<?php echo $fee_schedule->nonindigene_amount;?>" /> </td>
							<td> <input type="text" name="foreign_amount[]"  class="form-control eduportal-input" placeholder="" value="<?php echo $fee_schedule->foreign_amount;?>" /> </td>
                            
                            <?php $i++;?>
                            
                        </tr>
						<?php endforeach;
						  ?>
						    	<tr><td colspan="7"> <p align="left"> <input type="hidden" name="programme" value="<?php echo $programme;?>" /> 
								<input type="hidden" name="prog_type" value="<?php echo $prog_type;?>" /> 
								<input type="hidden" name="session" value="<?php echo $session;?>" /> 
								<input type="hidden" name="year" value="<?php echo $year;?>" /> 
                       <br/>
                      </p></td></tr>
                      </p></td></tr>
						<tr><td colspan="7" align="center"> <p >
                        <input type="submit" name="update" id="update" value="Update Fee Setup" class="btn btn-primary" >
                      </p></td></tr>
					
                        <?php
						  }?>
                    </tbody>
	  </table> </form>
				&nbsp;</p>
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



