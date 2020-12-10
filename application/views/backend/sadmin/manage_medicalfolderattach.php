<?php
$patient_attachment_info  = $this->db->get_where('meditech_patient_attachment', array('patient_id' => $param2))->result_array();
?>
<?php if ( !empty($patient_attachment_info) ) { ?>
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
        <?php foreach ($patient_attachment_info as $row) { ?>   
            <tr>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
          
                <td><?php echo $row['doc_type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="<?php echo base_url().'uploads/patient_folder_attachments/'.$row['file_name']; ?>" class="btn btn-blue btn-icon icon-left">
                        <i class="entypo-download"></i>
                        Download
                    </a>
                </td>
              
                <td>
                    <a href="<?php echo base_url();?>index.php?receptionist/manage_folderattach/delete/<?php echo $row['attachment_id']?>/<?php echo $row['patient_id']?>" 
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
    <p style="font-size: 15px;">No attachment has been created/added for this Patient yet.</p>
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

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?receptionist/manage_folderattach/create" method="post" enctype="multipart/form-data">


   
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('document'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('document_type'); ?></label>

                        <div class="col-sm-5">
                            <select name="document_type" class="form-control">
                              <option value=""></option>
                                <option value="pdf"><?php echo get_phrase('pdf'); ?></option>

                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-9">
                              <select name="description" class="form-control">
                                <option value=""></option>
                                <option value="Registration Form">Registration Form</option>
								<option value="O/G Record">O/G Record</option>
								<option value="Medical Diagnosis">Medical Diagnosis</option>
								<option value="Drug Chart">Drug Chart</option>
								<option value="Laboratory Result">Laboratory Result</option>

                            </select>
                        </div>
                    </div>
                    
                    <input type="hidden" name="patient_id" value="<?php echo $param2; ?>">

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