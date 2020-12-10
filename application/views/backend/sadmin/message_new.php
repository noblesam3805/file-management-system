<?php $facultyDetails = $this->db->query("select *  from faculty");
?>
<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h3>
</div>

<div class="mail-compose">

    <?php echo form_open('sadmin/message/send_new', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2" name="reciever">

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
           
		   	<?php foreach($facultyDetails->result() as $row1)
												{?>
		   
		   <optgroup label="<?php  echo $row1->faculty_name;?>">
                <?php
                $admin_info = $this->db->get_where('sadmin', array('unit_sch_id' => $row1->faculty_id))->result_array();
                    foreach ($admin_info as $row) { ?>

                        <option value="sadmin-<?php echo $row['sadmin_id']; ?>">
                            - <?php echo $row['name']; ?></option>

                <?php } ?>
            </optgroup>
           <?php 
	}
	?>
        </select>
    </div>


    <div class="compose-message-editor">
        <textarea row="5" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>" 
            id="sample_wysiwyg"></textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>

    </button>
</form>

</div>