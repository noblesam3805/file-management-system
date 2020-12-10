
<?php 

/** 
 *
 * Users chat functions are handled by this controller.
 *
 * @package	    Controllers
 * @author		Sumith Harshan
 * @version		Version 1.5
 * @created		19 10 2012
 * @link		http://www.faq.pctrickers.com 
*/
 
class Chat extends Controller {

	//Global variable to holds the output data for each view 
    public $outputData;		
	public $loggedInUser;
	
	
	function Chat()
    {
		parent::Controller();
		session_start();
			
		//Get Config Details From Db
		$this->config->db_config_fetch();
		
	   //Manage site Status 
		if($this->config->item('site_status') == 1)
		redirect('offline');		
		
		$this->load->model('user_model');
		
		//load Helpers
		$this->load->helpers('users');
				
		//Load the session library
		$this->load->library('session');		
    }

	
}  // End of the class

?>