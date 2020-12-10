<?php 
//$school = $this->db->query("select *  from schools order by schoolname");
$student_exist = $this->db->get_where('student', array("portal_id" => $param1))->row();
?> 
<p style="font-size:13px; color:#9d0000;"><?php if(isset($_SESSION['err_msg'])){echo $_SESSION['err_msg'];} ?></p>
<div class="row">

	<div class="col-md-12">



    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs bordered">

			<li  class="active">

            	<a href="#manage" data-toggle="tab"><i class="entypo-menu"></i>

					<?php echo "Manage Student Medical Files";?>

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
                  <form id="imageform2" name="imageform2"  method="post" enctype="multipart/form-data" action='index.php?sadmin/save_student_folder_attachment/<?php echo $id;?>' onsubmit="" >
<p>
		<div class="col-md-12 no-p receipt-image-div">

								<img src="<?php echo 'uploads/student_image/' . $student_exist->student_id. '.jpg'; ?>" width="150px" height="150px" />

							</div>
	</p>
	<p align="left">
	

									Application No: <?php echo $student_exist->portal_id; ?></p><br/>
									
									
                                
<p align="left">
							Fullname: <?php  echo $student_exist->surname; ?> <?php  echo $student_exist->othername; ?> 


							
</p><br/>             

			 <?php
$student_attachment_info  = $this->db->get_where('student_medical_attachments', array('application_number' => $param1))->result_array();
?>
<?php if ( !empty($student_attachment_info) ) { ?>
<table class="table table-bordered table-striped dataTable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('date');?></th>
       
            <th><?php echo get_phrase('document_type');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('download');?></th>
            <?php if($laboratorist_id == $this->session->userdata('login_user_id')) { ?>
                <th><?php echo get_phrase('options');?></th>
            <?php } ?>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($student_attachment_info as $row) { ?>   
            <tr>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
          
                <td><?php echo $row['doc_type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="<?php echo base_url().'uploads/student_medical_attachments/'.$row['file_name']; ?>" class="btn btn-blue btn-icon icon-left">
                        <i class="entypo-download"></i>
                        Download
                    </a>
                </td>
              
                <td>
                    <a href="<?php echo base_url();?>index.php?sadmin/delete_student_xray_results/<?php echo $row['attachment_id']?>/<?php echo $id;?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
                </td>
                
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    <p style="font-size: 15px;">No attachment has been created/added for this Student yet.</p>
<?php } ?>
<hr>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_scan/result_attachment'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

             
                    
                    <div class="form-group">.
                        <label class="col-sm-3 control-label"><?php echo get_phrase('document'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>
                    <br/><br/><br/>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('document_type'); ?></label>

                        <div class="col-sm-5">
                            <select name="document_type" class="form-control">
                              <option value=""></option>
                                <option value="pdf"><?php echo get_phrase('pdf'); ?></option>
								<option value="pdf"><?php echo get_phrase('word'); ?></option>
								 <option value="pdf"><?php echo get_phrase('image'); ?></option>

                            </select>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-5">
                              <select name="description" class="form-control">
                                <option value=""></option>
                                <option value="XRay Scan">XRay Scan</option>
								<option value="XRay Scan Report">XRay Scan Report</option>
						

                            </select>
                        </div>
                    </div>
                     <br/><br/>
                    <input type="hidden" name="application_number" value="<?php echo $param1; ?>">

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>


<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
                  
                </div>
				
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



