<?php $school = $this->db->query("select *  from schools order by schoolname");

//$semester = $this->db->query("select *  from course_semester order by semester_name");
//$session = $this->db->query("select *  from course_session order by sessionn_name");
$programme_type = $this->db->query("select *  from programme_type order by 	programme_type_id");?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<script type="text/javascript">
function getSenderType(str)
{
	if(str=="0")
	{
		alert("Please choose an option");
	}
	if(str=="1")
	{
		document.getElementById("departments").style.display="none";
	}
	if(str=="2")
	{
		document.getElementById("departments").style.display="block";
	}
	
}
</script>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Send Bulk SMS To Students";?>

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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/ajax_send_bulk_sms'  >
                     
                           <p align="left">
                      Send To
                       <select  name="sendtype" id="sendtype" class="form-select required" onChange="getSenderType(this.value)" >
					   <option value="0" selected="selected" >- Select -</option>

 <option value="1">All</option>
 <option value="2">Departments</option>
 </select>
                      </p>
<span id="departments" >                      
					   <p align="left">
                      School
                       <select  name="school" id="school" class="form-select required" onChange="javascript: populateDepartments(this.value,1); "><option value="" selected="selected" >- Select -</option>
<?php foreach($school->result() as $row)
	{
		
	?>
 <option value="<?php  echo $row->schoolid;?>"><?php  echo $row->schoolname;?></option>
<?php 
	}
	?>
 </select>
                      </p>
                      
                       <p align="left">
                      Department
                     <span id="dept">
                      <select  name="depts" id="depts" class="form-select required"><option value="" selected="selected" onChange="">- Select -</option>

 </select></span></p>
 </span>

                 <p align="left">
				 Message:<br>
				 <textarea name ="message" class="form-select required"  rows="15" cols="80">
				 
				 </textarea>
				 
				 </p>   
          
   
                                        
                     
                      
                   
                      
                      <p align="left">
                        <input type="submit" name="view" id="view" value="Send" class="btn btn-primary"  >
                      </p>
                  </form>
                  
                </div>
				
                  
                </div>
			</p>
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



