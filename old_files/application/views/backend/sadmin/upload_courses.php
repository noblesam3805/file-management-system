<p style="font-size:13px; color:#9d0000;">&nbsp;</p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Courses";?>

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
			
			<h3>Upload Courses !</h3>
			<hr />
			<p>&nbsp;</p>
			<div style="margin-left:30px">
			  <p>Note Supported format **CSV </p>
			  <p>&nbsp;</p>
			  <p><span style="font-size:13px; color:#9d0000;">
			    <?php if(isset($_SESSION["error"])){ echo $_SESSION["error"];}?>
			  </span> 
			    <div style="width:600px; height:100%" align="center">
                  <form id="imageform" name="imageform" method="post" enctype="multipart/form-data" action='index.php?sadmin/ajax_upload_courses' >
                      <p>
                        <input type="file" id="photoimg" name="photoimg" style="width: 228px" class="" />
                      </p>
                      <p>
                        <input type="submit" name="submit" id="submit" value="Upload">
                      </p>
                  </form>
                  
                </div>
				<div id='preview'>
                
				 
				  <div class="widget stacked widget-table">
	   <div class="widget-content">	
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table width="100%" class="table table-bordered datatable" id="table_export" >
      <thead>
        <tr bgcolor="#FFFFFF">
          <th width="61"><div align="left" ><span  style="color:#000">ID</span></div></th>
          <th width="197"><div align="left" class="style6"><span class="style4" style="color:#000">COURSE CODE</span></div></th>
          <th width="281"><div align="left" class="style6"><span class="style4" style="color:#000">COURSE TITLE </span></div></th>
          <th width="113"><div align="center" class="style6"><span class="style4" style="color:#000">ACTIVATED</span></div></th>
		  <th width="157" align="center"><div align="center" class="style6"><span class="style4" style="color:#000">ACTION</span></div></th>
 
        
        </tr>
      </thead>
    
	  <?php 
	  $id=1;
	// $query =mysql_query("select* from eduportal_courses_temp where sid = '$_SESSION[sid]'") or die("1");
	 $query =sqlsrv_query($conn,"select* from eduportal_courses order by course_code") or die("1");
								while(list($id1,$coursecode,$ct,$code,$activated) = sqlsrv_fetch_array($query))
								{?>
         <tbody> 
           <tr bgcolor="#E2E2E2">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             
           </tr>
           <tr>
          <td><div align="left"><span class="style5"><?php echo $id;?></span></div></td>
          <td><div align="left"><span class="style5"><?php echo $coursecode; ?></span></div></td>
         
          <td><div align="left"><span class="style5" id="courseHint<?php echo $id1;?>"><?php echo $ct  ;?></span><span class="style5" id="courseinput<?php echo $id1;?>" style="display:none;"><input name="coursename<?php echo $id1;?>" class="comme" id="coursename<?php echo $id1;?>" value="<?php echo $ct  ;?>" size="50" onkeydown="checkCommentBoxInputKey(event,this.value,<?php echo $id1;?>);"/></span><span id="commload<?php echo $id1;?>"></span></div></td>
		 
          <td><div align="center"><span class="style5">
            <?php if($activated=="1"){echo "TRUE";} else { echo "FALSE";};?>
          </span></div></td>
          <td align="center"><a href="#" onclick="OpenEditCourse(<?php echo $id1;?>)">Edit Details</a></td>
        </tr>
				  <?php 
				  $id = $id +1;}?></tbody>
</table></div>&nbsp;</p>
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

<?php if(isset($_SESSION["error"])){ unset($_SESSION["error"]);}?>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
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
                        "mColumns": [0, 1, 2, 3]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3]
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