<?php

	 class User_model extends Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function User_model() 
	  {
		parent::Model();
				
      }//Controller End
	  
	
	
	// --------------------------------------------------------------------

	/**
	 * Get Userslist
	 *
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getUserslist($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('users');
		$this->db->join('roles', 'roles.id = users.role_id','left');	
			
	 	$this->db->select('users.id,roles.role_name,users.user_name,users.name,users.role_id,users.country_symbol,users.message_notify,users.password,users.email,users.city,users.state,users.country,users.profile_desc,users.rate,users.project_notify,users.user_status,users.activation_key,users.created,users.verify_key,users.verify_by_phone,users.verify_billing_address,users.company_name');
		 
		$result = $this->db->get();
		return $result;
		
	 }//End of getUsers Function
	 
	
	
	 // --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsers($conditions=array(),$fields='')
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		
		$this->db->from('users');
		$this->db->join('roles', 'roles.id = users.role_id','left');	
		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('users.id,roles.role_name,users.user_name,users.name,users.role_id,users.country_symbol,users.message_notify,users.password,users.email,users.city,users.state,users.country,users.profile_desc,users.rate,users.project_notify,users.user_status,users.activation_key,users.created,users.last_activity,users.num_reviews,users.user_rating,users.logo,users.password_normal,users.verify_key,users.verify_by_phone,users.verify_billing_address,users.address,users.company_name');
		 
		$result = $this->db->get();
		return $result;
		
	 }//End of getUsers Function
	 
		
		
}
// End User_model Class
   
/* End of file User_model.php */ 
/* Location: ./app/models/User_model.php */
?>