<?php
$test_id          = $param2;
$laboratorist_id  = $param3;
$test_attachment_info  = $this->db->get_where('meditech_test_attachment', array('test_id' => $param2))->result_array();
?>
<?php if ( !empty($test_attachment_info) ) { ?>
<table class="table table-bordered table-striped dataTable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('report_type');?></th>
            <th><?php echo get_phrase('document_type');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('download');?></th>
            <?php if($laboratorist_id == $this->session->userdata('login_user_id')) { ?>
                <th><?php echo get_phrase('options');?></th>
            <?php } ?>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($test_attachment_info as $row) { ?>
            <tr>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                <td><?php echo $row['report_type']; ?></td>
                <td><?php echo $row['doc_type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="<?php echo base_url().'uploads/lab_report_attachments/'.$row['file_name']; ?>" class="btn btn-blue btn-icon icon-left">
                        <i class="entypo-download"></i>
                        Download
                    </a>
                </td>
                <?php if($laboratorist_id == $this->session->userdata('login_user_id')) { ?>
                <td>
                    <a href="<?php echo base_url();?>index.php?laboratorist/manage_attachment/delete/<?php echo $row['attachment_id']?>"
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    <p style="font-size: 15px;">No attachment has been created/added for this test yet.</p>
<?php }  ?>
<hr>


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
