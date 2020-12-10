<?php $usertype = 'sadmin'; ?>
<div style="height:300px; overflow:scroll;" id="msgChat">
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
</div>

<?php echo form_open('sadmin/message/send_reply/' . $current_message_thread_code, array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
    <div class="compose-message-editor">
        <textarea row="5" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="message" 
                  placeholder="<?php echo get_phrase('reply_message'); ?>" id="sample_wysiwyg" autofocus="on"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>
    </button>
    <br><br>
</div>
</form>


<script type="text/javascript">
var param = "<?php echo $current_message_thread_code; ?>";
var url = "<?php echo base_url() . 'index.php?' . $usertype . '/chat_window_refresh/'; ?>" + param;
    function scrollDiv() {
        var elem = document.getElementById('msgChat');
        elem.scrollTop = elem.scrollHeight;
    }

    window.scrollDiv();


var chaturl = "<?php echo base_url() . 'index.php?' . $usertype . '/ajaxMessageRefresh/' . $current_message_thread_code; ?>";
var INTERVAL_IN_MILISECONDS = 3000; 
function refreshChatDiv(){

        // The XMLHttpRequest object

        var xmlHttp;
        try{
            xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
        }
        catch (e){
            try{
                xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
            }

            catch (e){
                try{
                    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                }

                catch (e){
                    alert("Your browser does not support AJAX.");
                    return false;
                }
            }
        }

        // Timestamp for preventing IE caching the GET request

        fetch_unix_timestamp = function(){
            return parseInt(new Date().getTime().toString().substring(0, 10))
        }

        var timestamps = fetch_unix_timestamp();
        var nocacheurl = chaturl;

        // The code...

        xmlHttp.onreadystatechange=function(){
            if(xmlHttp.readyState==4){
                document.getElementById("msgChat").innerHTML=xmlHttp.responseText;
            }
        }
        xmlHttp.open("GET",nocacheurl,true);
        xmlHttp.send(null);
    }
    
refreshChatDiv();
window.scrollDiv();

setInterval(function (){
    refreshChatDiv();
    window.scrollDiv();
}, INTERVAL_IN_MILISECONDS);
    

</script>