<script type="text/javascript">

function getData(){
    var form = document.getElementById('student_data');
    var form_data = new FormData(form);
        var a = $('#school').val();
        alert(a);
        alert(form_data);
        console.log(form_data);
        if ($("#student_data :text[value='']").length === 0) {
    /*$.ajax({
    type:"post",
    url:"<?php echo base_url().'index.php?admin/student_data/search';?>",
    data:form_data,
    success:function(data){
        console.log(data);
        alert(data);
        
        //$("#search").val("");
     },
     processData: false, 
     contentType: false
  });*/
        }else{
            alert('Some fields are empty');
        }
}

</script>
<style>
.etti {
  position:relative;
  overflow:hidden; 
  border-top:1px solid #ddd;
  border-bottom:1px solid #ddd; 
}
.etti:before {
  content: ""; 
  position:absolute; 
  z-index: 1; 
  width:80%;  
  top: -10px; 
  height: 10px; 
  left: 2%; 
  border-radius: 100px / 5px; 
  box-shadow:0 0 18px rgba(0,0,0,0.6); 
}
.etti:after {
  content: "";
  position:absolute;
  z-index: 1;
  width:80%; 
  bottom: -10px;
  height: 10px;
  left: 2%;
  border-radius: 100px / 5px;
  box-shadow:0 0 18px rgba(0,0,0,0.6);
}
</style>

<div class="row">
	
<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-user"></i>
			<h3>Student Data</h3>
		</div>
	   <div class="widget-content">
    <div class="col-md-6">
		<?php echo form_open('sadmin/student_data/search' , array('id'=>'student_data','class' => 'form-horizontal validate','target'=>'_top'));?>
<!--form id="student_data" class="form-horizontal validate" target="_top"-->
                         
                                <div class="form-group eduportal-form-group p20">
                                <label class="label-control"><?php echo get_phrase('_school');?></label>
								<div class="input-group input-group-lg eduportal-input-group">
						         <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
								 <select class="form-control" id="school" name="school" required  onChange="checkInstitution(this.value)">
									    
										<option value="">SELECT YOUR SCHOOL</option>
										<option value ='4'>SCHOOL OF ARTS </option>
										<option value ='1'>SCHOOL OF AGRIC AND VOCATIONAL STUDIES </option>
										<option value ='5'>SCHOOL OF EDUCATION </option>
										<option value ='2'>SCHOOL OF NATURAL SCIENCES </option>
										<option value ='3'>SCHOOL OF SOCIAL SCIENCES </option>
									</select>
                                </div>
                            </div>
                            <div class="form-group eduportal-form-group p20">
                                <label class="label-control"><?php echo get_phrase('_department');?></label>
                                <div class="input-group input-group-lg eduportal-input-group">
						         <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                                    <select class="form-control" id="dept" name="dept">
                                        <option value="">Select an Institution</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group eduportal-form-group p20">
                                <label class="label-control"><?php echo get_phrase('_programme');?></label>
                                <div class="input-group input-group-lg eduportal-input-group">
						         <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                                    <select class="form-control" name="programme" onChange="showProgramme(this.value)">
										<option value="" >Select Your programme</option>
										<option value="PRE-NCE">PRE-NCE</option>
										<option value="NCE">NCE</option>
										<option value="DEGREE">DEGREE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group eduportal-form-group p20">
                                <label class="label-control"><?php echo get_phrase('programme_type');?></label>
                                <div class="input-group input-group-lg eduportal-input-group" id="progresult">
						         <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                                    <select name="prog_type" class="form-control" required= "required">
										<option value="">Select A Programme Type</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group eduportal-form-group p20">
                                <label class="label-control"><?php echo get_phrase('_level');?></label>
                                <div class="input-group input-group-lg eduportal-input-group" id="result2">
						         <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                                    <select name="level"  class="form-control">
                                           <option>Select Your Current Level</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group eduportal-form-group p20">
                                <label class="label-control"><?php echo get_phrase('_Sex');?></label>
                                <div class="input-group input-group-lg eduportal-input-group">
						         <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                                  <select type="text" name="sex" class="form-control">
                                    <option value="">Male/Female</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group eduportal-form-group p20">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" name="updateCourseOnly" style="padding:10px; 15px" class="btn btn-info"><i class="glyphicon glyphicon-floppy-saved"></i><?php echo get_phrase('Get Data');?></button>
                                    <!--button type="button" onclick="getData();" class="btn btn-info"><?php echo get_phrase('Get Data');?></button-->
                                </div>
                            </div>
</form>
</div>

		<div class="col-md-6 etti">
			<div class="row">
				<p style="font-size:18px;"><strong>School: <strong><?=$school?></strong></p>
				<p style="font-size:18px;"><strong>Department: <strong><?=$dept?></strong></p>
				<p style="font-size:18px;"><strong>Programme: <strong><?=$prog?></strong></p>
				<p style="font-size:18px;"><strong>Programme Type: <strong><?=$prog_type?></strong></p>
				<p style="font-size:18px;"><strong>Level: <strong><?=$level?></strong></p>
				<p style="font-size:18px;"><strong>Sex: <strong><?=$sex?></strong></p>
			</div>
			<div class="row">
				<p style="font-size:40px; text-align:left;">Total = <?=count($result)?></p>
			</div>

	    </div>
		</div>
	</div>
</div>

<script type="text/javascript">



    jQuery(document).ready(function($)
    {
        var datatable = $("#table_export").dataTable({

            "sPaginationType": "bootstrap",

            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",

            "oTableTools": {

                "aButtons": [
                    {
                        "sExtends": "xls",

                        "mColumns": [0, 1, 2, 3, 4, 5, 7]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4, 5, 7]
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