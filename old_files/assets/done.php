<?php
session_start();


       $customer_id = isset($_REQUEST['FINAL_CHECKSUM'])?$_REQUEST['FINAL_CHECKSUM']:'';
        $fullname = isset($_REQUEST['DEBITED_AMOUNT'])?$_REQUEST['DEBITED_AMOUNT']:'';
        $confirmation_code = isset($_REQUEST['CARD_HOLDER_NAME'])?$_REQUEST['CARD_HOLDER_NAME']:'';
        $descr = isset($_REQUEST['CARD_NO'])?$_REQUEST['CARD_NO']:'';
        
        echo $customer_id.' '.$fullname.' '.$confirmation_code.' '.$descr;

		
         
?>