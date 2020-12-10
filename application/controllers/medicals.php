<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
     session_start();
/*
 *  @author : Emmanuel Etti
 *  @contributor : Sunday Okoi
 *  18th January, 2015
 *  Eduportal
 *  www.autopathgrp.com
 *
 */


class Medicals extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function begin()  {
       /*$this->load->model('site_model');
         $page_data["Staff_no"] = $this->site_model->no_of_xray_apps_Staff();
		$page_data["OND_no"] = $this->site_model->no_of_xray_apps_OND();
		$page_data["HND_no"] = $this->site_model->no_of_xray_apps_HND();*/
		
		 $page_data['page_name']  = 'begin';
     
        $page_data['page_title'] = get_phrase('Federal Polytechnic Nekede | DIGITAL XRAY');
		$page_data['page_sub_heading'] ="DIGITAL XRAY CENTER: RADIOLOGICAL REQUEST FORM";
         $this->load->view('backend/medicals_print', $page_data); 

    }
	function populate_details($category,$appNoPIN,$level){
		$appNoPIN = str_replace("__","/",$appNoPIN);
		$level = str_replace("__"," ",$level);
		if($category=="staff_no"){
			$catName = "Staff No";
			$app_type = "Staff";
			$data = $this->db->get_where("staff_data",array("staff_code"=>$appNoPIN))->row();
		}
		elseif($category=="reg_no"){
			$catName = "Reg. No.";
			$app_type = "Student";
			$data1 = $this->db->get_where("eduportal_fees_payment_log",array("regno"=>$appNoPIN,"payment_fee_type"=>2))->row();
			$data = $this->db->get_where("student",array("reg_no"=>$data1->regno))->row();
		}
		else{
			$catName = "School Fees PIN";
			$app_type = "Student";
			$data1 = $this->db->get_where("eduportal_fees_payment_log",array("payment_code"=>$appNoPIN,"payment_fee_type"=>2))->row();
			$data = $this->db->get_where("student",array("reg_no"=>$data1->regno))->row();		}
		if($data){
			?>
            <hr />
            <?php
			if($category=="staff_no"){?>
            <div class="form-group"><label class="col-sm-3 control-label">Form No</label>
<div class="col-sm-5"><br>
                                    <input name="app_no" type="text" class="form-control" id="app_no" style="height:30px" value="<?php echo $data->staff_code;?>" readonly="readonly" required />
                                </div>
                            </div>
            <?php
			}
			else{
				?>
               <div class="form-group"><label class="col-sm-3 control-label">Form No</label>
<div class="col-sm-5"><br>
                                    <input name="app_no" type="text" class="form-control" id="app_no" style="height:30px" value="<?php echo $data->reg_no;?>" readonly="readonly" required />
                                </div>
                            </div> 
                <?php
			}
		?>
        <input type="hidden" name="level" id="level" value="<?php echo $level;?>" />
        <input type="hidden" name="forStudent" id="forStudent" value="<?php echo $data->reg_no;?>" />
        <input type="hidden" name="forStaff" id="forStaff" value="<?php echo $data->staff_code;?>" />
        <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type;?>" />
        
         <div class="form-group"><label class="col-sm-3 control-label">Surname</label>
<div class="col-sm-5"><br>
                                    <input name="surname" type="text" class="form-control" id="surname" style="height:30px" value="<?php echo $data->name;?>" readonly="readonly" required />
                                </div>
                            </div>
							<div class="form-group"><label class="col-sm-3 control-label">Other name</label>
    <div class="col-sm-5"><br>
                                    <input name="othername" type="text" class="form-control" id="othername" style="height:30px" value="<?php echo $data->othername;?>" readonly="readonly" required/>
                              </div>
                            </div><div class="form-group"><label class="col-sm-3 control-label">Sex</label>
                  <div class="col-sm-5"><br>
                    <label for="sex"><?php 
					$sex = array("Male","Female"); ?></label>
                                    <select name="sex" id="sex" required>
                                      <option value="<?php echo $data->sex;?>">Select</option>
                                     <?php for($s=0;$s<=1;$s++){
										 if($sex[$s]==$data->sex){
											 $sel = "selected";
										 }
										 
										 ?> <option value="<?php echo $sex[$s];?>" <?php if(isset($sel)){ echo $sel; } ?>><?php echo $sex[$s];?></option>
                                     <?php
									 unset($sel);
									 }
									 ?>
                                    </select>
                  </div>
                            </div><div class="form-group"><label class="col-sm-3 control-label">Age</label>
                  <div class="col-sm-5"><br>
                                    <input type="text" class="form-control" style="height:30px" name="age" value="" required id="age" />
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-5"><br>
                    <textarea name="address" rows="4" class="form-control" id="address" style="height:30px" required="required"><?php echo $data->address;?></textarea>
                                </div>
                            </div><div class="form-group"><label class="col-sm-3 control-label">Date</label>
                  <div class="col-sm-5"><br>
                                    <input name="date" type="text" class="form-control" id="date" style="height:30px" readonly="readonly" value="<?php echo date('d/m/Y');?>" />
                                </div></div><div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Save');?></button>
                              </div></div>
        <?php	
		}
		else{
			echo "No record for ".$catName." :".$appNoPIN;
		}
		
	}
	public function pro_med_form(){
		$this->load->model('site_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('surname', 'Surname', 'required');
		$this->form_validation->set_rules('othername', 'Othername', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('sex', 'Sex', 'required');
		if($this->form_validation->run() == FALSE){
		?>
        <script language="javascript">
				alert("All fields are compulsory!");
				window.location.href="<?php echo base_url().'index.php?medicals/begin';?>";
				</script>
        <?php
		}
		else{
			//$app_no = $this->input->post('app_no');
			//$surname = $this->input->post('surname');
			//$othername = $this->input->post('othername');
			$address = $this->input->post('address');
			$age = $this->input->post('age');
			$sex = $this->input->post('sex');
			$level = $this->input->post('level');
			$category = $this->input->post('app_type');
			
			$appNo1 = $this->input->post('forStaff');
			$appNo2 = $this->input->post('forStudent');
			
			$dy = date('d');
			$mt = date('m');
			$yr = date('Y');
			$form_date = $this->input->post('date');
			
			//info
			if($category=="Staff"){
				$data = $this->db->get_where("staff_data",array("staff_code"=>$appNo1))->row();
				$app_no= $data->staff_code;
			}
			else{
				$data = $this->db->get_where("student",array("reg_no"=>$appNo2))->row();
				$app_no= $data->reg_no;	
			}
			
			//check for previous record
			$check = $this->db->get_where("medical_form",array("app_no"=>$app_no))->row();
			if(!$check){
				$new['app_no']= $app_no;
				$new['surname']= $data->name;
				$new['othername']= $data->othername;
				$new['address']= $address;
				$new['age']= $age;
				$new['sex']= $sex;
				$new['level']= $level;
				$new['category']= $category;
				$new['dy']= $dy;
				$new['mt']= $mt;
				$new['yr']= $yr;
				$new['form_date']= $form_date;
				
				$this->db->insert("medical_form",$new);
				
				$med_form_id = $this->site_model->get_med_form_id();
				
				$lpad_id =$this->site_model->get_lpad_med_id(array('med_form_id'=>$med_form_id));
				$upd["xray_no"]="FPN/MED/18".$lpad_id;
				
				$this->db->where("app_no",$app_no)
						->update("medical_form",$upd);
			}
			$app_no2 = str_replace("/","__",$app_no);
			?>
        <script language="javascript">
				alert("Record saved successfully!");
				window.location.href="<?php echo base_url().'index.php?medicals/med_form/'.$app_no2;?>";
				</script>
        <?php
		}
		
	}
	
	function med_form($app_no){
		$page_data['page_name']  = 'form';
     	$page_data['app_no'] = str_replace("__","/",$app_no);
        $page_data['page_title'] = get_phrase('Federal Polytechnic Nekede | DIGITAL XRAY');
		$page_data['page_sub_heading'] ="DIGITAL XRAY CENTER: RADIOLOGICAL REQUEST FORM";
         $this->load->view('backend/medicals_print', $page_data); 
	}


}


