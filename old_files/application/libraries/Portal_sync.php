<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



  /**
    * @author Emmanuel Etti
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property mailbox_actions          $mailbox_actions
    * @property user_actions          $user_actions
    * @property employees_actions          $employees_actions
    */



  class portal_sync

  {





	//rtype = plain/json/xml



	//private $api_url = "http://localhost/OtimkpuSMS/api/sms_handler.php";

    private $balance = 0.0;

    private $api_url = "http://localhost/portalSync/query.php";

    private $status_msg = "";

    private $status_code = "";
	



	public function __construct()

	{



	}

	function fetch_details_fpno($payCode,$student_id){
		$payCode = str_replace("|","__",$payCode);
		$payCode = str_replace("-","_",$payCode);
		?>
			<script language="javascript">
			//load('http://162.144.134.70/nekede/index.php?student/fetch_portal_info/'+<?php echo $$student_id;?>);
			window.location.href="http://fpno.edu.ng/fpno/site/fetch_portal_info/<?php echo $payCode;?>/<?php echo $student_id;?>";
			</script>
			<?php
	}

}

/* End of file Etranzact.php */