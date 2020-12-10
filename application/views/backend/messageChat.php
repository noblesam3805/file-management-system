<?php
    $messages = $this->db->get_where('message', array('message_thread_code' => $current_message_thread_code))->result_array();
    foreach ($messages as $row):

        $sender = explode('-', $row['sender']);
        $sender_account_type = $sender[0];
        $sender_id = $sender[1];
        ?>
        <div class="mail-info">

            <div class="mail-sender " style="padding:7px;">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $this->crud_model->get_image_url('users', $sender_id); ?>" class="img-circle" width="30"> 
                    <span><?php echo $this->db->get_where('sadmin', array('sadmin_id' => $sender_id))->row()->name; ?></span>
                </a>
            </div>

            <div class="mail-date" style="padding:7px;">
                <?php echo date("d M, Y", $row['timestamp']); ?> 
            </div>
        </div>

        <div class="mail-text">         
            <p> <?php echo $row['message']; ?></p>
        </div>

    <?php endforeach; ?>