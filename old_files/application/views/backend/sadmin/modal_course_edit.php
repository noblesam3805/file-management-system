<?php
$edit_data = $this->db->get_where('courses' , array('id' => $param2) )->result_array();

foreach ($edit_data as $val):
?>
<style type="text/css">
	label{
		font-size:14px !important;
	}
	
</style>
<script type="text/javascript">
	function getXMLHTTP(){
	var xmlHttp=null;
	try{
		xmlHttp=new XMLHttpRequest();}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
		catch(e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
	}return xmlHttp;}
	
	function Departments(str){
		
		if(str == ""){
			document.getElementById('lga').innerHTML = "<option value=''>SELECT A L.G.A</option>";
			return;
		}
		
			// if the browser understands this command
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();

		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
		}
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('departments').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "assets/allDepartments.php?q=" + str, true);
		xmlhttp.send();
	}
		
</script>
<div class="row">
	<div class="col-md-12">
		<h3>Course Details</h3>
		<hr style="border-bottom:1px solid silver"/>
		<div class="col-md-6">
			<div class="form-group eduportal-form-group">
				<label class="label-control" for="course name"><?php echo get_phrase('course_name');?></label>
				<div class="input-group eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" value="<?php echo $val['course_name'] ?>" name="coursename" class="form-control eduportal-input" required />
				</div>
			</div>
			<div class="form-group eduportal-form-group">
				<label class="label-control" for="course name"><?php echo get_phrase('course_code');?></label>
				<div class="input-group eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" value="<?php echo $val['course_code'] ?>" name="coursecode" class="form-control eduportal-input" required />
				</div>
			</div>
			<div class="form-group eduportal-form-group">
				<label class="label-control" for="course name"><?php echo get_phrase('credit_load');?></label>
				<div class="input-group eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<input type="text" value="<?php echo $val['credit_load'] ?>" name="creditload" class="form-control eduportal-input" required />
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group eduportal-form-group">
				<label class="label-control" for="course name"><?php echo get_phrase('course_semester');?></label>
				<div class="input-group eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select class="form-control eduportal-input" required name="coursesemester">
						<option value="<?php $val['course_semester']; ?>" selected="selected"><?php echo "SEMESTER " . $val['course_semester']; ?></option>
						<option value="1">SEMESTER 1</option>
						<option value="2">SEMESTER 2</option>
					</select>
				</div>
			</div>
			<div class="form-group eduportal-form-group">
				<label class="label-control" for="course name"><?php echo get_phrase('course_year');?></label>
				<div class="input-group eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select class="form-control eduportal-input" required name="courseyear">
						<option value="<?php $val['course_year']; ?>" selected="selected"><?php echo "LEVEL " . $val['course_year']; ?></option>
						<option value="1">LEVEL 1</option>
						<option value="2">LEVEL 2</option>
						<option value="3">LEVEL 3</option>
						<option value="4">LEVEL 4</option>
						<option value="5">LEVEL 5</option>
					</select>
				</div>
			</div>
			<div class="form-group eduportal-form-group">
				<label class="label-control" for="course name"><?php echo get_phrase('programme_type');?></label>
				<div class="input-group eduportal-input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
					<select class="form-control eduportal-input" required name="progtype" >
						<option value="<?php echo $val['prog_type']; ?>"><?php echo $val['prog_type']; ?></option>
						<?php 
							foreach($prog as $p => $pval){
								for($i = 0; $i < count($pval); $i++){
									echo "<option>" . $pval['programme'] . "</option>";
								}
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3>Assign Course Head</h3>
		<hr style="border-bottom:1px solid silver"/>
		<div class="form-group eduportal-form-group" style="margin-bottom:20px;">
			<label class="label-control" for="course name">Course Head</label>
			<div class="input-group input-group-lg eduportal-input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<select name="courselecturer" class="form-control eduportal-input" required >
					<option value="">Select A Course Head</option>
					<?php
						foreach($lect as $l){
							echo "<option value=" . $l['id'] . ">" . $l['lecturer_name'] . "</option>";
						}
					?>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3 style="margin-top:35px;">Set Originating Course Department</h3>
		<hr style="border-bottom:1px solid silver"/>
		<div class="form-group eduportal-form-group">
			<label class="label-control" for="course name"><?php echo get_phrase('school');?></label>
			<div class="input-group input-group-lg eduportal-input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<select name="school" class="form-control eduportal-input" onchange="Departments(this.value);" required >
					<option value="">Select A School</option>
					<?php
						foreach($schools as $sch){
							echo "<option value=" . $sch['schoolid'] . ">" . $sch['schoolname'] . "</option>";
						}
					?>
				</select>
			</div>
		</div>
		
		<!-- Course Department -->
		<div class="form-group eduportal-form-group">
			<label class="label-control" for="course name"><?php echo get_phrase('department');?></label>
			<div class="input-group input-group-lg eduportal-input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
				<select class="form-control eduportal-input" id="departments"  required name="department" onChange="loadSchool(this.value);">
					<option value="">Choose A Department</option>
					
				</select>
			</div>
		</div>
	</div>
</div>

<?php endforeach; ?>