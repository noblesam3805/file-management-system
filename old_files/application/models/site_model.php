<?php
class Site_Model extends CI_Model
{

function getTerminalID(){
		return $this->db->get_where('app_settings', array("settings" => 'terminalID'))->row()->value;
	}
	

public function get_all_hnd_form_categories()
{
$sql = "select 	application_typeid, application_type,application_code from application_type where activated = ?";
$q =$this->db->query($sql,1);
if($q->num_rows() > 0)
{
foreach ($q->result() as $row)
{
   // echo $row->id." ".site_name." ".site_url;
	$data[] = $row;
}
return $data;
}
else
{
return "No Category was Found!";
}

}

  public function create_payment_invoice($data)
  {
	/*  $username = $data['mobile_no'];
	   $sql= "SELECT* from invoice_gen where mobile_no = ?";
	  $q =$this->db->query($sql,$username);
      if($q->num_rows() > 0)
      {
		   return 0;
		   exit;
	  }
	  else
	  {*/
		   $q =$this->db->insert('invoice_gen',$data);
		   // $this->db->insert('invoice_gen_back',$data);

           return $q;
	  //}
	 
	  
  

  }
  
   public function get_identification_no($data)
  {
	  $application_type_id = $data['application_type_id'];
	  $sql= "SELECT max(identification_no) as idm from invoice_gen where application_type_id = ?";
	  $q =$this->db->query($sql,$application_type_id);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->idm +1;
//	$data[] = $row;
         }
	  }

  }
  
  
    public function get_invoice_id()
  {
	  //$application_type_id = $data['application_type_id'];
	  $sql= "SELECT max(application_invoice_id) as inv from invoice_gen";
	  $q =$this->db->query($sql);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->inv +1;
//	$data[] = $row;
         }
	  }

  }
              public function get_lpad_med_id($data)
  {
	  $med_form_id = $data['med_form_id'];
	  $sql= "SELECT LPAD('$med_form_id',4,'0') as padded from medical_form";
	  $q =$this->db->query($sql);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->padded;
//	$data[] = $row;
         }
	  }

  }



   public function get_med_form_id()
  {
	  //$application_type_id = $data['application_type_id'];
	  $sql= "SELECT max(med_form_id) as inv from medical_form";
	  $q =$this->db->query($sql);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->inv;
//	$data[] = $row;
         }
	  }
	  else{
		return 1;  
		 }

  }
  
  public function get_lpad_invoice_id($data)
  {
	  $application_type_id = $data['application_invoice_id'];
	  $sql= "SELECT LPAD('$application_type_id',10,'0') as padded";
	  $q =$this->db->query($sql);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->padded;
//	$data[] = $row;
         }
	  }

  }
  
  public function get_lpad_app_id($data)
  {
	  $application_id = $data['application_id'];
	  $sql= "SELECT LPAD('$application_id',6,'0') as padded";
	  $q =$this->db->query($sql);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->padded;
//	$data[] = $row;
         }
	  }

  }
  
  
   
  
    public function get_lpad_exam_no($data)
  {
	  $identification_no = $data['identification_no'];
	  $sql= "SELECT LPAD('$identification_no',4,'0') as padded";
	  $q =$this->db->query($sql);
      if($q->num_rows() > 0)
      {
		  
		  
		foreach ($q->result() as $row)
         {
   return $row->padded;
//	$data[] = $row;
         }
	  }

  }
  
 
 
  

}

?>