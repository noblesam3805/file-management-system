<style type="text/css">
	.eduportal-form-group{
		margin-left:0px !important;
	}
	.eduportal-form-group .eduportal-input-group{
		border:1px solid #999;
	}
	.eduportal-form-group label, .eduportal-file-input label{
		font-size:16px;
		margin-top:10px;
		color:#555;
		
	}
	.eduportal-input-group .eduportal-input{
		border-left:1px solid #999;
	}
	.eduportal-col-2{
		margin-left:20px;
	}
	.eduportal-form-group .btn{
		border-radius:2px !important;
		padding:10px !important;
		float:right !important;
		font-size:13px;
		margin-top:35px;
	}
	.eduportal-file-input .thumbnail img{
		border:1px solid #777;
		padding:2px;
		border-radius:3px;
	}
	.eduportal-info{
		background:#AAAAFF;
		padding:10px;
		color:#333;
		font-size:16px;
		border-radius:2px;
	}
	.eduportal-info a{ 
		color:#DF5226;
	}
	.eduportal-report{
		padding:7px;
		background:#485162;
		color:#e5e5e5;
		text-align:center;
		font-size:15px;
		margin-top:10px;
		border-radius:2px;
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
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="glyphicon glyphicon-plus-sign"></i> 
					<?php echo get_phrase('add_courses');?>
                    	</a></li>
						
			<li class="<?php if(isset($_SESSION['excel-report'])){ echo 'active';} ?>">
            	<a href="#excel" data-toggle="tab"><i class="entypo-book"></i> 
					<?php echo get_phrase('upload_bulk_courses');?>
                </a>
			</li>
			<li class="<?php if(isset($_SESSION['edit-report'])){ echo 'active'; } ?>">
            	<a href="#edit" data-toggle="tab"><i class="glyphicon glyphicon-edit"></i> 
					<?php echo get_phrase('edit_course');?>
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------->
        <?php 
			/*$report = $this->session->userdata('report'); 
			if(!empty($report)){?>
				<div style="width:70%; height:30px; text-align:center; margin:15px auto; border-radius:3px; color:#424E63;"><?php echo $report; 
			}*/?>
			</div>
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('sadmin/courses/insert_course' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="col-md-8" style="margin:auto; float:none;">
						<?php
							if(isset($_SESSION['report'])){
								echo "<p class='eduportal-report'> <i class='glyphicon glyphicon-info-sign'></i> &nbsp; " . $_SESSION['report'] . "</p>";
							}
						?>
					</div>
					<div class="col-md-5">
						<!-- Course Name -->
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name"><?php echo get_phrase('course_name');?></label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="coursename" class="form-control eduportal-input" required placeholder="Course Name"/>
							</div>
						</div>
						
						<!-- Course Code -->
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name"><?php echo get_phrase('course_code');?></label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="coursecode" class="form-control eduportal-input" required placeholder="Course Code"/>
							</div>
						</div>
						
						<!-- Credit Load -->
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name"><?php echo get_phrase('credit_load');?></label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<input type="text" name="creditload" class="form-control eduportal-input" placeholder="Credit Load"/>
							</div>
						</div>
						
					</div>
					<div class="col-md-1">
					
					</div>
					<div class="col-md-5">
						<!-- Course Semester -->
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name"><?php echo get_phrase('course_semester');?></label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<select class="form-control eduportal-input" name="coursesemester">
									<option value="">Select An Option</option>
									<option value="1">SEMESTER 1</option>
									<option value="2">SEMESTER 2</option>
								</select>
							</div>
						</div>
						
						<!-- Course Year -->
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name"><?php echo get_phrase('course_year');?></label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<select class="form-control eduportal-input" name="courseyear">
									<option value="">Select An Option</option>
									<option value="1">LEVEL 1</option>
									<option value="2">LEVEL 2</option>
									<option value="3">LEVEL 3</option>
									<option value="4">LEVEL 4</option>
									<option value="5">LEVEL 5</option>
								</select>
							</div>
						</div>
						
						<!-- Course Programme Type -->
						<div class="form-group eduportal-form-group">
							<label class="label-control" for="course name"><?php echo get_phrase('programme_type');?></label>
							<div class="input-group input-group-lg eduportal-input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								<select class="form-control eduportal-input" required name="progtype" >
									<option value="">Choose A Programme Type</option>
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
						
						<div class="form-group eduportal-form-group">
							<label>&nbsp;</label>
							<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hand-right"></i> &nbsp; Create Course &rsaquo;&rsaquo;&rsaquo;</button>
						</div>
					</div>
                            
                </div>
			</div><?php echo form_close(); ?>
		
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box" id="excel" style="padding: 5px">
                <div class="box-content" >
					<?php echo form_open('sadmin/courses/upload_excel' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    <div class="col-md-7 eduportal-file-input" style="margin-top:10px">
						<div class="col-md-12">
							<p class="eduportal-info robotol">Please ensure that you follow the right excel sheet arrangement. This is to ensure that you have a successful upload. You can download the <a href="<?php echo base_url() . 'files/sample/sample.xls'; ?>"> sample excel sheet here </a></p>
						</div>
						<div class="form-group col-md-8" style="margin-left:10px;">
							<div class="col-md-12">
								<label>
									<?php echo get_phrase('_excel_file');?>
								</label>
							</div>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 200px; background:none;" data-trigger="fileinput" >
									<img src="<?php echo base_url() . 'images/excel.png'; ?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail imgframe" style="width: 200px; height: 200px; background:none; font-weight:bold; border:1px solid #777; border-radius:3px; color:#222;"></div>
								<div>
									<span class="btn btn-primary btn-file">
										<span class="fileinput-new"> <i class="glyphicon glyphicon-hand-right"></i> &nbsp; Select Excel File</span>
										<span class="fileinput-exists"> <i class="glyphicon glyphicon-refresh"></i> &nbsp; Change </span>
										<input type="file" required name="userfile" accept=".csv">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"> <i class="glyphicon glyphicon-remove"></i> &nbsp; Remove</a>
								</div>
							</div>
						</div>
					</div>
                </div><?php echo form_close(); ?>
			</div>
			
			<div class="tab-pane box" id="edit" style="padding: 5px">
                <div class="box-content" >
					<?php echo form_open('sadmin/courses/upload_excel' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    <div class="col-md-12 eduportal-file-input" style="margin-top:10px">
						<table  class="table table-bordered datatable" id="table_export3">

							<thead>

								<tr>
									<th><div><?php echo get_phrase('#');?></div></th>

									<th><div><?php echo get_phrase('Course_Name');?></div></th>

									<th><div><?php echo get_phrase('Course_code');?></div></th>

									<th><div><?php echo get_phrase('Credit_load');?></div></th>

									<th><div><?php echo get_phrase('Course_year');?></div></th>

									<th><div><?php echo get_phrase('Course_semester');?></div></th>

									<th><div><?php echo get_phrase('Programme_type');?></div></th>
									<th><div><?php echo get_phrase('_action');?></div></th>

								</tr>

							</thead>

							<tbody>

								<?php //$par = "FIB"; //$this->db->where('bankcode', $par); ?>
								<?php $i=1;?>

								<?php foreach($courses as $row):?>

								<tr>
									<td><?php echo $i;?></td>

									<td><?php echo $row['course_name'];?></td>

									<td><?php echo $row['course_code'];?></td>

									<td><?php echo $row['credit_load'];?></td>

									<td><?php echo $row['course_year'];?></td>

									<td><?php echo $row['course_semester'];?></td>

									<td><?php echo $row['prog_type'];?></td>

									<td><a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/coursepopup/modal_course_edit/<?php echo $row['id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('_edit');?>
                                               	</a></td>
									<?php $i++;?>
								</tr>
								

								<?php endforeach;?>

							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(isset($_SESSION['report'])){
			unset($_SESSION['report']);
		}
	?>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      

<script type="text/javascript">



    jQuery(document).ready(function($)

    {

        



        var datatable = $("#table_export3").dataTable({

            "sPaginationType": "bootstrap",

            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",

            "oTableTools": {

                "aButtons": [

                    

                    {

                        "sExtends": "xls",

                        "mColumns": [0, 1, 2, 3, 4, 5,6, 7]

                    },

                    {

                        "sExtends": "pdf",

                        "mColumns": [0, 1, 2, 3, 4, 5,6, 7]

                    },

                    {

                        "sExtends": "print",

                        "fnSetText"    : "Press 'esc' to return",

                        "fnClick": function (nButton, oConfig) {

                            datatable.fnSetColumnVis(1, true);

                            datatable.fnSetColumnVis(5, true);

                            

                            this.fnPrint( true, oConfig );



                            window.print();

                            

                            $(window).keyup(function(e) {

                                  if (e.which == 27) {

                                      datatable.fnSetColumnVis(1, true);

                                      datatable.fnSetColumnVis(5, true);

                                  }

                            });

                        },

                        

                    },

                ]

            },

            

        });

        

        $(".dataTables_wrapper select").select2({

            minimumResultsForSearch: -1

        });

    });

        

</script>